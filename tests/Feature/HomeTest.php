<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Models\User;
use App\Models\Table;
use App\Models\Content;
use Database\Seeders\ContentSeeder;
use Illuminate\Support\Facades\Auth;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    use RefreshDatabase;
 

    public function testIfHomePageRuningCorrectly()
    {
        // Run a specific seeder...
        $this->seed(ContentSeeder::class);
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testIfDatabaseCanSaveContent()
    {
        $content = New Content;
        $content->name = 'New Content';
        $content->content = 'Content';
        $content->save();

        //Assert
        $this->assertDatabaseHas('contents', [
            'name'      => 'New Content',
            'content'   => 'Content',
        ]);
    }

    
    public function testIfAdminCanAddTable()
    {
       
        $this->seed();
        $this->seed(RoleAndPermissionSeeder::class);
        $admin = User::where('name', 'Admin')->first();

        
        $this
        ->actingAs($admin)
        ->post('/admin/tables', [
            'name'  => 'table',
            'guest_number' => 4,
            'status' => 'available',
            'location' => 'upstair',
            'user_id' => $admin->id,
            '_token' => csrf_token(),
            
        ])->assertStatus(302)
        ->assertSessionHas('info');

        $this->assertEquals(session('info'), 'Vytvorili ste nový stôl');

    }

    public function testIfTableFormIsValidated()
    {
       
        $this->seed();
        $this->seed(RoleAndPermissionSeeder::class);//seed() not seeding role table
        $admin = User::where('name', 'Admin')->first();

        
        $this
        ->actingAs($admin)
        ->post('/admin/tables', [
            'name'  => '',
            'guest_number' => '',
            'status' => '',
            'location' => '',
            'user_id' => $admin->id,
            '_token' => csrf_token(),
            
        ])->assertStatus(302)
        ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();

        //dd($messages->getMessages()); //for dump messages

        $this->assertEquals($messages['name'][0], 'The name field is required.');
        $this->assertEquals($messages['location'][0], 'The location field is required.');

    }

    public function testIfAdminCanUpgradeTable()
    {
       
        $this->seed();
        $this->seed(RoleAndPermissionSeeder::class);
        $admin = User::where('name', 'Admin')->first();

        $table = New table;
        $table->name = 'New table';
        $table->guest_number = 1;
        $table->location = 'new';
        $table->status = 'new';
        $table->save();

        //Assert
        $this->assertDatabaseHas('tables', [
            'name'      => 'New table',
            'guest_number' => 1,
            'location' => 'new',
            'status' => 'new',
        ]);

        $this
        ->actingAs($admin)
        ->put("/admin/tables/{$table->id}", [
            'name'  => 'upgrade table',
            'guest_number' => 5,
            'status' => 'available',
            'location' => 'upstair',
            'user_id' => $admin->id,
            '_token' => csrf_token(),
            
        ])->assertStatus(302)
        ->assertSessionHas('info');

        $this->assertEquals(session('info'), 'Stôl bol upravený');

    }

}

<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Bezmäsité jedlá',
            'description' => 'Jedlá vhodné pre vegetariánov',
            'image' => 'public/categories/eBUoBIbtqVu6CLosgkrTfcQKEnaMU7R6JIpfXhgk.jpg',
            ]);

            Category::create([
                'name' => 'Mäsité jedlá',
                'description' => 'Jedlá vhodné pre nie vegetariánov',
                'image' => 'public/categories/lvYdqnynAGb7rDJ37tt6L24D8dmtz7BxQnoYlA5H.jpg',
                ]);       
    }
}

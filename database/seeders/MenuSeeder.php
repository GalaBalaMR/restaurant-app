<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = Menu::create([
            'name' => 'Mäsové guličky',
            'description' => 'Mäso s ryžou v guličke :D',
            'image' => 'public/menus/wbcw5sODk22000B2rRGcLq8c8Rf5yfe5IfHGToRD.jpg',
            'price' => 10,
             ]);

        $cat = Category::where('name','Mäsité jedlá')->first();
        $menu->categories()->sync($cat->id); 

        $menu = Menu::create([
            'name' => 'Zeleninové guličky',
            'description' => 'Zelenina s ryžou v guličke',
            'image' => 'public/menus/LrM5nCOZLt1dG8vYvTyc96U2IDdE5GzUoX0SsjbW.jpg',
            'price' => 8,
            ]);

        $cat = Category::where('name','Bezmäsité jedlá')->first();
        $menu->categories()->sync($cat->id);
    }
}

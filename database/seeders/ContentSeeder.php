<?php

namespace Database\Seeders;

use App\Models\Content;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Content::create([
            'name' => 'About_nadpis',
            'content' => '<h3>Eum ipsam laborum deleniti <strong>velit pariatur architecto aut nihil</strong></h3>',
        ]);
        Content::create([
            'name' => 'About_p',
            'content' => '<p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
                            </p>
                            <p class="fst-italic">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                         </p>>',
        ]);
        Content::create([
            'name' => 'About_ul',
            'content' => '<ul>
                            <li><i class="bx bx-check-double"></i>Papučko laboris nisi ut aliquip ex ea commodo consequat.
                            </li>
                            <li><i class="bx bx-check-double"></i> 
                            Duis aute irure dolor in reprehenderit in voluptate velit.
                            </li>
                            <li><i class="bx bx-check-double"></i>
                            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.
                            </li>
                          </ul>',
        ]);
    }
}

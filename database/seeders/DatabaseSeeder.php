<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use App\Models\Chapter;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Course::factory(15)->create();
        Chapter::factory(150)->create();
    }
}

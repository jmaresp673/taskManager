<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use App\Models\TaskAttachment;
use App\Models\TaskComment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        $this->call([
            CategoriesTableSeeder::class,
            TasksTableSeeder::class,
        ]);
        TaskAttachment::factory(50)->create();
        TaskComment::factory(50)->create();
    }
}

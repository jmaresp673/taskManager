<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasks')->insert([
            ['title' => 'Submit report', 'description' => 'Complete and submit the monthly financial report.', 'due_date' => '2025-04-15', 'priority' => 'high', 'status' => 'incomplete', 'user_id' => 3, 'category_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Fix bug #120', 'description' => 'Resolve the layout issue on the login page.', 'due_date' => '2025-04-08', 'priority' => 'urgent', 'status' => 'incomplete', 'user_id' => 5, 'category_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Team meeting', 'description' => 'Weekly team meeting to align project goals.', 'due_date' => '2025-04-06', 'priority' => 'medium', 'status' => 'completed', 'user_id' => 1, 'category_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Write documentation', 'description' => 'Add API documentation for new endpoints.', 'due_date' => '2025-04-12', 'priority' => 'medium', 'status' => 'incomplete', 'user_id' => 2, 'category_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Client feedback', 'description' => 'Review and respond to the latest client feedback.', 'due_date' => '2025-04-10', 'priority' => 'low', 'status' => 'completed', 'user_id' => 4, 'category_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Deploy new version', 'description' => 'Deploy version 2.1.0 to production server.', 'due_date' => '2025-04-18', 'priority' => 'high', 'status' => 'incomplete', 'user_id' => 6, 'category_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Organize files', 'description' => 'Reorganize project directory for clarity.', 'due_date' => '2025-04-22', 'priority' => 'low', 'status' => 'completed', 'user_id' => 2, 'category_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Update dependencies', 'description' => 'Update all npm and composer dependencies.', 'due_date' => '2025-04-11', 'priority' => 'medium', 'status' => 'incomplete', 'user_id' => 1, 'category_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Create wireframes', 'description' => 'Design new UI wireframes for the dashboard.', 'due_date' => '2025-04-09', 'priority' => 'high', 'status' => 'incomplete', 'user_id' => 7, 'category_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Fix SEO issues', 'description' => 'Improve meta tags and URLs for better SEO.', 'due_date' => '2025-04-14', 'priority' => 'medium', 'status' => 'completed', 'user_id' => 8, 'category_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Backup database', 'description' => 'Schedule automatic daily backups.', 'due_date' => '2025-04-04', 'priority' => 'urgent', 'status' => 'completed', 'user_id' => 9, 'category_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Check analytics', 'description' => 'Review Google Analytics reports for March.', 'due_date' => '2025-04-13', 'priority' => 'low', 'status' => 'completed', 'user_id' => 10, 'category_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Implement search', 'description' => 'Add advanced search filtering to product list.', 'due_date' => '2025-04-20', 'priority' => 'high', 'status' => 'incomplete', 'user_id' => 3, 'category_id' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Prepare newsletter', 'description' => 'Draft and send April newsletter.', 'due_date' => '2025-04-17', 'priority' => 'medium', 'status' => 'completed', 'user_id' => 4, 'category_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Fix dark mode', 'description' => 'Adjust contrast issues in dark mode theme.', 'due_date' => '2025-04-08', 'priority' => 'high', 'status' => 'incomplete', 'user_id' => 5, 'category_id' => 8, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Refactor auth', 'description' => 'Improve and simplify authentication logic.', 'due_date' => '2025-04-10', 'priority' => 'high', 'status' => 'completed', 'user_id' => 6, 'category_id' => 9, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Audit logs', 'description' => 'Check audit logs for unauthorized access.', 'due_date' => '2025-04-05', 'priority' => 'urgent', 'status' => 'completed', 'user_id' => 7, 'category_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Marketing plan', 'description' => 'Brainstorm strategies for Q2.', 'due_date' => '2025-04-19', 'priority' => 'medium', 'status' => 'incomplete', 'user_id' => 8, 'category_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Performance review', 'description' => 'Prepare for employee quarterly reviews.', 'due_date' => '2025-04-15', 'priority' => 'medium', 'status' => 'completed', 'user_id' => 9, 'category_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Mobile testing', 'description' => 'Test new app version on mobile devices.', 'due_date' => '2025-04-21', 'priority' => 'medium', 'status' => 'incomplete', 'user_id' => 10, 'category_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Design icons', 'description' => 'Create custom icons for new features.', 'due_date' => '2025-04-18', 'priority' => 'low', 'status' => 'incomplete', 'user_id' => 1, 'category_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Fix responsiveness', 'description' => 'Ensure the layout works on all screen sizes.', 'due_date' => '2025-04-09', 'priority' => 'high', 'status' => 'incomplete', 'user_id' => 2, 'category_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Add 2FA', 'description' => 'Enable two-factor authentication.', 'due_date' => '2025-04-14', 'priority' => 'urgent', 'status' => 'completed', 'user_id' => 3, 'category_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Data import tool', 'description' => 'Create tool to import large data sets.', 'due_date' => '2025-04-22', 'priority' => 'high', 'status' => 'incomplete', 'user_id' => 4, 'category_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Bug triage', 'description' => 'Organize bugs by severity and status.', 'due_date' => '2025-04-12', 'priority' => 'medium', 'status' => 'completed', 'user_id' => 5, 'category_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Clean inbox', 'description' => 'Archive or reply to old emails.', 'due_date' => '2025-04-06', 'priority' => 'low', 'status' => 'completed', 'user_id' => 6, 'category_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Translate content', 'description' => 'Translate landing page to Spanish.', 'due_date' => '2025-04-11', 'priority' => 'medium', 'status' => 'incomplete', 'user_id' => 7, 'category_id' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Migrate server', 'description' => 'Move to a new cloud server instance.', 'due_date' => '2025-04-19', 'priority' => 'urgent', 'status' => 'incomplete', 'user_id' => 8, 'category_id' => 8, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Create test suite', 'description' => 'Write integration tests for user module.', 'due_date' => '2025-04-17', 'priority' => 'high', 'status' => 'completed', 'user_id' => 9, 'category_id' => 9, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Legal review', 'description' => 'Review updated terms of service.', 'due_date' => '2025-04-15', 'priority' => 'medium', 'status' => 'completed', 'user_id' => 10, 'category_id' => 10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}

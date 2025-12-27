<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Team;
use App\Models\Thread;
use App\Models\Message;
use Illuminate\Support\Facades\Hash;

class TeamMessagingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create team members
        $teamLead1 = User::create([
            'name' => 'Sarah Johnson',
            'email' => 'sarah.johnson@everly.com',
            'password' => Hash::make('password'),
            'role' => 'team',
        ]);

        $teamMember1 = User::create([
            'name' => 'Mike Davis',
            'email' => 'mike.davis@everly.com',
            'password' => Hash::make('password'),
            'role' => 'team',
        ]);

        $teamLead2 = User::create([
            'name' => 'Emily Chen',
            'email' => 'emily.chen@everly.com',
            'password' => Hash::make('password'),
            'role' => 'team',
        ]);

        // Create teams
        $team1 = Team::create([
            'name' => 'Team 1 - Tax Services',
            'description' => 'Handles all tax-related inquiries and document processing',
        ]);

        $team2 = Team::create([
            'name' => 'Team 2 - Payroll Services',
            'description' => 'Manages payroll processing and employee records',
        ]);

        // Assign members to teams
        $team1->users()->attach($teamLead1->id, ['role' => 'lead']);
        $team1->users()->attach($teamMember1->id, ['role' => 'member']);
        $team2->users()->attach($teamLead2->id, ['role' => 'lead']);

        // Get or create some regular users
        $user1 = User::where('email', 'user@example.com')->first();
        if (!$user1) {
            $user1 = User::create([
                'name' => 'John Client',
                'email' => 'john.client@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]);
        }

        $user2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        $user3 = User::create([
            'name' => 'Bob Williams',
            'email' => 'bob.williams@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Create threads for users
        $thread1 = Thread::create([
            'user_id' => $user1->id,
            'team_id' => $team1->id,
            'status' => 'open',
            'last_message_at' => now()->subHours(2),
        ]);

        $thread2 = Thread::create([
            'user_id' => $user2->id,
            'team_id' => $team1->id,
            'status' => 'open',
            'last_message_at' => now()->subDays(1),
        ]);

        $thread3 = Thread::create([
            'user_id' => $user3->id,
            'team_id' => $team2->id,
            'status' => 'closed',
            'last_message_at' => now()->subDays(3),
        ]);

        // Create sample messages
        Message::create([
            'thread_id' => $thread1->id,
            'sender_id' => $user1->id,
            'sender_role' => 'user',
            'message' => 'Hi, I have a question about my tax documents for Q4 2024. Can you help me understand what forms I need to submit?',
            'created_at' => now()->subHours(3),
        ]);

        Message::create([
            'thread_id' => $thread1->id,
            'sender_id' => $teamLead1->id,
            'sender_role' => 'team',
            'message' => 'Hello John! I\'d be happy to help you with that. For Q4 2024, you\'ll need to submit Form 1099 if you\'re self-employed, along with your quarterly estimated tax payments. Do you have any specific questions about these forms?',
            'created_at' => now()->subHours(2),
        ]);

        Message::create([
            'thread_id' => $thread2->id,
            'sender_id' => $user2->id,
            'sender_role' => 'user',
            'message' => 'I need help uploading my receipts for December. The system seems to be giving me an error.',
            'created_at' => now()->subDays(1)->subHours(2),
        ]);

        Message::create([
            'thread_id' => $thread2->id,
            'sender_id' => $teamMember1->id,
            'sender_role' => 'team',
            'message' => 'Hi Jane, I\'ll look into this for you. Can you tell me what error message you\'re seeing?',
            'created_at' => now()->subDays(1),
        ]);

        Message::create([
            'thread_id' => $thread3->id,
            'sender_id' => $user3->id,
            'sender_role' => 'user',
            'message' => 'Thank you for processing my payroll documents!',
            'created_at' => now()->subDays(3)->subHours(1),
        ]);

        Message::create([
            'thread_id' => $thread3->id,
            'sender_id' => $teamLead2->id,
            'sender_role' => 'team',
            'message' => 'You\'re welcome, Bob! Everything has been processed successfully. Let me know if you need anything else.',
            'created_at' => now()->subDays(3),
        ]);

        $this->command->info('Team and messaging data seeded successfully!');
        $this->command->info('');
        $this->command->info('Test Accounts Created:');
        $this->command->info('======================');
        $this->command->info('Team Lead 1: sarah.johnson@everly.com / password');
        $this->command->info('Team Member 1: mike.davis@everly.com / password');
        $this->command->info('Team Lead 2: emily.chen@everly.com / password');
        $this->command->info('User 1: john.client@example.com / password');
        $this->command->info('User 2: jane.smith@example.com / password');
        $this->command->info('User 3: bob.williams@example.com / password');
    }
}

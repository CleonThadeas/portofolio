<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Activity;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Andry',
            'email' => 'andrisomantri1324@gmail.com',
            'password' => bcrypt('Auliadini838'),
            'role' => 'admin',
        ]);

        // Create profile
        Profile::create([
            'user_id' => $admin->id,
            'name' => 'Andry',
            'headline' => 'Full-Stack Developer',
            'bio' => 'Passionate developer with experience in building modern web applications. I love creating clean, efficient, and scalable solutions.',
            'email' => 'andry@example.com',
            'phone' => '+6281234567890',
            'social_links' => [
                'github' => 'https://github.com/andry',
                'linkedin' => 'https://linkedin.com/in/andry',
                'instagram' => 'https://instagram.com/andry',
            ],
        ]);

        // Sample projects
        Project::create([
            'title' => 'E-Commerce Platform',
            'slug' => 'e-commerce-platform',
            'short_description' => 'A full-featured online store built with Laravel and Vue.js',
            'description' => 'A comprehensive e-commerce platform featuring product management, shopping cart, payment integration, and order tracking. Built with modern technologies and best practices.',
            'tech_stack' => ['Laravel', 'Vue.js', 'MySQL', 'Tailwind CSS', 'Stripe'],
            'demo_link' => 'https://demo.example.com',
            'repo_link' => 'https://github.com/andry/ecommerce',
            'is_published' => true,
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Project::create([
            'title' => 'Task Management App',
            'slug' => 'task-management-app',
            'short_description' => 'Collaborative project management tool',
            'description' => 'A real-time task management application with team collaboration features, kanban boards, and activity tracking.',
            'tech_stack' => ['React', 'Node.js', 'MongoDB', 'Socket.io'],
            'demo_link' => 'https://tasks.example.com',
            'repo_link' => 'https://github.com/andry/taskmanager',
            'is_published' => true,
            'is_featured' => true,
            'sort_order' => 2,
        ]);

        Project::create([
            'title' => 'Portfolio Website',
            'slug' => 'portfolio-website',
            'short_description' => 'Personal portfolio with CMS',
            'description' => 'A dynamic portfolio website with an integrated content management system for easy content updates.',
            'tech_stack' => ['Laravel', 'Tailwind CSS', 'MySQL'],
            'is_published' => true,
            'is_featured' => false,
            'sort_order' => 3,
        ]);

        // Sample skills
        $skills = [
            ['name' => 'PHP', 'category' => 'Backend', 'level' => 90],
            ['name' => 'Laravel', 'category' => 'Backend', 'level' => 85],
            ['name' => 'JavaScript', 'category' => 'Frontend', 'level' => 85],
            ['name' => 'Vue.js', 'category' => 'Frontend', 'level' => 75],
            ['name' => 'React', 'category' => 'Frontend', 'level' => 70],
            ['name' => 'Tailwind CSS', 'category' => 'Frontend', 'level' => 90],
            ['name' => 'MySQL', 'category' => 'Database', 'level' => 80],
            ['name' => 'Git', 'category' => 'Tools', 'level' => 85],
            ['name' => 'Docker', 'category' => 'DevOps', 'level' => 60],
            ['name' => 'Python', 'category' => 'Backend', 'level' => 65],
        ];
        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        // Sample certificates
        Certificate::create([
            'name' => 'Laravel Certified Developer',
            'issuer' => 'Laravel',
            'date' => '2024-06-15',
            'description' => 'Official certification for Laravel framework proficiency.',
        ]);

        Certificate::create([
            'name' => 'AWS Cloud Practitioner',
            'issuer' => 'Amazon Web Services',
            'date' => '2024-03-20',
            'description' => 'Foundational cloud computing certification from AWS.',
        ]);

        // Sample experiences
        Experience::create([
            'position' => 'Full-Stack Developer',
            'organization' => 'Tech Company',
            'type' => 'work',
            'start_date' => '2023-01-01',
            'end_date' => null,
            'is_current' => true,
            'description' => 'Developing and maintaining web applications using Laravel and Vue.js. Leading frontend architecture decisions.',
        ]);

        Experience::create([
            'position' => 'Junior Developer',
            'organization' => 'Startup Inc.',
            'type' => 'work',
            'start_date' => '2021-06-01',
            'end_date' => '2022-12-31',
            'is_current' => false,
            'description' => 'Built REST APIs and responsive frontends for client projects.',
        ]);

        Experience::create([
            'position' => 'Head of IT Division',
            'organization' => 'Student Organization',
            'type' => 'organization',
            'start_date' => '2020-09-01',
            'end_date' => '2021-08-31',
            'is_current' => false,
            'description' => 'Led the IT division, organized tech workshops and hackathons.',
        ]);

        // Sample activities
        Activity::create([
            'title' => 'National Hackathon 2024',
            'type' => 'Competition',
            'date' => '2024-05-10',
            'description' => 'Participated in a 48-hour national hackathon, built an AI-powered health monitoring app.',
        ]);

        Activity::create([
            'title' => 'Web Development Workshop',
            'type' => 'Workshop',
            'date' => '2024-03-15',
            'description' => 'Speaker at a university workshop on modern web development with Laravel.',
        ]);
    }
}

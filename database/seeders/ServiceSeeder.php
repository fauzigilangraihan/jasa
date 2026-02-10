<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Web Development',
                'description' => 'Membangun website modern, responsif, dan performa tinggi dengan teknologi terkini.',
                'icon' => 'fa-globe',
                'features' => json_encode(['Responsive Design', 'SEO Friendly', 'Fast Loading', 'Modern Stack']),
                'is_active' => true,
            ],
            [
                'name' => 'UI/UX Design',
                'description' => 'Desain interface yang menarik, user-friendly, dan meningkatkan konversi bisnis Anda.',
                'icon' => 'fa-paint-brush',
                'features' => json_encode(['User Research', 'Wireframing', 'Prototyping', 'High Fidelity Design']),
                'is_active' => true,
            ],
            [
                'name' => 'Mobile App',
                'description' => 'Aplikasi mobile native dan cross-platform untuk iOS dan Android.',
                'icon' => 'fa-mobile-alt',
                'features' => json_encode(['React Native', 'Flutter', 'Firebase Integration', 'Push Notifications']),
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}

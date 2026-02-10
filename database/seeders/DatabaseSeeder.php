<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\PricingPackage;
use App\Models\Testimonial;
use App\Models\FaqItem;
use App\Models\PortfolioProject;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Jalankan seeder database aplikasi.
     */
    public function run(): void
    {
        // Buat pengguna admin
        User::create([
            'name' => 'Pengguna Admin',
            'email' => 'admin@fauzidev.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Buat contoh klien
        User::factory(5)->create(['role' => 'client']);

        // Buat layanan
        $services = [
            [
                'name' => 'Pengembangan Web',
                'description' => 'Pengembangan website profesional menggunakan teknologi modern',
                'icon' => '🌐',
            ],
            [
                'name' => 'E-Commerce',
                'description' => 'Solusi e-commerce lengkap dengan integrasi pembayaran',
                'icon' => '🛒',
            ],
            [
                'name' => 'Sistem Custom',
                'description' => 'Solusi bisnis yang disesuaikan dengan kebutuhan spesifik Anda',
                'icon' => '⚙️',
            ],
            [
                'name' => 'Desain UI/UX',
                'description' => 'Desain interface yang indah dan user-friendly',
                'icon' => '🎨',
            ],
            [
                'name' => 'Pemeliharaan',
                'description' => 'Layanan dukungan berkelanjutan dan pemeliharaan website',
                'icon' => '🔧',
            ],
        ];

        foreach ($services as $serviceData) {
            $service = Service::create([...$serviceData, 'is_active' => true]);

            // Buat paket harga untuk setiap layanan
            if ($service->name === 'Pengembangan Web') {
                PricingPackage::create([
                    'service_id' => $service->id,
                    'name' => 'Dasar',
                    'description' => 'Website informatif 5 halaman',
                    'price' => 1000,
                    'delivery_days' => 14,
                    'revision_rounds' => 2,
                    'features' => json_encode(['Desain Responsif', 'Form Kontak', 'Dasar SEO', '5 Halaman', 'Domain Gratis 1 Tahun']),
                    'is_active' => true,
                ]);

                PricingPackage::create([
                    'service_id' => $service->id,
                    'name' => 'Standar',
                    'description' => 'Website profesional 10 halaman',
                    'price' => 2500,
                    'delivery_days' => 30,
                    'revision_rounds' => 3,
                    'features' => json_encode(['Responsif Penuh', 'Integrasi CMS', 'Sertifikat SSL', '10 Halaman', 'Bagian Blog', 'Domain Gratis 1 Tahun', 'Pengaturan Email Gratis']),
                    'is_active' => true,
                ]);

                PricingPackage::create([
                    'service_id' => $service->id,
                    'name' => 'Premium',
                    'description' => 'Website canggih dengan semua fitur',
                    'price' => 5000,
                    'delivery_days' => 45,
                    'revision_rounds' => 5,
                    'features' => json_encode(['Desain Sepenuhnya Custom', 'CMS Canggih', 'Siap E-commerce', '20+ Halaman', 'Integrasi API', 'Sertifikat SSL', 'Pengaturan Email Gratis', 'Dukungan 1 Tahun']),
                    'is_active' => true,
                ]);
            } elseif ($service->name === 'E-Commerce') {
                PricingPackage::create([
                    'service_id' => $service->id,
                    'name' => 'Dasar',
                    'description' => 'Toko e-commerce pemula',
                    'price' => 3000,
                    'delivery_days' => 21,
                    'revision_rounds' => 2,
                    'features' => json_encode(['Hingga 50 Produk', 'Pintu Gerbang Pembayaran', 'Manajemen Inventaris', 'Analitik Dasar']),
                    'is_active' => true,
                ]);

                PricingPackage::create([
                    'service_id' => $service->id,
                    'name' => 'Profesional',
                    'description' => 'Platform e-commerce berfitur lengkap',
                    'price' => 6000,
                    'delivery_days' => 35,
                    'revision_rounds' => 3,
                    'features' => json_encode(['Produk Tidak Terbatas', 'Opsi Pembayaran Ganda', 'Analitik Canggih', 'Manajemen Inventaris', 'Akun Pelanggan', 'Integrasi Pemasaran Email']),
                    'is_active' => true,
                ]);
            }
        }

        // Buat proyek portfolio
        $portfolioProjects = [
            [
                'title' => 'Profil Perusahaan TechCorp',
                'description' => 'Website profil perusahaan modern untuk startup teknologi',
                'website_url' => 'https://example.com',
                'service_id' => 1,
                'industry' => 'Teknologi',
                'thumbnail_path' => null,
            ],
            [
                'title' => 'Toko Fashion E-Shop',
                'description' => 'Solusi e-commerce lengkap untuk ritel fashion',
                'website_url' => 'https://example.com',
                'service_id' => 2,
                'industry' => 'Ritel',
                'thumbnail_path' => null,
            ],
            [
                'title' => 'Website Portfolio',
                'description' => 'Website portfolio kreatif untuk seorang desainer',
                'website_url' => 'https://example.com',
                'service_id' => 1,
                'industry' => 'Desain',
                'thumbnail_path' => null,
            ],
        ];

        foreach ($portfolioProjects as $index => $project) {
            PortfolioProject::create([...$project, 'is_active' => true, 'order_column' => $index]);
        }

        // Buat testimonial
        $testimonials = [
            [
                'client_name' => 'John Anderson',
                'client_company' => 'Tech Innovations Inc.',
                'message' => 'fauziDev memberikan website yang luar biasa. Tim mereka profesional, responsif, dan tepat waktu.',
                'rating' => 5,
            ],
            [
                'client_name' => 'Sarah Williams',
                'client_company' => 'Fashion Hub',
                'message' => 'Platform e-commerce yang mereka bangun meningkatkan penjualan kami 40%. Sangat direkomendasikan!',
                'rating' => 5,
            ],
            [
                'client_name' => 'Mike Johnson',
                'client_company' => 'Agensi Kreatif',
                'message' => 'Perhatian terhadap detail yang luar biasa. Desainnya indah dan fungsionalitasnya sempurna.',
                'rating' => 4,
            ],
        ];

        foreach ($testimonials as $index => $testimonial) {
            Testimonial::create([...$testimonial, 'is_active' => true, 'order_column' => $index]);
        }

        // Buat item FAQ
        $faqs = [
            [
                'question' => 'Berapa lama waktu untuk membangun website?',
                'answer' => 'Tergantung pada kompleksitas dan kebutuhan spesifik Anda. Website dasar memakan waktu 14 hari, sementara solusi yang lebih kompleks dapat memakan waktu 30-45 hari.',
            ],
            [
                'question' => 'Apakah Anda menyediakan dukungan berkelanjutan?',
                'answer' => 'Ya! Kami menawarkan paket pemeliharaan dan dukungan. Paket premium termasuk 1 tahun dukungan gratis.',
            ],
            [
                'question' => 'Metode pembayaran apa yang Anda terima?',
                'answer' => 'Kami menerima transfer bank, kartu kredit, cryptocurrency, dan PayPal. Kami juga menawarkan opsi pembayaran DP 30%.',
            ],
            [
                'question' => 'Dapatkah Anda mendesain ulang website yang ada?',
                'answer' => 'Tentu saja! Kami dapat memberikan makeover lengkap pada website yang ada dengan desain dan fungsionalitas modern.',
            ],
            [
                'question' => 'Apakah website saya akan mobile-friendly?',
                'answer' => 'Ya, semua website kami dibangun dengan pendekatan mobile-first dan fully responsive di semua perangkat.',
            ],
        ];

        foreach ($faqs as $index => $faq) {
            FaqItem::create([...$faq, 'is_active' => true, 'order_column' => $index]);
        }
    }
}

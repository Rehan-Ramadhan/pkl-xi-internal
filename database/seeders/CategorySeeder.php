<?php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // ========================
        // DAFTAR KATEGORI TOKO KOMIK
        // Maksimal 6 kategori
        // Semua kategori dipakai minimal 1 produk
        // Fokus utama: Lookism & Questism
        // ========================

        $categories = [

            // MANHWA KOREA
            [
                'name'        => 'Manhwa Korea',
                'slug'        => 'manhwa-korea',
                'image'       => 'categories/manhwa-korea.jpg',
                'description' => 'Komik Korea berwarna dengan cerita aksi, drama sekolah, dan sistem seperti Lookism dan Questism.',
                'is_active'   => true,
            ],

            // MANGA JEPANG
            [
                'name'        => 'Manga Jepang',
                'slug'        => 'manga-jepang',
                'image'       => 'categories/manga-jepang.jpg',
                'description' => 'Komik asli Jepang seperti One Piece, Naruto, Attack on Titan, dan Jujutsu Kaisen.',
                'is_active'   => true,
            ],

            // MANHUA CHINA
            [
                'name'        => 'Manhua China',
                'slug'        => 'manhua-china',
                'image'       => 'categories/manhua-china.jpg',
                'description' => 'Komik asal Tiongkok dengan tema kultivasi, game, dan dunia fantasi.',
                'is_active'   => true,
            ],

            // KOMIK BARAT
            [
                'name'        => 'Komik Barat',
                'slug'        => 'komik-barat',
                'image'       => 'categories/komik-barat.jpg',
                'description' => 'Komik Amerika dan Eropa seperti Batman, Spider Man, dan Avengers.',
                'is_active'   => true,
            ],

            // EDISI TERBATAS
            [
                'name'        => 'Edisi Terbatas',
                'slug'        => 'edisi-terbatas',
                'image'       => 'categories/edisi-terbatas.jpg',
                'description' => 'Komik edisi terbatas dengan cover eksklusif dan kualitas cetak premium.',
                'is_active'   => true,
            ],

            // BEST SELLER
            [
                'name'        => 'Best Seller',
                'slug'        => 'best-seller',
                'image'       => 'categories/best-seller.jpg',
                'description' => 'Kategori untuk komik paling laris, termasuk Lookism & Questism favorit pembaca.',
                'is_active'   => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $this->command->info('Kategori komik berhasil dibuat');
    }
}

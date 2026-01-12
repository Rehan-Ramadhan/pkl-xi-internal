<?php
namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID kategori berdasarkan slug
        $categories = Category::pluck('id', 'slug');

        $products = [
            // MANHWA KOREA
            [
                'name'        => 'Lookism Vol. 1',
                'category'    => 'manhwa-korea',
                'price'       => 57000,
                'image'       => 'lookism-vol-1.jpg',
                'description' => 'Park Hyung Seok memiliki dua tubuh: satu tampan dan satu biasa. Volume pembuka ini memperlihatkan kehidupan sekolah dan bullying.',
            ],
            [
                'name'        => 'Lookism Vol. 2',
                'category'    => 'manhwa-korea',
                'price'       => 57000,
                'image'       => 'lookism-vol-2.jpg',
                'description' => 'Cerita semakin seru dengan konflik sosial dan hubungan antar teman di sekolah.',
            ],
            [
                'name'        => 'Lookism Vol. 3',
                'category'    => 'manhwa-korea',
                'price'       => 58000,
                'image'       => 'lookism-vol-3.jpg',
                'description' => 'Pertarungan antar siswa mulai intens dan muncul karakter kuat baru.',
            ],
            [
                'name'        => 'Questism Vol. 1',
                'category'    => 'manhwa-korea',
                'price'       => 60000,
                'image'       => 'questism-vol-1.jpg',
                'description' => 'Kim Suhyeon menerima sistem quest misterius yang mengubah kehidupannya di sekolah.',
            ],
            [
                'name'        => 'Questism Vol. 2',
                'category'    => 'manhwa-korea',
                'price'       => 60000,
                'image'       => 'questism-vol-2.jpg',
                'description' => 'Suhyeon mulai menyelesaikan quest demi quest, meningkatkan kemampuan.',
            ],
            [
                'name'        => 'Questism Vol. 3',
                'category'    => 'manhwa-korea',
                'price'       => 61000,
                'image'       => 'questism-vol-3.jpg',
                'description' => 'Pertarungan antar sekolah memanas, sistem quest menjadi senjata utama.',
            ],
            [
                'name'        => 'Solo Leveling Vol. 1',
                'category'    => 'manhwa-korea',
                'price'       => 65000,
                'image'       => 'solo-leveling-vol-1.jpg',
                'description' => 'Sung Jin Woo memulai perjalanan dari hunter terlemah menjadi yang terkuat.',
            ],
            [
                'name'        => 'Solo Leveling Vol. 2',
                'category'    => 'manhwa-korea',
                'price'       => 65000,
                'image'       => 'solo-leveling-vol-2.jpg',
                'description' => 'Kekuatan bayangan mulai berkembang, dan dunia hunter semakin berbahaya.',
            ],
            [
                'name'        => 'Tower of God Vol. 1',
                'category'    => 'manhwa-korea',
                'price'       => 60000,
                'image'       => 'tower-of-god-vol-1.jpg',
                'description' => 'Bam memulai pendakian menara demi menemukan Rachel dan misteri di dalamnya.',
            ],
            [
                'name'        => 'True Beauty Vol. 1',
                'category'    => 'manhwa-korea',
                'price'       => 55000,
                'image'       => 'true-beauty-vol-1.jpg',
                'description' => 'Romansa remaja dengan kepercayaan diri dan rahasia di balik riasan wajah.',
            ],
            [
                'name'        => 'Omniscient Reader Vol. 1',
                'category'    => 'manhwa-korea',
                'price'       => 68000,
                'image'       => 'orv-vol-1.jpg',
                'description' => 'Dunia novel menjadi nyata, Kim Dokja satu-satunya yang tahu akhir cerita.',
            ],

            // MANGA JEPANG
            [
                'name'        => 'Wotakoi Vol. 1',
                'category'    => 'manga-jepang',
                'price'       => 45000,
                'image'       => 'wotakoi-vol-1.jpg',
                'description' => 'Narumi, seorang fujoshi, dan Hirotaka, seorang gaming otaku, mulai berkencan.',
            ],
            [
                'name'        => 'Wotakoi Vol. 2',
                'category'    => 'manga-jepang',
                'price'       => 45000,
                'image'       => 'wotakoi-vol-2.jpg',
                'description' => 'Kencan pertama di Comiket! Menyeimbangkan hobi berat dengan romansa kantor.',
            ],
            [
                'name'        => 'Wotakoi Vol. 3',
                'category'    => 'manga-jepang',
                'price'       => 45000,
                'image'       => 'wotakoi-vol-3.jpg',
                'description' => 'Hubungan Kabakura dan Koyanagi yang penuh pertengkaran namun manis.',
            ],
            [
                'name'        => 'One Piece Vol. 1',
                'category'    => 'manga-jepang',
                'price'       => 45000,
                'image'       => 'one-piece-vol-1.jpg',
                'description' => 'Awal petualangan Monkey D. Luffy menuju Raja Bajak Laut.',
            ],
            [
                'name'        => 'Attack on Titan Vol. 1',
                'category'    => 'manga-jepang',
                'price'       => 48000,
                'image'       => 'aot-vol-1.jpg',
                'description' => 'Manusia melawan Titan demi bertahan hidup dan mempertahankan kemanusiaan.',
            ],
            [
                'name'        => 'Jujutsu Kaisen Vol. 1',
                'category'    => 'manga-jepang',
                'price'       => 46000,
                'image'       => 'jujutsu-vol-1.jpg',
                'description' => 'Kutukan dan penyihir jujutsu memulai pertarungan mematikan.',
            ],

            // MANHUA CHINA
            [
                'name'        => 'Soul Land Vol. 1',
                'category'    => 'manhua-china',
                'price'       => 60000,
                'image'       => 'soul-land-vol-1.jpg',
                'description' => 'Dunia roh dan kekuatan spiritual dimulai dengan pertarungan dan kultivasi.',
            ],
            [
                'name'        => 'The Kings Avatar Vol. 1',
                'category'    => 'manhua-china',
                'price'       => 62000,
                'image'       => 'kings-avatar-vol-1.jpg',
                'description' => 'Legenda e-sport kembali ke puncak dalam game kompetitif.',
            ],
            [
                'name'        => 'Tales of Demons and Gods Vol. 1',
                'category'    => 'manhua-china',
                'price'       => 58000,
                'image'       => 'tdg-vol-1.jpg',
                'description' => 'Kesempatan kedua untuk mengubah masa depan dan melindungi kota.',
            ],

            // KOMIK BARAT
            [
                'name'        => 'Batman Year One',
                'category'    => 'komik-barat',
                'price'       => 120000,
                'image'       => 'batman-year-one.jpg',
                'description' => 'Asal-usul Batman sebagai pelindung Gotham dan awal perjalanan gelapnya.',
            ],
            [
                'name'        => 'Batman The Killing Joke',
                'category'    => 'komik-barat',
                'price'       => 135000,
                'image'       => 'batman-killing-joke.jpg',
                'description' => 'Pertarungan psikologis Batman melawan Joker yang gila.',
            ],
            [
                'name'        => 'Spider-Man Homecoming',
                'category'    => 'komik-barat',
                'price'       => 110000,
                'image'       => 'spiderman-homecoming.jpg',
                'description' => 'Peter Parker menyeimbangkan kehidupan sekolah dan menjadi pahlawan.',
            ],
            [
                'name'        => 'Avengers Infinity War',
                'category'    => 'komik-barat',
                'price'       => 150000,
                'image'       => 'avengers-infinity-war.jpg',
                'description' => 'Pertempuran besar para Avengers melawan Thanos.',
            ],

            // LIMITED EDITION & BEST SELLER
            [
                'name'        => 'Lookism Special Edition',
                'category'    => 'edisi-terbatas',
                'price'       => 150000,
                'image'       => 'lookism-special.jpg',
                'description' => 'Edisi khusus Lookism dengan cover premium dan ilustrasi eksklusif.',
            ],
            [
                'name'        => 'Questism Limited Edition',
                'category'    => 'edisi-terbatas',
                'price'       => 160000,
                'image'       => 'questism-limited.jpg',
                'description' => 'Edisi terbatas Questism dengan cover eksklusif dan bonus ilustrasi.',
            ],
            [
                'name'        => 'Lookism Vol. 1 (Best Seller)',
                'category'    => 'best-seller',
                'price'       => 57000,
                'image'       => 'lookism-vol-1.jpg',
                'description' => 'Volume pertama Lookism yang paling laris di toko, wajib punya!',
            ],
            [
                'name'        => 'Questism Vol. 1 (Best Seller)',
                'category'    => 'best-seller',
                'price'       => 60000,
                'image'       => 'questism-vol-1.jpg',
                'description' => 'Volume pertama Questism yang paling diminati pembaca.',
            ],
            [
                'name'        => 'Wotakoi (Best Seller)',
                'category'    => 'best-seller',
                'price'       => 48000,
                'image'       => 'wotakoi-best.jpg',
                'description' => 'Edisi paling dicari! Kisah komedi romantis otaku.',
            ],
        ];

        // LOOP CREATE PRODUCT
        foreach ($products as $productData) {
            // Cek kategori agar tidak error jika slug tidak pas
            $categoryId = $categories[$productData['category']] ?? null;

            if ($categoryId) {
                $product = Product::create([
                    'category_id' => $categoryId,
                    'name'        => $productData['name'],
                    'slug'        => Str::slug($productData['name'] . '-' . Str::random(5)),
                    'description' => $productData['description'],
                    'price'       => $productData['price'],
                    'stock'       => rand(75, 100),
                    'weight'      => rand(300, 700),
                    'image'       => $productData['image'],
                    'is_active'   => true,
                    'is_featured' => rand(0, 1),
                ]);

                // Sinkronisasi ke tabel ProductImages
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'products/' . $productData['image'],
                    'is_primary' => true,
                    'sort_order' => 0,
                ]);
            }
        }

        $this->command->info('Berhasil input ' . Product::count() . ' produk ke database.');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Collection;
use App\Models\Category;
use App\Services\QrCodeService;
use Illuminate\Support\Str;

class CollectionSeeder extends Seeder
{
    protected $qrCodeService;

    public function __construct(QrCodeService $qrCodeService)
    {
        $this->qrCodeService = $qrCodeService;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collections = [
            [
                'name' => 'Keris Pusaka Majapahit',
                'category_id' => 1,
                'description' => 'Keris pusaka dari era Majapahit yang memiliki nilai historis tinggi. Keris ini dibuat dengan teknik tradisional yang rumit dan menggunakan material berkualitas tinggi. Motif dan ukiran pada keris ini menggambarkan kekayaan budaya dan filosofi Jawa yang mendalam.',
                'year_period' => '1293-1527',
                'origin_location' => 'Jawa Timur',
                'material' => 'Besi, Kayu, Emas',
                'dimensions' => '45cm x 8cm x 2cm',
                'conservation_status' => 'Baik',
                'rating' => 4.8,
                'technical_overview' => 'Keris dengan pamor yang indah, menggunakan teknik tempa tradisional yang menghasilkan bilah yang kuat dan lentur.',
                'nilai_budaya' => 'Keris merupakan simbol kekuatan dan kearifan budaya Jawa, menggambarkan keahlian pandai besi tradisional yang telah diwariskan turun-temurun.',
                'nilai_historis' => 'Keris ini merupakan peninggalan dari era Majapahit yang menggambarkan kejayaan kerajaan terbesar di Nusantara. Memiliki nilai historis tinggi sebagai bukti keahlian pandai besi tradisional Jawa.',
                'nilai_edukatif' => 'Mengajarkan tentang teknik tempa tradisional, filosofi Jawa, dan nilai-nilai spiritual yang terkandung dalam senjata tradisional.'
            ],
            [
                'name' => 'Batik Tulis Kraton Yogyakarta',
                'category_id' => 2,
                'description' => 'Batik tulis asli dari Kraton Yogyakarta dengan motif parang rusak yang eksklusif. Batik ini dibuat dengan tangan menggunakan canting dan malam, proses yang memakan waktu berbulan-bulan. Setiap motif memiliki makna filosofis yang dalam.',
                'year_period' => '1755-1945',
                'origin_location' => 'Yogyakarta',
                'material' => 'Kain Sutra, Malam, Pewarna Alam',
                'dimensions' => '250cm x 110cm',
                'conservation_status' => 'Sangat Baik',
                'rating' => 4.9,
                'technical_overview' => 'Batik tulis dengan teknik canting tradisional, menggunakan pewarna alam yang tahan lama dan motif yang memiliki makna filosofis.'
            ],
            [
                'name' => 'Gamelan Gamelan Sekaten',
                'category_id' => 4,
                'description' => 'Gamelan Sekaten yang digunakan dalam upacara tradisional di Kraton Surakarta. Gamelan ini terdiri dari berbagai instrumen yang harmonis, menghasilkan nada-nada yang sakral dan spiritual. Setiap instrumen memiliki fungsi dan makna khusus dalam ritual.',
                'year_period' => '1745-1945',
                'origin_location' => 'Surakarta',
                'material' => 'Perunggu, Kayu Jati, Kulit',
                'dimensions' => 'Set lengkap - berbagai ukuran',
                'conservation_status' => 'Baik',
                'rating' => 4.7,
                'technical_overview' => 'Gamelan dengan nada pelog dan slendro, menggunakan teknik pengecoran perunggu tradisional yang menghasilkan suara yang khas.'
            ],
            [
                'name' => 'Mahkota Raja Bali',
                'category_id' => 3,
                'description' => 'Mahkota raja dari kerajaan Bali yang terbuat dari emas murni dengan hiasan batu permata. Mahkota ini memiliki desain yang rumit dengan motif-motif tradisional Bali yang menggambarkan kekuatan dan kewibawaan pemakainya.',
                'year_period' => '1600-1900',
                'origin_location' => 'Bali',
                'material' => 'Emas, Permata, Mutiara',
                'dimensions' => '25cm x 20cm x 15cm',
                'conservation_status' => 'Sangat Baik',
                'rating' => 4.9,
                'technical_overview' => 'Mahkota dengan teknik ukir emas tradisional, menggunakan batu permata asli dan teknik penyepuhan yang halus.'
            ],
            [
                'name' => 'Wayang Kulit Purwa',
                'category_id' => 5,
                'description' => 'Wayang kulit purwa dengan tokoh-tokoh dari epos Mahabharata dan Ramayana. Wayang ini dibuat dari kulit kerbau yang diukir dengan detail yang sangat halus. Setiap tokoh memiliki karakteristik dan makna filosofis yang unik.',
                'year_period' => '1700-1900',
                'origin_location' => 'Jawa Tengah',
                'material' => 'Kulit Kerbau, Tanduk, Cat',
                'dimensions' => '60cm x 40cm',
                'conservation_status' => 'Baik',
                'rating' => 4.6,
                'technical_overview' => 'Wayang dengan ukiran detail yang halus, menggunakan teknik pahat tradisional dan pewarnaan yang tahan lama.'
            ],
            [
                'name' => 'Tombak Trisula',
                'category_id' => 1,
                'description' => 'Tombak trisula dengan tiga mata yang melambangkan kekuatan spiritual. Tombak ini digunakan dalam upacara-upacara sakral dan ritual keagamaan. Desainnya menggabungkan unsur fungsional dengan nilai estetika yang tinggi.',
                'year_period' => '1500-1700',
                'origin_location' => 'Jawa Barat',
                'material' => 'Besi, Kayu, Perak',
                'dimensions' => '180cm x 15cm',
                'conservation_status' => 'Baik',
                'rating' => 4.5,
                'technical_overview' => 'Tombak dengan tiga mata yang seimbang, menggunakan teknik tempa tradisional yang menghasilkan bilah yang kuat.'
            ],
            [
                'name' => 'Songket Minangkabau',
                'category_id' => 2,
                'description' => 'Kain songket tradisional Minangkabau dengan motif-motif geometris yang khas. Songket ini dibuat dengan teknik tenun yang rumit menggunakan benang emas dan perak. Setiap motif memiliki makna dan filosofi yang dalam.',
                'year_period' => '1800-1950',
                'origin_location' => 'Sumatera Barat',
                'material' => 'Sutra, Benang Emas, Benang Perak',
                'dimensions' => '200cm x 90cm',
                'conservation_status' => 'Sangat Baik',
                'rating' => 4.8,
                'technical_overview' => 'Songket dengan teknik tenun tradisional, menggunakan benang emas dan perak asli yang menghasilkan kilau yang indah.'
            ],
            [
                'name' => 'Angklung Bambu',
                'category_id' => 4,
                'description' => 'Angklung tradisional yang terbuat dari bambu pilihan dengan nada yang harmonis. Angklung ini digunakan dalam berbagai upacara tradisional dan pertunjukan musik. Setiap tabung bambu menghasilkan nada yang berbeda.',
                'year_period' => '1900-1950',
                'origin_location' => 'Jawa Barat',
                'material' => 'Bambu, Tali, Cat',
                'dimensions' => 'Set lengkap - berbagai ukuran',
                'conservation_status' => 'Baik',
                'rating' => 4.4,
                'technical_overview' => 'Angklung dengan nada yang presisi, menggunakan bambu pilihan dan teknik pembuatan tradisional yang teliti.'
            ],
            [
                'name' => 'Kalung Mutiara Raja',
                'category_id' => 3,
                'description' => 'Kalung mutiara asli yang pernah dipakai oleh raja-raja di Nusantara. Mutiara-mutiara ini dipilih dengan kualitas terbaik dan dirangkai dengan teknik yang sangat halus. Kalung ini melambangkan kemewahan dan kekuasaan.',
                'year_period' => '1600-1800',
                'origin_location' => 'Maluku',
                'material' => 'Mutiara Asli, Emas, Sutra',
                'dimensions' => 'Panjang 50cm',
                'conservation_status' => 'Sangat Baik',
                'rating' => 4.9,
                'technical_overview' => 'Kalung dengan mutiara asli berkualitas tinggi, menggunakan teknik rangkaian tradisional yang halus.'
            ],
            [
                'name' => 'Tepak Sirih Tradisional',
                'category_id' => 6,
                'description' => 'Tepak sirih tradisional yang digunakan dalam upacara adat dan penyambutan tamu. Tepak ini terbuat dari perak dengan ukiran yang detail dan memiliki beberapa kompartemen untuk menyimpan berbagai bahan sirih.',
                'year_period' => '1700-1900',
                'origin_location' => 'Aceh',
                'material' => 'Perak, Kayu, Ukiran',
                'dimensions' => '30cm x 20cm x 15cm',
                'conservation_status' => 'Baik',
                'rating' => 4.3,
                'technical_overview' => 'Tepak dengan ukiran perak yang detail, menggunakan teknik ukir tradisional yang menghasilkan motif yang indah.'
            ],
            [
                'name' => 'Pedang Samurai Nusantara',
                'category_id' => 1,
                'description' => 'Pedang samurai yang dibuat oleh pandai besi lokal dengan pengaruh teknik Jepang. Pedang ini memiliki bilah yang tajam dan gagang yang dihias dengan detail yang rumit. Setiap bagian pedang memiliki makna filosofis.',
                'year_period' => '1600-1800',
                'origin_location' => 'Jawa Tengah',
                'material' => 'Besi, Kayu, Emas',
                'dimensions' => '100cm x 8cm x 2cm',
                'conservation_status' => 'Baik',
                'rating' => 4.7,
                'technical_overview' => 'Pedang dengan teknik tempa yang halus, menghasilkan bilah yang kuat dan lentur dengan pola pamor yang indah.'
            ],
            [
                'name' => 'Kain Ulos Batak',
                'category_id' => 2,
                'description' => 'Kain ulos tradisional Batak dengan motif-motif yang khas dan warna-warna yang cerah. Ulos ini dibuat dengan teknik tenun tradisional dan digunakan dalam berbagai upacara adat Batak. Setiap motif memiliki makna khusus.',
                'year_period' => '1800-1950',
                'origin_location' => 'Sumatera Utara',
                'material' => 'Kapas, Benang, Pewarna Alam',
                'dimensions' => '180cm x 80cm',
                'conservation_status' => 'Sangat Baik',
                'rating' => 4.6,
                'technical_overview' => 'Ulos dengan teknik tenun tradisional, menggunakan pewarna alam yang menghasilkan warna yang tahan lama.'
            ]
        ];

        foreach ($collections as $collection) {
            $category = Category::where('id', $collection['category_id'])->first();

            if ($category) {
                $newCollection = Collection::create([
                    'name' => $collection['name'],
                    'slug' => Str::slug($collection['name']),
                    'category_id' => $category->id,
                    'description' => $collection['description'],
                    'year_period' => $collection['year_period'],
                    'origin_location' => $collection['origin_location'],
                    'material' => $collection['material'] ?? null,
                    'dimensions' => $collection['dimensions'] ?? null,
                    'conservation_status' => $collection['conservation_status'] ?? null,
                    'rating' => $collection['rating'] ?? null,
                    'technical_overview' => $collection['technical_overview'] ?? null,
                    'nilai_historis' => $collection['nilai_historis'] ?? null,
                    'nilai_edukatif' => $collection['nilai_edukatif'] ?? null,
                    'nilai_budaya' => $collection['nilai_budaya'] ?? null,
                    'image_path' => null, // Admin akan upload gambar nanti
                    'is_featured' => false, // Default to false for new collections
                    'is_active' => true,
                    'view_count' => rand(10, 500)
                ]);

                // Auto-generate QR code for new collection
                try {
                    $this->qrCodeService->generateQrCode($newCollection);
                } catch (\Exception $e) {
                    // Log error but don't fail the seeder
                    \Log::error('Failed to generate QR code for collection ' . $newCollection->id . ': ' . $e->getMessage());
                }
            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Collection;
use App\Models\Category;
use Illuminate\Support\Str;

class AdditionalCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collections = [
            [
                'name' => 'Keris Bengkulu Pusaka',
                'category_id' => 1,
                'description' => 'Keris pusaka khas Bengkulu dengan motif dan ukiran yang unik. Keris ini menggambarkan kekayaan budaya Bengkulu dan keahlian pandai besi tradisional yang telah diwariskan turun-temurun.',
                'year_period' => '1700-1900',
                'origin_location' => 'Bengkulu',
                'material' => 'Besi, Kayu, Emas',
                'dimensions' => '42cm x 7cm x 2cm',
                'conservation_status' => 'Baik',
                'technical_overview' => 'Keris dengan pamor yang khas Bengkulu, menggunakan teknik tempa tradisional yang menghasilkan bilah yang kuat dan lentur.',
                'nilai_budaya' => 'Keris ini merupakan simbol kekuatan dan kearifan budaya Bengkulu, menggambarkan keahlian pandai besi tradisional.',
                'nilai_historis' => 'Keris ini merupakan peninggalan bersejarah yang menggambarkan kejayaan budaya Bengkulu pada masa lampau.',
                'nilai_edukatif' => 'Mengajarkan tentang teknik tempa tradisional dan nilai-nilai spiritual yang terkandung dalam senjata tradisional Bengkulu.'
            ],
            [
                'name' => 'Batik Bengkulu Motif Pucuk Rebung',
                'category_id' => 2,
                'description' => 'Batik tradisional Bengkulu dengan motif pucuk rebung yang khas. Batik ini dibuat dengan teknik tulis tradisional menggunakan canting dan malam. Motif pucuk rebung melambangkan pertumbuhan dan kemajuan.',
                'year_period' => '1800-1950',
                'origin_location' => 'Bengkulu',
                'material' => 'Kain Katun, Malam, Pewarna Alam',
                'dimensions' => '240cm x 105cm',
                'conservation_status' => 'Sangat Baik',
                'technical_overview' => 'Batik dengan teknik canting tradisional, menggunakan pewarna alam yang tahan lama dan motif yang memiliki makna filosofis.',
                'nilai_budaya' => 'Batik ini merupakan warisan budaya Bengkulu yang menggambarkan keahlian seni batik tradisional.',
                'nilai_historis' => 'Motif pucuk rebung memiliki sejarah panjang dalam budaya Bengkulu dan melambangkan pertumbuhan masyarakat.',
                'nilai_edukatif' => 'Mengajarkan tentang teknik membatik tradisional dan makna filosofis motif-motif batik Bengkulu.'
            ],
            [
                'name' => 'Dol Bengkulu Tradisional',
                'category_id' => 4,
                'description' => 'Dol tradisional Bengkulu yang digunakan dalam berbagai upacara adat dan pertunjukan musik. Dol ini terbuat dari kayu pilihan dengan kulit sapi yang menghasilkan suara yang khas dan merdu.',
                'year_period' => '1900-1950',
                'origin_location' => 'Bengkulu',
                'material' => 'Kayu, Kulit Sapi, Tali',
                'dimensions' => 'Diameter 60cm, Tinggi 40cm',
                'conservation_status' => 'Baik',
                'technical_overview' => 'Dol dengan teknik pembuatan tradisional, menggunakan kayu pilihan dan kulit sapi yang menghasilkan suara yang khas.',
                'nilai_budaya' => 'Dol merupakan alat musik tradisional Bengkulu yang digunakan dalam berbagai upacara adat.',
                'nilai_historis' => 'Dol memiliki sejarah panjang dalam budaya Bengkulu dan merupakan bagian penting dari tradisi musik daerah.',
                'nilai_edukatif' => 'Mengajarkan tentang teknik pembuatan alat musik tradisional dan nilai-nilai budaya Bengkulu.'
            ],
            [
                'name' => 'Mahkota Sultan Bengkulu',
                'category_id' => 3,
                'description' => 'Mahkota sultan Bengkulu yang terbuat dari emas dengan hiasan batu permata dan mutiara. Mahkota ini memiliki desain yang khas dengan motif-motif tradisional Bengkulu yang menggambarkan kekuatan dan kewibawaan.',
                'year_period' => '1700-1800',
                'origin_location' => 'Bengkulu',
                'material' => 'Emas, Permata, Mutiara',
                'dimensions' => '28cm x 22cm x 18cm',
                'conservation_status' => 'Sangat Baik',
                'technical_overview' => 'Mahkota dengan teknik ukir emas tradisional, menggunakan batu permata asli dan teknik penyepuhan yang halus.',
                'nilai_budaya' => 'Mahkota ini merupakan simbol kekuasaan dan kewibawaan sultan Bengkulu pada masa lampau.',
                'nilai_historis' => 'Mahkota ini merupakan peninggalan bersejarah yang menggambarkan kejayaan kesultanan Bengkulu.',
                'nilai_edukatif' => 'Mengajarkan tentang teknik pembuatan perhiasan tradisional dan nilai-nilai budaya kesultanan.'
            ],
            [
                'name' => 'Wayang Kulit Bengkulu',
                'category_id' => 5,
                'description' => 'Wayang kulit tradisional Bengkulu dengan tokoh-tokoh dari cerita rakyat lokal. Wayang ini dibuat dari kulit kerbau yang diukir dengan detail yang sangat halus dan memiliki karakteristik khas Bengkulu.',
                'year_period' => '1800-1900',
                'origin_location' => 'Bengkulu',
                'material' => 'Kulit Kerbau, Tanduk, Cat',
                'dimensions' => '55cm x 35cm',
                'conservation_status' => 'Baik',
                'technical_overview' => 'Wayang dengan ukiran detail yang halus, menggunakan teknik pahat tradisional dan pewarnaan yang tahan lama.',
                'nilai_budaya' => 'Wayang kulit merupakan seni pertunjukan tradisional Bengkulu yang menggambarkan cerita rakyat lokal.',
                'nilai_historis' => 'Wayang ini merupakan peninggalan budaya yang menggambarkan tradisi seni pertunjukan Bengkulu.',
                'nilai_edukatif' => 'Mengajarkan tentang teknik pembuatan wayang dan nilai-nilai moral dalam cerita rakyat.'
            ],
            [
                'name' => 'Tombak Bengkulu Pusaka',
                'category_id' => 1,
                'description' => 'Tombak pusaka Bengkulu dengan mata yang tajam dan gagang yang dihias dengan ukiran tradisional. Tombak ini digunakan dalam upacara-upacara sakral dan ritual keagamaan masyarakat Bengkulu.',
                'year_period' => '1600-1800',
                'origin_location' => 'Bengkulu',
                'material' => 'Besi, Kayu, Perak',
                'dimensions' => '175cm x 12cm',
                'conservation_status' => 'Baik',
                'technical_overview' => 'Tombak dengan mata yang tajam dan seimbang, menggunakan teknik tempa tradisional yang menghasilkan bilah yang kuat.',
                'nilai_budaya' => 'Tombak ini merupakan senjata tradisional Bengkulu yang memiliki nilai spiritual dan budaya tinggi.',
                'nilai_historis' => 'Tombak ini merupakan peninggalan bersejarah yang menggambarkan tradisi pembuatan senjata tradisional Bengkulu.',
                'nilai_edukatif' => 'Mengajarkan tentang teknik pembuatan senjata tradisional dan nilai-nilai spiritual yang terkandung di dalamnya.'
            ],
            [
                'name' => 'Songket Bengkulu Motif Pucuk Rebung',
                'category_id' => 2,
                'description' => 'Kain songket tradisional Bengkulu dengan motif pucuk rebung yang khas. Songket ini dibuat dengan teknik tenun yang rumit menggunakan benang emas dan perak. Motif pucuk rebung melambangkan pertumbuhan dan kemajuan.',
                'year_period' => '1800-1950',
                'origin_location' => 'Bengkulu',
                'material' => 'Sutra, Benang Emas, Benang Perak',
                'dimensions' => '220cm x 95cm',
                'conservation_status' => 'Sangat Baik',
                'technical_overview' => 'Songket dengan teknik tenun tradisional, menggunakan benang emas dan perak asli yang menghasilkan kilau yang indah.',
                'nilai_budaya' => 'Songket ini merupakan warisan budaya Bengkulu yang menggambarkan keahlian seni tenun tradisional.',
                'nilai_historis' => 'Motif pucuk rebung memiliki sejarah panjang dalam budaya Bengkulu dan melambangkan pertumbuhan masyarakat.',
                'nilai_edukatif' => 'Mengajarkan tentang teknik tenun tradisional dan makna filosofis motif-motif songket Bengkulu.'
            ],
            [
                'name' => 'Gendang Bengkulu Tradisional',
                'category_id' => 4,
                'description' => 'Gendang tradisional Bengkulu yang digunakan dalam berbagai upacara adat dan pertunjukan musik. Gendang ini terbuat dari kayu pilihan dengan kulit sapi yang menghasilkan suara yang khas dan merdu.',
                'year_period' => '1900-1950',
                'origin_location' => 'Bengkulu',
                'material' => 'Kayu, Kulit Sapi, Tali',
                'dimensions' => 'Diameter 45cm, Tinggi 30cm',
                'conservation_status' => 'Baik',
                'technical_overview' => 'Gendang dengan teknik pembuatan tradisional, menggunakan kayu pilihan dan kulit sapi yang menghasilkan suara yang khas.',
                'nilai_budaya' => 'Gendang merupakan alat musik tradisional Bengkulu yang digunakan dalam berbagai upacara adat.',
                'nilai_historis' => 'Gendang memiliki sejarah panjang dalam budaya Bengkulu dan merupakan bagian penting dari tradisi musik daerah.',
                'nilai_edukatif' => 'Mengajarkan tentang teknik pembuatan alat musik tradisional dan nilai-nilai budaya Bengkulu.'
            ],
            [
                'name' => 'Kalung Mutiara Bengkulu',
                'category_id' => 3,
                'description' => 'Kalung mutiara tradisional Bengkulu yang terbuat dari mutiara asli berkualitas tinggi. Kalung ini dirangkai dengan teknik yang sangat halus dan memiliki desain yang khas Bengkulu.',
                'year_period' => '1700-1800',
                'origin_location' => 'Bengkulu',
                'material' => 'Mutiara Asli, Emas, Sutra',
                'dimensions' => 'Panjang 45cm',
                'conservation_status' => 'Sangat Baik',
                'technical_overview' => 'Kalung dengan mutiara asli berkualitas tinggi, menggunakan teknik rangkaian tradisional yang halus.',
                'nilai_budaya' => 'Kalung ini merupakan perhiasan tradisional Bengkulu yang melambangkan kemewahan dan keindahan.',
                'nilai_historis' => 'Kalung ini merupakan peninggalan bersejarah yang menggambarkan tradisi pembuatan perhiasan Bengkulu.',
                'nilai_edukatif' => 'Mengajarkan tentang teknik pembuatan perhiasan tradisional dan nilai-nilai estetika budaya Bengkulu.'
            ],
            [
                'name' => 'Tepak Sirih Bengkulu',
                'category_id' => 6,
                'description' => 'Tepak sirih tradisional Bengkulu yang digunakan dalam upacara adat dan penyambutan tamu. Tepak ini terbuat dari perak dengan ukiran yang detail dan memiliki beberapa kompartemen untuk menyimpan berbagai bahan sirih.',
                'year_period' => '1700-1900',
                'origin_location' => 'Bengkulu',
                'material' => 'Perak, Kayu, Ukiran',
                'dimensions' => '32cm x 22cm x 18cm',
                'conservation_status' => 'Baik',
                'technical_overview' => 'Tepak dengan ukiran perak yang detail, menggunakan teknik ukir tradisional yang menghasilkan motif yang indah.',
                'nilai_budaya' => 'Tepak sirih merupakan alat tradisional Bengkulu yang digunakan dalam berbagai upacara adat.',
                'nilai_historis' => 'Tepak ini merupakan peninggalan bersejarah yang menggambarkan tradisi penyambutan tamu di Bengkulu.',
                'nilai_edukatif' => 'Mengajarkan tentang teknik pembuatan alat tradisional dan nilai-nilai budaya dalam penyambutan tamu.'
            ]
        ];

        foreach ($collections as $collection) {
            $category = Category::where('id', $collection['category_id'])->first();

            if ($category) {
                Collection::create([
                    'name' => $collection['name'],
                    'slug' => Str::slug($collection['name']),
                    'category_id' => $category->id,
                    'description' => $collection['description'],
                    'year_period' => $collection['year_period'],
                    'origin_location' => $collection['origin_location'],
                    'material' => $collection['material'] ?? null,
                    'dimensions' => $collection['dimensions'] ?? null,
                    'conservation_status' => $collection['conservation_status'] ?? null,
                    'technical_overview' => $collection['technical_overview'] ?? null,
                    'nilai_historis' => $collection['nilai_historis'] ?? null,
                    'nilai_edukatif' => $collection['nilai_edukatif'] ?? null,
                    'nilai_budaya' => $collection['nilai_budaya'] ?? null,
                    'image_path' => null, // Admin akan upload gambar nanti
                    'is_featured' => false,
                    'is_active' => true,
                    'view_count' => rand(10, 500)
                ]);
            }
        }

        $this->command->info('Additional collections seeded successfully!');
    }
}

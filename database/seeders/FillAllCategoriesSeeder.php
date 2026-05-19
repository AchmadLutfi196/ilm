<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FillAllCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::first();
        $categories = Category::all()->keyBy('slug');

        $allNews = [
            'headline' => [
                ['title' => 'Guru Non-ASN Dijamin Tetap Mengajar, Pemerintah Siapkan Skema Jadi ASN', 'content' => 'Pemerintah Kabupaten Mojokerto memastikan guru non-ASN tetap mendapat kesempatan mengajar dan disiapkan jalur seleksi PPPK.', 'featured' => true],
                ['title' => 'Mulai 9 Mei KA Argo Bromo Anggrek Resmi Berubah Nama Jadi KA Anggrek', 'content' => 'PT KAI resmi mengubah nama kereta api Argo Bromo Anggrek menjadi KA Anggrek yang berlaku efektif mulai 9 Mei 2026.', 'featured' => true],
                ['title' => 'BPS Mencatat Pertumbuhan Ekonomi Mojokerto Triwulan 1 2026 Mencapai 5.41 Persen', 'content' => 'Badan Pusat Statistik mencatat pertumbuhan ekonomi wilayah Mojokerto pada triwulan pertama tahun 2026 mencapai 5,41 persen.', 'featured' => true],
            ],
            'regional' => [
                ['title' => 'Pemkab Mojokerto Gelar Musyawarah Perencanaan Pembangunan Kecamatan', 'content' => 'Serangkaian program prioritas tahun 2027 mulai dibahas di tingkat kecamatan untuk menyerap aspirasi langsung dari warga.'],
                ['title' => 'Warga Desa Wisata Bejijong Terima Bantuan Penguatan Literasi Budaya', 'content' => 'Upaya pelestarian warisan Majapahit mendapatkan dukungan dari pemerintah provinsi melalui program hibah peralatan digital.'],
                ['title' => 'Jalan Provinsi di Kecamatan Pacet Diperbaiki Senilai Rp 12 Miliar', 'content' => 'Perbaikan jalan provinsi sepanjang 4,5 km di Kecamatan Pacet ditargetkan selesai sebelum musim hujan.'],
                ['title' => 'Festival Kuliner Mojokerto 2026 Hadirkan 200 UMKM Lokal', 'content' => 'Festival kuliner tahunan Mojokerto kembali digelar dengan menghadirkan 200 pelaku UMKM dari seluruh kecamatan.'],
            ],
            'hukum' => [
                ['title' => 'Kejaksaan Negeri Mojokerto Tuntaskan Kasus Sengketa Lahan Milik Warga', 'content' => 'Setelah melalui proses mediasi panjang, Kejari berhasil mengembalikan hak atas tanah kepada kelompok tani yang telah berjuang selama lima tahun.'],
                ['title' => 'Polres Mojokerto Ungkap Jaringan Penipuan Online Bermodus Investasi Bodong', 'content' => 'Tiga tersangka ditangkap setelah dilaporkan oleh puluhan korban dengan total kerugian mencapai Rp 2,3 miliar.'],
                ['title' => 'Sidang Kasus Korupsi Dana Desa di Mojokerto Memasuki Babak Baru', 'content' => 'Jaksa penuntut umum menghadirkan saksi kunci dalam persidangan kasus korupsi dana desa yang merugikan negara Rp 800 juta.'],
            ],
            'politik' => [
                ['title' => 'Konsolidasi Parpol di Jawa Timur Mulai Menghangat Jelang Pilkada Serentak', 'content' => 'Beberapa koalisi besar mulai menunjukkan strategi komunikasi politik melalui agenda kunjungan ke tokoh lokal.'],
                ['title' => 'DPRD Mojokerto Sahkan Perda Penataan PKL di Pusat Kota', 'content' => 'DPRD Kota Mojokerto resmi mengesahkan Peraturan Daerah tentang penataan pedagang kaki lima di kawasan pusat kota.'],
                ['title' => 'Partai Golkar Jatim Gelar Rapimda Bahas Strategi Pilkada 2027', 'content' => 'DPD Partai Golkar Jawa Timur menggelar Rapat Pimpinan Daerah yang dihadiri seluruh pengurus tingkat kabupaten/kota.'],
            ],
            'dikbud' => [
                ['title' => 'PPDB 2026 Mulai Disosialisasikan di Mojokerto', 'content' => 'Dinas Pendidikan memastikan sistem zonasi tahun ini akan lebih fleksibel untuk membantu siswa di daerah perbatasan.'],
                ['title' => 'SMK Negeri 1 Mojokerto Raih Juara Umum LKS Tingkat Provinsi', 'content' => 'SMK Negeri 1 Mojokerto berhasil meraih predikat juara umum dalam Lomba Kompetensi Siswa tingkat Provinsi Jawa Timur.'],
                ['title' => 'Program Literasi Digital Masuk Kurikulum SD di Mojokerto', 'content' => 'Dinas Pendidikan Kabupaten Mojokerto mulai mengintegrasikan literasi digital ke dalam kurikulum sekolah dasar.'],
            ],
            'pariwisata' => [
                ['title' => 'Pesona Air Terjun Dlundung Tarik Minat Wisatawan Mancanegara', 'content' => 'Keindahan alam Trawas kembali menjadi primadona dengan peningkatan kunjungan turis dari kawasan Asia Tenggara.'],
                ['title' => 'Desa Wisata Trowulan Kembangkan Paket Wisata Edukasi Majapahit', 'content' => 'Pokdarwis di kawasan Trowulan mengembangkan paket wisata edukasi bertema Kerajaan Majapahit.'],
                ['title' => 'Wisata Alam Pacet Siapkan Infrastruktur Baru untuk Libur Lebaran', 'content' => 'Pengelola kawasan wisata Pacet membangun jalur pedestrian dan area parkir baru menjelang musim libur.'],
            ],
            'tekno' => [
                ['title' => 'Startup Lokal Mojokerto Ciptakan Aplikasi Prediksi Harga Pangan Berbasis AI', 'content' => 'Aplikasi TaniCerdas menggunakan data historis harga, cuaca, dan pola tanam untuk memprediksi harga komoditas.'],
                ['title' => 'Pemkab Mojokerto Luncurkan Aplikasi Layanan Publik Terintegrasi', 'content' => 'Aplikasi Mojokerto Smart City mengintegrasikan berbagai layanan publik dalam satu platform.'],
                ['title' => 'Workshop Coding untuk Anak Digelar di Perpustakaan Kota Mojokerto', 'content' => 'Program pengenalan pemrograman komputer untuk anak usia 10-15 tahun digelar gratis selama sebulan penuh.'],
            ],
            'ekonomi' => [
                ['title' => 'UMKM Mojokerto Raya Tembus Pasar Ekspor Kerajinan Alas Kaki', 'content' => 'Sektor industri kecil kembali menggeliat dengan ditandatanganinya kerjasama dagang bersama distributor dari Australia.'],
                ['title' => 'Kenaikan Harga Beras Mulai Meresahkan Warga Pasar Tanjung', 'content' => 'Harga beras di Pasar Tanjung mengalami kenaikan signifikan dalam dua pekan terakhir.'],
                ['title' => 'Bank Jatim Salurkan KUR Rp 50 Miliar untuk Petani Mojokerto', 'content' => 'Bank Jatim menyalurkan Kredit Usaha Rakyat senilai Rp 50 miliar untuk para petani di Kabupaten Mojokerto.'],
            ],
            'kuliner' => [
                ['title' => 'Onde-onde Mojokerto Kini Hadir dengan Varian Rasa Kekinian', 'content' => 'Inovasi kuliner khas Mojokerto mulai merambah rasa matcha dan salted egg, menarik minat generasi muda.'],
                ['title' => 'Warung Rujak Cingur Legendaris di Mojokerto Ramai Dikunjungi Wisatawan', 'content' => 'Warung rujak cingur yang sudah berdiri sejak 1970 ini menjadi destinasi kuliner wajib bagi pengunjung Mojokerto.'],
                ['title' => 'Festival Jajanan Tradisional Mojokerto Digelar di Alun-alun', 'content' => 'Puluhan pedagang jajanan tradisional memamerkan kreasi kuliner khas Mojokerto selama tiga hari berturut-turut.'],
            ],
            'olahraga' => [
                ['title' => 'PSMP Mojokerto Siapkan Skuat Muda untuk Liga 3 Musim Depan', 'content' => 'Manajemen PSMP tengah berburu pemain muda berkualitas untuk memperkuat tim menjelang Liga 3.'],
                ['title' => 'Atlet Pencak Silat Mojokerto Raih Emas di Kejurnas', 'content' => 'Muhammad Rizki berhasil meraih medali emas di Kejuaraan Nasional Pencak Silat 2026.'],
                ['title' => 'Turnamen Bulu Tangkis Antar Kecamatan Digelar di GOR Mojokerto', 'content' => 'GOR Kota Mojokerto menjadi tuan rumah turnamen bulu tangkis yang diikuti 200 atlet dari 21 kecamatan.'],
            ],
            'info-pelayanan-public' => [
                ['title' => 'Jadwal SIM Keliling Mojokerto Minggu Kedua Mei 2026', 'content' => 'Masyarakat diimbau mengecek lokasi operasional bus SIM Keliling guna mempermudah perpanjangan dokumen.'],
                ['title' => 'Layanan Adminduk Online Mojokerto Kini Bisa Diakses 24 Jam', 'content' => 'Dinas Kependudukan dan Catatan Sipil meluncurkan layanan online yang bisa diakses kapan saja.'],
                ['title' => 'Pemkab Buka Pendaftaran Bantuan Sosial Tunai Periode Mei 2026', 'content' => 'Warga yang memenuhi kriteria dapat mendaftar melalui kelurahan masing-masing hingga akhir bulan.'],
            ],
            'literasi' => [
                ['title' => 'Festival Literasi Mojokerto: Menumbuhkan Budaya Membaca Sejak Dini', 'content' => 'Rangkaian acara bedah buku dan lomba menulis cerpen digelar untuk meningkatkan indeks literasi masyarakat.'],
                ['title' => 'Perpustakaan Keliling Mojokerto Kunjungi 50 Desa Terpencil', 'content' => 'Program perpustakaan keliling berhasil menjangkau desa-desa yang jauh dari akses perpustakaan umum.'],
                ['title' => 'Komunitas Baca Mojokerto Gelar Diskusi Buku Bulanan di Taman Kota', 'content' => 'Kegiatan rutin ini bertujuan membangun kebiasaan membaca dan berdiskusi di kalangan anak muda.'],
            ],
            'potret' => [
                ['title' => 'Potret Kehidupan Nelayan Sungai Brantas di Pagi Hari', 'content' => 'Dokumentasi aktivitas nelayan tradisional yang masih bertahan di sepanjang Sungai Brantas, Mojokerto.'],
                ['title' => 'Wajah Baru Alun-alun Mojokerto Setelah Revitalisasi', 'content' => 'Alun-alun Kota Mojokerto tampil lebih modern dengan taman bermain anak dan area jogging track.'],
                ['title' => 'Suasana Pasar Tradisional Mojosari di Hari Minggu', 'content' => 'Keramaian pasar tradisional yang masih menjadi denyut ekonomi warga Kecamatan Mojosari setiap akhir pekan.'],
            ],
            'potret-kelana-kota' => [
                ['title' => 'Upacara Hari Pendidikan Nasional 2026 di Mojokerto', 'content' => 'Dokumentasi upacara peringatan Hari Pendidikan Nasional yang digelar di halaman Pemkab Mojokerto.'],
                ['title' => 'Fun Run 5K Menjadi Launching JConnect Run Mojokerto 10K 2026', 'content' => 'Ratusan peserta mengikuti fun run 5K sebagai pembuka rangkaian event lari JConnect Run Mojokerto.'],
                ['title' => 'Peringatan May Day 2026 di Alun-alun Mojokerto', 'content' => 'Ribuan buruh dari berbagai serikat pekerja menggelar aksi damai memperingati Hari Buruh Internasional.'],
            ],
        ];

        $imgIndex = 1;
        foreach ($allNews as $catSlug => $articles) {
            $category = $categories->get($catSlug);
            if (!$category) {
                $this->command->warn("Category not found: $catSlug");
                continue;
            }

            foreach ($articles as $article) {
                $imgNum = str_pad(($imgIndex % 20) + 1, 2, '0', STR_PAD_LEFT);
                
                News::firstOrCreate(
                    ['title' => $article['title']],
                    [
                        'slug' => Str::slug($article['title']),
                        'content' => '<p>' . $article['content'] . '</p>',
                        'excerpt' => Str::limit($article['content'], 150),
                        'thumbnail' => "thumbnails/2026/05/news_{$imgNum}.jpg",
                        'category_id' => $category->id,
                        'author_id' => $author->id,
                        'status' => 'published',
                        'is_featured' => $article['featured'] ?? false,
                        'is_breaking_news' => false,
                        'views' => rand(50, 5000),
                        'published_at' => now()->subHours(rand(1, 168)),
                    ]
                );
                $imgIndex++;
            }
            $this->command->info("Seeded: $catSlug ({$category->name}) - " . count($articles) . " articles");
        }

        $this->command->info('All categories filled!');
    }
}

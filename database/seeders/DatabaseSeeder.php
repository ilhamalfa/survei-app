<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Jawaban;
use App\Models\JawabanGanda;
use App\Models\SoalKuisioner;
use App\Models\Unsur;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // User
        User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'nomor_telp' => '081216110775',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Test',
            'username' => 'test',
            'email' => 'test@gmail.com',
            'nomor_telp' => '081216110776',
            'password' => Hash::make('operator123'),
            'role' => 'operator'
        ]);

        User::create([
            'name' => 'Coba',
            'username' => 'coba',
            'email' => 'coba@gmail.com',
            'nomor_telp' => '081216110777',
            'password' => Hash::make('operator123'),
            'role' => 'operator'
        ]);

        // Unsur
        Unsur::create([
            'unsur_skm' => 'Persyaratan',
        ]);

        Unsur::create([
            'unsur_skm' => 'Sistem, Mekanisme, dan Prosedur',
        ]);

        Unsur::create([
            'unsur_skm' => 'Waktu Penyelesaian',
        ]);

        Unsur::create([
            'unsur_skm' => 'Biaya/Tarif',
        ]);

        Unsur::create([
            'unsur_skm' => 'Produk Spesifikasi jenis pelayanan',
        ]);

        Unsur::create([
            'unsur_skm' => 'Kompetensi pelaksana',
        ]);

        Unsur::create([
            'unsur_skm' => 'Perilaku pelaksana',
        ]);

        Unsur::create([
            'unsur_skm' => 'Penanganan Pengaduan, Saran dan Masukan',
        ]);

        Unsur::create([
            'unsur_skm' => 'Sarana dan Prasana',
        ]);


        // Jenis Jawaban
        Jawaban::create([
            'jenis_jawaban' => 'Jenis Jawaban 1',
        ]);

        Jawaban::create([
            'jenis_jawaban' => 'Jenis Jawaban 2',
        ]);

        Jawaban::create([
            'jenis_jawaban' => 'Jenis Jawaban 3',
        ]);

        Jawaban::create([
            'jenis_jawaban' => 'Jenis Jawaban 4',
        ]);

        Jawaban::create([
            'jenis_jawaban' => 'Jenis Jawaban 5',
        ]);

        Jawaban::create([
            'jenis_jawaban' => 'Jenis Jawaban 6',
        ]);

        Jawaban::create([
            'jenis_jawaban' => 'Jenis Jawaban 7',
        ]);

        // Jawaban Ganda
        // jawaban 1
        JawabanGanda::create([
            'jawaban' => 'Sangat Sesuai',
            'bobot' => 4.00,
            'jawaban_id' => 1
        ]);

        JawabanGanda::create([
            'jawaban' => 'Sesuai',
            'bobot' => 3.00,
            'jawaban_id' => 1
        ]);

        JawabanGanda::create([
            'jawaban' => 'Kurang Sesuai',
            'bobot' => 2.00,
            'jawaban_id' => 1
        ]);

        JawabanGanda::create([
            'jawaban' => 'Tidak Sesuai',
            'bobot' => 1.00,
            'jawaban_id' => 1
        ]);

        // jawaban 2
        JawabanGanda::create([
            'jawaban' => 'Sangat Mudah',
            'bobot' => 4.00,
            'jawaban_id' => 2
        ]);

        JawabanGanda::create([
            'jawaban' => 'Mudah',
            'bobot' => 3.00,
            'jawaban_id' => 2
        ]);

        JawabanGanda::create([
            'jawaban' => 'Kurang Mudah',
            'bobot' => 2.00,
            'jawaban_id' => 2
        ]);

        JawabanGanda::create([
            'jawaban' => 'Tidak Mudah',
            'bobot' => 1.00,
            'jawaban_id' => 2
        ]);

        // jawaban 3
        JawabanGanda::create([
            'jawaban' => 'Sangat Cepat',
            'bobot' => 4.00,
            'jawaban_id' => 3
        ]);

        JawabanGanda::create([
            'jawaban' => 'Cepat',
            'bobot' => 3.00,
            'jawaban_id' => 3
        ]);

        JawabanGanda::create([
            'jawaban' => 'Kurang Cepat',
            'bobot' => 2.00,
            'jawaban_id' => 3
        ]);

        JawabanGanda::create([
            'jawaban' => 'Tidak Cepat',
            'bobot' => 1.00,
            'jawaban_id' => 3
        ]);

        // jawaban 4
        JawabanGanda::create([
            'jawaban' => 'Gratis',
            'bobot' => 4.00,
            'jawaban_id' => 4
        ]);

        JawabanGanda::create([
            'jawaban' => 'Murah',
            'bobot' => 3.00,
            'jawaban_id' => 4
        ]);

        JawabanGanda::create([
            'jawaban' => 'Cukup Mahal',
            'bobot' => 2.00,
            'jawaban_id' => 4
        ]);

        JawabanGanda::create([
            'jawaban' => 'Sangat Mahal',
            'bobot' => 1.00,
            'jawaban_id' => 4
        ]);

        // jawaban 5
        JawabanGanda::create([
            'jawaban' => 'Sangat Kompeten',
            'bobot' => 4.00,
            'jawaban_id' => 5
        ]);

        JawabanGanda::create([
            'jawaban' => 'Kompeten',
            'bobot' => 3.00,
            'jawaban_id' => 5
        ]);

        JawabanGanda::create([
            'jawaban' => 'Kurang Kompeten',
            'bobot' => 2.00,
            'jawaban_id' => 5
        ]);

        JawabanGanda::create([
            'jawaban' => 'Tidak Kompeten',
            'bobot' => 1.00,
            'jawaban_id' => 5
        ]);

        // jawaban 6
        JawabanGanda::create([
            'jawaban' => 'Sangat Baik',
            'bobot' => 4.00,
            'jawaban_id' => 6
        ]);

        JawabanGanda::create([
            'jawaban' => 'Baik',
            'bobot' => 3.00,
            'jawaban_id' => 6
        ]);

        JawabanGanda::create([
            'jawaban' => 'Cukup',
            'bobot' => 2.00,
            'jawaban_id' => 6
        ]);

        JawabanGanda::create([
            'jawaban' => 'Buruk',
            'bobot' => 1.00,
            'jawaban_id' => 6
        ]);

        // jawaban 7
        JawabanGanda::create([
            'jawaban' => 'Dikelola Dengan Baik',
            'bobot' => 4.00,
            'jawaban_id' => 7
        ]);

        JawabanGanda::create([
            'jawaban' => 'Berfungsi Kurang Maksimal',
            'bobot' => 3.00,
            'jawaban_id' => 7
        ]);

        JawabanGanda::create([
            'jawaban' => 'Ada Tetapi Tidak Berfungsi',
            'bobot' => 2.00,
            'jawaban_id' => 7
        ]);

        JawabanGanda::create([
            'jawaban' => 'Tidak Ada',
            'bobot' => 1.00,
            'jawaban_id' => 7
        ]);

        // Soal Kuisioner Default
        SoalKuisioner::create([
            'pertanyaan' => 'Bagaimana pendapat Saudara tentang kesesuaian persyaratan pelayanan dengan jenis pelayanannya?',
            'unsur_id' => 1,
            'is_default' => 1
        ]);

        SoalKuisioner::create([
            'pertanyaan' => 'Bagaimana pemahaman Saudara tentang kemudahan prosedur pelayanan di unit ini?',
            'unsur_id' => 2,
            'is_default' => 1
        ]);

        SoalKuisioner::create([
            'pertanyaan' => 'Bagaimana pendapat Saudara tentang kecepatan waktu dalam memberikan pelayanan?',
            'unsur_id' => 3,
            'is_default' => 1
        ]);

        SoalKuisioner::create([
            'pertanyaan' => 'Bagaimana pendapat Saudara tentang kewajaran biaya atau tarif dalam pelayanan?',
            'unsur_id' => 4,
            'is_default' => 1
        ]);

        SoalKuisioner::create([
            'pertanyaan' => 'Bagaimana pendapat Saudara tentang kesesuaian produk pelayanan antara yang tercantum dalam standar pelayanan dengan hasil yang diberikan?',
            'unsur_id' => 5,
            'is_default' => 1
        ]);

        SoalKuisioner::create([
            'pertanyaan' => 'Bagaimana pendapat Saudara tentang kompetensi atau kemampuan petugas dalam pelayanan?',
            'unsur_id' => 6,
            'is_default' => 1
        ]);

        SoalKuisioner::create([
            'pertanyaan' => 'Bagaimana pendapat saudara perilaku petugas dalam pelayanan terkait kesopanan dan keramahan?',
            'unsur_id' => 7,
            'is_default' => 1
        ]);

        SoalKuisioner::create([
            'pertanyaan' => 'Bagaimana pendapat Saudara tentang kualitas sarana dan prasarana?',
            'unsur_id' => 8,
            'is_default' => 1
        ]);

        SoalKuisioner::create([
            'pertanyaan' => 'Bagaimana pendapat Saudara tentang penanganan pengaduan pengguna layanan',
            'unsur_id' => 9,
            'is_default' => 1
        ]);
    }
}

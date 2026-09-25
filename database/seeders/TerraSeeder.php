<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Work;
use App\Models\Chapter;
use App\Models\Comment;

class TerraSeeder extends Seeder
{
    public function run(): void
    {
        // Sample Karya 1: Novel Martial Arts / Slice of Life
        $work1 = Work::create([
            'title'       => 'Satu Babak Sebelum Fajar',
            'slug'        => 'satu-babak-sebelum-fajar',
            'synopsis'    => 'Di balik deru mesin motor di jalanan kota dan keringat di ruang latihan, ada kisah-kisah kecil yang tak pernah sempat diceritakan.',
            'type'        => 'novel',
            'genre'       => 'Slice of Life & Martial Arts',
            'status'      => 'ongoing',
            'views'       => 128
        ]);

        $chap1 = Chapter::create([
            'work_id'               => $work1->id,
            'title'                 => 'Bab 1: Aroma Kopi dan Sabuk Hitam',
            'slug'                  => 'bab-1-aroma-kopi-dan-sabuk-hitam',
            'chapter_number'        => 1,
            'content'               => "Bunyi dentingan sendok di cangkir kopi mengawali pagi itu. Angin dingin merayap masuk dari celah jendela warkop, membawa bau hujan semalam.\n\nGenggamannya pada piala perunggu itu terasa begitu dingin. Bukan tentang medali yang ia menangkan kemarin petang, tapi tentang pertanyaan yang selalu membayangi setiap kali melangkah keluar dari arena dojo.\n\n\"Lu mau terus-terusan di sini, atau mau melangkah lebih jauh?\" bisik suara di benaknya.",
            'reading_time_minutes'  => 3,
            'likes'                 => 15
        ]);

        Comment::create([
    'chapter_id' => $chap1->id,
    'username'   => 'Pembaca Setia',
    'comment'    => 'Opening-nya dapet banget atmosfer warkopnya! Lanjut bab 2 bang!'
]);

        // Sample Karya 2: Antologi Puisi
        $work2 = Work::create([
            'title'       => 'Catatan Tepi Kota Sidoarjo',
            'slug'        => 'catatan-tepi-kota-sidoarjo',
            'synopsis'    => 'Kumpulan larik sederhana tentang aspal, lampu jalan, dan obrolan malam.',
            'type'        => 'poetry',
            'genre'       => 'Poetry',
            'status'      => 'completed',
            'views'       => 75
        ]);

        Chapter::create([
            'work_id'               => $work2->id,
            'title'                 => 'Bait 01: Di Luar Doa',
            'slug'                  => 'bait-01-di-luar-doa',
            'chapter_number'        => 1,
            'content'               => "Asap tipis mengepul dari cangkir hitam.\nDi antara barisan kode yang belum usai,\nKita mengeja waktu yang terbuang,\nTanpa perlu berdebat siapa yang menang.",
            'reading_time_minutes'  => 1,
            'likes'                 => 24
        ]);
    }
}
<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Hadith;

class HadithSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hadiths = [
            [
                'order' => 'الحديث الأول',
                'text' => 'أَبْرِدُوا بِالظُّهْرِ، فَإِنَّ شِدَّةِ الحَرِّ مِنْ فَيْحِ جَهَنَّمَ',
             
            ],
            [
                'order' => 'الحديث الثاني',
                'text' => 'فْطَرَ الحَاجِمُ والمَحْجُومُ',
            ],
            [
                'order' => 'الحديث الثالث',
                'text' => 'للَّهُمَّ إِنَّكَ سَأَلْتَنَا مِنْ أَنْفُسِنَا مَا لَا نَمْلِكُهُ إِلَّا بِكَ، فَأَعْطِنَا مِنْكَ مَا يُرْضِيكَ عَنَّا',
            ],
           
        ];

        foreach ($hadiths as $hadith) {
            Hadith::create($hadith);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Setting::create([
            'name' => 'انتِ',
            'name_en' => 'انتِ',
            'discription' => 'انتِ',
            'discription_en' => 'انتِ',
            'image' => 'logo.png',
            'image_id' => 'logo.png',
            'email' => 'your2019@gmail.com',
            'facebook' => 'your2019@gmail.com',
            'twiter' => 'your2019@gmail.com',
            'linked_in' => 'your2019@gmail.com',
            'instagram' => 'your2019@gmail.com',
            'whatsapp' => 'your2019@gmail.com',
            'address' => 'your',
            'address_en' => 'your',
        ]);
    }
}

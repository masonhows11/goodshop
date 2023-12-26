<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'title' => 'فروشگاه من',
            'description' => 'توضیحات فروشگاه من',
            'keywords' => 'کلمات کلیدی فروشگاه',
            'logo' => null,
            'icon' => null,
        ]);
    }
}

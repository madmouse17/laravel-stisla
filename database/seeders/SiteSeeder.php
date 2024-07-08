<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $path = public_path('images/favicon');
        $path1 = public_path('images/logo');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        if (!file_exists($path1)) {
            mkdir($path1, 0777, true);
        }
        SiteSetting::create([
            'title' => 'Website Pneumonia',
            'description' => 'Cirebon',
            'favicon' => $faker->image($path, 25, 25, null, false),
            'logo' => $faker->image($path1, 100, 100, null, false),
        ]);
    }
}

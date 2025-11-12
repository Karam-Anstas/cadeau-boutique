<?php

namespace Database\Seeders;

use App\Models\Occasion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OccasionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $occasions = [
            [
                "name" => "Birthday",
                "description" => "Find your gifts for birthdays celebrations",
                "image" => null,
            ],
            [
                "name" => "Mother's day",
                "description" => "Special gifts for mothers",
                "image" => null,
            ],
            [
                "name" => "Father's day",
                "description" => "Special gifts for fathers",
                "image" => null,
            ],
            [
                "name" => "Anniversary",
                "description" => "Lovely gifts for anniversaries",
                "image" => null,
            ],
            [
                "name" => "Christmas",
                "description" => "Festive gifts for Christmas celebrations",
                "image" => null,
            ],
            [
                "name" => "Housewarming",
                "description" => "Perfect gifts for new homes",
                "image" => null,
            ],
        ];

        foreach ($occasions as $occasion) {
            Occasion::create($occasion);
        }
    }
}

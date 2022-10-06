<?php

namespace Database\Factories;

use App\Enums\AcceptanceStatus;
use App\Models\Album;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ImageFactory extends Factory
{
    protected $model = Image::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(4, true),
            'description' => $this->faker->text(),
            'image' => $this->faker->imageUrl(3000,2000),
            'image_file_name' => $this->faker->name(),
            'accepted' => AcceptanceStatus::NOT_DEFINED->value,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'album_id' => Album::inRandomOrder()->first(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Material;
use App\Models\RecyclingCenter; // Assurez-vous d'importer le modèle correct
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class MaterialFactory extends Factory
{
    protected $model = Material::class;

    public function definition()
    {
        return [
            'material_name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'recycling_center_id' => RecyclingCenter::inRandomOrder()->first()->id, // Utilisation correcte du modèle Eloquent
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Empresa;

class ProdutoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Produto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $empresa_id = Empresa::pluck('id')->toArray();
        return [
            'nome'              => $this->faker->word(),
            'decricao'          => $this->faker->text(),
            'quantidade'        => $this->faker->randomDigit(),
            'valor'             => $this->faker->randomFloat(2, 10, 500),
            'foto'              => $this->faker->imageUrl(200, 360, 'produto'),
            'empresa_id'        => $this->faker->randomElement($empresa_id),
        ];
    }
}

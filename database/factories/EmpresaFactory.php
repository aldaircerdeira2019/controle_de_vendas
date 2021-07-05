<?php

namespace Database\Factories;

use App\Models\Empresa;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpresaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Empresa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome'              => $this->faker->company(),
            'cnpj'              => $this->faker->unique()->cnpj(),
            'cep'               => '90000-000',
            'razao_social'      => $this->faker->words(5, true),
            'rua'               => $this->faker->streetName(),
            'bairro'            => $this->faker->citySuffix(),
            'cidade'            => $this->faker->city(),
            'uf'                => $this->faker->stateAbbr(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Venda;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Empresa;
use App\Models\Produto;

class VendaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Venda::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $empresa_id = Empresa::pluck('id')->toArray();
        $produto_id = Produto::pluck('id')->toArray();
        return [
            'valor_unitatio'       => $this->faker->randomFloat(2, 10, 500),
            'valor_total'          => $this->faker->randomFloat(2, 10, 500),
            'quantidade'           => 1,
            'empresa_id'           => $this->faker->randomElement($empresa_id),
            'produto_id'           => $this->faker->randomElement($empresa_id),
        ];
    }
}

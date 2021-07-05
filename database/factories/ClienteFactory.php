<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_id = range(3,103);

        return [
            'nome'        => $this->faker->name,
            'cpf'         => $this->faker->unique()->cpf(),
            'email'       => $this->faker->unique()->safeEmail(),
            'saldo'       => 100.00,
            'user_id'      => $this->faker->randomElement($user_id),
        ];
    }
}

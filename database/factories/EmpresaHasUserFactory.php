<?php

namespace Database\Factories;

use App\Models\EmpresaHasUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpresaHasUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmpresaHasUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $user_id = range(110,160);
        $empresa_id = range(1,20);

        return [
            'user_id'        => $this->faker->unique()->randomElement($user_id),
            'empresa_id'     => $this->faker->randomElement($empresa_id),
        ];

    }
}

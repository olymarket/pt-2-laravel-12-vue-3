<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Agenda;
use Carbon\Carbon;

class AgendaFactory extends Factory
{

    protected $model = Agenda::class;

    public function definition(): array
    {
        $name  = $this->faker->unique()->text(30);
        $phone = $this->faker->unique()->numerify('272#######');
        return [
            'name'       => $name,
            'phone'      => $phone,
            'date'       => Carbon::now()->format('Y-m-d'),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

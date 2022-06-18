<?php

namespace Database\Factories;

use App\Models\Label;
use App\Models\PackageStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Label>
 */
class LabelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $packageStatus_id = PackageStatus::select('id')->inRandomOrder()->first();
        $carrierCompany_id = User::select('id')->where('role_id', '=', 3)->inRandomOrder()->first();

        if (rand(0, 1) == 0) {
            $sender = User::select('id', 'address', 'city', 'postcode')->where('role_id', '=', 2)->inRandomOrder()->first();
            $receiver = User::select('id', 'address', 'city', 'postcode')->where('role_id', '=', 4)->inRandomOrder()->first();

            return [
                'barcode_id' => Label::generateLabelCode(),
                'package_status_id' => $packageStatus_id,
                'carrier_user_id' => $carrierCompany_id,
                'sender_user_id' => $sender->id,
                'sender_address' => $sender->address,
                'sender_city' => $sender->city,
                'sender_postcode' => $sender->postcode,
                'receiver_user_id' => $receiver->id,
                'receiver_address' => $receiver->address,
                'receiver_city' => $receiver->city,
                'receiver_postcode' => $receiver->postcode
            ];
        } else {
            return [
                'barcode_id' => Label::generateLabelCode(),
                'package_status_id' => $packageStatus_id,
                'carrier_user_id' => $carrierCompany_id,
                'sender_address' => $this->faker->streetAddress,
                'sender_postcode' => $this->faker->postcode,
                'sender_city' => $this->faker->city,
                'receiver_address' => $this->faker->streetAddress,
                'receiver_city' => $this->faker->city,
                'receiver_postcode' => $this->faker->postcode
            ];
        }
    }
}

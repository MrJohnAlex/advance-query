<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Create Users
       $users = User::factory(10)->create();

       // Create Rooms
       $rooms = Room::factory(50)->create();

       // Create Reservations and attach Rooms to Reservations
       $users->each(function($user) use ($rooms) {
           $reservations = Reservation::factory(mt_rand(1, 5))->create(['user_id' => $user->id]);
           $reservations->each(function($reservation) use ($rooms) {
               $reservation->rooms()->attach(
                   $rooms->random(mt_rand(1, 5))->pluck('id')->toArray(),
                   [
                       'status' => (bool) random_int(0,1)
                   ]
               );
           });
       });
    }
}
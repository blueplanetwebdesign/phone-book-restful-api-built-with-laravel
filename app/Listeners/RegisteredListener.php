<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\PhoneBook;
use Faker\Factory AS FakerFactory;

class RegisteredListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SomeEvent  $event
     * @return void
     */
    public function handle($request)
    {
        $faker = FakerFactory::create();

        $user_id = $request->user->id;

        for ($i = 0; $i < 2; ++$i){
            $data[] = array(
                            'user_id'=> $user_id,
                            'name'=> $faker->name,
                            'email'=> $faker->email,
                            'phone_number'=> $faker->phoneNumber
                            );
        }

        PhoneBook::insert($data);
    }
}

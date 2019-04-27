<?php

use App\Key;
use Illuminate\Database\Seeder;

class KeysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Key::class, config('seeds.key.create'))->create([
            'password' => '$argon2i$v=19$m=1024,t=2,p=2$UUxxaWZ1akM1dzlmbEtiNA$+Q2+IURHJIe0xYmLds0j3x59SeC+77W6/Qp9wR85jQY', // secret
            'user_id' => config('factories.user.id'),
        ]);

        Key::insert(factory(Key::class, config('seeds.key.insert'))->make()->toArray());
    }
}

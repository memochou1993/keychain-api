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
            'user_id' => config('api.debug.user.id'),
        ]);

        Key::insert(factory(Key::class, config('seeds.key.insert'))->make()->toArray());
    }
}

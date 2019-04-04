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
        $records = factory(Key::class, config('seeds.key.number'))->make();

        Key::insert($records->toArray());
    }
}

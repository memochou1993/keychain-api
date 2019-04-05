<?php

namespace Tests\Feature\Api\User;

use App\User;
use App\Key;
use Tests\TestCase;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KeyControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected $key;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->key = factory(Key::class)->make([
            'user_id' => $this->user->id,
        ]);

        Passport::actingAs($this->user);
    }

    public function testIndex()
    {
        $key = $this->key;
        $key->save();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get(
            "/api/users/me/keys?with=user"
        );

        // $this->dd($response);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    collect($key)->except([
                        'user_id',
                    ])->keys()->merge([
                        'user',
                    ])->toArray(),
                ],
                'links',
                'meta',
            ]);
    }

    public function testStore()
    {
        $key = $this->key;

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post(
            "/api/users/me/keys?with=user",
            collect($key)->merge([
                'user',
            ])->toArray()
        );

        // $this->dd($response);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => collect($this->key)->except([
                    'user_id',
                ])->keys()->merge([
                    'user',
                ])->toArray(),
            ]);
    }

    public function testShow()
    {
        $key = $this->key;
        $key->save();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get(
            "/api/users/me/keys/{$key->id}?with=user"
        );

        // $this->dd($response);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => collect($key)->except([
                    'user_id',
                ])->keys()->merge([
                    'user',
                ])->toArray(),
            ]);
    }

    public function testUpdate()
    {
        $key = $this->key;
        $key->save();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->patch(
            "/api/users/me/keys/{$key->id}?with=user",
            collect($key)->toArray()
        );

        // $this->dd($response);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => collect($key)->except([
                    'user_id',
                ])->keys()->merge([
                    'user',
                ])->toArray(),
            ]);
    }

    public function testDestroy()
    {
        $key = $this->key;
        $key->save();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->delete(
            "/api/users/me/keys/{$key->id}"
        );

        // $this->dd($response);

        $response
            ->assertStatus(204);
    }
}

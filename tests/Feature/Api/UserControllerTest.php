<?php

namespace Tests\Feature\Api;

use App\User;
use Tests\TestCase;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->make([
            'username' => 'username',
        ]);

        Passport::actingAs($this->user);
    }

    public function testStore()
    {
        $user = $this->user;

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post(
            "/api/users",
            collect($user)->merge([
                'password' => 'password',
            ])->toArray()
        );

        // $this->dd($response);

        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => collect($user)->except([
                    'email_verified_at',
                ])->keys()->toArray(),
            ]);
    }

    public function testShow()
    {
        $user = $this->user;
        $user->save();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get(
            "/api/users/{$user->id}?with=keys"
        );

        // $this->dd($response);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => collect($user)->except([
                    'email_verified_at',
                ])->keys()->merge([
                    'keys',
                ])->toArray(),
            ]);
    }

    public function testUpdate()
    {
        $user = $this->user;
        $user->save();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->patch(
            "/api/users/{$user->id}?with=keys",
            collect($user)->toArray()
        );

        // $this->dd($response);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => collect($user)->except([
                    'email_verified_at',
                ])->keys()->toArray(),
            ]);
    }
}

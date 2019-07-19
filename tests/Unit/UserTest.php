<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();
        Session::start();
    }

    /** @test */
    public function can_enlist_users(){
        $this->post(get('users.list'))
            ->assertStatus(200);
    }

    /** @test */
    public function can_create_a_user()
    {
        $data = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'address' => $this->faker->address,
            'post_code' => $this->faker->postcode,
            'contact_phone_number' => $this->faker->phoneNumber,
            'username' => $this->faker->userName,
            'email' => $this->faker->freeEmail,
            'password' => $this->faker->password
        ];

        $this->post(route('users.store'), $data)
            ->assertStatus(200);
    }

    /** @test */
    public function can_update_a_user(){
        $this->assertTrue(true);
    }

    /** @test */
    public function can_delete_a_user(){
        $this->assertTrue(true);
    }
}

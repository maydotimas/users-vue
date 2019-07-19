<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithoutMiddleware;

    protected $data = [];
    protected $password = '';

    protected $structure = [
        "id",
        "first_name",
        "last_name",
        "address",
        "post_code",
        "contact_phone_number",
        "username",
        "email",
        "email_verified_at",
        "created_at",
        "updated_at"

    ];


    public function setUp()
    {
        parent::setUp();
        Session::start();

        $this->password = $this->faker->password;

        $this->data = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'address' => $this->faker->address,
            'post_code' => $this->faker->postcode,
            'contact_phone_number' => $this->faker->phoneNumber,
            'username' => $this->faker->userName,
            'email' => $this->faker->freeEmail,
            'password' => $this->password,
            'password_confirmation' => $this->password
        ];

    }

    /** @test */
    public function can_enlist_users()
    {
        $this->get(route('users.list'))
            ->assertStatus(201);
    }

    /** @test */
    public function can_create_a_user()
    {
        $this->post(route('users.store'), $this->data)
            ->assertStatus(201);
    }

    /** @test */
    public function can_update_a_user()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function can_delete_a_user()
    {
        $this->assertTrue(true);
    }
}

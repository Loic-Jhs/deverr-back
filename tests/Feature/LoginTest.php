<?php

namespace Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_with_correct_credentials()
    {
        $user = new User();
        $user->firstname = 'John';
        $user->lastname = 'Doe';
        $user->email = 'test@test.fr';
        $user->password = bcrypt('password');
        $user->role = "0";
        $user->save();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_user_can_login_with_incorrect_credentials()
    {
        $user = new User();
        $user->firstname = 'John';
        $user->lastname = 'Doe';
        $user->email = 'test@test.fr';
        $user->password = bcrypt('password1');
        $user->role = "0";
        $user->save();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response->assertStatus(401);
    }
}

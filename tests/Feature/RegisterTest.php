<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegisterNewUser()
    {
        $response = $this->postJson('/register',
            [
                'firstname' => 'john',
                'lastname'
            ]
        );
    }
}

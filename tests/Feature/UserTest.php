<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use JWTAuth;

class UserTest extends TestCase
{
    /** @test */
//    public function a_user_can_edit_his_profile() {
//        $user = User::first();
//
//        $token = JWTAuth::fromUser($user);
//
//        $attributes = ['name' => $this->faker->name];
//
//        $this->patchJson('api/user', $attributes, ['authorization' => "bearer $token"])
//            ->assertStatus(200);
//
//        $this->assertDatabaseHas($user->getTable(), array_merge($attributes, [
//            'id' => $user->id
//        ]));
//    }
    public function testRegister_validate_name()
    {
        //User's data
        $data = [
//            'email' => 'test@gmail.com',
//            'name' => 'Test',
//            'username' => 'Test',
            'password' => 'secret1234',
            'password_confirmation' => 'secret1234',
        ];
        $response = $this->json('POST', route('api.auth.register'), $data);

        $response->assertStatus(422);

        $this->assertArrayHasKey('errors', $response->json());
    }

    public function testRegister()
    {
        //User's data
        $data = [
            'email' => 'test@gmail.com',
            'name' => 'Test',
            'username' => 'Test',
            'password' => 'secret1234',
            'password_confirmation' => 'secret1234',
            'rols' => ['rol_id' => 1]
        ];
        //Send post request
        $response = $this->json('POST', route('api.auth.register'), $data);

        //Assert it was successful
        $response->assertStatus(200);
        //Assert we received a token
        $this->assertArrayHasKey('token', $response->json());
        //Delete data
        User::where('email', 'test@gmail.com')->delete();
    }
}

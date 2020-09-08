<?php

namespace Tests\Feature;

use App\GaelO\Constants\Constants;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordTest extends TestCase
{
    use DatabaseMigrations {
        runDatabaseMigrations as baseRunDatabaseMigrations;
    }

    /**
     * Define hooks to migrate the database before and after each test.
     *
     * @return void
     */
    public function runDatabaseMigrations()
    {
        $this->baseRunDatabaseMigrations();
        $this->artisan('db:seed');
    }

    public function testValidResetPassword()
    {
        $data = [
            'username' => 'administrator',
            'email' => 'administrator@gaelo.fr'
        ];
        $this->post('api/tools/reset-password', $data)
        ->assertStatus(200);
        $modifiedUser = User::where('username', 'administrator')->first();
        $this->assertEquals( $modifiedUser['status'], Constants::USER_STATUS_UNCONFIRMED );
    }

    public function testWrongUsernameResetPassword(){
        $data = [
            'username' => 'administrator2',
            'email' => 'administrator@gaelo.fr'
        ];
        $this->post('api/tools/reset-password', $data)
        ->assertStatus(400);
    }

    public function testWrongEmailResetPassword(){
        $data = [
            'username' => 'administrator',
            'email' => 'administrator2@gaelo.fr'
        ];
        $this->post('api/tools/reset-password', $data)
        ->assertStatus(400);

    }
}
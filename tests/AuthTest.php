<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * User should not be able to access home page unless logged in
     *
     * @return void
     */
    public function testHomeNonAuth()
    {
        $this->visit('/home')
             ->see('Login')
             ->seePageIs('/login');
    }

    /**
     * Non auth user should be able to access login page
     *
     * @return void
     */
    public function testLoginNonAuth()
    {
        $this->visit('/login')
             ->see('Login')
             ->seePageIs('/login');
    }

    /**
     * Non auth user should be able to register login page
     *
     * @return void
     */
    public function testRegisterNonAuth()
    {
        $this->visit('/register')
             ->see('Register')
             ->seePageIs('/register');
    }

    /**
     * Non auth user should be able to register
     *
     * @return void
     */
    public function testRegister()
    {
        $this->visit('/register')
             ->type('User Test', 'name')
             ->type('user@test.com', 'email')
             ->type('dummyPass', 'password')
             ->type('dummyPass', 'password_confirmation')
             ->press('Register')
             ->seePageIs('/home');

        $user = User::first();

        $this->assertEquals('User Test', $user->name);
        $this->assertEquals('user@test.com', $user->email);
        $this->assertEquals('user', $user->role);
    }

    /**
     * Registered user should be able to login
     *
     * @return void
     */
    public function testLogin()
    {
        $user = factory(App\User::class)->create();

        $this->visit('/login')
             ->type($user->email, 'email')
             ->type('secret', 'password')
             ->press('Login')
             ->seePageIs('/home');
    }
}

<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Auth\Access\AuthorizationException;
use App\User;

class AuthorizationTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Testing user dashboard and access
     *
     * @return void
     */
    public function testUserDashboard()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
             ->visit('/home')
             ->seePageIs('/home')
             ->seeLink('My Meals')
             ->dontSeeLink('Users')
             ->click('My Meals')
             ->seeRouteIs('users.meals.index', [ 'user' => $user->id ]);
    }

    /**
     * Testing admin dashboard and access
     *
     * @return void
     */
    public function testAdminDashboard()
    {
        $admin = factory(App\User::class)->states('admin')->create();

        $this->actingAs($admin)
             ->visit('/home')
             ->seePageIs('/home')
             ->seeLink('Users')
             ->dontSeeLink('My Meals')
             ->click('Users')
             ->seeRouteIs('users.index');
    }

    /**
     * Testing users manager dashboard and access
     *
     * @return void
     */
    public function testUsersManagerDashboard()
    {
        $usersManager = factory(App\User::class)->states('usersManager')->create();

        $this->actingAs($usersManager)
             ->visit('/home')
             ->seePageIs('/home')
             ->seeLink('Users')
             ->dontSeeLink('My Meals')
             ->click('Users')
             ->seeRouteIs('users.index');
    }

    /**
     * Testing user failed access
     *
     * @return void
     */
    public function testUserAccess()
    {
        $user = factory(App\User::class)->create();

        try {
            $this->actingAs($user)
                 ->visit('/users');
        } catch (Exception $e) {
            $this->assertResponseStatus(403);
            $this->assertEquals($e->getMessage(), 'A request to [http://calories-input/users] failed. Received status code [403].');
        }
    }

}

<?php

namespace Tests\Browser\Pages\Login;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    public bool $seed = true;


    private function clearCookies()
    {
        foreach (static::$browsers as $browser) {
            $browser->driver->manage()->deleteAllCookies();
        }
    }

    /**
     * Test the login of a superAdmin user account.
     *
     * @return void
     */
    public function testSuperAdminLogin()
    {
        $password = 'password';

        $user = User::factory()->create([
            'email' => 'duskAdmin@test.com',
            'password' => Hash::make($password),
            'role_id' => 1
        ]);

        $this->browse(function (Browser $browser) use ($user, $password) {
            $browser->visit('/login')
                ->assertSee('Trackr')
                ->assertSee('Login')
                ->type('email', $user->email)
                ->type('password', $password)
                ->press('Login')
                ->assertPathIs('/home');
        });

        $this->clearCookies();
    }

    /**
     * Test the login of a sender user account.
     *
     * @return void
     */
    public function testSenderLogin()
    {
        $password = 'password';

        $user = User::factory()->create([
            'email' => 'duskSender@test.com',
            'password' => Hash::make($password),
            'role_id' => 2
        ]);

        $this->browse(function (Browser $browser) use ($user, $password) {
            $browser->visit('/login')
                ->assertSee('Trackr')
                ->assertSee('Login')
                ->type('email', $user->email)
                ->type('password', $password)
                ->press('Login')
                ->assertPathIs('/home');
        });

        $this->clearCookies();
    }

    /**
     * Test the login of a packer user account.
     *
     * @return void
     */
    public function testPackerLogin()
    {
        $password = 'password';

        $user = User::factory()->create([
            'email' => 'duskPacker@test.com',
            'password' => Hash::make($password),
            'role_id' => 3
        ]);

        $this->browse(function (Browser $browser) use ($user, $password) {
            $browser->visit('/login')
                ->assertSee('Trackr')
                ->assertSee('Login')
                ->type('email', $user->email)
                ->type('password', $password)
                ->press('Login')
                ->assertPathIs('/home');
        });

        $this->clearCookies();
    }

    /**
     * Test the login of a receiver user account.
     *
     * @return void
     */
    public function testReceiverLogin()
    {
        $password = 'password';

        $user = User::factory()->create([
            'email' => 'duskReceiver@test.com',
            'password' => Hash::make($password),
            'role_id' => 4
        ]);

        $this->browse(function (Browser $browser) use ($user, $password) {
            $browser->visit('/login')
                ->assertSee('Trackr')
                ->assertSee('Login')
                ->type('email', $user->email)
                ->type('password', $password)
                ->press('Login')
                ->assertPathIs('/home');
        });

        $this->clearCookies();
    }

    /**
     * Test the login with incorrect credentials user account.
     *
     * @return void
     */
    public function testIncorrectCredentialsLogin()
    {
        $email = 'duskFake@test.com';
        $password = 'password';

        $this->browse(function (Browser $browser) use ($email, $password) {
            $browser->visit('/login')
                ->assertSee('Trackr')
                ->assertSee('Login')
                ->type('email', $email)
                ->type('password', $password)
                ->press('Login')
                ->assertPathIs('/login');
        });
    }
}

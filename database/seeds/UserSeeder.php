<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use ProcessMaker\Models\User;
use ProcessMaker\Models\Group;
use ProcessMaker\Models\GroupMember;
use Laravel\Passport\ClientRepository;

class UserSeeder extends Seeder
{

    static $INSTALLER_ADMIN_USERNAME = 'admin';
    static $INSTALLER_ADMIN_PASSWORD = 'admin';
    static $INSTALLER_ADMIN_EMAIL = 'admin@processmaker.com';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ClientRepository $clients)
    {
        if (User::count() !== 0) {
            return;
        }

        //Create admin user
        $user = factory(User::class)->create([
            'username' => self::$INSTALLER_ADMIN_USERNAME,
            'password' => Hash::make(self::$INSTALLER_ADMIN_PASSWORD),
            'email' => self::$INSTALLER_ADMIN_EMAIL,
            'firstname' => 'admin',
            'lastname' => 'admin',
            'timezone' => 'America/Los_Angeles',
            'datetime_format' => 'm/d/Y H:i',
            'language' => 'en',
            'status' => 'ACTIVE',
            'is_administrator' => true,
        ]);

        // Create client so we can generate tokens
        $clients->createPersonalAccessClient(
            null,
            'PmApi',
            'http://localhost'
        );

        // Create client OAuth (for 3-legged auth)
        $clients->create(
            null,
            'Swagger UI Auth',
            env('APP_URL', 'http://localhost') . '/api/oauth2-callback'
        );
        
        // Allow users get at token using the password grant flow
        $clients->createPasswordGrantClient(
            null, 'Password Grant', 'http://localhost'
        );
    }
}

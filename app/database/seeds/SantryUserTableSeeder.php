<?php

// Composer: "fzaninotto/faker": "v1.3.0"


class SantryUserTableSeeder extends Seeder {

    public function run()
    {



        // Creating admin group

        try
        {
            $group = Sentry::createGroup(array(
                'name'        => 'Super Administrator',
                'permissions' => array(
                    'admin' => 1,
                    'users' => 1,
                ),
            ));
        }
        catch (Exception $e)
        {
            echo 'Login field is required.';
        }

        try
        {
            $group = Sentry::createGroup(array(
                'name'        => 'BQu',
                'permissions' => array(
                    'users' => 1,
                ),
            ));
        }
        catch (Exception $e)
        {
            echo 'Login field is required.';
        }

        // Creating Admin
        try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'=> 'admin@bqu.com',
                'password'  => '123',
                'activated' => true,
                'first_name'=> 'BQu',
                'last_name'=> 'Administrator'
            ));

            // Find the group using the group id
            $adminGroup = Sentry::findGroupByName('Super Administrator');

            // Assign the group to the user
            $user->addGroup($adminGroup);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }

        // Creating User

        try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'=> 'rajitha.mendries@bquintelligence.com',
                'password'  => '123',
                'activated' => true,
                'first_name'=> 'Rajitha',
                'last_name'=> 'Mendries'
            ));

            // Find the group using the group id
            $BQuGroup = Sentry::findGroupByName('BQu');

            // Assign the group to the user
            $user->addGroup($BQuGroup);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }

        // Creating User

        try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'=> 'bhagya.weerathunga@bquintelligence.com',
                'password'  => '123',
                'activated' => true,
                'first_name'=> 'Bhagya',
                'last_name'=> 'Weerathunga'
            ));

            // Find the group using the group id
            $BQuGroup = Sentry::findGroupByName('BQu');

            // Assign the group to the user
            $user->addGroup($BQuGroup);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }

        // Creating User

        try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'=> 'whitney.fraser@bquintelligence.com',
                'password'  => '123',
                'activated' => true,
                'first_name'=> 'Whitney',
                'last_name'=> 'Fraser'
            ));

            // Find the group using the group id
            $BQuGroup = Sentry::findGroupByName('BQu');

            // Assign the group to the user
            $user->addGroup($BQuGroup);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }

        // Creating User

        try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'=> 'dileepa.gamage@bquintelligence.com',
                'password'  => '123',
                'activated' => true,
                'first_name'=> 'Dileepa',
                'last_name'=> 'Gamage'
            ));

            // Find the group using the group id
            $BQuGroup = Sentry::findGroupByName('BQu');

            // Assign the group to the user
            $user->addGroup($BQuGroup);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }

        // Creating User

        try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'=> 'nalin.ambepitiya@bquintelligence.com',
                'password'  => '123',
                'activated' => true,
                'first_name'=> 'Nalin',
                'last_name'=> 'Ambepitiya'
            ));

            // Find the group using the group id
            $BQuGroup = Sentry::findGroupByName('BQu');

            // Assign the group to the user
            $user->addGroup($BQuGroup);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }

        // Creating User

        try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'=> 'damith.harischandrathilaka@bquintelligence.com',
                'password'  => '123',
                'activated' => true,
                'first_name'=> 'Damith',
                'last_name'=> 'Harischandrathilaka'
            ));

            // Find the group using the group id
            $BQuGroup = Sentry::findGroupByName('Super Administrator');

            // Assign the group to the user
            $user->addGroup($BQuGroup);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }

        // Creating User

        try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'=> 'irantha.jayasekara@bquintelligence.com',
                'password'  => '123',
                'activated' => true,
                'first_name'=> 'Irantha',
                'last_name'=> 'Jayasekara'
            ));

            // Find the group using the group id
            $BQuGroup = Sentry::findGroupByName('Super Administrator');

            // Assign the group to the user
            $user->addGroup($BQuGroup);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }

        // Creating User

        try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'=> 'gihan.liyanage@bquintelligence.com',
                'password'  => '123',
                'activated' => true,
                'first_name'=> 'Gihan',
                'last_name'=> 'Liyanage'
            ));

            // Find the group using the group id
            $BQuGroup = Sentry::findGroupByName('BQu');

            // Assign the group to the user
            $user->addGroup($BQuGroup);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }

        // Creating User

        try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'=> 'surandi.fernando@bquintelligence.com',
                'password'  => '123',
                'activated' => true,
                'first_name'=> 'surandi',
                'last_name'=> 'fernando'
            ));

            // Find the group using the group id
            $BQuGroup = Sentry::findGroupByName('BQu');

            // Assign the group to the user
            $user->addGroup($BQuGroup);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }

        // Creating User

        try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'=> 'nuwan.wijethilaka@bquintelligence.com',
                'password'  => '123',
                'activated' => true,
                'first_name'=> 'Nuwan',
                'last_name'=> 'Wijethilaka'
            ));

            // Find the group using the group id
            $BQuGroup = Sentry::findGroupByName('BQu');

            // Assign the group to the user
            $user->addGroup($BQuGroup);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }

        // Creating User

        try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'=> 'sahan.kariyawasam@bquintelligence.com',
                'password'  => '123',
                'activated' => true,
                'first_name'=> 'Sahan',
                'last_name'=> 'Kariyawasam'
            ));

            // Find the group using the group id
            $BQuGroup = Sentry::findGroupByName('BQu');

            // Assign the group to the user
            $user->addGroup($BQuGroup);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }

        // Creating User

        try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'=> 'poshitha.harischandra@bquintelligence.com',
                'password'  => '123',
                'activated' => true,
                'first_name'=> 'Poshitha',
                'last_name'=> 'Harischandra'
            ));

            // Find the group using the group id
            $BQuGroup = Sentry::findGroupByName('BQu');

            // Assign the group to the user
            $user->addGroup($BQuGroup);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }

        // Creating User

        try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'=> 'ruksala.wimalasooriya@bquintelligence.com',
                'password'  => '123',
                'activated' => true,
                'first_name'=> 'Ruksala',
                'last_name'=> 'Wimalasooriya'
            ));

            // Find the group using the group id
            $BQuGroup = Sentry::findGroupByName('BQu');

            // Assign the group to the user
            $user->addGroup($BQuGroup);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }

        // Creating User

        try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'=> 'prasangi.mallikarachchi@bquintelligence.com',
                'password'  => '123',
                'activated' => true,
                'first_name'=> 'Prasangi',
                'last_name'=> 'Mallikarachchi'
            ));

            // Find the group using the group id
            $BQuGroup = Sentry::findGroupByName('BQu');

            // Assign the group to the user
            $user->addGroup($BQuGroup);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }

        // Creating User

        try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'=> 'isanka.dona@bquintelligence.com',
                'password'  => '123',
                'activated' => true,
                'first_name'=> 'Isanka',
                'last_name'=> 'Dona'
            ));

            // Find the group using the group id
            $BQuGroup = Sentry::findGroupByName('BQu');

            // Assign the group to the user
            $user->addGroup($BQuGroup);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }

        // Creating User

        try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'=> 'sanojaa.thiyagarajah@bquintelligence.com',
                'password'  => '123',
                'activated' => true,
                'first_name'=> 'Sanojaa',
                'last_name'=> 'Thiyagarajah'
            ));

            // Find the group using the group id
            $BQuGroup = Sentry::findGroupByName('BQu');

            // Assign the group to the user
            $user->addGroup($BQuGroup);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }
		
		        // Creating User
		
		try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'=> 'yukthika.premadase@bquintelligence.com',
                'password'  => '123',
                'activated' => true,
                'first_name'=> 'Yukthika',
                'last_name'=> 'Premadase'
            ));

            // Find the group using the group id
            $BQuGroup = Sentry::findGroupByName('BQu');

            // Assign the group to the user
            $user->addGroup($BQuGroup);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }
		
		        // Creating User
		
		try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'=> 'harshani.fonseka@bquintelligence.com',
                'password'  => '123',
                'activated' => true,
                'first_name'=> 'Harshani',
                'last_name'=> 'Fonseka'
            ));

            // Find the group using the group id
            $BQuGroup = Sentry::findGroupByName('BQu');

            // Assign the group to the user
            $user->addGroup($BQuGroup);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }
		
		        // Creating User
		
		try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'=> 'jacques.decock@bquintelligence.com',
                'password'  => '123',
                'activated' => true,
                'first_name'=> 'Jacques',
                'last_name'=> 'DeCock'
            ));

            // Find the group using the group id
            $BQuGroup = Sentry::findGroupByName('BQu');

            // Assign the group to the user
            $user->addGroup($BQuGroup);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }
		
		

}}
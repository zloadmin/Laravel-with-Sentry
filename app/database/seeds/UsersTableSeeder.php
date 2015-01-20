<?php


use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 100) as $index)
		{
            try
            {
                // Create the user
                $user = Sentry::createUser(array(
                    'email'       => $faker->email,
                    'password'    => rand(111111,999999),
                    'username'    => $faker->firstName($gender = null|'male'|'female'),
                    'fio'         => $faker->name($gender = null|'male'|'female'),
                    'phone'       => $faker->phoneNumber(),
                    'managername' => $faker->name($gender = null|'male'|'female'),
                    'typepal'     => rand(1,3),
                    'address'     => $faker->address(),
                    'activated' => true,
                ));

                // Find the group using the group id
                $userGroup = Sentry::findGroupByName('User');

                // Assign the group to the user
                $user->addGroup($userGroup);
            }
            catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
            {
                echo 'Login field is required.';
            }
            catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
            {
                echo 'Password field is required.';
            }
            catch (Cartalyst\Sentry\Users\UserExistsException $e)
            {
                echo 'User with this login already exists.';
            }
            catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
            {
                echo 'Group was not found.';
            }

		}
	}

}
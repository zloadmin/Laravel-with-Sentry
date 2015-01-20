<?php

//php artisan migrate --package=cartalyst/sentry

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        //Add My Columns
        Schema::table('users', function($table)
        {
            $table->string('fio');
            $table->string('phone');
            $table->string('username');
            $table->string('managername');
            $table->integer('typepal');
            $table->text('address');
        });


        // Add Groups
        Sentry::createGroup(array(
            'name'        => 'Administartor',
            'permissions' => array(
                'admin' => 1,
                'edit' => 1,
                'users' => 1,
            ),
        ));

        Sentry::createGroup(array(
            'name'        => 'Moderator',
            'permissions' => array(
                'edit' => 1,
                'users' => 1,
            ),
        ));

        Sentry::createGroup(array(
            'name'        => 'User',
            'permissions' => array(
                'users' => 1,
            ),
        ));

        // Add Adminisrator
        $user = Sentry::createUser(array(
            'username' => 'admin',
            'email' => 'admin@examples.loc',
            'password' => 'password',
            'activated' => 1
        ));

        $adminGroup = Sentry::findGroupByName('Administartor');

        $user->addGroup($adminGroup);

	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

        //Delete My Columns
        Schema::table('users', function($table)
        {
            $table->dropColumn('fio');
            $table->dropColumn('phone');
            $table->dropColumn('username');
            $table->dropColumn('managername');
            $table->dropColumn('typepal');
            $table->dropColumn('address');

        });


        // Delete Administrator
        $user = Sentry::findUserByLogin('admin@examples.loc');

        $user->delete();

        //Delete groups
        $groups = Sentry::findAllGroups();

        foreach($groups as $group) {
            $group->delete();
        }



	}

}

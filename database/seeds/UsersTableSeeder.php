<?php

use App\User;
use App\About;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $userRole 			= Role::where('name', '=', 'User')->first();
        $adminRole 			= Role::where('name', '=', 'Admin')->first();
		$permissions 		= Permission::all();

	    /**
	     * Add Users
	     *
	     */
        if (User::where('email', '=', 'admin@admin.com')->first() === null) {

	        $newUser = User::create([
	            'name' => 'Admin',
	            'email' => 'admin@admin.com',
	            'password' => bcrypt('password'),
	        ]);

	        $newUser->attachRole($adminRole);
			foreach ($permissions as $permission) {
				$newUser->attachPermission($permission);
			}
		 $about = new About;
		 $about->user_id = $newUser->id;
		 $about->save();

        }

        if (User::where('email', '=', 'user@user.com')->first() === null) {

	        $newUser = User::create([
	            'name' => 'User',
	            'email' => 'user@user.com',
	            'password' => bcrypt('password'),
	        ]);

	        $newUser;
	        $newUser->attachRole($userRole);
		
		$about = new About;
		$about->user_id = $newUser->id;
		$about->save();

        }

    }
}

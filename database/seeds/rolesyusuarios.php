<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Role;

class rolesyusuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Model::unguard();

        Role::create([
        	'name' 		=>	'control-total',
        	'display_name'	=>	'Control Total',
        	'description'		=>	'El usuario tendrá acceso total a la aplicacion'
        ]);
    }
}

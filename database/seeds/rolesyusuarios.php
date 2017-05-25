<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\DatosVivero;
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
        User::create([
        	'name' 		=>	'Control Total',
        	'email'	=>	'gestor@gestor.com',
        	'password'		=>	bcrypt('12345678')
        ]);
        DatosVivero::create([
        	'Nit_vivero' 		=>	'1234',
        	'Nom_vivero' 		=>	'Control Total',
        	'Direccion_vivero'	=>	'klala',
        	'Telefono_vivero'		=>	'12345678'
        ]);
        \DB::table('role_user')->insert(array(
           'user_id' => '1'
           'role_id'  => '1'
    ));
        \DB::table('role_user')->insert(array(
           'user_id' => '2'
           'role_id'  => '1'
    ));
        \DB::table('role_user')->insert(array(
           'user_id' => '3'
           'role_id'  => '1'
    ));
        \DB::table('role_user')->insert(array(
           'user_id' => '4'
           'role_id'  => '1'
    ));
    }
}

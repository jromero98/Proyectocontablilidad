<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Role;
use App\DatosVivero;
use App\Permission;

class rolesyusuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DatosVivero::create([
        	'Nit_vivero' 		=>	'1234',
        	'Nom_vivero' 		=>	'La Arboleda',
        	'Direccion_vivero'	=>	'klala'
        ]);
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
        Permission::create([
        	'name' 		=>	'administrar-puc',
        	'display_name'	=>	'Administrar PUC',
        	'description'		=>	'El usuario podrá administrar el Plan Único de Cuentas'
        ]);

        DB::table('role_user')->insert(array(
           'user_id' => '1',
           'role_id'  => '1'
   		 ));
        DB::table('permission_role')->insert(array(
           'permission_id' => '1',
           'role_id'  => '1'
   		 ));
    }
}

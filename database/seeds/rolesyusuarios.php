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
        	'nit_vivero' 		=>	'1234',
        	'nom_vivero' 		=>	'La Arboleda',
        	'direccion_vivero'	=>	'klala'
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
        $permission = [
          ['name' => 'cuentas_manuales'
,            'display_name' => 'Realizar cuentas manuales',
            'description' => 'El usuario podrá realizar cuentas manuales'],
          ['name' => 'balance',
           'display_name' => 'Ver Balance de cuentas',
           'description' => 'El usuario podrá ver el balance de las cuentas'],
          ['name' => 'crear-usuario',
           'display_name' => 'Crear Usuario',
           'description' => 'El usuario podrá crear usuarios'],
          ['name' => 'crear-rol',
           'display_name' => 'Crear Rol',
           'description' => 'El Usuario podrá crear roles de usuarios'],
          ['name' => 'editar-rol',
           'display_name' => 'Editar rol',
           'description' => 'El usuario podrá editar los roles'],
          ['name' => 'editar-usuario',
           'display_name' => 'Editar usuario',
           'description' => 'El usuario podrá editar los usuarios'],
          ['name' => 'administrar-puc',
           'display_name' => 'Administrar PUC',
           'description' => 'El usuario podrá administrar el Plan Único de Cuentas'],
          ['name' => 'facturar-ventas',
           'display_name' => 'Facturar Ventas',
           'description' => 'El usuario podrá realizar las operaciones de Facturación de ventas'],
          ['name' => 'facturar-compras',
           'display_name' => 'Facturar Compras',
           'description' => 'El usuario podrá generas Facturación de compras'],
          ['name' => 'categoria',
           'display_name' => 'Administrar Categorias',
           'description' => 'El usuario podrá administrar las categorías de los productos'],
          ['name' => 'articulo',
           'display_name' => 'Administrar Articulos',
           'description' => 'El usuario podrá Administrar los articulos'],
          ['name' => 'ver-kardex',
           'display_name' => 'Ver Kardex',
           'description' => 'El usuario podrá ver el Kardex de los productos']
        ];

        foreach ($permission as $key => $value) {
          Permission::create($value);
        }

        DB::table('role_user')->insert(array(
           'user_id' => '1',
           'role_id'  => '1'
       ));
        DB::table('descripcion_cuenta')->insert(array(
           'iddescripcion_cuenta' => '0',
           'descripcion_cuenta'  => ''
   		 ));
        DB::table('permission_role')->insert(array(
           'permission_id' => '1',
           'role_id'  => '1'
       ));
        DB::table('permission_role')->insert(array(
           'permission_id' => '2',
           'role_id'  => '1'
       ));
        DB::table('permission_role')->insert(array(
           'permission_id' => '3',
           'role_id'  => '1'
       ));
        DB::table('permission_role')->insert(array(
           'permission_id' => '4',
           'role_id'  => '1'
       ));
        DB::table('permission_role')->insert(array(
           'permission_id' => '5',
           'role_id'  => '1'
       ));
        DB::table('permission_role')->insert(array(
           'permission_id' => '6',
           'role_id'  => '1'
       ));
        DB::table('permission_role')->insert(array(
           'permission_id' => '7',
           'role_id'  => '1'
       ));
        DB::table('permission_role')->insert(array(
           'permission_id' => '8',
           'role_id'  => '1'
       ));
        DB::table('permission_role')->insert(array(
           'permission_id' => '9',
           'role_id'  => '1'
       ));
        DB::table('permission_role')->insert(array(
           'permission_id' => '10',
           'role_id'  => '1'
       ));
        DB::table('permission_role')->insert(array(
           'permission_id' => '11',
           'role_id'  => '1'
       ));
        DB::table('permission_role')->insert(array(
           'permission_id' => '12',
           'role_id'  => '1'
   		 ));
        DB::table('clase_puc')->insert(array(
           'descripcion'  => 'Activo'
       ));
        DB::table('clase_puc')->insert(array(
           'descripcion'  => 'Pasivo'
       ));
        DB::table('clase_puc')->insert(array(
           'descripcion'  => 'Patrimonio'
       ));
        DB::table('clase_puc')->insert(array(
           'descripcion'  => 'Ingreso'
       ));
        DB::table('clase_puc')->insert(array(
           'descripcion'  => 'Gasto'
       ));
        DB::table('clase_puc')->insert(array(
           'descripcion'  => 'Costo'
   		 ));
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
// Correr: php artisan db:seed --class=PermissionsSeeder
class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $data = $this->data();
        // Creación de Permisos
        foreach ($data as $value) {
            Permission::create([
                'name' => $value['name'],
                'tabla' => $value['tabla'],
            ]);
        }

        // Creación de roles
        $gerente = Role::create(['name' => 'Gerente']); 
        $servicio = Role::create(['name' => 'Servicio']); 
        $cliente = Role::create(['name' => 'Cliente']); 

        // Asignamos roles a los usuarios
        $user = User::find(1);
        $user->assignRole('Gerente');
    }

    public function data()
    {
        $data = [];
        // list of model permission
        $model = ['categorias','motivo_devoluciones','negocio','proveedores','salidas','ingresos','devoluciones','productos',];
        foreach ($model as $value) {
            foreach ($this->crudActions($value) as $action) {
                $data[] = [
                    'name' => $action,
                    'tabla' => $value
                ];
            }
        }
        // Permisos de ver dashboard
        // $data[]=['dashboard admin'],
        // $data[]=['dashboard servicio'],
        // $data[]=['dashboard cliente'],

        return $data;
    }

    public function crudActions($name)
    {
        $actions = [];
        // list of permission actions
        $crud = ['dashboard','list','create', 'show', 'edit', 'delete','report'];

        foreach ($crud as $value) {
            $actions[] = $value.' '.$name;
        }

        return $actions;
    }
}

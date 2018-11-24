<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use Illuminate\Support\Str;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new \DateTime(null);
        $role_Admin = Role::where('name', 'Parametrage')->first();
        $role_da = Role::where('name', 'Gestionnaire_DA')->first();
        $role_confirm_da = Role::where('name', 'Valideur_DA')->first();
        $role_proforma = Role::where('name', 'Gestionnaire_Pro_Forma')->first();
        $role_BC = Role::where('name', 'Gestionnaire_BC')->first();
        $role_confirm_bc = Role::where('name', 'Valideur_BC')->first();

        $user = new User();
        $user->name = 'administrateur';
        $user->email = 'admin@eiffage.com';
        $user->abréviation = 'Admin';
        $user->function = 'Gestionnaire Application ';
        $user->password = bcrypt('Administrateur');
        $user->slug = Str::slug($user->email . $date->format('dmYhis'));
        $user->save();
        $user->roles()->attach($role_Admin);
        $user->roles()->attach($role_da);
        $user->roles()->attach($role_confirm_da);
        $user->roles()->attach($role_proforma);
        $user->roles()->attach($role_BC);
        $user->roles()->attach($role_confirm_bc);

    }
}

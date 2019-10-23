<?php

use Illuminate\Database\Seeder;
use App\Role;
class Rowseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role_Admin = new Role();
        $role_Admin->name="Parametrage";
        $role_Admin->description="PARAMETRAGE";
        $role_Admin->save();

        $role_da = new Role();
        $role_da->name="Gestionnaire_DA";
        $role_da->description="GESTION DES D.A";
        $role_da->save();



        $role_confirm_da = new Role();
        $role_confirm_da->name="Valideur_DA";
        $role_confirm_da->description="VALIDATION DES D.A";
        $role_confirm_da->save();

        $role_proforma = new Role();
        $role_proforma->name="Gestionnaire_Pro_Forma";
        $role_proforma->description="GESTION DES PRO FORMA";
        $role_proforma->save();

        $role_BC = new Role();
        $role_BC->name="Gestionnaire_BC";
        $role_BC->description="GESTION DES B.C";
        $role_BC->save();

        $role_confirm_bc = new Role();
        $role_confirm_bc->name="Valideur_BC";
        $role_confirm_bc->description="VALIDATION DES B.C";
        $role_confirm_bc->save();

        $role_BC = new Role();
        $role_BC->name="Gestionnaire_Facture";
        $role_BC->description="GESTION DES FACTURES";
        $role_BC->save();

    }
}

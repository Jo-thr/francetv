<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SeedPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $superadmin = Role::updateOrCreate(['name' => 'superadmin']);
        $admin = Role::updateOrCreate(['name' => 'admin']);
        $editor = Role::updateOrCreate(['name' => 'editor']);

        Permission::updateOrCreate(['name'=>'Voir tous les utilisateurs'])->assignRole($superadmin);
        Permission::updateOrCreate(['name'=>'Voir un utilisateur'])->assignRole($superadmin);
        Permission::updateOrCreate(['name'=>'Créer un utilisateur'])->assignRole($superadmin);
        Permission::updateOrCreate(['name'=>'Éditer un utilisateur'])->assignRole($superadmin);
        Permission::updateOrCreate(['name'=>'Supprimer un utilisateur'])->assignRole($superadmin);
        Permission::updateOrCreate(['name'=>'Restaurer un utilisateur'])->assignRole($superadmin);
        Permission::updateOrCreate(['name'=>'Supprimer de force un utilisateur'])->assignRole($superadmin);

        Permission::updateOrCreate(['name'=>'Voir tous les tags'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Voir un tag'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Créer un tag'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Éditer un tag'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Supprimer un tag'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Restaurer un tag'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Supprimer de force un tag'])
      ->assignRole($superadmin)
      ->assignRole($admin);

        Permission::updateOrCreate(['name'=>'Voir tous les articles'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Voir un article'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Créer un article'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Éditer un article'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Supprimer un article'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Restaurer un article'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Supprimer de force un article'])
      ->assignRole($superadmin)
      ->assignRole($admin);

        Permission::updateOrCreate(['name'=>'Voir tous les metamedia'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Voir tous les tests'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Voir un test'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Créer un test'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Éditer un test'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Supprimer un test'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Restaurer un test'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Supprimer de force un test'])
      ->assignRole($superadmin)
      ->assignRole($admin);

        Permission::updateOrCreate(['name'=>'Voir tous les metamedia'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Voir un metamedia'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Créer un metamedia'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Éditer un metamedia'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Supprimer un metamedia'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Restaurer un metamedia'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Supprimer de force un metamedia'])
      ->assignRole($superadmin)
      ->assignRole($admin);

        Permission::updateOrCreate(['name'=>'Voir toutes les MEA'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Voir une MEA'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Créer une MEA']);

        Permission::updateOrCreate(['name'=>'Éditer une MEA'])
      ->assignRole($superadmin)
      ->assignRole($admin)
      ->assignRole($editor);

        Permission::updateOrCreate(['name'=>'Supprimer une MEA']);

        Permission::updateOrCreate(['name'=>'Restaurer une MEA'])
      ->assignRole($superadmin);

        Permission::updateOrCreate(['name'=>'Supprimer de force une MEA']);

        Permission::updateOrCreate(['name'=>'Voir tous les sponsors'])
        ->assignRole($editor)
        ->assignRole($admin)
        ->assignRole($superadmin);

        Permission::updateOrCreate(['name'=>'Voir un sponsor'])
        ->assignRole($editor)
        ->assignRole($admin)
        ->assignRole($superadmin);

        Permission::updateOrCreate(['name'=>'Créer un sponsor'])->assignRole($superadmin);

        Permission::updateOrCreate(['name'=>'Éditer un sponsor'])->assignRole($superadmin);

        Permission::updateOrCreate(['name'=>'Supprimer un sponsor'])->assignRole($superadmin);

        Permission::updateOrCreate(['name'=>'Restaurer un sponsor'])->assignRole($superadmin);

        Permission::updateOrCreate(['name'=>'Supprimer de force un sponsor'])->assignRole($superadmin);


        Permission::updateOrCreate(['name'=>'Voir tous les pictograms'])
        ->assignRole($editor)
        ->assignRole($admin)
        ->assignRole($superadmin);

        Permission::updateOrCreate(['name'=>'Voir un pictogram'])
        ->assignRole($editor)
        ->assignRole($admin)
        ->assignRole($superadmin);

        Permission::updateOrCreate(['name'=>'Créer un pictogram'])->assignRole($superadmin);

        Permission::updateOrCreate(['name'=>'Éditer un pictogram'])->assignRole($superadmin);

        Permission::updateOrCreate(['name'=>'Supprimer un pictogram'])->assignRole($superadmin);

        Permission::updateOrCreate(['name'=>'Restaurer un pictogram'])->assignRole($superadmin);

        Permission::updateOrCreate(['name'=>'Supprimer de force un pictogram'])->assignRole($superadmin);


        Permission::updateOrCreate(['name'=>'Voir tous les services'])->assignRole($superadmin);

        Permission::updateOrCreate(['name'=>'Voir un service'])->assignRole($superadmin);

        Permission::updateOrCreate(['name'=>'Créer un service'])->assignRole($superadmin);

        Permission::updateOrCreate(['name'=>'Éditer un service'])->assignRole($superadmin);

        Permission::updateOrCreate(['name'=>'Supprimer un service'])->assignRole($superadmin);

        Permission::updateOrCreate(['name'=>'Restaurer un service'])->assignRole($superadmin);

        Permission::updateOrCreate(['name'=>'Supprimer de force un service'])->assignRole($superadmin);


        Permission::updateOrCreate(['name' => "Voir tous les contacts"])
        ->assignRole($admin)
        ->assignRole($superadmin);

        Permission::updateOrCreate(['name' => "Voir un contact"])
        ->assignRole($admin)
        ->assignRole($superadmin);

        Permission::updateOrCreate(['name' => "Créer un contact"])->assignRole($superadmin);
        Permission::updateOrCreate(['name' => "Editer un contact"])->assignRole($superadmin);
        Permission::updateOrCreate(['name' => "Supprimer un contact"])->assignRole($superadmin);
        Permission::updateOrCreate(['name' => "Restaurer un contact"])->assignRole($superadmin);
        Permission::updateOrCreate(['name' => "Forcer la suppression d'un contact"])
        ->assignRole($superadmin);
    }
}

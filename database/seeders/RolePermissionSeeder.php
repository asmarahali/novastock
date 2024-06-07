<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roles = [
            Role::DEFAULT_ROLES["ADMIN"] => [
                'create-user', 'read-user', 'update-user',
                'read-paramaters','create-paramaters','show-paramaters','update-paramaters','delete-paramaters',
                'create-structure','update-structure','show-structure','delete-structure','read-structure',
                'read-role','read-name-roles','show-role','create-role','update-role','delete-role','nbrOfUser'
                ,'nbrOfActiveUser','nbrOfNoActiveUser','nbrOfStructure','getLoginFrequency','LastTwoLogins'
            ],
            Role::DEFAULT_ROLES["ASA"]  => [
                'create-fournisseur','read-fournisseur','update-fournisseur','delete-fournisseur',
                'show-fournisseur','read-chapter','create-chapter','update-chapter','delete-chapter',
                'read-product','create-product','show-product','update-product','delete-product',
                'read-article','create-article','show-article','update-article','delete-article',
                'show-paramaters','read-BCE','create-BCE','show-BCE','delete-BCE','create-bce',
                'nbrofChapter','nbrofArticle','nbrofProduct','nbrofBce','mostCommandedProducts',
                'yearly','totalQuantity','listing'
            ],
            Role::DEFAULT_ROLES['MAGASINIER'] => [
                'read-BCE','create-BCE','show-BCE','delete-BCE','create-bce',
                'update-br','index-br','create-br','delete-br','show-info-br','show-br','show_bs','show-qnty-BCI',
                'index_b_sortie','index_b_decharge','createBSorBD','RetourDeProduit','create-inv','show-inv',
                'mostDemandedProducts','countBci','countBS','countBD'
            ],
            Role::DEFAULT_ROLES["CONSOMATEUR"]  => [
             'create-BCI','read-BCI','show-BCI','delete-BCI',
             'add-producrt-to-BCI','update-BCI','show-qnty-BCI','getUserBCICount',
             'getUserBCICount','getQunatityConsu','produitRetourne','getConsumptionStatistics'

            ],
            Role::DEFAULT_ROLES["RSR"]  => [
                'create-BCI','read-BCI','show-BCI','delete-BCI',
             'add-producrt-to-BCI','update-BCI','show-qnty-BCI' ,'countBciNotvadlidatedbyRDS',
             'countBcivadlidatedbyRDS','getTopConsumers','getTopProductsByStructure'  
            ],
            Role::DEFAULT_ROLES["DIRECTEUR"] => [
                'create-BCI','read-BCI','show-BCI','delete-BCI',
             'add-producrt-to-BCI','update-BCI','show-qnty-BCI','countBciNotvadlidatedbyDIR',
             'countBcivadlidatedbyDIR','getTotalDeliveredQuantity'

            ],
        ];
        foreach ($roles as $role => $permissions) {
            $r = Role::create([
                'name' => $role
            ]);
            foreach ($permissions as $name) {
                $permission = Permission::firstWhere('name', $name);
                if (!$permission) {
                    $permission = Permission::create([
                        'name' => $name
                    ]);
                }
                DB::table('role_permission')->insert([
                    'role_id' => $r->id,
                    'permission_id' => $permission->id
                ]);
            }
        }
    }
    }


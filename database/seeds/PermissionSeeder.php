<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Module;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();
        Module::truncate();
        
        //tests
        $tests_module=Module::Create([
            'name'=>'tests'
        ]);

        Permission::insert(
        [
            [
                'module_id'=>$tests_module['id'],
                'key'=>'view_test',
                'name'=>'View'
            ],
            [
                'module_id'=>$tests_module['id'],
                'key'=>'create_test',
                'name'=>'Create'
            ],
            [
                'module_id'=>$tests_module['id'],
                'key'=>'edit_test',
                'name'=>'Edit'
            ],
            [
                'module_id'=>$tests_module['id'],
                'key'=>'delete_test',
                'name'=>'Delete'
            ],
        ]
        );

        //cultures
        $cultures_module=Module::Create([
            'name'=>'cultures'
        ]);

        Permission::insert(
        [
            [
                'module_id'=>$cultures_module['id'],
                'key'=>'view_culture',
                'name'=>'View'
            ],
            [
                'module_id'=>$cultures_module['id'],
                'key'=>'create_culture',
                'name'=>'Create'
            ],
            [
                'module_id'=>$cultures_module['id'],
                'key'=>'edit_culture',
                'name'=>'Edit'
            ],
            [
                'module_id'=>$cultures_module['id'],
                'key'=>'delete_culture',
                'name'=>'Delete'
            ],
        ]
        );

        //antibiotics
        $antibiotics_module=Module::Create([
            'name'=>'antibiotics'
        ]);

        Permission::insert(
        [
            [
                'module_id'=>$antibiotics_module['id'],
                'key'=>'view_antibiotic',
                'name'=>'View'
            ],
            [
                'module_id'=>$antibiotics_module['id'],
                'key'=>'create_antibiotic',
                'name'=>'Create'
            ],
            [
                'module_id'=>$antibiotics_module['id'],
                'key'=>'edit_antibiotic',
                'name'=>'Edit'
            ],
            [
                'module_id'=>$antibiotics_module['id'],
                'key'=>'delete_antibiotic',
                'name'=>'Delete'
            ],
        ]
        );

        //culture options
        $culture_options_module=Module::Create([
            'name'=>'culture options'
        ]);

        Permission::insert(
        [
            [
                'module_id'=>$culture_options_module['id'],
                'key'=>'view_culture_option',
                'name'=>'View'
            ],
            [
                'module_id'=>$culture_options_module['id'],
                'key'=>'create_culture_option',
                'name'=>'Create'
            ],
            [
                'module_id'=>$culture_options_module['id'],
                'key'=>'edit_culture_option',
                'name'=>'Edit'
            ],
            [
                'module_id'=>$culture_options_module['id'],
                'key'=>'delete_culture_option',
                'name'=>'Delete'
            ],
        ]
        );

        //doctors
        $doctors_module=Module::Create([
            'name'=>'doctors'
        ]);

        Permission::insert(
        [
            [
                'module_id'=>$doctors_module['id'],
                'key'=>'view_doctor',
                'name'=>'View'
            ],
            [
                'module_id'=>$doctors_module['id'],
                'key'=>'create_doctor',
                'name'=>'Create'
            ],
            [
                'module_id'=>$doctors_module['id'],
                'key'=>'edit_doctor',
                'name'=>'Edit'
            ],
            [
                'module_id'=>$doctors_module['id'],
                'key'=>'delete_doctor',
                'name'=>'Delete'
            ],
        ]
        );

        //groups
        $groups_module=Module::Create([
            'name'=>'groups tests'
        ]);

        Permission::insert(
        [
            [
                'module_id'=>$groups_module['id'],
                'key'=>'view_group',
                'name'=>'View'
            ],
            [
                'module_id'=>$groups_module['id'],
                'key'=>'create_group',
                'name'=>'Create'
            ],
            [
                'module_id'=>$groups_module['id'],
                'key'=>'edit_group',
                'name'=>'Edit'
            ],
            [
                'module_id'=>$groups_module['id'],
                'key'=>'delete_group',
                'name'=>'Delete'
            ],
        ]
        );

        //patients
        $patients_module=Module::Create([
            'name'=>'patients'
        ]);

        Permission::insert(
        [
            [
                'module_id'=>$patients_module['id'],
                'key'=>'view_patient',
                'name'=>'View'
            ],
            [
                'module_id'=>$patients_module['id'],
                'key'=>'create_patient',
                'name'=>'Create'
            ],
            [
                'module_id'=>$patients_module['id'],
                'key'=>'edit_patient',
                'name'=>'Edit'
            ],
            [
                'module_id'=>$patients_module['id'],
                'key'=>'delete_patient',
                'name'=>'Delete'
            ],
        ]
        );

        //tests reports
        $reports_module=Module::Create([
            'name'=>'tests reports'
        ]);

        Permission::insert(
        [
            [
                'module_id'=>$reports_module['id'],
                'key'=>'view_report',
                'name'=>'View'
            ],
            [
                'module_id'=>$reports_module['id'],
                'key'=>'create_report',
                'name'=>'Create'
            ],
            [
                'module_id'=>$reports_module['id'],
                'key'=>'edit_report',
                'name'=>'Edit'
            ],
            [
                'module_id'=>$reports_module['id'],
                'key'=>'delete_report',
                'name'=>'Delete'
            ],
            [
                'module_id'=>$reports_module['id'],
                'key'=>'sign_report',
                'name'=>'Sign'
            ],
        ]
        );

        //roles
        $roles_module=Module::Create([
            'name'=>'roles'
        ]);

        Permission::insert(
        [
            [
                'module_id'=>$roles_module['id'],
                'key'=>'view_role',
                'name'=>'View'
            ],
            [
                'module_id'=>$roles_module['id'],
                'key'=>'create_role',
                'name'=>'Create'
            ],
            [
                'module_id'=>$roles_module['id'],
                'key'=>'edit_role',
                'name'=>'Edit'
            ],
            [
                'module_id'=>$roles_module['id'],
                'key'=>'delete_role',
                'name'=>'Delete'
            ],
        ]
        );

        //users
        $users_module=Module::Create([
            'name'=>'users'
        ]);

        Permission::insert(
        [
            [
                'module_id'=>$users_module['id'],
                'key'=>'view_user',
                'name'=>'View'
            ],
            [
                'module_id'=>$users_module['id'],
                'key'=>'create_user',
                'name'=>'Create'
            ],
            [
                'module_id'=>$users_module['id'],
                'key'=>'edit_user',
                'name'=>'Edit'
            ],
            [
                'module_id'=>$users_module['id'],
                'key'=>'delete_user',
                'name'=>'Delete'
            ],
        ]
        );

        //price list
        $price_list_module=Module::Create([
            'name'=>'price list'
        ]);

        Permission::insert(
        [
            [
                'module_id'=>$price_list_module['id'],
                'key'=>'view_test_prices',
                'name'=>'View tests prices'
            ],
            [
                'module_id'=>$price_list_module['id'],
                'key'=>'update_test_prices',
                'name'=>'update tests prices'
            ],
            [
                'module_id'=>$price_list_module['id'],
                'key'=>'view_culture_prices',
                'name'=>'View cultures prices'
            ],
            [
                'module_id'=>$price_list_module['id'],
                'key'=>'update_culture_prices',
                'name'=>'Update cultures prices'
            ],
        ]
        );

       

        //accounting
        $accounting_module=Module::Create([
            'name'=>'accounting reports'
        ]);

        Permission::insert(
        [
            [
                'module_id'=>$accounting_module['id'],
                'key'=>'view_accounting_reports',
                'name'=>'View'
            ],
            [
                'module_id'=>$accounting_module['id'],
                'key'=>'generate_report_accounting',
                'name'=>'Generate'
            ],
        ]
        );

        

        //visits
        $visits_module=Module::Create([
            'name'=>'Home visits'
        ]);

        Permission::insert(
        [
            [
                'module_id'=>$visits_module['id'],
                'key'=>'view_visit',
                'name'=>'View'
            ],
            [
                'module_id'=>$visits_module['id'],
                'key'=>'create_visit',
                'name'=>'Create'
            ],
            [
                'module_id'=>$visits_module['id'],
                'key'=>'edit_visit',
                'name'=>'Edit'
            ],
            [
                'module_id'=>$visits_module['id'],
                'key'=>'delete_visit',
                'name'=>'Delete'
            ],
        ]  
        );

        //branches
        $branches_module=Module::Create([
            'name'=>'Branches'
        ]);

        Permission::insert(
        [
            [
                'module_id'=>$branches_module['id'],
                'key'=>'view_branch',
                'name'=>'View'
            ],
            [
                'module_id'=>$branches_module['id'],
                'key'=>'create_branch',
                'name'=>'Create'
            ],
            [
                'module_id'=>$branches_module['id'],
                'key'=>'edit_branch',
                'name'=>'Edit'
            ],
            [
                'module_id'=>$branches_module['id'],
                'key'=>'delete_branch',
                'name'=>'Delete'
            ],
        ]
        );

        //contracts
        $contracts_module=Module::Create([
            'name'=>'contracts'
        ]);

        Permission::insert(
        [
            [
                'module_id'=>$contracts_module['id'],
                'key'=>'view_contract',
                'name'=>'View'
            ],
            [
                'module_id'=>$contracts_module['id'],
                'key'=>'create_contract',
                'name'=>'Create'
            ],
            [
                'module_id'=>$contracts_module['id'],
                'key'=>'edit_contract',
                'name'=>'Edit'
            ],
            [
                'module_id'=>$contracts_module['id'],
                'key'=>'delete_contract',
                'name'=>'Delete'
            ],
        ]  
        );

        //expense category
        $expense_category_module=Module::Create([
            'name'=>'expense categories'
        ]);

        Permission::insert(
        [
            [
                'module_id'=>$expense_category_module['id'],
                'key'=>'view_expense_category',
                'name'=>'View'
            ],
            [
                'module_id'=>$expense_category_module['id'],
                'key'=>'create_expense_category',
                'name'=>'Create'
            ],
            [
                'module_id'=>$expense_category_module['id'],
                'key'=>'edit_expense_category',
                'name'=>'Edit'
            ],
            [
                'module_id'=>$expense_category_module['id'],
                'key'=>'delete_expense_category',
                'name'=>'Delete'
            ],
        ]  
        );

        //expenses
        $expense_module=Module::Create([
            'name'=>'Expenses'
        ]);

        Permission::insert(
        [
            [
                'module_id'=>$expense_module['id'],
                'key'=>'view_expense',
                'name'=>'View'
            ],
            [
                'module_id'=>$expense_module['id'],
                'key'=>'create_expense',
                'name'=>'Create'
            ],
            [
                'module_id'=>$expense_module['id'],
                'key'=>'edit_expense',
                'name'=>'Edit'
            ],
            [
                'module_id'=>$expense_module['id'],
                'key'=>'delete_expense',
                'name'=>'Delete'
            ],
        ]  
        );

        
        //backups
        $backups_module=Module::Create([
            'name'=>'Backups'
        ]);

        Permission::insert(
        [
            [
                'module_id'=>$backups_module['id'],
                'key'=>'view_backup',
                'name'=>'View'
            ],
            [
                'module_id'=>$backups_module['id'],
                'key'=>'create_backup',
                'name'=>'Create'
            ],
            [
                'module_id'=>$backups_module['id'],
                'key'=>'delete_backup',
                'name'=>'Delete'
            ],
        ]
        );

        //settings
        $setting_module=Module::Create([
            'name'=>'setting'
        ]);

        Permission::insert(
        [
            [
                'module_id'=>$setting_module['id'],
                'key'=>'view_setting',
                'name'=>'Update'
            ],
        ]
        );

        //chat
        $chat_module=Module::Create([
            'name'=>'Chat'
        ]);

        Permission::insert(
        [
            [
                'module_id'=>$chat_module['id'],
                'key'=>'view_chat',
                'name'=>'View'
            ]
        ]
        );

        //activity log
        $log_module=Module::Create([
            'name'=>'Actvity logs'
        ]);

        Permission::insert(
        [
            [
                'module_id'=>$log_module['id'],
                'key'=>'view_activity_log',
                'name'=>'View'
            ],
            [
                'module_id'=>$log_module['id'],
                'key'=>'clear_activity_log',
                'name'=>'Clear'
            ],
        ]
        );

        //translation
        $translation_module=Module::Create([
            'name'=>'Translation'
        ]);

        Permission::insert(
        [
            [
                'module_id'=>$translation_module['id'],
                'key'=>'view_translation',
                'name'=>'View'
            ],
            [
                'module_id'=>$translation_module['id'],
                'key'=>'edit_translation',
                'name'=>'Edit'
            ],
        ]
        );


    }
}

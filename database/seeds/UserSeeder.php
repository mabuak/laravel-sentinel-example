<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        #Create User
        $credentials = [
            'email'      => 'admin@admin.com',
            'password'   => 'password',
            'first_name' => 'Rama',
            'last_name'  => 'Dhan',
            'created_by' => 'Migration',
            'updated_by' => 'Migration',
        ];
    
        $userDb = Sentinel::registerAndActivate( $credentials );
    
        #Create Role
        Sentinel::getRoleRepository()
                ->createModel()
                ->create( [
                    'name'       => 'Root',
                    'slug'       => 'root',
                    'created_by' => 'Migration',
                    'updated_by' => 'Migration',
                ] )
                ->users()
                ->attach( $userDb );
        
        Sentinel::getRoleRepository()
                ->createModel()
                ->create( [
                    'name'       => 'User',
                    'slug'       => 'user',
                    'permissions'=> ['dashboard' => true],
                    'created_by' => 'Migration',
                    'updated_by' => 'Migration',
                ] );
    }
}

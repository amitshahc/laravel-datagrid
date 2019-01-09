<?php

namespace Modules\Dashboard\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Dashboard\Entities\Contacts;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Modules\Dashboard\Entities\Contacts::unguard();
        $contacts = factory(Contacts::class, 35000)->create();
        //Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}

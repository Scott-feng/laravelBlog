<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\User;

class SeedUsersData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $user_data = [
            'name' => 'Scott',
            'email' => 'tryqtyl2017@163.com',
            'password' => bcrypt('rjzd2018')
        ];

        //asign role
        $user= new User();
        $user->fill($user_data);
        $user->is_admin = true;
        $user->activated = true;
        $user->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::delete('delete from users where name=:name',['name'=>'scott']);
    }
}

<?php

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

  /**
    *
    *-------------------------------------------------
    * Create Table
    *-------------------------------------------------
    *
    **/

    public function create()
    {
        DB::schema()->create('users', function ($table) {
                $table->increments('id');
                $table->string('name', 50);
                $table->string('email')->unique();
                $table->string('password', 255);
                $table->timestamps();
        });
    }

  /**
    *
    *-------------------------------------------------
    * Drop Table
    *-------------------------------------------------
    *
    **/

    public function drop()
    {
        DB::schema()->dropIfExists('users');
    }
    
}
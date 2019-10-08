<?php

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Migrations\Migration;

class CreateTestTable extends Migration
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
        DB::schema()->create('test', function ($table) {
                $table->increments('id');
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
        DB::schema()->dropIfExists('test');
    }
}
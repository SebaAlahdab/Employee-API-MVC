<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmployeeFieldsToEmployeesTable extends Migration
{
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
        });
    }

    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropUnique(['email']);
            $table->dropUnique(['phone']);

            $table->dropColumn(['name', 'email', 'phone']);
        });
    }
}
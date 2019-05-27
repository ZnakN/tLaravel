<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    private $name = 'employees';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->name, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('company_id')->unsigned();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->timestamps();

        });

        Schema::table($this->name,function (Blueprint $table){
            // create foreign index
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable($this->name)) {
            Schema::enableForeignKeyConstraints();
            Schema::table($this->name,function (Blueprint $table){
                $table->dropForeign(['company_id']);
            });
            Schema::disableForeignKeyConstraints();
        }
        Schema::dropIfExists($this->name);
    }
}

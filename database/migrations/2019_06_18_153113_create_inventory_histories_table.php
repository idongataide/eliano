<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->date('issue_date');
            $table->integer('employee_id');
            $table->integer('equipment_id');
            $table->integer('project_id');
            $table->integer('situation_id');
            $table->integer('projectTo_id');
            $table->string('approvedby');
            $table->string('remarks')->nullable();
            $table->integer('user_id');
            $table->string('document_url')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_histories');
    }
}

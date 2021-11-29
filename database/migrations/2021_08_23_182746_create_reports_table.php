<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->String('title');
            $table->String('type');
            $table->String('file');
            $table->String('fileimage');
            $table->String('year');
            $table->smallInteger('status');
            $table->String('slug');
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
        Schema::dropIfExists('reports');
    }
}

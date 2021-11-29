<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->String('filepath');
            $table->smallInteger('status');
            $table->foreignId('event_id');
            $table->softDeletes();
            $table->timestamps();
        });

         Schema::table('posts', function (Blueprint $table){
          $table->dropSoftDeletes();
         });
        }
        
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
          // Schema::table('posts', function (Blueprint $table){
          //  $table->dropSoftDeletes();
          // });
      // Schema::dropIfExists('posts');

    }
}

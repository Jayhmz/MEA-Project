<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('events', function (Blueprint $table) {
      $table->uuid('id');
      $table->String('title');
      $table->String('event_category');
      $table->String('description');
      $table->String('event_type');
      $table->String('event_year');
      $table->String('start_date')->nullable();
      $table->String('end_date')->nullable();
      $table->String('flyer_url');
      $table->String('external_reg_link')->nullable();
      $table->smallInteger('requires_registration')->nullable();
      $table->String('video_link')->nullable();
      $table->smallInteger('status');
      $table->String('added_by')->nullable();
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
    Schema::dropIfExists('events');
  }
}

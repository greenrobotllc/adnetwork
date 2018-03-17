<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clicks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->uuid('ad_id');
            $table->uuid('widget_id');
            $table->uuid('campaign_id');
            $table->integer('cost');
            $table->string('ip_address');
            $table->date('click_date');
            $table->uuid('advertiser_user_id');
            $table->uuid('publisher_user_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clicks');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->timestamps();
            $table->uuid('user_id');
            $table->string('name');
            $table->integer('bid_amount');
            $table->integer('budget_amount');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->boolean('all_countries');
            $table->string('countries');
            $table->boolean('all_devices');
            $table->boolean('desktop_enabled');
            $table->boolean('mobile_enabled');
            $table->boolean('tablet_enabled');
            $table->boolean('all_operating_systems');
            $table->boolean('android_enabled');
            $table->boolean('ios_enabled');
            $table->integer('bid_range_low');
            $table->integer('bid_range_high');
            $table->integer('cost')->default(0);
            $table->boolean('enabled')->default(1);
            $table->enum('status', array('disabled', 'active', 'account_low_funds', 'campaign_reached_budget', 'no_ads', 'ads_pending_review'));



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}

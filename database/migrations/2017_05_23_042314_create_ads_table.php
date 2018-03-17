<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->timestamps();
            $table->uuid('user_id');
            $table->uuid('campaign_id');
            $table->string('url');

            $table->string('headline');
            $table->string('brand_name');
            $table->string('image_url');
            $table->boolean('enabled');
            $table->boolean('campaign_enabled');

            $table->integer('average_position')->nullable();
            $table->enum('status', array('approved', 'denied', 'pending'));

            $table->boolean('all_countries');
            $table->string('countries');
            $table->boolean('all_devices');
            $table->boolean('desktop_enabled');
            $table->boolean('mobile_enabled');
            $table->boolean('tablet_enabled');
            $table->boolean('all_operating_systems');
            $table->boolean('android_enabled');
            $table->boolean('ios_enabled');
            
            $table->enum('campaign_status', array('disabled', 'active', 'account_low_funds', 'campaign_reached_budget', 'no_ads', 'ads_pending_review'));


            $table->integer('bid_amount')->nullable();

            $table->integer('rpm')->nullable();
            $table->float('weight')->default(0.01);
            $table->index(['status', 'campaign_status', 'enabled', 'campaign_enabled', 'desktop_enabled', 'all_countries', 'countries', 'weight', 'mobile_enabled', 'tablet_enabled', 'all_operating_systems', 'android_enabled', 'ios_enabled'], 'ad_index');
            $table->index(['status', 'campaign_status', 'enabled', 'campaign_enabled', 'desktop_enabled', 'all_countries', 'countries', 'mobile_enabled', 'tablet_enabled', 'all_operating_systems', 'android_enabled', 'ios_enabled'], 'ad_index_2');


        });
            }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}

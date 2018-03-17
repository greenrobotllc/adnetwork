<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyAdUnitReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_ad_unit_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->date('report_date');
            $table->uuid('ad_unit_id');
            $table->uuid('publisher_widget_id');
            $table->uuid('publisher_user_id');
            $table->uuid('advertiser_user_id');
            $table->uuid('campaign_id');
            $table->uuid('site_id');
            $table->integer('impressions')->default(0);
            $table->integer('clicks')->default(0);
            $table->integer('total_cost')->nullable();
            $table->integer('avg_cpc')->nullable();
            $table->integer('rpm')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_ad_unit_reports');
    }
}

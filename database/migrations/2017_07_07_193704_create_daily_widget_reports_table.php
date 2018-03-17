<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyWidgetReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_widget_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->date('report_date');
            $table->uuid('widget_id');
            $table->uuid('publisher_user_id');
            $table->uuid('site_id');
            $table->integer('impressions')->default(0);
            $table->integer('clicks')->default(0);
            $table->integer('total_revenue')->nullable();
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
        Schema::dropIfExists('daily_widget_reports');
    }
}

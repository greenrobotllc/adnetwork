<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyAdUnitReport extends Model
{
    //
    protected $fillable = ['ad_unit_id', 'report_date', 'impressions', 'publisher_widget_id', 'campaign_id', 'site_id', 'advertiser_user_id', 'publisher_user_id'];
}

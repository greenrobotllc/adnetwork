<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyWidgetReport extends Model
{
    //
     protected $fillable = ['report_date', 'widget_id', 'publisher_user_id', 'site_id', 'impressions', 'clicks', 'total_revenue', 'avg_cpc', 'rpm'];
}

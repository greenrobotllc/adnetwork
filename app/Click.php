<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Click extends Model
{
    //
    protected $fillable = ['widget_id', 'ad_id', 'cost', 'ip_address', 'campaign_id', 'click_date', 'advertiser_user_id', 'publisher_user_id'];
}

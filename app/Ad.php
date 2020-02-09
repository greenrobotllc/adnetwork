<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Uuids;

class Ad extends Model
{
            use Uuids;

    //
            public $incrementing = false;

            protected $table = "ads";
            protected $fillable = ['url', 'user_id', 'campaign_id', 'headline', 'brand_name', 'image_url', 'enabled', 'status', 'campaign_enabled', 'campaign_status', 'all_countries', 'countries', 'all_devices', 'desktop_enabled', 'mobile_enabled', 'tablet_enabled', 'all_operating_systems', 'android_enabled', 'ios_enabled', 'bid_amount', 'id', 'whitelist_only'];

}

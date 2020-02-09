<?php

namespace App;
use App\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class Campaign extends Model
{
    use Uuids;
    public $incrementing = false;

    //
    protected $fillable = ['name', 'bid_amount', 'budget_amount', 'start_date', 'end_date', 'user_id', 'all_countries', 'all_devices', 'desktop_enabled', 'mobile_enabled', 'tablet_enabled', 'all_operating_systems', 'android_enabled', 'ios_enabled', 'bid_range_low', 'bid_range_high', 'countries', 'status', 'id', 'whitelist_only'];


    protected static function boot()
    {
        parent::boot();

        static::creating(
            function ($model) {
                if (Auth::check()) {
                    $model->user_id = Auth::id();
                    //$model->updated_by_id = Auth::id();
                     //$model->{$model->getKeyName()} = Uuid::generate()->string;
                    $model->id = Uuid::generate()->string;

                }
            }
        );



        static::updating(
            function ($model) {
                if (Auth::check()) {
                    //$model->updated_by_id = Auth::id();
                }
            }
        );
    }  




}

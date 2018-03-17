<?php

namespace App;
use App\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class Sites extends Model
{
        use Uuids;

    protected $fillable = ['name', 'url', 'platform', 'approval_status', 'id'];
    public $incrementing = false;


        protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (Auth::check()) {
                $model->user_id = Auth::id();
                //$model->updated_by_id = Auth::id();
                $model->id = Uuid::generate()->string;

            }
        });

        static::updating(function($model) {
            if (Auth::check()) {
                //$model->updated_by_id = Auth::id();
            }
        });
    }  
}

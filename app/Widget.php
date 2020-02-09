<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Uuids;

class Widget extends Model
{
    //
       use Uuids;
       public $incrementing = false;
    protected $fillable = ['name', 'site_id', 'user_id', 'id'];

}

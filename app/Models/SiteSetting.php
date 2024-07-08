<?php

namespace App\Models;

use App\Helper\ImageableDynamic;
use App\Helper\ImageableMultiple;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiteSetting extends Model
{
    use HasFactory,ImageableMultiple,ImageableDynamic;
    protected $table="site_settings";
    protected $fillable = [
        'title',
        'description',
        'logo',
        'favicon'
    ];
}

<?php

namespace App\Models;

use App\Models\Abstracts\ExtendedModel;
use App\Models\Abstracts\ValidatorTrait;

class Patient extends ExtendedModel
{
    use ValidatorTrait;

    // Table
    protected $table = 'patients';
    protected static $tableName = 'patients';

    // Fields
    protected $hidden = ['id','created_at','updated_at','deleted_at'];
    protected $fillable = ['name','surname','gender','birth','height','weight','profession','country','region','city',
        'zip','address_main','address_secondary','phone_prefix','phone','email','referrer','pathology','notes'];

    protected $rules = array();
    protected $reqRules = array();
    protected $uniqueRules = array();


}

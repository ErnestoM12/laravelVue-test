<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class todo extends Model
{
    protected $primaryKey = 'id';
    protected $fillable=['name','email','message','typesID'];


}

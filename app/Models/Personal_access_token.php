<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal_access_token extends Model
{
    use HasFactory;
    protected $fillable=['tokenable_type','tokenable_id','name','token','abilities'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkData extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'lname',
        'email',
        'photo',
        'phone_number',
        'jobtype', 
        'workplace',
        'jobdata', 
        'jobarea', 
        'jobdate', 
        'job_status',
        'admin_id'
    ];
    public $timestamps = true;
}

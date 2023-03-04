<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    use HasFactory;
    protected $guarded=['id','created_at','updated_at'];

    public function created_by()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}

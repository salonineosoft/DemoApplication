<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cms extends Model
{
    protected $fillable=['title','body','image'];
    protected $table = "cms";
    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zip extends Model
{
    use HasFactory;

    public const STATUS_WAIT = "wait";
    public const STATUS_PROCESSING = "processing";
    public const STATUS_DONE = "done";

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'name',
        'size',
        'path',
        "status",
        "user_id"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_is");
    }

    public function files(){
        return $this->hasMany(ZipFile::class ,"zip_id");
    }
}

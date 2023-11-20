<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZipFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'size',
        'path',
        "zip_id",
        "type",
        "extension" ,
        "location"
    ];

    public function scopeFilters($query, $request)
    {
        if($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where("name", "like", "%" . $request->search . "%");
            });

        }

        if($request->type) {
            $query->where("type", $request->type);
        }
    }
}

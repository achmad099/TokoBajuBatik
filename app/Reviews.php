<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reviews extends Model
{
    protected $fillable = [
        'rating', 'description', 'user_id', 'product_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function review()
    {
        $query = "SELECT * FROM review";
        var_dump(DB::select($query));
        die;
    }
}

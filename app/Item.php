<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    public function model()
    {
        return $this->belongsTo(ModelPage::class);
    }




}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales_invoice_item extends Model
{
    protected $guarded = [];

    public function sales_invoice(){
        return $this->belongsTo('App\Sales_invoice');
    }

}

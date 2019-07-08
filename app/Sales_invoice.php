<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales_invoice extends Model
{
    protected $guarded = [];

    public function sales_invoice_item(){
        return $this->hasMany('App\Sales_invoice_item');
    }
    public function getEntryDateAttribute($input)
{
    return Carbon::createFromFormat('Y-m-d', $input)
      ->format(config('app.date_format'));
}

}

<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'id',
        'name',
        'item_name',
        'item_code',
        'item_group',
        'stock_uom',
        'kategori_menu',
        'standard_rate',
        'thumbnail',
    ];
    public function getNameAttribute($value)
    {
        $return = Product::where('name',$value)->first(['item_name']);
        // dd($a);
        return $return->item_name;
        // return $this->name = $this->item_name;
    }
    public function updateOrInsertItem($data){
        // dd($data);
        foreach ($data as $key => $value) {
		if($value['thumbnail'] == null){
			$value['thumbnail'] = '/files/GhQZhaO 2019-06-14 22:09:23_small.jpg';
		}
            if ($this->hasCreated($value['item_code'])) {
                $this->where('item_code', $value['item_code'])->update($value);
            }else{
                $this->create($value);
            }
        }
    }

    public function hasCreated($itemCode) {
        $data = $this->where('item_code', $itemCode)->first(['id']);
        return !empty($data);
    }

    public function getDefault($categories, $search) {
        $products = $this->select([
            'id',
            'name',
            // 'item_name',
            'item_code',
            'item_group',
            'stock_uom',
            'standard_rate',
            'kategori_menu',
            'thumbnail',
        ]);
        if (!empty($categories)) 
            $products->whereIn('kategori_menu', $categories);

        $products = $products->where('name', 'like', '%' . $search . '%');

        return $products->get();
    }
}

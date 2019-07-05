<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';
    protected $fillable = [
        'id',
        'name',
        'created_at',
    ];

    public function getDefault(){
        return $this->get([
            'id',
            'name',
        ]);
    }

    public function updateOrInsertItem($items){
        foreach ($items as $item) {
            if ($this->hasCreated($item['name'])) {
                $this->where('name', $item['name'])
                    ->update($item);
            } else {
                $this->create($item);
            }
        }
    }

    public function hasCreated($name) {
        $item = $this->where('name', $name)->first();
        return !empty($item);
    }
}

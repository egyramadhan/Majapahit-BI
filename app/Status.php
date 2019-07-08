<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';

    public function getByName($name) {
        return $this->where('name', $name)->first(['id'])->id;
    }
}

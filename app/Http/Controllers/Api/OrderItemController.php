<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OrderItem;
use App\Order;

class OrderItemController extends Controller
{
    public function finish($id){
        return (new OrderItem)->finish($id);
    }

    public function print($id){
        $order = (new Order)->dataPrint($id);
        if (empty($order))
            return 'Invalid id';

        return $order;
    }

    public function printPerItem($id){
        $order = (new Order)->dataPrintPerItem($id);
        if (empty($order))
            return 'Invalid id';

        return $order;
    }
}

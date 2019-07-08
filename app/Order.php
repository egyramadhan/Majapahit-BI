<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Config;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'id',
        'user_name',
        'user_phone',
        'subtotal',
        'tax',
        'discount',
        'grand_total',
        'payment_method',
        'amount',
        'status_id',
        'created_at',
    ];
    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
           ->format('d-m-Y');
    }
    public function getPendingOrder(){
        return $this->whereIn('status_id', [1,2])->get([
            'id',
            'user_name',
            'user_phone',
            'subtotal',
            'tax',
            'discount',
            'grand_total',
            'payment_method',
            'amount',
        ]);
    }

    public function getPendingOrderList($id) {
        $orders = $this->getPendingOrder();
        // dd($orders);
        $orderLists = array();
        foreach ($orders as $order) {
            $order->items = OrderItem::where([
                    'order_items.order_id' => $order->id,
                    'order_items.order_category_id' => $id,
                ])
                ->join('products as p', 'p.id', '=', 'order_items.product_id')
                ->get([
                    'order_items.id',
                    'order_items.product_id',
                    'p.name',
                    'p.item_name',
                    DB::raw('CONCAT("' . config('constants.base.app_server_url') . '", p.thumbnail) as thumbnail'),
                    'order_items.qty',
                    'order_items.price',
                    'order_items.subtotal',
                    'order_items.tax',
                    'order_items.discount',
                    'order_items.grand_total',
                    'order_items.status_id',
                ]);
            
            $itemsFinishedCount = OrderItem::where([
                    'order_items.order_id' => $order->id,
                    'order_items.order_category_id' => $id,
                    'order_items.status_id' => 3,
                ])
                ->join('products as p', 'p.id', '=', 'order_items.product_id')
                ->count();
            
            $orderItemCount = $order->items->count();
            if ($orderItemCount > 0 && $itemsFinishedCount < $orderItemCount) 
                array_push($orderLists, $order);
        }

        $orders = $orders->reject(function($order){
            return $order->items->count() < 1;
        });

        return $orderLists;
    }

    public function dataPrint($id) {
        $order = $this->select([
                'id',
                'officer',
                'user_name',
                'user_phone',
                'subtotal',
                'tax',
                'discount',
                'grand_total',
                'payment_method',
                'amount',
                'created_at',
            ])
            ->find($id);
            // dd($order);
        $order->items = OrderItem::where('order_id', $order->id)
            ->join('products as p', 'p.id', '=', 'order_items.product_id')
            ->get([
                'order_items.id',
                'p.name',
                'p.item_name',
                'p.item_code',
                'p.standard_rate',
                'order_items.qty',
                'order_items.price',
                'order_items.subtotal',
                'order_items.discount',
                'order_items.tax',
                'order_items.grand_total',
                'order_items.status_id'
            ]);
                // dd($order);
        return view('prints.kasir', compact('order'));
    }


    public function dataPrintPerItem($id) {
        $order = OrderItem::where('order_items.id', $id)->where('order_items.status_id','=',3)
            ->join('products as p', 'p.id', '=', 'order_items.product_id')
            ->join('orders as o', 'o.id', '=', 'order_items.order_id')
            ->first([
                'order_items.id',
                'o.id as order_id',
                'o.user_name',
                'o.user_phone',
                'p.name',
                'p.item_name',
                'p.item_code',
                'p.standard_rate',
                'order_items.qty',
                'order_items.price',
                'order_items.subtotal',
                'order_items.discount',
                'order_items.tax',
                'order_items.grand_total',
                'order_items.status_id',
                'order_items.created_at',
            ]);
            // dd($order);
        return view('prints.barista_kitchen', compact('order'));
    }
}

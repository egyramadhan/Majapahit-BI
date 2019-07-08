<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;  
use App\Libraries\JsonResponse;
use Exception;

class OrderItem extends Model
{
    protected $table = 'order_items';
    protected $fillable = [
        'id',
        'product_id',
        'order_id',
        'qty',
        'order_category_id',
        'price',
        'subtotal',
        'tax',
        'discount',
        'grand_total',
        'status_id',
        'created_at',
    ];

    public function pendingItems($orderId) {
        return $this->where('order_id', $orderId)
            ->whereIn('status_id', [1,2])
            ->get();
    }

    public function finish($id) {
        try {
            $finish = (new Status)->getByName('Sync');
            $updateItem = $this->where('id', $id)->first();
            $updateItem->status_id = $finish;
            $updateItem->save();

            $orderItemPendingCount = $this->pendingItems($updateItem->order_id)->count();
            if ($orderItemPendingCount == 0) 
                Order::where('id', $updateItem->order_id)->update(['status_id' => $finish]);
            
        } catch (ModelNotFoundException $e) {
            return JsonResponse::notFound('Invalid id');
        } catch (Exception $e) {
            // dd($e);
            return JsonResponse::internalServerError($e->getMessage());
        }
        return JsonResponse::ok($id);
    }
    public function orderCategory()
    {
        return $this->belongsTo('App\OrderCategory');
    }
}

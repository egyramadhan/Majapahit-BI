<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderItem;
use App\Product;
use App\Libraries\JsonResponse;
use App\Libraries\TransactionService;
use Validator;
use DB;
use Carbon\Carbon;
use Exception;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::get();
        foreach ($orders as $order) {
            $orderItem = OrderItem::where('order_id', $order->id)->join('products as p', 'p.id', '=', 'order_items.product_id')->get(['p.name']);
            $order->item_total = $orderItem->count();
            $order->items = $orderItem;
        }
        return ['data' => $orders];
    }

    public function listOf($id) {
        return ['data' => (new Order)->getPendingOrderList($id)];
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'user_phone' => 'required',
            'tax' => 'required|numeric',
            'discount' => 'required|numeric',
            'payment_method' => 'required',
            'status_id' => 'required|exists:statuses,id',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qty' => 'required|numeric',
            'items.*.tax' => 'required|numeric|max:100',
            'items.*.discount' => 'required|numeric|max:100',
            'items.*.status_id' => 'required|exists:statuses,id',
            'items.*.order_category_id' => 'required|exists:order_categories,id',
        ]);

        if ($validator->fails())
            return JsonResponse::badRequest($validator->errors()->first());

            // return JsonResponse::internalServerError('tes');
        $userName = $request->input('user_name');
        $userPhone = $request->input('user_phone');
        $tax = $request->input('tax');
        $discount = $request->input('discount');
        $paymentMethod = $request->input('payment_method');
        $statusId = $request->input('status_id');
        $items = $request->input('items');

        DB::beginTransaction();
        try {

            $order = Order::create([
                'user_name' => $userName,
                'user_phone' => $userPhone,
                'payment_method' => $paymentMethod,
                'status_id' => $statusId,
                'created_at' => Carbon::now(),
            ]);

            $subtotal = 0;
            foreach ($items as $item) {
                $productId = $item['product_id'];
                $productQty = $item['qty'];
                $productTax = $item['tax'];
                $productDiscount = $item['discount'];
                $itemStatusId = $item['status_id'];
                $itemCategoryId = $item['order_category_id'];

                $product = Product::select(['standard_rate'])->find($productId);

                $productSubtotal = $productQty * $product->standard_rate;
                $productTaxValue = ($productTax/100) * $productSubtotal;
                $productDiscountValue = ($productDiscount/100) * $productSubtotal;
                $productGrandTotal = $productSubtotal + $productTaxValue - $productDiscountValue;
                // return JsonResponse::internalServerError($productGrandTotal);
                $subtotal += $productGrandTotal;

                OrderItem::create([
                    'product_id' => $productId,
                    'order_id' => $order->id,
                    'order_category_id' => $itemCategoryId,
                    'qty' => $productQty,
                    'price' => $product->standard_rate,
                    'subtotal' => $productSubtotal,
                    'tax' => $productTaxValue,
                    'discount' => $productDiscountValue,
                    'grand_total' => $productGrandTotal,
                    'status_id' => $itemStatusId,
                    'created_at' => Carbon::now(),
                ]);
            }

            $taxValue = ($tax/100) * $subtotal;
            $discountValue = ($discount/100) * $subtotal;
            $grandTotal = $subtotal + $taxValue - $discountValue;

            $order->subtotal = $subtotal;
            $order->tax = $taxValue;
            $order->discount = $discountValue;
            $order->grand_total = $grandTotal;
            $order->amount = $grandTotal;
            $order->save();

        } catch (Exception $e) {
            DB::rollback();
            // dd($e);
            return JsonResponse::internalServerError($e->getMessage());
        }

        DB::commit();
        
        return JsonResponse::ok($order->id);
    }

    public function upload(Request $request)
    {
        $orders = Order::where([
                'sync' => 0,
                'status_id' => 3,
            ])->get();
        $user = $request->input('email');
        $password = $request->input('password');


        foreach ($orders as $order) {
            $items = OrderItem::where([
                    'order_items.order_id' => $order->id,
                ])
                ->join('products as p', 'p.id', '=', 'order_items.product_id')
                ->get([
                    'order_items.id',
                    'order_items.product_id',
                    'p.name',
                    'p.item_code',
                    'p.item_group',
                    'p.stock_uom',
                    'order_items.qty',
                    'order_items.price',
                    'order_items.subtotal',
                    'order_items.tax',
                    'order_items.discount',
                    'order_items.grand_total',
                    'order_items.status_id',
                ]);

                $dataUpload["is_pos"] = '1'; 
                $dataUpload["name"] = 'test'; 
                $dataUpload["submit_on_creation"] = '1'; 
                $dataUpload["against_income_account"] = "4110.000 - Penjualan - MJP"; 
                $dataUpload["owner"] = $user; 
                $dataUpload["price_list_currency"] = 'IDR'; 
                $dataUpload["mode_of_payment"] = 'IDR'; 
                $dataUpload["update_stock"] = '1'; 
                $dataUpload["company"] = 'Makanan Jajanan Pait'; 
                $dataUpload['customer'] = 'Outlet Bunga Coklat';
                $dataUpload["booking_name"] = $order->user_name; 
                $dataUpload["is_opening"] = 'No'; 
                $dataUpload["customer_group"] = 'All Customer Groups'; 
                $dataUpload["naming_series"] = 'SINV-'; 
                $dataUpload["currency"] = 'IDR'; 
                $dataUpload["debit_to"] = '1131.0010 - Piutang Dagang - MJP'; 
                $dataUpload["remarks"] = 'No Remarks'; 
                $dataUpload["posting_date"] = Carbon::now()->format('Y-m-d'); 
                $dataUpload["selling_price_list"] = 'Standard Selling'; 
                $dataUpload["discount_amount"] = $order->discount; 
                $dataUpload["apply_discount_on"] = ''; 
                $dataUpload["docstatus"] = 1; 
                $dataUpload['items'] = array();
                foreach ($items as $item) {
                    $dataItem = array(
                        'qty' => $item->qty,
                        'margin_rate_or_amount' => 0,
                        'rate' => $item->price,
                        'owner' => $user,
                        'cost_center' => "Main - MJP",
                        'base_net_amount' => $item->subtotal,
                        'base_net_rate' => $item->grand_total,
                        'item_name' => $item->name,
                        'amount' => $item->grand_total,
                        'warehouse' => 'Stores - MJP',
                        'income_account' => '4480.000 - Pendapatan Lain lain - MJP',
                        'item_code' => $item->item_code,
                    );
                    array_push($dataUpload['items'], $dataItem);
                }

                $dataUpload['payments'] = array();
                $dataPayment = array(
                    "mode_of_payment" => "Cash",
                    "amount" => $order->amount,
                    "account" => "1111.0020 - Kas Besar - MJP"
                );
                array_push($dataUpload['payments'], $dataPayment);
                //return $dataUpload;
                $transaction = TransactionService::uploadProduct($user, $password, $dataUpload);
                if ($transaction['error']) {
                    return response($transaction['message'], $transaction['status_code']);
                }
                $order->sync = 1;
                $order->save();
        }

        return JsonResponse::ok('Data berhasil dikirim');
    }
}

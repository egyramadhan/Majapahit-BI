<?php

namespace App\Http\Controllers;

use App\Libraries\TransactionService;
use Illuminate\Http\Request;
use App\Sales_invoice;
use App\Sales_invoice_item;
use DB;

class AdminController extends Controller
{
    public function index($full_name)
    {
        $a = \Session::get('full_name');
        if ($full_name != $a) {
            return redirect()->back();
        }
        $sales_invoices = Sales_invoice::all();
        return view('admin.dashboard',compact('sales_invoices'));
    }
    public function sycinvoice()
    {
        $user = "administrator";
        $password = "qazplm123";
        $transactions = TransactionService::getInvoice($user, $password);
        DB::beginTransaction();
        try {
            foreach ($transactions['data'] as $key => $transaction) {
                $check_data = Sales_invoice::where('name',$transaction['name'])->first();
                if (empty($check_data)) {
                $sales_invoice_insert = Sales_invoice::create([
                    'name' => $transaction['name'],
                    'outlet' => $transaction['customer'],
                    'booking_name' => $transaction['booking_name'],
                    'posting_date' => $transaction['posting_date'],
                    'net_total' => $transaction['net_total'],
                    'base_grand_total' => $transaction['base_grand_total'],
                    'status' => $transaction['status'],
                ]);
                $transaction_item = TransactionService::getInvoiceItem($user, $password, $sales_invoice_insert->name);
                $transaction_item_singles = $transaction_item['data']['items'];
                foreach ($transaction_item_singles as $key => $transaction_item_single) {
                    // dd($transaction_item_single);
                    $sales_invoice_item_insert = Sales_invoice_item::create([
                        'sales_invoice_id' => $sales_invoice_insert->id,
                        'item_group' => $transaction_item_single['item_group'],
                        'amount' => $transaction_item_single['amount'],
                        'qty' => $transaction_item_single['qty'],
                        'rate' => $transaction_item_single['rate'],
                        'stock_uom' => $transaction_item_single['stock_uom'],
                        'item_name' => $transaction_item_single['item_name'],
                        'uom' => $transaction_item_single['uom'],
                        'description' => $transaction_item_single['description'],
                    ]);
                }
              }
            }
            DB::commit();
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
        }
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Sales_invoice_item;
use App\OrderItem;
use App\Http\Controllers\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // ngambil label menu kategori
        $labels = OrderItem::select('order_category_id', DB::raw('count(*) as total'))
                            ->groupBy('order_category_id')
                            ->get();
        $kategori = [];
        foreach($labels as $lb){
            $kategori[] = $lb->orderCategory->name;
        }

        //ngambil nilai grand total dari per kategori menu
        $data = OrderItem::groupBy('order_category_id')->selectRaw('sum(grand_total) as total, order_category_id')
        ->pluck('total','order_category_id');
        $datatotal = [];

        foreach($data as $dt){
            $datatotal[] = $dt;
        }

        // //ngambil total per menu
        // $description = Sales_invoice_item::groupBy('description')->selectRaw('sum(amount) as total, description')
        // ->pluck('total','description');
        // $sorted = $description->sortByDesc('total');
        // $sorted->values()->all();
        // // dd($sorted);

        // $datamenu = [];

        // foreach($description as $dcp){
        //     $datamenu[] = $dcp->orderBy('total');
        // }
        // dd($datamenu);
        return view('dashboard',['kategori'=>$kategori,'datatotal'=>$datatotal]);
  
    }
    public function logout(Request $request) {
        $request->session()->flush();
        return redirect('/');
      }
}

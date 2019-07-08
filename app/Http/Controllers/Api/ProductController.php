<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\JsonResponse;
use App\Libraries\TransactionService;
use App\Product;
use Validator;

class ProductController extends Controller
{
    public function index(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'categories' => 'nullable',
            'search' => 'nullable',
        ]);

        if ($validator->fails())
            return JsonResponse::badRequest($validator->errors()->first());

        $products = TransactionService::getProducts('administrator', 'qazplm123');
        // dd($products);
        
        if (is_array($products))
            (new Product())->updateOrInsertItem($products['data']);
        $categories = $request->input('categories');
        $categories = json_decode($categories, true);
        $search = $request->input('search');

        $products = (new Product())->getDefault($categories, $search);
// dd('a');
        return ['data' => $products];
    }

}

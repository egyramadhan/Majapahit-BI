<?php

namespace App\Http\Controllers\Api;

use App\ProductCategory;
use App\Http\Controllers\Controller;
use App\Libraries\TransactionService;
use App\Libraries\JsonResponse;
use Illuminate\Http\Request;
use Validator;

class ProductCategoryController extends Controller
{
    public function index(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) 
            return JsonResponse::badRequest($validator->errors()->first());

        $username = $request->input('username');
        $password = $request->input('password');

        $productCategories = TransactionService::getProductCategories($username, $password);
        
        if (is_array($productCategories))
            (new ProductCategory())->updateOrInsertItem($productCategories['data']);

        $datas = (new ProductCategory)->getDefault();

        return ['data' => $datas];
    }
}

<?php

namespace App\Http\Controllers\Api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\admin\ShopRequest;
use App\Models\Shop;

class ShopController extends Controller
{

    public function index()
    {
        $shops = Shop::paginate();

        return api_resource('admin\ShopResource')->make($shops);
    }

    public function store(ShopRequest $request)
    {
        $shop = Shop::create($request->validated());

        if ($shop instanceof Shop) {
            return api_resource('admin\ShopResource')->make($shop);
        }

        return response()->json(['message' => 'Error']);
    }

    public function show(Shop $shop)
    {
        return api_resource('admin\ShopResource')->make($shop);
    }

    public function update(ShopRequest $request, Shop $shop)
    {
        if ($shop->update($request->validated())) {
            return api_resource('admin\ShopResource')->make($shop);
        }

        return response()->json(['message' => 'Error']);
    }

    public function destroy($id)
    {
        //
    }
}

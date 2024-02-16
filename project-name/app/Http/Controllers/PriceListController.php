<?php

namespace App\Http\Controllers;

use App\Models\PriceList;
use Illuminate\Http\Request;

class PriceListController extends Controller
{
    public function index()
    {
        return PriceList::all();
    }

    public function show($id)
    {
        return PriceList::find($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric',
            'sku'   => 'required|string|max:255',
        ]);

        $priceList = PriceList::create($request->all());

        return $priceList;
    }

    public function update(Request $request, $id)
    {
        $priceList = PriceList::findOrFail($id);
        $priceList->update($request->all());

        return $priceList;
    }

    public function destroy($id)
    {
        return PriceList::destroy($id);
    }
}

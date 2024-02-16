<?php

namespace App\Http\Controllers;

use App\Models\ContractList;
use Illuminate\Http\Request;

class ContractListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ContractList::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'    => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'price'      => 'required|numeric|min:0',
            'sku'        => 'required|string|max:255',
        ]);

        $contractList = ContractList::create($request->all());

        return response()->json(['message' => 'Ugovorna lista uspješno dodana.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id'    => 'sometimes|required|exists:users,id',
            'product_id' => 'sometimes|required|exists:products,id',
            'price'      => 'sometimes|required|numeric|min:0',
            'sku'        => 'sometimes|required|string|max:255',
        ]);

        $contractList = ContractList::findOrFail($id);
        $contractList->update($request->all());

        return response()->json(['message' => 'Ugovorna lista uspješno ažurirana.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return ContractList::destroy($id);
    }
}

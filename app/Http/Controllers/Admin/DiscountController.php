<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Discount\StoreRequest;
use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::get();
        return view('admin.discount.index', compact('discounts'));
    }

    public function create()
    {
        return view('admin.discount.create');
    }

    public function store(StoreRequest $request)
    {
        Discount::create($request->all());

        return redirect()->route('admin.discount.index')->with('success', 'Discount Has Been Created');
    }

    public function edit(Discount $discount)
    {

    }

    public function update(Discount $discount)
    {

    }

    public function destroy(Discount $discount)
    {
        $discount->delete();
        return back()->with('success', 'Discount Has Been Deleted');
    }
}

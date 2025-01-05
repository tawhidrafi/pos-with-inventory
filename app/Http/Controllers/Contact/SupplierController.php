<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\SupplierCreateRequest;
use App\Http\Requests\Contact\SupplierUpdateRequest;
use App\Models\Contact\Supplier;

class SupplierController extends Controller
{
    // index page
    public function index()
    {
        $suppliers = Supplier::all();
        return view('supplier.index', compact('suppliers'));
    }
    // create new supplier
    public function store(SupplierCreateRequest $request)
    {
        $validated = $request->validated();
        Supplier::create($validated);
        return redirect()->back()->with('success', 'Supplier added successfully!');
    }
    // show single supplier info, purchases
    public function show(Supplier $supplier)
    {
        $supplier->load('purchases');
        return view('supplier.show', compact('supplier'));
    }
    // edit page
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }
    // update supplier
    public function update(Supplier $supplier, SupplierUpdateRequest $request)
    {
        $validated = $request->validated();
        $supplier->update($validated);
        return redirect()->route('supplier.index')->with('success', 'Supplier updated successfully!');
    }
    // delete supplier
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully!');
    }
}

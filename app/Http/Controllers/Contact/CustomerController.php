<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\CustomerCreateRequest;
use App\Http\Requests\Contact\CustomerUpdateRequest;
use App\Models\Contact\Customer;

class CustomerController extends Controller
{
    //index page with create form
    public function index()
    {
        $customers = Customer::all();
        return view('customer.index', compact('customers'));
    }
    //create new customer
    public function store(CustomerCreateRequest $request)
    {
        Customer::create($request->validated());
        return redirect()->back()->with('success', 'Customer added successfully!');
    }
    //show page with sales data
    public function show(Customer $customer)
    {
        $customer->load('sales');
        return view('customer.show', compact('customer'));
    }
    //edit page
    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }
    //update customer
    public function update(Customer $customer, CustomerUpdateRequest $request)
    {
        $validated = $request->validated();
        $customer->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'city' => $validated['city'],
            'address' => $validated['address'],
        ]);
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
    }
    //delete customer
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully!');
    }
}

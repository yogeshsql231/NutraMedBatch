<?php

namespace App\Http\Controllers;

use App\Imports\CustomersImport;
use App\Models\Customer;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $customers = Customer::all();
            return view('customers.indexCustomer', compact('customers'));
        } catch (\Exception $e) {
            Log::error('View  customers', [
                'error_message' => $e->getMessage(),
            ]);
            return redirect()->back()->with('error', 'An error occurred. Please check your inputs and try again.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('customers.newCustomerForm');
        } catch (\Exception $e) {
            Log::error('create customers', [
                'error_message' => $e->getMessage(),
            ]);
            return redirect()->back()->with('error', 'An error occurred. Please check your inputs and try again.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'customer_id' => 'required|unique:customers,customer_id',
            'customer_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|unique:customers,email',
            'address_street' => 'required|string|max:255',
            'address_street_2' => 'nullable|string|max:255',
            'town' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zipcode' => 'required|string|max:10',
            'shipping_street' => 'required|string|max:255',
            'shipping_street_2' => 'nullable|string|max:255',
            'shipping_town' => 'required|string|max:255',
            'shipping_state' => 'required|string|max:255',
            'shipping_zipcode' => 'required|string|max:10',
        ]);

        try {
            $customer = Customer::create($validatedData);
            return redirect()->route('customer.index')->with('success', 'Customer created successfully.');
        } catch (\Exception $e) {
            Log::error('Register new customer', [
                'error_message' => $e->getMessage(),
            ]);
            return redirect()->back()->with('error', 'An error occurred. Please check your inputs and try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        try {

            return view('customers.newCustomerForm', compact('customer'));
        } catch (\Exception $e) {
            Log::error('open edit customer', ['error_message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred. Please check your inputs and try again.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'customer_id' => 'required',
            'customer_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'address_street' => 'required|string|max:255',
            'address_street_2' => 'nullable|string|max:255',
            'town' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zipcode' => 'required|string|max:10',
            'shipping_street' => 'required|string|max:255',
            'shipping_street_2' => 'nullable|string|max:255',
            'shipping_town' => 'required|string|max:255',
            'shipping_state' => 'required|string|max:255',
            'shipping_zipcode' => 'required|string|max:10',
        ]);

        try {
            $customer->update($validated);
            return redirect()->route('customer.index')->with('success', "{$request->customer_name}'s details updated successfully.");
        } catch (\Exception $e) {
            Log::error('Update customer', ['error_message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred. Please check your inputs and try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
            return redirect()->route('customer.index')->with('success', "{$customer->customer_name}'s deleted successfully.");
        } catch (\Exception $e) {
            Log::error('Delete customer', ['error_message' => $e->getMessage()]);

            return redirect()->back()->with('error', 'An error occurred. Please check your inputs and try again.');
        }
    }

    // view upload form
    public function uploadCustomerExcelForm(Request $request)
    {
        try {
            return view('customers.uploadCustomerExcel');
        } catch (\Exception $e) {
            Log::error('Upload customer from excel', ['error_message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred. Please check your inputs and try again.');
        }
    }

    //upload customer form excel to db
    public function uploadCustomerExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls',
        ]);

        try {
            Excel::import(new CustomersImport, $request->file('file'));
            return redirect()->back()->with('success', 'Customers imported successfully!');
        } catch (\Exception $e) {
            Log::error('File import error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred during the import. Please try again.');
        }
    }



    //fetch the customer record when select cutserid

    public function getCustomerById($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            return response()->json($customer);
        } else {
            return response()->json(['error' => 'Customer not found'], 404);
        }
    }
}

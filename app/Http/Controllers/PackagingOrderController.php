<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DuplicatePackagingOrder;
use App\Models\PackagingOrder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PackagingOrderImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use OwenIt\Auditing\Models\Audit;

class PackagingOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    //  master batch record view
    public function index()
    {
        try {
            $OderRecords = PackagingOrder::with('customers')->orderBy('created_at', 'desc')->get();
            return view('packagingOrders.viewPackagingOrder', compact('OderRecords'));
        } catch (\Exception $e) {
            Log::error('Error fetching Packaging Orders:', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'An error occurred. Please check your inputs and try again.' . $e->getMessage());
        }
    }


    // Duplicate Packaging Order view

    public function viewDuplicatePackagingOrder(Request $request)
    {
        try {
            $duplicateOrderRecords = DuplicatePackagingOrder::with('customers')->orderBy('created_at', 'desc')->get();
            return view('packagingOrders.viewDuplicatePackagingOrder', compact('duplicateOrderRecords'));
        } catch (\Exception $e) {
            Log::error('Error fetching Duplicate Packaging Orders:', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'An error occurred. Please check your inputs and try again.' . $e->getMessage());
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $customers = Customer::select('id', 'customer_id', 'customer_name')->get();
            return view('packagingOrders.newOrderForm', compact('customers'));
        } catch (\Exception $e) {
            Log::error('Error open form Packaging Orders:', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'An error occurred. Please check your inputs and try again.' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validated = $request->validate(
            [
                // 'orderId' => 'nullable|numeric|unique:packaging_orders,orderId',
                'date' => 'nullable|date',
                'customerId' => 'required|numeric',
                'productName' => 'nullable|string|max:255',
                'genericName' => 'nullable|string|max:255',
                'po' => 'nullable|string',
                'fProduct' => 'nullable|string|max:255',
                'formula' => 'nullable|string|max:255',
                'wo' => 'nullable|string',
                'lot' => 'nullable|string|max:50',
                'Exp' => [
                    'nullable',
                    'string',
                    'regex:/^(0?[1-9]|1[012])\/\d{4}$|^(0?[1-9]|[12][0-9]|3[01])\/(0?[1-9]|1[012])\/\d{4}$/'
                ],
                'orderQty' => 'nullable|numeric|min:0',
                'poQty' => 'nullable|numeric|min:0',
                'dosageForm' => 'nullable|string|max:255',
                'ofDosesUnit' => 'nullable|string|max:50',
                'bluckProdLot' => 'nullable|string|max:50',
                'prodSuplyBy' => 'nullable|string|max:255',
                'ndcUpc' => 'nullable|string|max:50',
                'unitDescription' => 'nullable|string|max:255',
                'customerInfo' => 'nullable|string',

                'compName'   => 'nullable|array',
                'compName.*' => 'nullable|string|max:255',
                'compDesc'   => 'nullable|array',
                'compDesc.*' => 'nullable|string|max:255',
                'compCode'   => 'nullable|array',
                'compCode.*' => 'nullable|string|max:50',


                'packInstruction' => 'nullable|string',
                'toolingNumber' => 'nullable|string|max:50',
                'toolingDrawing' => 'nullable|string',
                'testToolingSpecfication' => 'nullable|string',
                'pkgSize' => 'nullable|string|max:50',
                'matWidth' => 'nullable|numeric|min:0',
                'foilYield' => 'nullable|numeric|min:0',
                'foilcode' => 'nullable|string|max:50',
                'PvcYield' => 'nullable|numeric|min:0',
                'PbvCode' => 'nullable|string|max:50',
                'visualInspection' => 'nullable|string',
                'testOne' => 'nullable|string',
                'testTwo' => 'nullable|string',
                'testThree' => 'nullable|string',
                'testFour' => 'nullable|string',
                'testFive' => 'nullable|string',
                'processParameter' => 'nullable|string',
                'peopleAssigment' => 'nullable|string',
                'inspectionInst' => 'nullable|string',
                'document' => 'nullable|',
                'masterOrd' => 'nullable|string|max:50',
                'newOrderCreatedBy' => 'nullable|string|max:255',

                'indexSetting' => 'array|nullable',
                'indexSetting.*' => 'string|nullable',

            ],
            [

                'Exp.regex' => 'The Exp field must be in MM/YYYY or DD/MM/YYYY format.',
            ]
        );


        try {


            $lastOrder = PackagingOrder::orderBy('orderId', 'desc')->first();
            $nextOrderId = $lastOrder ? $lastOrder->orderId + 1 : 1000;


            $packagingOrder = new PackagingOrder();

            $packagingOrder->orderId = $nextOrderId;
            $packagingOrder->orderDate     = $validated['date'];
            $packagingOrder->customerId = $validated['customerId'];


            $packagingOrder->productName = $validated['productName'];
            $packagingOrder->genericName = $validated['genericName'];
            $packagingOrder->po = $validated['po'];
            $packagingOrder->fProduct = $validated['fProduct'];
            $packagingOrder->formula = $validated['formula'];
            $packagingOrder->wo = $validated['wo'];
            $packagingOrder->lot = $validated['lot'];

            $packagingOrder->Exp = $validated['Exp'];

            $packagingOrder->orderQty = $validated['orderQty'];
            $packagingOrder->poQty = $validated['poQty'];

            $packagingOrder->dosageForm = $validated['dosageForm'];
            $packagingOrder->ofDosesUnit = $validated['ofDosesUnit'];
            $packagingOrder->bluckProdLot = $validated['bluckProdLot'];
            $packagingOrder->prodSuplyBy = $validated['prodSuplyBy'];


            $packagingOrder->ndcUpc = $validated['ndcUpc'];
            $packagingOrder->unitDescription = $validated['unitDescription'];
            $packagingOrder->customerInfo = $validated['customerInfo'];


            $packagingOrder->compName = json_encode($validated['compName']);
            $packagingOrder->compDesc = json_encode($validated['compDesc']);
            $packagingOrder->compCode = json_encode($validated['compCode']);


            $packagingOrder->packInstruction = $validated['packInstruction'];
            $packagingOrder->toolingNumber = $validated['toolingNumber'];

            $packagingOrder->toolingDrawing = $validated['toolingDrawing'];
            $packagingOrder->testToolingSpecfication = $validated['testToolingSpecfication'];

            $packagingOrder->pkgSize = $validated['pkgSize'];
            $packagingOrder->matWidth = $validated['matWidth'];
            $packagingOrder->foilYield = $validated['foilYield'];
            $packagingOrder->foilcode = $validated['foilcode'];


            $packagingOrder->PvcYield = $validated['PvcYield'];

            $packagingOrder->PbvCode = $validated['PbvCode'];

            $packagingOrder->visualInspection = $validated['visualInspection'];
            $packagingOrder->testOne = $validated['testOne'];
            $packagingOrder->testTwo = $validated['testTwo'];
            $packagingOrder->testThree = $validated['testThree'];
            $packagingOrder->testFour = $validated['testFour'];
            $packagingOrder->testFive = $validated['testFive'];

            $packagingOrder->processParameter = $validated['processParameter'];

            $packagingOrder->peopleAssigment = $validated['peopleAssigment'];

            $packagingOrder->inspectionInst = $validated['inspectionInst'];
            $packagingOrder->document = $validated['document'];
            $packagingOrder->masterOrd = $validated['masterOrd'];
            $packagingOrder->newOrderCreatedBy = $validated['newOrderCreatedBy'];


            $packagingOrder->indexSetting = json_encode($validated['indexSetting']);

            $packagingOrder->save();
            return redirect()->route('viewPackaginingOrders')->with('success', "Order ID {$packagingOrder->orderId} has been saved successfully.");
        } catch (\Exception $e) {
            Log::error('Error Store Packaging Orders:', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'An error occurred. Please check your inputs and try again.' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PackagingOrder $packagingOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PackagingOrder $packagingOrder, Request $request)
    {
        try {

            if (!$request->user()->can('PackagingOrder-update')) {
                return redirect()->back()->with('error', 'You do not have permission to access this form.');
            }

            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();
            $customers = Customer::all();
            $editData = PackagingOrder::with('customers')->findOrFail($request->orderId);

            return view('packagingOrders.searchPackagingOrder', compact('orders', 'editData', 'customers'));
        } catch (\Exception $e) {
            Log::error('Error Edit form open of Packaging Orders:', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'stack_trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'An error occurred. Please check your inputs and try again.' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, PackagingOrder $packagingOrder)
    {

        $validated = $request->validate([
            'orderId' => 'required|numeric',
            'date' => 'nullable|date',
            'customerId' => 'required|numeric',
            'productName' => 'nullable|string|max:255',
            'genericName' => 'nullable|string|max:255',
            'po' =>  'nullable|string',
            'fProduct' => 'nullable|string|max:255',
            'formula' => 'nullable|string|max:255',
            'wo' => 'nullable|string',
            'lot' => 'nullable|string|max:50',
            'Exp' => [
                'nullable',
                'string',
                'regex:/^(0?[1-9]|1[012])\/\d{4}$|^(0?[1-9]|[12][0-9]|3[01])\/(0?[1-9]|1[012])\/\d{4}$/'
            ],
            'orderQty' => 'nullable|string',
            'poQty' => 'nullable|numeric|min:0',
            'dosageForm' => 'nullable|string|max:255',
            'ofDosesUnit' => 'nullable|string|max:50',
            'bluckProdLot' => 'nullable|string|max:50',
            'prodSuplyBy' => 'nullable|string|max:255',
            'ndcUpc' => 'nullable|string|max:50',
            'unitDescription' => 'nullable|string|max:255',
            'customerInfo' => 'nullable|string',

            'compName'   => 'nullable|array',
            'compName.*' => 'nullable|string|max:255',
            'compDesc'   => 'nullable|array',
            'compDesc.*' => 'nullable|string|max:255',
            'compCode'   => 'nullable|array',
            'compCode.*' => 'nullable|string|max:50',

            'packInstruction' => 'nullable|string',
            'toolingNumber' => 'nullable|string|max:50',
            'toolingDrawing' => 'nullable|string',
            'testToolingSpecfication' => 'nullable|string',
            'pkgSize' => 'nullable|string|max:50',
            'matWidth' => 'nullable|numeric|min:0',
            'foilYield' => 'nullable|numeric|min:0',
            'foilcode' => 'nullable|string|max:50',
            'PvcYield' => 'nullable|numeric|min:0',
            'PbvCode' => 'nullable|string|max:50',
            'visualInspection' => 'nullable|string',
            'testOne' => 'nullable|string',
            'testTwo' => 'nullable|string',
            'testThree' => 'nullable|string',
            'testFour' => 'nullable|string',
            'testFive' => 'nullable|string',
            'processParameter' => 'nullable|string',
            'peopleAssigment' => 'nullable|string',
            'inspectionInst' => 'nullable|string',
            'document' => 'nullable|string',
            'masterOrd' => 'nullable|string|max:50',
            'newOrderCreatedBy' => 'nullable|string|max:255',

            'indexSetting' => 'array|nullable',
            'indexSetting.*' => 'string|nullable',
        ]);

        try {
            $packagingOrder->orderId = $validated['orderId'];
            $packagingOrder->orderDate = $validated['date'];
            $packagingOrder->customerId = $validated['customerId'];

            $packagingOrder->productName = $validated['productName'];
            $packagingOrder->genericName = $validated['genericName'];
            $packagingOrder->po = $validated['po'];
            $packagingOrder->fProduct = $validated['fProduct'];
            $packagingOrder->formula = $validated['formula'];
            $packagingOrder->wo = $validated['wo'];
            $packagingOrder->lot = $validated['lot'];
            $packagingOrder->Exp = $validated['Exp'];
            $packagingOrder->orderQty = $validated['orderQty'];
            $packagingOrder->poQty = $validated['poQty'];
            $packagingOrder->dosageForm = $validated['dosageForm'];
            $packagingOrder->ofDosesUnit = $validated['ofDosesUnit'];
            $packagingOrder->bluckProdLot = $validated['bluckProdLot'];
            $packagingOrder->prodSuplyBy = $validated['prodSuplyBy'];
            $packagingOrder->ndcUpc = $validated['ndcUpc'];
            $packagingOrder->unitDescription = $validated['unitDescription'];
            $packagingOrder->customerInfo = $validated['customerInfo'];


            $packagingOrder->compName = json_encode($validated['compName']);
            $packagingOrder->compDesc = json_encode($validated['compDesc']);
            $packagingOrder->compCode = json_encode($validated['compCode']);

            $packagingOrder->packInstruction = $validated['packInstruction'];
            $packagingOrder->toolingNumber = $validated['toolingNumber'];
            $packagingOrder->toolingDrawing = $validated['toolingDrawing'];
            $packagingOrder->testToolingSpecfication = $validated['testToolingSpecfication'];
            $packagingOrder->pkgSize = $validated['pkgSize'];
            $packagingOrder->matWidth = $validated['matWidth'];
            $packagingOrder->foilYield = $validated['foilYield'];
            $packagingOrder->foilcode = $validated['foilcode'];
            $packagingOrder->PvcYield = $validated['PvcYield'];
            $packagingOrder->PbvCode = $validated['PbvCode'];
            $packagingOrder->visualInspection = $validated['visualInspection'];
            $packagingOrder->testOne = $validated['testOne'];
            $packagingOrder->testTwo = $validated['testTwo'];
            $packagingOrder->testThree = $validated['testThree'];
            $packagingOrder->testFour = $validated['testFour'];
            $packagingOrder->testFive = $validated['testFive'];
            $packagingOrder->processParameter = $validated['processParameter'];
            $packagingOrder->peopleAssigment = $validated['peopleAssigment'];
            $packagingOrder->inspectionInst = $validated['inspectionInst'];
            $packagingOrder->document = $validated['document'];
            $packagingOrder->masterOrd = $validated['masterOrd'];
            $packagingOrder->newOrderCreatedBy = $validated['newOrderCreatedBy'];

            $packagingOrder->indexSetting = json_encode($validated['indexSetting']);

            $packagingOrder->save();

            return redirect()->back()->with('success', 'Order has updated successfully.');
        } catch (\Exception $e) {

            Log::error('Error Update Packaging Orders:', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'stack_trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'An error occurred. Please check your inputs and try again: ' . $e->getMessage());
        }
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackagingOrder $packagingOrder)
    {
        //
    }



    // upload form
    public function uploadOrderRecordForm(Request $request)
    {
        try {
            return view('packagingOrders.uploadOrderRecordForm');
        } catch (\Exception $e) {
            Log::error('Error Upload form of Packaging Orders:', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'An error occurred. Please check your inputs and try again.' . $e->getMessage());
        }
    }


    // upload order from excel to db
    public function uploadOrderRecord(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:csv'
        ]);


        try {
            Excel::import(new PackagingOrderImport, $request->file('file'));
            return redirect()->route('viewPackaginingOrders')->with('success', 'Packaging Orders Imported Successfully!');
        } catch (\Exception $e) {
            Log::error('Error Upload to CSV of Packaging Orders:', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'An error occurred. Please check your inputs and try again.' . $e->getMessage());
        }
    }


    // search packaging order
    public function searchPackagingOrder(Request $request)
    {

        try {
            if (!$request->user()->can('PackagingOrder-update')) {
                return redirect()->back()->with('error', 'You do not have permission to access this form.');
            }
            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();

            $editData = "";

            return view('packagingOrders.searchPackagingOrder', compact('orders', 'editData'));
        } catch (\Exception $e) {
            Log::error('Error Search Packaging Orders:', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'An error occurred. Please check your inputs and try again.' . $e->getMessage());
        }
    }

    // open print order page
    public function printOrder(Request $request)
    {
        try {
            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();
            $DuplicatePackagingorders = DuplicatePackagingOrder::select('id', 'orderId', 'productName')->get();

            $printOrder = '';

            return view('packagingOrders.printOrder', compact('orders', 'printOrder', 'DuplicatePackagingorders'));
        } catch (\Exception $e) {
            Log::error('Error Print Packaging Orders:', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }

    //search order for print by order id
    public function searchPrintOrder(Request $request)
    {
        try {

            $tableName = $request->tableName;
            if ($tableName == 'Customer Order') {
                $printOrder = PackagingOrder::with('customers')->findOrFail($request->orderId);
            } elseif ($tableName == 'Production Order') {
                $printOrder = DuplicatePackagingOrder::with('customers')->findOrFail($request->orderId);
            }

            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();
            $DuplicatePackagingorders = DuplicatePackagingOrder::select('id', 'orderId', 'productName')->get();

            $rev = Audit::where('auditable_type', 'App\Models\PackagingOrder')
                ->where('auditable_id', $request->orderId)
                ->where('event', 'updated')
                ->count();

            return view('packagingOrders.printOrder', compact('printOrder', 'orders', 'rev', 'DuplicatePackagingorders'));
        } catch (\Exception $e) {
            Log::error('Search order Print' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }
}

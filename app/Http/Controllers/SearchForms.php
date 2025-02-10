<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DuplicatePackagingOrder;
use App\Models\PackagingOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OwenIt\Auditing\Models\Audit;
use App\Traits\SearchFormByOrderId;
use Illuminate\Auth\Access\AuthorizationException;
use PhpParser\Node\Stmt\ElseIf_;

class SearchForms extends Controller
{

    use SearchFormByOrderId;

    public function inspection235(Request $request)
    {
        try {
            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();
            $duplicatePackagigOrder = DuplicatePackagingOrder::select('id', 'orderId', 'productName')->get();

            return view('seachForms.inspections2-3-5', compact('orders', 'duplicatePackagigOrder'));
        } catch (\Exception $e) {
            Log::error('inspection235 Form' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }


    // using ajax
    public function fetchPackagingOrderDetails(Request $request)
    {
        $orderId = $request->input('orderId');
        $orderDetails = PackagingOrder::with('customers')->find($orderId);

        $rev = Audit::where('auditable_type', 'App\Models\PackagingOrder')
            ->where('auditable_id', $orderId)
            ->where('event', 'updated')
            ->count();

        if ($orderDetails) {
            return response()->json([
                'success' => true,
                'data' => $orderDetails,
                'rev' => $rev,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Order not found'
        ]);
    }

    // fetchDuplicatePackagingOrderDetails using ajax
    public function fetchDuplicatePackagingOrderDetails(Request $request)
    {
        $orderId = $request->input('orderId');
        $orderDetails = DuplicatePackagingOrder::with('customers')->find($orderId);

        $rev = Audit::where('auditable_type', 'App\Models\PackagingOrder')
            ->where('auditable_id', $orderId)
            ->where('event', 'updated')
            ->count();

        if ($orderDetails) {
            return response()->json([
                'success' => true,
                'data' => $orderDetails,
                'rev' => $rev,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Order not found'
        ]);
    }


    public function materialTransfer4(Request $request)
    {
        try {
            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();
            $DuplicatePackagingorders = DuplicatePackagingOrder::select('id', 'orderId', 'productName')->get();

            $orderDetails = '';
            return view('seachForms.materialTransfer4', compact('orders', 'orderDetails', 'DuplicatePackagingorders'));
        } catch (\Exception $e) {
            Log::error('Material Transfer 4 Form' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }

    //select order id and fetch data for dynamic print

    public function materialTranfer4Print(Request $request)
    {
        try {
            $orderId = $request->input('orderId');
            $tbName = $request->input('tbName');

            if ($tbName == 'Customer Order') {
                $orderDetails = PackagingOrder::with('customers')->find($orderId);
            } elseif ($tbName == 'Production Order') {
                $orderDetails = DuplicatePackagingOrder::with('customers')->find($orderId);
            }

            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();
            $DuplicatePackagingorders = DuplicatePackagingOrder::select('id', 'orderId', 'productName')->get();

            $rev = Audit::where('auditable_type', 'App\Models\PackagingOrder')
                ->where('auditable_id', $orderId)
                ->where('event', 'updated')
                ->count();

            return view('seachForms.materialTransfer4', compact('orderDetails', 'orders', 'rev', 'DuplicatePackagingorders'));
        } catch (\Exception $e) {
            Log::error('Material transfer 4 page fetch record based on order id' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }


    public function materialTransfer4_1(Request $request)
    {
        try {
            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();
            $duplicatePackagigOrder = DuplicatePackagingOrder::select('id', 'orderId', 'productName')->get();
            return view('seachForms.materialTransfer4_1', compact('orders', 'duplicatePackagigOrder'));
        } catch (\Exception $e) {
            Log::error('Material Transfer 4 Form' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }


    public function inspection6_8_10(Request $request)
    {
        try {
            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();
            $duplicatePackagingOrder = DuplicatePackagingOrder::select('id', 'orderId', 'productName')->get();

            $orderDetails = '';
            return view('seachForms.inspection6_8_10', compact('orders', 'orderDetails', 'duplicatePackagingOrder'));
        } catch (\Exception $e) {
            Log::error('inspection_6_8_10 Form' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }

    public function inspection_6_8_10_Print(Request $request)
    {
        try {
            $orderId = $request->input('orderId');
            $tbName = $request->input('tbName');

            if ($tbName == 'Customer Order') {
                $orderDetails = PackagingOrder::with('customers')->find($orderId);
            } elseif ($tbName == 'Production Order') {
                $orderDetails = DuplicatePackagingOrder::with('customers')->find($orderId);
            }

            // $orderDetails = PackagingOrder::with('customers', 'audits')->find($orderId);

            $rev = Audit::where('auditable_type', 'App\Models\PackagingOrder')
                ->where('auditable_id', $orderId)
                ->where('event', 'updated')
                ->count();

            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();
            $duplicatePackagingOrder = DuplicatePackagingOrder::select('id', 'orderId', 'productName')->get();

            return view('seachForms.inspection6_8_10', compact('orderDetails', 'orders', 'rev', 'duplicatePackagingOrder'));
        } catch (\Exception $e) {
            Log::error('inspection_6_8_10_Print Form' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }



    //inspection11_12
    public function inspection11_12(Request $request)
    {
        try {
            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();
            $duplicatePackagingOrder = DuplicatePackagingOrder::select('id', 'orderId', 'productName')->get();
            $orderDetails = '';
            return view('seachForms.inspection11_12', compact('orders', 'orderDetails', 'duplicatePackagingOrder'));
        } catch (\Exception $e) {
            Log::error('inspection_11_12_Print Form' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }

    //inspection11-12_Print
    public function inspection11_12_Print(Request $request)
    {
        try {
            $orderId = $request->input('orderId');
            $tbName = $request->input('tbName');

            if ($tbName == 'Customer Order') {
                $orderDetails = PackagingOrder::with('customers')->find($orderId);
            } elseif ($tbName == 'Production Order') {
                $orderDetails = DuplicatePackagingOrder::with('customers')->find($orderId);
            }


            // $orderDetails = PackagingOrder::with('customers', 'audits')->find($orderId);

            $rev = Audit::where('auditable_type', 'App\Models\PackagingOrder')
                ->where('auditable_id', $orderId)
                ->where('event', 'updated')
                ->count();
            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();
            $duplicatePackagingOrder = DuplicatePackagingOrder::select('id', 'orderId', 'productName')->get();

            return view('seachForms.inspection11_12', compact('orderDetails', 'orders', 'rev', 'duplicatePackagingOrder'));
        } catch (\Exception $e) {
            Log::error('inspection_11_12_Print Form' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }


    //inspection_scale_weight_printed
    public function inspection_scale_weight_printed(Request $request)
    {
        try {
            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();
            $orderDetails = '';
            $data = '';
            $duplicatePackagigOrder = DuplicatePackagingOrder::select('id', 'orderId', 'productName')->get();

            return view('seachForms.inspection_scale_weight_printed', compact('orders', 'orderDetails', 'data', 'duplicatePackagigOrder'));
        } catch (\Exception $e) {
            Log::error('inspection_scale_weight_printed Form' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }



    // inspection_7_13
    public function inspection_7_13(Request $request)
    {
        try {
            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();
            $duplicatePackagingOrder = DuplicatePackagingOrder::select('id', 'orderId', 'productName')->get();
            $data = [];
            return view('seachForms.inspection_7_13', compact('orders',  'data', 'duplicatePackagingOrder'));
        } catch (\Exception $e) {
            Log::error('inspection_7_13 Form' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }

    // inspection_7_13_ print
    public function inspection_7_13_print(Request $request)
    {
        try {
            $orderId = $request->input('orderId');
            $tbName = $request->input('tbName');

            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();

            $data = $this->searchFormByOrderId($orderId, $tbName);


            $duplicatePackagingOrder = DuplicatePackagingOrder::select('id', 'orderId', 'productName')->get();

            return view('seachForms.inspection_7_13', compact('orders', 'data', 'duplicatePackagingOrder'));
        } catch (\Exception $e) {
            Log::error('inspection_7_13 Form' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }


    // A-Inspection- RE-inspection/Random sampling
    public function a_Inspection(Request $request)
    {
        try {
            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();
            $duplicatePackagigOrder = DuplicatePackagingOrder::select('id', 'orderId', 'productName')->get();

            return view('seachForms.a_Inspection', compact('orders', 'duplicatePackagigOrder'));
        } catch (\Exception $e) {
            Log::error(' A-Inspection- RE-inspection/Random sampling' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }


    public function b_material_warehouse(Request $request)
    {
        try {
            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();
            $data = [];
            $duplicatePackagingOrder = DuplicatePackagingOrder::select('id', 'orderId', 'productName')->get();
            return view('seachForms.b_material_warehouse', compact('orders', 'data', 'duplicatePackagingOrder'));
        } catch (\Exception $e) {
            Log::error('b_material_warehouse' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }

    public function b_material_warehouse_print(Request $request)
    {
        try {
            $orderId = $request->input('orderId');
            $tbName = $request->input('tbName');

            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();
            $data = $this->searchFormByOrderId($orderId, $tbName);

            $duplicatePackagingOrder = DuplicatePackagingOrder::select('id', 'orderId', 'productName')->get();

            return view('seachForms.b_material_warehouse', compact('orders', 'data', 'duplicatePackagingOrder'));
        } catch (\Exception $e) {
            Log::error('b_material_warehouse_print Form' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }


    //vision Setup Challenge
    public function visionSetupChallenge(Request $request)
    {
        try {
            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();
            $data = [];
            $duplicatePackagigOrder = DuplicatePackagingOrder::select('id', 'orderId', 'productName')->get();
            return view('seachForms.visionSetupChallenge', compact('orders', 'data', 'duplicatePackagigOrder'));
        } catch (\Exception $e) {
            Log::error('vision Setup Challenge' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }

    // warehouse Material
    public function warehouseMaterial(Request $request)
    {
        try {

            if (!$request->user()->can('Search-warehouse_Material')) {
                return redirect()->back()->with('error', 'You do not have permission to access this form.');
            }

            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();
            $data = [];
            $duplicatePackagigOrder = DuplicatePackagingOrder::select('id', 'orderId', 'productName')->get();
            return view('seachForms.warehouseMaterial', compact('orders', 'data', 'duplicatePackagigOrder'));
        } catch (AuthorizationException $e) {
            return redirect()->back()->with('error', 'You do not have permission to access this form.');
        } catch (\Exception $e) {
            Log::error('warehouse Material' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }


    // product Specification
    public function productSpecification(Request $request)
    {
        try {
            if (!$request->user()->can('Search-product_Specification')) {
                return redirect()->back()->with('error', 'You do not have permission to access this form.');
            }
            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();
            $data = [];
            $duplicatePackagigOrder = DuplicatePackagingOrder::select('id', 'orderId', 'productName')->get();
            return view('seachForms.productSpecification', compact('orders', 'data', 'duplicatePackagigOrder'));
        } catch (AuthorizationException $e) {
            return redirect()->back()->with('error', 'You do not have permission to access this form.');
        } catch (\Exception $e) {
            Log::error('product Specification' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }



    //Edit the duplicate orders
    public function searchDuplicatePackagingOrder(Request $request)
    {
        try {
            if (!$request->user()->can('DuplicatePackagingOrder-update')) {
                return redirect()->back()->with('error', 'You do not have permission to access this form.');
            }
            $orders = DuplicatePackagingOrder::select('id', 'orderId', 'productName')->get();
            $customers = Customer::all();

            $editData = "";
            return view('seachForms.searchDuplicatePackagingOrder', compact('orders', 'editData', 'customers'));
        } catch (\Exception $e) {
            Log::error('Search DUplicate Packaging order' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred. Please check your inputs and try again.' . $e->getMessage());
        }
    }

    //Edit duplicate order

    public function EditDuplicatePackagingOrder(Request $request)
    {
        try {
            if (!$request->user()->can('DuplicatePackagingOrder-update')) {
                return redirect()->back()->with('error', 'You do not have permission to access this form.');
            }

            $orders = DuplicatePackagingOrder::select('id', 'orderId', 'productName')->get();
            $customers = Customer::all();
            $editData = DuplicatePackagingOrder::find($request->orderId);
            return view('seachForms.searchDuplicatePackagingOrder', compact('orders', 'editData', 'customers'));
        } catch (\Exception $e) {
            Log::error('Edit duplicate packaging order' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred. Please check your inputs and try again.' . $e->getMessage());
        }
    }

    //update updateDuplicatePackagingOrder

    public function updateDuplicatePackagingOrder(Request $request, $updateDuplicatePackagingOrder)
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
            'wo' => 'nullable|numeric',
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

            $DuplicatePackagingOrder = DuplicatePackagingOrder::find($updateDuplicatePackagingOrder);

            $DuplicatePackagingOrder->orderId = $validated['orderId'];
            $DuplicatePackagingOrder->orderDate = $validated['date'];
            $DuplicatePackagingOrder->customerId = $validated['customerId'];

            $DuplicatePackagingOrder->productName = $validated['productName'];
            $DuplicatePackagingOrder->genericName = $validated['genericName'];
            $DuplicatePackagingOrder->po = $validated['po'];
            $DuplicatePackagingOrder->fProduct = $validated['fProduct'];
            $DuplicatePackagingOrder->formula = $validated['formula'];
            $DuplicatePackagingOrder->wo = $validated['wo'];
            $DuplicatePackagingOrder->lot = $validated['lot'];
            $DuplicatePackagingOrder->Exp = $validated['Exp'];
            $DuplicatePackagingOrder->orderQty = $validated['orderQty'];
            $DuplicatePackagingOrder->poQty = $validated['poQty'];
            $DuplicatePackagingOrder->dosageForm = $validated['dosageForm'];
            $DuplicatePackagingOrder->ofDosesUnit = $validated['ofDosesUnit'];
            $DuplicatePackagingOrder->bluckProdLot = $validated['bluckProdLot'];
            $DuplicatePackagingOrder->prodSuplyBy = $validated['prodSuplyBy'];
            $DuplicatePackagingOrder->ndcUpc = $validated['ndcUpc'];
            $DuplicatePackagingOrder->unitDescription = $validated['unitDescription'];
            $DuplicatePackagingOrder->customerInfo = $validated['customerInfo'];


            $DuplicatePackagingOrder->compName = json_encode($validated['compName']);
            $DuplicatePackagingOrder->compDesc = json_encode($validated['compDesc']);
            $DuplicatePackagingOrder->compCode = json_encode($validated['compCode']);

            $DuplicatePackagingOrder->packInstruction = $validated['packInstruction'];
            $DuplicatePackagingOrder->toolingNumber = $validated['toolingNumber'];
            $DuplicatePackagingOrder->toolingDrawing = $validated['toolingDrawing'];
            $DuplicatePackagingOrder->testToolingSpecfication = $validated['testToolingSpecfication'];
            $DuplicatePackagingOrder->pkgSize = $validated['pkgSize'];
            $DuplicatePackagingOrder->matWidth = $validated['matWidth'];
            $DuplicatePackagingOrder->foilYield = $validated['foilYield'];
            $DuplicatePackagingOrder->foilcode = $validated['foilcode'];
            $DuplicatePackagingOrder->PvcYield = $validated['PvcYield'];
            $DuplicatePackagingOrder->PbvCode = $validated['PbvCode'];
            $DuplicatePackagingOrder->visualInspection = $validated['visualInspection'];
            $DuplicatePackagingOrder->testOne = $validated['testOne'];
            $DuplicatePackagingOrder->testTwo = $validated['testTwo'];
            $DuplicatePackagingOrder->testThree = $validated['testThree'];
            $DuplicatePackagingOrder->testFour = $validated['testFour'];
            $DuplicatePackagingOrder->testFive = $validated['testFive'];
            $DuplicatePackagingOrder->processParameter = $validated['processParameter'];
            $DuplicatePackagingOrder->peopleAssigment = $validated['peopleAssigment'];
            $DuplicatePackagingOrder->inspectionInst = $validated['inspectionInst'];
            $DuplicatePackagingOrder->document = $validated['document'];
            $DuplicatePackagingOrder->masterOrd = $validated['masterOrd'];
            $DuplicatePackagingOrder->newOrderCreatedBy = $validated['newOrderCreatedBy'];

            $DuplicatePackagingOrder->indexSetting = json_encode($validated['indexSetting']);

            $DuplicatePackagingOrder->save();

            return redirect()->back()->with('success', 'Order has updated successfully.');
        } catch (\Exception $e) {
            Log::error('Update Packaging order' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred. Please check your inputs and try again: ' . $e->getMessage());
        }
    }




    //  Print all forms on single click
    public function printAllForms(Request $request)
    {
        try {
            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();
            $duplicatePackagingOrder = DuplicatePackagingOrder::select('id', 'orderId', 'productName')->get();
            $data = '';
            return view('seachForms.printAllForms', compact('orders', 'duplicatePackagingOrder', 'data'));
        } catch (\Exception $e) {
            Log::error('Print All Forms' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred. Please check your inputs and try again: ' . $e->getMessage());
        }
    }

    // Print  All Forms Fetch
    public function PrintAllFormsFetch(Request $request)
    {
        try {

            $orderId = $request->input('orderId');
            $tbName = $request->input('tbName');



            $orders = PackagingOrder::select('id', 'orderId', 'productName')->get();
            $duplicatePackagingOrder = DuplicatePackagingOrder::select('id', 'orderId', 'productName')->get();

            $data = $this->searchFormByOrderId($orderId, $tbName);


            return view('seachForms.printAllForms', compact('orders', 'duplicatePackagingOrder', 'data'));
        } catch (\Exception $e) {
            Log::error('Print All Forms Fetch' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred. Please check your inputs and try again: ' . $e->getMessage());
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\DuplicatePackagingOrder;
use App\Models\PackagingOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OfrmCreateOrdersController extends Controller
{

    //open OfrmCreateOrders
    public function OfrmCreateOrders(Request $request)
    {
        if ($request->isMethod('get')) {
            try {
                $orderTemplate = PackagingOrder::select('id', 'orderId', 'customerId', 'productName', 'fProduct')
                    ->with(relations: 'customers:id,customer_name')->get();
                return view('OfrmCreateOrders.OfrmCreateOrders', compact('orderTemplate'));
            } catch (\Exception $e) {
                Log::error('OfrmCreateOrders' . $e->getMessage());
                return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
            }
        }
    }

    public function TemplateSubmit(Request $request)
    {
        if ($request->isMethod('get')) {

            $request->validate([
                'selectedOrder' => 'required',
            ], [
                'selectedOrder.required' => 'Please select an order template.',
            ]);

            try {
                $selectOrderData = PackagingOrder::select('id', 'orderId', 'customerId', 'productName', 'fProduct')
                    ->with('customers:id,customer_name')
                    ->find($request->selectedOrder);
                return view('OfrmCreateOrders.newOrderDataWithTemp', compact('selectOrderData'));
            } catch (\Exception $e) {
                Log::error('OfrmCreateOrders' . $e->getMessage());
                return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
            }
        }
    }



    public function saveNewTemplateRecord(Request $request)
    {
        $request->validate(
            [
                'lot' => 'required|string|max:50',
                'expDate' => [
                    'required',
                    'string',
                    'regex:/^(0?[1-9]|1[012])\/\d{4}$|^(0?[1-9]|[12][0-9]|3[01])\/(0?[1-9]|1[012])\/\d{4}$/'
                ],
                'bulkLot' => 'required|string|max:50',
                'poNumber' => 'required|numeric|digits_between:8,10',
                'woNumber' => 'required|numeric|digits:4',
                'quantity' => 'required|numeric|min:0',
                'blisterBottleQty' => 'required|numeric|min:1',
            ],
            [

                'Exp.regex' => 'The Exp field must be in MM/YYYY or DD/MM/YYYY format.',
            ]
        );

        try {

            $existingOrderData = PackagingOrder::findOrFail($request->exsitingOrderId);



            $lastOrder = DuplicatePackagingOrder::orderBy('orderId', 'desc')->first();
            $nextOrderId = $lastOrder ? $lastOrder->orderId + 1 : 10000;

            $DuplicatePackagingOrder = new DuplicatePackagingOrder();

            $DuplicatePackagingOrder->orderId = $nextOrderId;
            $DuplicatePackagingOrder->orderDate   = now()->toDateString();
            $DuplicatePackagingOrder->customerId = $existingOrderData->customerId;

            $DuplicatePackagingOrder->productName = $existingOrderData->productName;
            $DuplicatePackagingOrder->genericName = $existingOrderData->genericName;
            $DuplicatePackagingOrder->po = $request->poNumber; //
            $DuplicatePackagingOrder->fProduct = $existingOrderData->fProduct;
            $DuplicatePackagingOrder->formula = $existingOrderData->formula;
            $DuplicatePackagingOrder->wo = $request->woNumber; //
            $DuplicatePackagingOrder->lot = $request->lot; //

            $DuplicatePackagingOrder->Exp = $request->expDate; //

            $DuplicatePackagingOrder->orderQty = $request->quantity; //
            $DuplicatePackagingOrder->poQty = $request->blisterBottleQty; //

            $DuplicatePackagingOrder->dosageForm = $existingOrderData->dosageForm;
            $DuplicatePackagingOrder->ofDosesUnit = $existingOrderData->ofDosesUnit;
            $DuplicatePackagingOrder->bluckProdLot = $request->bulkLot; //
            $DuplicatePackagingOrder->prodSuplyBy = $existingOrderData->prodSuplyBy;


            $DuplicatePackagingOrder->ndcUpc = $existingOrderData->ndcUpc;
            $DuplicatePackagingOrder->unitDescription = $existingOrderData->unitDescription;
            $DuplicatePackagingOrder->customerInfo = $existingOrderData->customerInfo;


            $DuplicatePackagingOrder->compName = $existingOrderData->compName;
            $DuplicatePackagingOrder->compDesc = $existingOrderData->compDesc;
            $DuplicatePackagingOrder->compCode = $existingOrderData->compCode;


            $DuplicatePackagingOrder->packInstruction = $existingOrderData->packInstruction;
            $DuplicatePackagingOrder->toolingNumber = $existingOrderData->toolingNumber;

            $DuplicatePackagingOrder->toolingDrawing = $existingOrderData->toolingDrawing;
            $DuplicatePackagingOrder->testToolingSpecfication = $existingOrderData->testToolingSpecfication;

            $DuplicatePackagingOrder->pkgSize = $existingOrderData->pkgSize;
            $DuplicatePackagingOrder->matWidth = $existingOrderData->matWidth;
            $DuplicatePackagingOrder->foilYield = $existingOrderData->foilYield;
            $DuplicatePackagingOrder->foilcode = $existingOrderData->foilcode;


            $DuplicatePackagingOrder->PvcYield = $existingOrderData->PvcYield;

            $DuplicatePackagingOrder->PbvCode = $existingOrderData->PbvCode;

            $DuplicatePackagingOrder->visualInspection = $existingOrderData->visualInspection;
            $DuplicatePackagingOrder->testOne = $existingOrderData->testOne;
            $DuplicatePackagingOrder->testTwo = $existingOrderData->testTwo;
            $DuplicatePackagingOrder->testThree = $existingOrderData->testThree;
            $DuplicatePackagingOrder->testFour = $existingOrderData->testFour;
            $DuplicatePackagingOrder->testFive = $existingOrderData->testFive;

            $DuplicatePackagingOrder->processParameter = $existingOrderData->processParameter;

            $DuplicatePackagingOrder->peopleAssigment = $existingOrderData->peopleAssigment;

            $DuplicatePackagingOrder->inspectionInst = $existingOrderData->inspectionInst;
            $DuplicatePackagingOrder->document = $existingOrderData->document;
            $DuplicatePackagingOrder->masterOrd = $existingOrderData->masterOrd;
            $DuplicatePackagingOrder->newOrderCreatedBy = $existingOrderData->newOrderCreatedBy;
            $DuplicatePackagingOrder->indexSetting = $existingOrderData->indexSetting;

            $DuplicatePackagingOrder->save();


            return redirect()->back()->with('success', "Order '$DuplicatePackagingOrder->orderId' Genrated successfully");
        } catch (\Exception $e) {
            Log::error('Create New Duplicate order ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }
}

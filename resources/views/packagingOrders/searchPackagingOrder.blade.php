@extends('layouts.masterLayout')

@section('title','Search Order')

@section('content')


<div class="section-header">
    <h1>Search & Update Order</h1>
</div>

<div class="row mb-5">
    <div class="col col-4">
        <form id="orderForm" action="{{route('EditPackagingOrder')}}" method="get">
            <label for="orderSelect" class="fw-bold">Select an Order:</label>
            <select id="orderSelect" class="form-control" name="orderId" onchange="this.form.submit()">
                <option value="">Select an order</option>
                @foreach ($orders as $item)
                <option value="{{$item->id}}">{{$item->orderId .' - '. $item->productName}}</option>
                @endforeach

            </select>


        </form>
    </div>
</div>



{{-- Update form --}}
@if($editData)

<form action="{{ route('updatePackagingOrder',['packagingOrder'=>$editData->id]) }}" method="POST">
    @csrf
    <div class="row">
        <div class="col col-6">
            <div class="col-4 d-flex align-items-center">
                <label for="orderId" class="form-label me-2">Order_Id:</label>
                <input type="number" name="orderId" id="orderId" class="form-control"
                    value="{{ old('orderId', $editData->orderId) }}" readonly>
            </div>
            @error('orderId')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col col-6 d-flex justify-content-end">
            <div class="d-flex align-items-center">
                <label for="date" class="form-label me-2">Date:</label>
                <input type="date" class="form-control" name="date" id="date"
                    value="{{ old('date', \Carbon\Carbon::parse($editData->orderDate)->format('Y-m-d')) }}">
            </div>
            @error('date')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <hr class="mb-3 mt-2">

    <div class="container">

        <div class="row">

            <div class="col-12 col-md-4 d-flex align-items-center mb-2 mb-md-0">
                <label for="customerId" class="form-label me-1">Customer_Id:</label>
                <select class="form-control" id="customerIdSelect" name="customerId">
                    <option value="" disabled selected>Select a customer ID</option>
                    @foreach ($customers as $item)
                    <option value="{{ $item->id }}" {{ (old('customerId')==$item->id || $editData->customerId ==
                        $item->id) ? 'selected' : '' }}>
                        {{ $item->customer_id }} - {{ $item->customer_name }}
                    </option>
                    @endforeach
                </select>

                @error('customerId')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            {{-- <div class="col-4 d-flex align-items-center">
                <label for="customerId" class="form-label me-1">Customer_Id:</label>
                <input type="number" name="customerId" id="customerId" class="form-control"
                    value="{{ old('customerId' , $editData->customerId) }}">
                @error('customerId')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div> --}}

            <div class="col-8 d-flex align-items-center">
                <label for="customerName" class="form-label me-1">Customer_Name:</label>
                <input type="text" name="customerName" id="customerName" class="form-control"
                    value="{{ old('customerName' , $editData->customers->customer_name) }}" readonly>
                @error('customerName')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-4 d-flex align-items-center">
                <label for="productName" class="form-label me-1">Product_Name:</label>
                <input type="text" name="productName" id="productName" class="form-control"
                    value="{{ old('productName', $editData->productName) }}">
                @error('productName')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-4 d-flex align-items-center">
                <label for="genericName" class="form-label me-1">Generic_Name:</label>
                <input type="text" name="genericName" id="genericName" class="form-control"
                    value="{{ old('genericName',$editData->genericName) }}">
                @error('genericName')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-4 d-flex align-items-center">
                <label for="po" class="form-label me-1">PO:</label>
                <input type="text" name="po" id="po" class="form-control" value="{{$editData->PO }}">
                @error('po')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-3 d-flex align-items-center">
                <label for="fProduct" class="form-label me-1">F.Prod:</label>
                <input type="text" name="fProduct" id="fProduct" class="form-control"
                    value="{{ old('fProduct' ,$editData->fProduct) }}">
                @error('fProduct')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-3 d-flex align-items-center">
                <label for="formula" class="form-label me-1">Formula:</label>
                <input type="text" name="formula" id="formula" class="form-control"
                    value="{{ old('formula',$editData->formula) }}">
                @error('formula')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-3 d-flex align-items-center">
                <label for="wo" class="form-label me-1">WO:</label>
                <input type="text" name="wo" id="wo" class="form-control" value="{{ old('wo', $editData->WO) }}">
                @error('wo')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-3 d-flex align-items-center">
                <label for="lot" class="form-label me-1">LOT:</label>
                <input type="text" name="lot" id="lot" class="form-control" value="{{ old('lot',$editData->LOT) }}">
                @error('lot')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-3 d-flex align-items-center">
                <label for="Exp" class="form-label me-1">Exp:</label>
                <input type="text" name="Exp" id="Exp" class="form-control" value="{{ $editData->Exp }}">
                @error('Exp')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-3 d-flex align-items-center">
                <label for="orderQty" class="form-label me-1">Order_Qty:</label>
                <input type="text" name="orderQty" id="orderQty" class="form-control"
                    value="{{ old('orderQty',$editData->orderQty) }}">
                @error('orderQty')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-3 d-flex align-items-center">
                <label for="poQty" class="form-label me-1">PO_Qty:</label>
                <input type="text" name="poQty" id="poQty" class="form-control"
                    value="{{ old('poQty',$editData->poQty) }}">
                @error('poQty')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-3 d-flex align-items-center">
                <label for="dosageForm" class="form-label me-1">Dosage_Form:</label>
                <input type="text" name="dosageForm" id="dosageForm" class="form-control"
                    value="{{ old('dosageForm',$editData->dosageForm) }}">
                @error('dosageForm')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-3 d-flex align-items-center">
                <label for="ofDosesUnit" class="form-label me-1">of_Dosage/Unit:</label>
                <input type="text" name="ofDosesUnit" id="ofDosesUnit" class="form-control"
                    value="{{ old('ofDosesUnit',$editData->ofDosesUnit) }}">
                @error('ofDosesUnit')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-3 d-flex align-items-center">
                <label for="bluckProdLot" class="form-label me-1">Bulk_Prod_lot:</label>
                <input type="text" name="bluckProdLot" id="bluckProdLot" class="form-control"
                    value="{{ old('bluckProdLot',$editData->bluckProdLot) }}">
                @error('bluckProdLot')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-3 d-flex align-items-center">
                <label for="prodSuplyBy" class="form-label me-1">Prod_Supplied_By:</label>
                <input type="text" name="prodSuplyBy" id="prodSuplyBy" class="form-control"
                    value="{{ old('prodSuplyBy',$editData->prodSuplyBy) }}">
                @error('prodSuplyBy')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-3 d-flex align-items-center">
                <label for="ndcUpc" class="form-label me-1">NDC/UPC:</label>
                <input type="text" name="ndcUpc" id="ndcUpc" class="form-control"
                    value="{{ old('ndcUpc', $editData->ndcUpc) }}">
                @error('ndcUpc')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>


        <div class="row mt-2">
            <div class="col-6 d-flex align-items-center">
                <label for="unitDescription" class="form-label me-1">Unit_Description:</label>
                <textarea name="unitDescription" id="unitDescription"
                    class="form-control">{{ old('unitDescription',$editData->unitDescription) }}</textarea>
                @error('unitDescription')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-6 d-flex align-items-center">
                <label for="customerInfo" class="form-label me-1">Customer_Info:</label>
                <textarea name="customerInfo" id="customerInfo" class="form-control" rows="3" style="height: auto;"
                    readonly>{{ old('customerInfo', $editData->customerInfo) }}</textarea>
                @error('customerInfo')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>



        <div class="row mt-2">
            <h6>Components:</h6>

            @php
            $decodedCompName = json_decode($editData->compName);
            $decodedCompDesc = json_decode($editData->compDesc);
            $decodedCompCode = json_decode($editData->compCode);
            @endphp

            <div id="dynamicFields">
                @foreach($decodedCompName as $index => $compName)
                <div class="row mb-2">

                    <div class="col-4 d-flex align-items-center">
                        <label for="compName{{ $index }}" class="form-label me-1">Name:</label>
                        <input type="text" name="compName[]" id="compName{{ $index }}" class="form-control"
                            value="{{ old('compName.' . $index, $compName) }}">
                        @error('compName.' . $index)
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-4 d-flex align-items-center">
                        <label for="compDesc{{ $index }}" class="form-label me-1">Description:</label>
                        <input type="text" name="compDesc[]" id="compDesc{{ $index }}" class="form-control"
                            value="{{ old('compDesc.' . $index, $decodedCompDesc[$index] ?? '') }}">
                        @error('compDesc.' . $index)
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-4 d-flex align-items-center">
                        <label for="compCode{{ $index }}" class="form-label me-1">Code:</label>
                        <input type="text" name="compCode[]" id="compCode{{ $index }}" class="form-control"
                            value="{{ old('compCode.' . $index, $decodedCompCode[$index] ?? '') }}">
                        @error('compCode.' . $index)
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <button type="button" class="btn btn-danger btn-sm ms-2 remove-field">Delete</button>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="col col-sm">
                <button type="button" class="btn btn-primary btn-sm mt-2" id="addField">Add More</button>
            </div>
        </div>




        <div class="row mt-2">
            <div class="col-12 d-flex align-items-center">
                <label for="packInstruction" class="form-label me-1">Pack_Instruction:</label>
                <textarea name="packInstruction" id="packInstruction" class="form-control" rows="7"
                    style="height: auto;">{{ old('packInstruction',$editData->packInstruction) }}</textarea>
                @error('packInstruction')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-4 d-flex align-items-center">
                <label for="toolingNumber" class="form-label me-1">Tooling_Number:</label>
                <input type="text" name="toolingNumber" id="toolingNumber" class="form-control"
                    value="{{ old('toolingNumber',$editData->toolingNumber) }}">
                @error('toolingNumber')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-4 d-flex align-items-center">
                <label for="toolingDrawing" class="form-label me-1">Tooling_Drawing:</label>
                <input type="text" name="toolingDrawing" id="toolingDrawing" class="form-control"
                    value="{{ old('toolingDrawing',$editData->toolingDrawing) }}">
                @error('toolingDrawing')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-6 d-flex align-items-center">
                <label for="testToolingSpecfication" class="form-label me-1">Tooling_Spec:</label>
                <textarea name="testToolingSpecfication" id="testToolingSpecfication" rows="5" class="form-control"
                    style="height: auto;">{{ old('testToolingSpecfication',$editData->testToolingSpecfication) }}</textarea>
                @error('testToolingSpecfication')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-12 d-flex align-items-center mt-1">
                        <label for="pkgSize" class="form-label me-1">PKG_Size:</label>
                        <input type="text" name="pkgSize" id="pkgSize" class="form-control"
                            value="{{ old('pkgSize',$editData->pkgSize) }}">
                        @error('pkgSize')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 d-flex align-items-center mt-1">
                        <label for="matWidth" class="form-label me-1">Mat_Width:</label>
                        <input type="text" name="matWidth" id="matWidth" class="form-control"
                            value="{{ old('matWidth',$editData->matWidth) }}">
                        @error('matWidth')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 d-flex align-items-center mt-1">
                        <div class="row">
                            <div class="col-8 d-flex align-items-center">
                                <label for="foilYield" class="form-label me-1">Foil_Yield:</label>
                                <input type="text" name="foilYield" id="foilYield" class="form-control"
                                    value="{{ old('foilYield',$editData->foilYield) }}">
                                @error('foilYield')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-4 d-flex align-items-center">
                                <label for="foilcode" class="form-label me-1">Code<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="foilcode" id="foilcode" class="form-control"
                                    value="{{ old('foilcode',$editData->foilcode) }}">
                                @error('foilcode')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12 d-flex align-items-center mt-1">
                        <div class="row">
                            <div class="col-8 d-flex align-items-center">
                                <label for="PvcYield" class="form-label me-1">PVC_Yield:</label>
                                <input type="text" name="PvcYield" id="PvcYield" class="form-control"
                                    value="{{ old('PvcYield',$editData->PvcYield) }}">
                                @error('PvcYield')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-4 d-flex align-items-center">
                                <label for="PbvCode" class="form-label me-1">Code<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="PbvCode" id="PbvCode" class="form-control"
                                    value="{{ old('PbvCode',$editData->PbvCode) }}">
                                @error('PbvCode')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12 d-flex align-items-center">
                <label for="visualInspection" class="form-label me-1">Visual_Inspection:</label>
                <textarea name="visualInspection" id="visualInspection" class="form-control" rows="7"
                    style="height: auto;">{{ old('visualInspection',$editData->visualInspection) }}</textarea>
                @error('visualInspection')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mt-2">
            <div class="col col-2 d-flex align-items-center">
                <label for="testOne" class="form-label me-1">Test_One</label>
                <input type="text" name="testOne" id="testOne" class="form-control"
                    value="{{ old('testOne',$editData->testOne) }}">
                @error('testOne')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col col-2 d-flex align-items-center">
                <label for="testTwo" class="form-label me-1">Test_Two</label>
                <input type="text" name="testTwo" id="testTwo" class="form-control"
                    value="{{ old('testTwo',$editData->testTwo) }}">
                @error('testTwo')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col col-2 d-flex align-items-center">
                <label for="testThree" class="form-label me-1">Test_Three</label>
                <input type="text" name="testThree" id="testThree" class="form-control"
                    value="{{ old('testThree',$editData->testThree) }}">
                @error('testThree')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col col-2 d-flex align-items-center">
                <label for="testFour" class="form-label me-1">Test_Four</label>
                <input type="text" name="testFour" id="testFour" class="form-control"
                    value="{{ old('testFour',$editData->testFour) }}">
                @error('testFour')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col col-2 d-flex align-items-center">
                <label for="testFive" class="form-label me-1">Test_Five</label>
                <input type="text" name="testFive" id="testFive" class="form-control"
                    value="{{ old('testFive',$editData->testFive) }}">
                @error('testFive')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>


        <div class="row mt-2">
            <div class="col-12 d-flex align-items-center">
                <label for="processParameter" class="form-label me-1">Process_Parameter:</label>
                <textarea name="processParameter" id="processParameter" class="form-control" rows="10"
                    style="height: auto;">{{ old('processParameter',$editData->processParameter) }}</textarea>
                @error('processParameter')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>



        @php
        $decodeindexSetting = json_decode($editData->indexSetting);
        @endphp



        <div class="container mt-4">
            <div class="row" id="dynamicFieldsIndexSetting">
                @foreach (old('indexSetting', $decodeindexSetting ?? []) as $indexSettingValue)
                <div class="col-12 col-md-4 mb-2 mb-md-0 d-flex align-items-center">
                    <label for="indexSetting1" class="form-label mr-1">Index_Setting</label>
                    <input type="text" class="form-control" name="indexSetting[]" value="{{ $indexSettingValue }}">

                    @error('indexSetting.*')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <button type="button" class="btn btn-danger btn-sm ml-2 remove-fieldIndexSetting">Delete</button>
                </div>
                @endforeach
            </div>

            <div class="col col-sm mt-2">
                <button type="button" class="btn btn-primary btn-sm" id="addFieldIndexSetting">Add More</button>
            </div>
        </div>






        <div class="row mt-2">
            <div class="col-12 d-flex align-items-center">
                <label for="peopleAssigment" class="form-label me-1">People_assignment:</label>
                <textarea name="peopleAssigment" id="peopleAssigment" class="form-control" rows="3"
                    style="height: auto;">{{ old('peopleAssigment',$editData->peopleAssigment) }}</textarea>
                @error('peopleAssigment')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12 d-flex align-items-center">
                <label for="inspectionInst" class="form-label me-1">Inspection_Instruction:</label>
                <textarea name="inspectionInst" id="inspectionInst" class="form-control" rows="3"
                    style="height: auto;">{{ old('inspectionInst',$editData->inspectionInst) }}</textarea>
                @error('inspectionInst')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mt-2">
            <div class="col col-4 d-flex align-items-center">
                <label for="document" class="form-label me-1">Document:</label>
                <input type="text" name="document" id="document" class="form-control"
                    value="{{ old('document',$editData->document) }}">
                @error('document')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col col-4 d-flex align-items-center">
                <label for="masterOrd" class="form-label me-1">Master_order:</label>
                <input type="text" name="masterOrd" id="masterOrd" class="form-control"
                    value="{{ old('masterOrd',$editData->masterOrd) }}">
                @error('masterOrd')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col col-4 d-flex align-items-center">
                <label for="newOrderCreatedBy" class="form-label me-1">New_Order_createBy:</label>
                <input type="text" name="newOrderCreatedBy" id="newOrderCreatedBy" class="form-control"
                    value="{{ old('newOrderCreatedBy',$editData->newOrderCreatedBy) }}">
                @error('newOrderCreatedBy')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col  text-center">
            <input type="submit" value="Update" class="btn btn-primary mt-5">

        </div>
    </div>
</form>

@endif



{{-- fetch customer data using ajax when select customer id --}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#customerIdSelect').on('change', function() {
            var customerId = $(this).val();

            if (customerId) {
                $.ajax({
                    url: '/customer/' + customerId,
                    type: 'GET',
                    success: function(response) {


                        $('#customerName').val(response.customer_name);
                        $('#customerInfo').val(
                            'Phone : '+  response.phone + '\n' +
                        'Shipping Address : '
                        +response.shipping_street+' , '
                        + response.shipping_street_2+' , '
                        + response.shipping_town + ' , '
                        + response.shipping_state + ' , '
                        + response.shipping_zipcode);

                    },
                    error: function(xhr, status, error) {

                    alert('Error retrieving customer data: ' + xhr.responseText);
                }
                });
            }
        });
    });
</script>






<script>
    // JavaScript to handle adding/removing fields
    document.getElementById('addField').addEventListener('click', function () {
        let dynamicFields = document.getElementById('dynamicFields');
        let index = dynamicFields.children.length; // Get current index based on existing fields
        let newField = `
        <div class="row mb-2">
            <div class="col-4 d-flex align-items-center">
                <label for="compName${index}" class="form-label me-1">Name:</label>
                <input type="text" name="compName[]" id="compName${index}" class="form-control" value="">
            </div>

            <div class="col-4 d-flex align-items-center">
                <label for="compDesc${index}" class="form-label me-1">Description:</label>
                <input type="text" name="compDesc[]" id="compDesc${index}" class="form-control" value="">
            </div>

            <div class="col-4 d-flex align-items-center">
                <label for="compCode${index}" class="form-label me-1">Code:</label>
                <input type="text" name="compCode[]" id="compCode${index}" class="form-control" value="">
                <button type="button" class="btn btn-danger btn-sm ms-2 remove-field">Delete</button>
            </div>
        </div>
        `;
        dynamicFields.insertAdjacentHTML('beforeend', newField);
    });

    // JavaScript to remove a field
    document.addEventListener('click', function (event) {
        if (event.target && event.target.classList.contains('remove-field')) {
            event.target.closest('.row').remove();
        }
    });
</script>


{{-- handling edit and add and delete of index setting --}}
<script>
    document.getElementById('addFieldIndexSetting').addEventListener('click', function () {
        let dynamicFields = document.getElementById('dynamicFieldsIndexSetting');

        let newField = `
        <div class="col-12 col-md-4 mb-2 mb-md-0 d-flex align-items-center">
            <label for="indexSetting1" class="form-label mr-1">Index_Setting</label>
            <input type="text" name="indexSetting[]" class="form-control" value="">
            <button type="button" class="btn btn-danger btn-sm ml-2 remove-fieldIndexSetting">Delete</button>
        </div>
        `;

        // Insert the new field at the end of the row
        dynamicFields.insertAdjacentHTML('beforeend', newField);
    });

    // JavaScript to remove a field when the delete button is clicked
    document.getElementById('dynamicFieldsIndexSetting').addEventListener('click', function (event) {
        if (event.target && event.target.classList.contains('remove-fieldIndexSetting')) {
            // Remove the closest .col element (the entire field block)
            event.target.closest('.col-12').remove();
        }
    });
</script>


@endsection
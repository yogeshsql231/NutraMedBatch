@extends('layouts.masterLayout')

@section('title','Create Order')

@section('content')

<div class="section-header">
    <h1>Enter New Order Data</h1>
</div>

<div class="row justify-content-center">
    <div class="col-6 text-center">
        <h6>Template Selected</h6>
    </div>
</div>

<div class="text-center border justify-content-center p-4">
    <div class="row mb-1">
        <div class="col-6">
            Order NO
        </div>
        <div class="col-6 font-weight-bold">
            {{ $selectOrderData->orderId }}
        </div>
    </div>

    <div class="row mb-1">
        <div class="col-6">
            Customer Name
        </div>
        <div class="col-6 font-weight-bold">
            {{ $selectOrderData->customers->customer_name }}
        </div>
    </div>

    <div class="row mb-1">
        <div class="col-6">
            Finished Product NO
        </div>
        <div class="col-6 font-weight-bold">
            {{ $selectOrderData->fProduct }}
        </div>
    </div>

    <div class="row mb-1">
        <div class="col-6">
            Product Name
        </div>
        <div class="col-6 font-weight-bold">
            {{ $selectOrderData->productName }}
        </div>
    </div>
</div>

<div class="text-center mt-4">

    <form action="{{ route('saveNewTemplateRecord') }}" method="POST">

        @csrf
        <div class="row mb-1">
            <div class="col-6">LOT</div>
            <div class="col-6 font-weight-bold">
                <input type="text" class="form-control" name="lot" value="{{ old('lot', $request->lotN ?? '') }}">
                @error('lot')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-1">
            <div class="col-6">
                Exp Date
            </div>
            <div class="col-6 font-weight-bold">
                <input type="text" class="form-control" name="expDate" value="{{ old('expDate') }}">
                @error('expDate')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

        </div>

        <div class="row mb-1">
            <div class="col-6">
                Bulk LOT
            </div>
            <div class="col-6 font-weight-bold">
                <input type="text" class="form-control" name="bulkLot" value="{{ old('bulkLot') }}">
                @error('bulkLot')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

        </div>

        <div class="row mb-1">
            <div class="col-6">
                PO Number
            </div>
            <div class="col-6 font-weight-bold">
                <input type="text" class="form-control" name="poNumber" value="{{ old('poNumber') }}">
                @error('poNumber')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

        </div>

        <div class="row mb-1">
            <div class="col-6">
                WO Number
            </div>
            <div class="col-6 font-weight-bold">
                <input type="text" class="form-control" name="woNumber" value="{{ old('woNumber') }}">
                @error('woNumber')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

        </div>

        <div class="row mb-1">
            <div class="col-6">
                Quantity
            </div>
            <div class="col-6 font-weight-bold">
                <input type="text" class="form-control" name="quantity" value="{{ old('quantity') }}">
                @error('quantity')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

        </div>

        <div class="row mb-1">
            <div class="col-6">
                Blister/Bottle Qty
            </div>
            <div class="col-6 font-weight-bold">
                <input type="text" class="form-control" name="blisterBottleQty" value="{{ old('blisterBottleQty') }}">
                @error('blisterBottleQty')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <input type="hidden" name="exsitingOrderId" value="{{$selectOrderData->id}}">

        <div class="text-center">
            <input type="submit" class="btn btn-primary " value="Create New Order">
        </div>
    </form>



</div>

@endsection
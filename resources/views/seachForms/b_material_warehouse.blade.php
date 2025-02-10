@extends('layouts.masterLayout')

@section('title','B-Material Warehouse')

@section('content')

<div class="section-header">
    <h1>B-Material Transfer from Warehouse</h1>
</div>


<style>
    @media print {
        body * {
            visibility: hidden;
        }

        .printtableDiv,
        .printtableDiv * {
            visibility: visible;
        }

        .printtableDiv {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }

        .page-break {
            page-break-before: always;
            /* Force a page break before this element */
        }

        .no-print {
            display: none !important;
        }


    }
</style>



{{-- <style>
    @media print {
        body * {
            visibility: hidden;
        }

        .printtableDiv,
        .printtableDiv * {
            visibility: visible;
        }

        .printtableDiv {
            position: absolute;
            top: 10px;
            left: 0;
            width: 100%;
        }

        .page-break {
            page-break-before: always;
            margin-top: 100px;
            /* Force a page break before this element */
        }

        .no-print {
            display: none !important;
        }

        /* ------------------ */

        .header,
        .footer {
            position: fixed;
            width: 100%;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 12px;
            /* background-color: #f9f5f5f9; */
            z-index: 1000;
        }

        .header {
            top: 0;
            padding: 10px;
            border-bottom: 1px solid #000;
        }

        .footer {
            bottom: 0;
            padding: 5px;
            border-top: 1px solid #000;
        }


        .content {
            margin: 60px 0;
            /* Account for header and footer heights */
            padding: px;
        }


        .print-content {
            page-break-before: always;

        }

        .print-content:first-child {
            page-break-before: avoid;

        }

        /* Prevent header/footer overlap */
        .header+.content {
            padding-top: 150px;

        }

    }
</style> --}}





<div class="row mb-5">
    <div class="col col-6">
        <form id="orderForm" action="{{route('b_material_warehouse_print')}}" method="post">
            @csrf
            <label for="orderSelect" class="fw-bold">Select an Order(4 Digit Order Id):</label>
            <select id="orderSelect" class="form-control" name="orderId" onchange="this.form.submit()">
                <option value="">Select an customer order</option>
                @foreach ($orders as $item)
                <option value="{{$item->id}}">{{$item->orderId .' - '. $item->productName}}</option>
                @endforeach
            </select>
            <input type="hidden" name="tbName" value="Customer Order">
        </form>
    </div>

    <div class="col col-6">
        <form id="orderForm" action="{{route('b_material_warehouse_print')}}" method="post">
            @csrf
            <label for="orderSelect" class="fw-bold">Select an Order(5 Digit Order Id):</label>
            <select id="orderSelect" class="form-control" name="orderId" onchange="this.form.submit()">
                <option value="">Select an production order</option>
                @foreach ($duplicatePackagingOrder as $item)
                <option value="{{$item->id}}">{{$item->orderId .' - '. $item->productName}}</option>
                @endforeach
            </select>
            <input type="hidden" name="tbName" value="Production Order">
        </form>
    </div>
</div>

@if ($data)

<div class="printtableDiv">

    <div class="header">

        <div class="text-center">
            <p class="" style="font-size: 25px">NUTRA-MED PACKAGING</p>
            <p class="font-weight-bold text-uppercase" style="font-size:25px">Warehouse material transfer form</p>
        </div>
        <div class="text-right">
            <span> Order Id: <span class="font-weight-bold"> {{$data['orderDetails']->orderId}} </span> </span>
        </div>

        <div class="border p-2">
            <div class="d-flex justify-content-between">
                <p class="font-weight-bold"> PRODUCT: <span>{{$data['orderDetails']->productName}}</span> </p>
                <p class="font-weight-bold">Order Qty: <span>{{$data['orderDetails']->orderQty}}</span></p>
            </div>
            <div class="d-flex justify-content-between">
                <p class="font-weight-bold"> CUSTOMER: <span> {{$data['orderDetails']->customers->customer_name}}
                    </span>
                </p>
                <p class="font-weight-bold">Room#: <span>________</span></p>
            </div>

            <div class="d-flex justify-content-between" style="margin-left: 30rem">

                <p class="font-weight-bold">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                <p class="font-weight-bold">Exp: <span>{{$data['orderDetails']->Exp}}</span></p>
            </div>
        </div>

    </div>


    <div class="content">
        <div class="print-content mt-5">

            @php
            $compName = json_decode($data['orderDetails']->compName, true);
            $compCode=json_decode($data['orderDetails']->compCode, true);
            $compDesc=json_decode($data['orderDetails']->compDesc, true);
            @endphp


            <div class="row mb-2">
                <div class="col-4"></div>
                <div class="col-8">
                    <div class="row">
                        <div class="col-4">Code #</div>
                        <div class="col-4">Issued By </div>
                        <div class="col-4">Date /Time</div>
                    </div>
                </div>
            </div>

            @foreach ($compName as $key => $value)
            <div class="row">
                <div class="col-2">{{$compName[$key]}}</div>
                <div class="col-10"> <span>{{$compDesc[$key]}}</span> <span class="ml-3">{{$compCode[$key]}}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-2"></div>
                <div class="col-10">
                    <div class="row">
                        <div class="col-3 border mr-4">Qty</div>
                        <div class="col-3 border mr-2">&nbsp;</div>
                        <div class="col-2 border mr-2">&nbsp;</div>
                        <div class="col-2 border ">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-3 border mr-4">Qty</div>
                        <div class="col-3 border mr-2">&nbsp;</div>
                        <div class="col-2 border mr-2">&nbsp;</div>
                        <div class="col-2 border ">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-3 border mr-4">Qty</div>
                        <div class="col-3 border mr-2">&nbsp;</div>
                        <div class="col-2 border mr-2">&nbsp;</div>
                        <div class="col-2 border ">&nbsp;</div>
                    </div>
                </div>
            </div>
            <br>

            @if($key==9)

            <div class="header mb-3">

                <div class="text-center">
                    <p class="" style="font-size: 25px">NUTRA-MED PACKAGING</p>
                    <p class="font-weight-bold text-uppercase" style="font-size:25px">Warehouse material transfer form
                    </p>
                </div>
                <div class="text-right">
                    <span> Order Id: <span class="font-weight-bold"> {{$data['orderDetails']->orderId}} </span> </span>
                </div>

                <div class="border p-2">
                    <div class="d-flex justify-content-between">
                        <p class="font-weight-bold"> PRODUCT: <span>{{$data['orderDetails']->productName}}</span> </p>
                        <p class="font-weight-bold">Order Qty: <span>{{$data['orderDetails']->orderQty}}</span></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="font-weight-bold"> CUSTOMER: <span>
                                {{$data['orderDetails']->customers->customer_name}}
                            </span>
                        </p>
                        <p class="font-weight-bold">Room#: <span>________</span></p>
                    </div>

                    <div class="d-flex justify-content-between" style="margin-left: 30rem">

                        <p class="font-weight-bold">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                        <p class="font-weight-bold">Exp: <span>{{$data['orderDetails']->Exp}}</span></p>
                    </div>
                </div>

            </div>

            @endif


            @endforeach

            {{-- fix 3 --}}


            <div class="row">
                <div class="col-2"></div>
                <div class="col-10">
                    <div class="row">
                        <div class="col-3 border mr-4">Qty</div>
                        <div class="col-3 border mr-2">&nbsp;</div>
                        <div class="col-2 border mr-2">&nbsp;</div>
                        <div class="col-2 border ">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-3 border mr-4">Qty</div>
                        <div class="col-3 border mr-2">&nbsp;</div>
                        <div class="col-2 border mr-2">&nbsp;</div>
                        <div class="col-2 border ">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-3 border mr-4">Qty</div>
                        <div class="col-3 border mr-2">&nbsp;</div>
                        <div class="col-2 border mr-2">&nbsp;</div>
                        <div class="col-2 border ">&nbsp;</div>
                    </div>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-2"></div>
                <div class="col-10">
                    <div class="row">
                        <div class="col-3 border mr-4">Qty</div>
                        <div class="col-3 border mr-2">&nbsp;</div>
                        <div class="col-2 border mr-2">&nbsp;</div>
                        <div class="col-2 border ">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-3 border mr-4">Qty</div>
                        <div class="col-3 border mr-2">&nbsp;</div>
                        <div class="col-2 border mr-2">&nbsp;</div>
                        <div class="col-2 border ">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-3 border mr-4">Qty</div>
                        <div class="col-3 border mr-2">&nbsp;</div>
                        <div class="col-2 border mr-2">&nbsp;</div>
                        <div class="col-2 border ">&nbsp;</div>
                    </div>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-2"></div>
                <div class="col-10">
                    <div class="row">
                        <div class="col-3 border mr-4">Qty</div>
                        <div class="col-3 border mr-2">&nbsp;</div>
                        <div class="col-2 border mr-2">&nbsp;</div>
                        <div class="col-2 border ">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-3 border mr-4">Qty</div>
                        <div class="col-3 border mr-2">&nbsp;</div>
                        <div class="col-2 border mr-2">&nbsp;</div>
                        <div class="col-2 border ">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-3 border mr-4">Qty</div>
                        <div class="col-3 border mr-2">&nbsp;</div>
                        <div class="col-2 border mr-2">&nbsp;</div>
                        <div class="col-2 border ">&nbsp;</div>
                    </div>
                </div>
            </div>
            <br>



        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="div pt-1 ">
            <div class="row ">
                <div class="col-6">
                    <div>
                        <span class="mr-1">
                            Form: <span># 014-4</span>
                        </span>
                        <span class="mr-1">
                            Rev: <span id="revision">{{$data['rev']}}</span>
                        </span>
                        <span>
                            Issued: <span>{{
                                \Carbon\Carbon::parse($data['orderDetails']->created_at)->format('m/Y')}}</span>
                        </span>

                    </div>
                </div>

            </div>
        </div>
    </div>


</div>



<!-- Print Button -->
<div class="text-center mt-5">
    <button class="btn btn-primary" onclick="printDiv()">Print</button>
</div>

<script>
    function printDiv() {
        window.print();
    }
</script>

@else
<h4 class="text-center text-muted">
    Kindly select a Packaging Order to print.
</h4>

@endif


@endsection
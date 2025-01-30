@extends('layouts.masterLayout')

@section('title','Material Transfer 4')

@section('content')
<div class="section-header">
    <h1>Material Transfer 4</h1>
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

        @page {
            size: landscape;
            /* Set the page orientation to landscape */
            margin: 1cm;
            /* Adjust margins if needed */
        }






    }
</style>





<div class="row mb-5">

    <div class="col col-6">
        <form id="orderForm" action="{{route('materialTranfer4Print')}}" method="get">
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
        <form id="orderForm" action="{{route('materialTranfer4Print')}}" method="get">
            <label for="orderSelect" class="fw-bold">Select an Order(5 Digit Order Id):</label>
            <select id="orderSelect" class="form-control" name="orderId" onchange="this.form.submit()">
                <option value="">Select an production order</option>
                @foreach ($DuplicatePackagingorders as $item)
                <option value="{{$item->id}}">{{$item->orderId .' - '. $item->productName}}</option>
                @endforeach
            </select>
            <input type="hidden" name="tbName" value="Production Order">

        </form>
    </div>

</div>





@if ($orderDetails)

<div class="printtableDiv">

    <div class="container-fluid">

        <div class="page_heading">
            <div class="text-center">
                <p class="" style="font-size: 25px">NUTRA-MED PACKAGING</p>
                <p class="font-weight-bold text-uppercase" style="font-size:25px">Material Transfer Report</p>
            </div>
            <div class="text-right">
                <span> Order Id: <span class="font-weight-bold"> {{$orderDetails->orderId}} </span> </span>
            </div>

            <div class="border p-2">
                <div class="d-flex justify-content-between">
                    <p class="font-weight-bold"> PRODUCT: <span>{{$orderDetails->productName}}</span> </p>
                    <p class="font-weight-bold">RM#: <span>____________</span></p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="font-weight-bold"> CUSTOMER: <span> {{$orderDetails->customers->customer_name}} </span>
                    </p>
                    <p class="font-weight-bold">Lot#: <span>{{$orderDetails->LOT}}</span></p>
                    <p class="font-weight-bold">Exp: <span>{{$orderDetails->Exp}}</span></p>
                </div>
            </div>
        </div>


        <div class="mt-1">
            <table class="table table-bordered  table-sm">
                {{-- <thead> --}}
                    <tr>
                        <th scope="col" class="border">Date</th>
                        <th scope="col" class="border">Qty Issued</th>
                        <th scope="col" class="border">Lot#</th>
                        <th scope="col" class="border">Code#</th>
                        <th scope="col" class="border">Receipt#</th>
                        <th scope="col" class="border">Verified By</th>
                        <th scope="col" class="border">Checked By</th>
                        <th scope="col" class="border">Qty Returned</th>
                        <th scope="col" class="border">By</th>
                    </tr>
                    {{--
                </thead> --}}

                {{-- <tbody id="table-body">

                    @php
                    $compName = json_decode($orderDetails->compName, true);
                    $compCode=json_decode($orderDetails->compCode, true);
                    @endphp

                    @if($compName)
                    @foreach($compName as $key => $value)

                    <tr>
                        <th colspan="9" class="border">{{$compName[$key]}}</th>
                    </tr>

                    <tr>
                        <th scope="row" class="border"></th>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border">
                            <span class="p-0" style="font-size: 0.60rem;">{{$compCode[$key]}}</span>
                        </td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                    </tr>

                    <tr>
                        <th scope="row" class="border">&nbsp;</th>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                    </tr>

                    <tr>
                        <th scope="row" class="border">&nbsp;</th>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                    </tr>

                    <tr>
                        <th scope="row" class="border">&nbsp;</th>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                    </tr>
                    @if ($key==0)
                    <tr>
                        <th colspan="5" class="border text-left ">
                            Batch Size of the Lot: <br>
                            Total Qty. Issued:
                        </th>
                        <th colspan="4" class="border text-left "> <br>
                            Bulk Product Expiration Date: <span class="border-bottom d-inline-block w-25"></span>
                        </th>
                    </tr>


                    <tr>
                        <td colspan="9" class="border p-3"> </td>
                    </tr>

                    <tr>
                        <th scope="row" class="border">&nbsp;</th>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                    </tr>

                    <tr>
                        <th scope="row" class="border">&nbsp;</th>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                    </tr>

                    <tr>
                        <th scope="row" class="border">&nbsp;</th>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                    </tr>

                    <tr>
                        <th scope="row" class="border">&nbsp;</th>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                    </tr>

                    <tr>
                        <th colspan="9" scope="row" class="border">Total: </th>
                    </tr>
                    @else
                    <tr>
                        <th colspan="9" scope="row" class="border">Total: </th>
                    </tr>
                    @endif

                    @endforeach
                    @endif

                </tbody> --}}


                {{-- <tbody id="table-body"> --}}
                    @php
                    $compName = json_decode($orderDetails->compName, true);
                    $compCode = json_decode($orderDetails->compCode, true);
                    @endphp

                    @if($compName)
                    @foreach($compName as $key => $value)
                    @php
                    $index = $key + 1; // Start $index from 1
                    @endphp

                    <!-- Display the page heading every 2 iterations -->
                    @if($index % 2 == 0)
                    <tr>
                        <td colspan="9" class="border page-break">
                            <div class="page_heading">
                                <div class="text-center">
                                    <p class="" style="font-size: 25px">NUTRA-MED PACKAGING</p>
                                    <p class="font-weight-bold text-uppercase" style="font-size:25px">Material Transfer
                                        Report</p>
                                </div>
                                <div class="text-right">
                                    <span>Order Id: <span
                                            class="font-weight-bold">{{$orderDetails->orderId}}</span></span>
                                </div>
                                <div class="border p-2">
                                    <div class="d-flex justify-content-between">
                                        <p class="font-weight-bold">PRODUCT: <span>{{$orderDetails->productName}}</span>
                                        </p>
                                        <p class="font-weight-bold">RM#: <span>____________</span></p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="font-weight-bold">CUSTOMER:
                                            <span>{{$orderDetails->customers->customer_name}}</span>
                                        </p>
                                        <p class="font-weight-bold">Lot#: <span>{{$orderDetails->LOT}}</span></p>
                                        <p class="font-weight-bold">Exp: <span>{{$orderDetails->Exp}}</span></p>
                                    </div>
                                </div>
                            </div>
                        </td>

                    </tr>
                    @endif

                    <!-- Material details -->
                    <tr>
                        <th colspan="9" class="border">{{$compName[$key]}}</th>
                    </tr>
                    <tr>
                        <th scope="row" class="border">&nbsp;</th>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border">
                            <span class="p-0" style="font-size: 0.60rem;">{{$compCode[$key]}}</span>
                        </td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                    </tr>

                    <!-- Additional rows -->
                    @for($i = 0; $i < 3; $i++) <tr>
                        <th scope="row" class="border">&nbsp;</th>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        <td class="border"></td>
                        </tr>
                        @endfor

                        <!-- Total row -->
                        @if ($index == 1)
                        <tr>
                            <th colspan="5" class="border text-left">
                                Batch Size of the Lot: <br>
                                Total Qty. Issued:
                            </th>
                            <th colspan="4" class="border text-left">
                                Bulk Product Expiration Date: <span class="border-bottom d-inline-block w-25"></span>
                            </th>
                        </tr>
                        @endif
                        <tr>
                            <th colspan="9" scope="row" class="border">Total:</th>
                        </tr>
                        @endforeach
                        @endif
                        {{--
                </tbody> --}}







            </table>
        </div>

        <div class="container">
            <!-- Footer Section -->
            <div class="footer mt-5 pt-3 ">
                <div class="row ">
                    <div class="col-6">
                        <div>
                            <span class="mr-1">
                                Form: <span># 014-2</span>
                            </span>
                            <span class="mr-1">
                                Rev: <span id="revision">{{$rev}}</span>
                            </span>
                            <span>
                                Issued: <span>{{
                                    \Carbon\Carbon::parse($orderDetails->created_at)->format('m/Y')}}</span>
                            </span>

                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <div>Seq. No. <span>4 of 13 </span></div>
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

@endif

<script>
    function printDiv() {
        window.print();
    }
</script>


@endsection
@extends('layouts.masterLayout')

@section('title','Print Packaging Order')

<style>
    /* Print-specific styling */
    @media print {
        .no-print {
            display: none;
            /* Hide elements you don't want to print */
        }

        .page-break {
            page-break-before: always;
            /* Force a page break before this element */
        }
    }
</style>

@section('content')

<div class="section-header">
    <h1>Print Packaging Order</h1>
</div>

<div class="row mb-5">
    <div class="col col-6">
        <form id="orderForm" action="{{route('searchPrintOrder')}}" method="get">
            <label for="orderSelect" class="fw-bold">Select an Customer Order(4 Digit Order Id):</label>
            <select id="orderSelect" class="form-control" name="orderId" onchange="this.form.submit()">
                <option value="">Select an Customer order</option>
                @foreach ($orders as $item)
                <option value="{{$item->id}}">{{$item->orderId .' - '. $item->productName}}</option>
                @endforeach
            </select>
            <input type="hidden" name="tableName" value="Customer Order">

        </form>
    </div>


    <div class="col col-6">
        <form id="orderForm" action="{{route('searchPrintOrder')}}" method="get">
            <label for="orderSelect" class="fw-bold">Select an Production Order(5 Digit Order Id):</label>
            <select id="orderSelect" class="form-control" name="orderId" onchange="this.form.submit()">
                <option value="">Select an Production order</option>
                @foreach ($DuplicatePackagingorders as $item)
                <option value="{{$item->id}}">{{$item->orderId .' - '. $item->productName}}</option>
                @endforeach
                <input type="hidden" name="tableName" value="Production Order">
            </select>
        </form>
    </div>
</div>

{{-- Print order section --}}

@if($printOrder)
<div id="printableArea">
    <div class="text-center">
        <h6>NUTRA-MED PACKAGING</h6>
        <h6>PACKAGING ORDER</h6>
    </div>
    <div class="text-right">
        <span class="font-weight-bold"> Order Id : {{$printOrder->orderId}}</span>
        <hr>
    </div>

    <div class="container">
        {{-- <div class="d-flex justify-content-between mb-2">
            <span class="font-weight-bold">Customer: {{$printOrder->customers->customer_name}}</span>
            <span class="font-weight-bold">PO: {{$printOrder->PO}}</span>
        </div> --}}
        <div class="row">
            <div class="col-9">
                <span class="font-weight-bold">Customer : {{$printOrder->customers->customer_name}}</span>
            </div>
            <div class="col-3">
                <span class="font-weight-bold">PO : {{$printOrder->PO}}</span>
            </div>
        </div>

        <div class="row m-1">
            <div class="col-9 border p-2">
                ph : {{$printOrder->customers->phone}}<br>
                Address : {{ $printOrder->customers->shipping_street }},
                @if($printOrder->customers->shipping_street_2)
                {{ $printOrder->customers->shipping_street_2 }},
                @endif

                {{ $printOrder->customers->shipping_town }}, {{ $printOrder->customers->shipping_state }} {{
                $printOrder->customers->shipping_zipcode }}

            </div>

            <div class="col-3">
                <span class="font-weight-bold">WO : {{$printOrder->WO}}</span> <br>
                <span class="font-weight-bold">Order Qty : {{$printOrder->orderQty}}</span> <br>
                <span class="font-weight-bold">LOT : {{$printOrder->LOT}}</span> <br>
                <span class="font-weight-bold">Exp : {{$printOrder->Exp}}</span> <br>
            </div>
        </div>
    </div>
    <hr>

    <div class="container">
        <span class="font-weight-bold ">Product Name : {{$printOrder->productName}}</span>

        <div class="d-flex justify-content-between flex-wrap mt-2">
            <span class="font-weight-bold mr-5">F. Prod: {{$printOrder->fProduct}}</span>
            <span class="font-weight-bold mr-5">Bulk Prod Lot: {{$printOrder->bluckProdLot}}</span>
            <span class="font-weight-bold mr-5">Dosage Form: {{$printOrder->dosageForm}}</span>
            <span class="font-weight-bold mr-5">Of Tablet/ Unit: {{$printOrder->ofDosesUnit}}</span>
            <span class="font-weight-bold mr-5">NDC/UPC: {{$printOrder->ndcUpc}}</span>
        </div>
    </div>
    <hr>

    <div class="container">
        <span class="font-weight-bold">Description : {{$printOrder->ofDosesUnit}} {{$printOrder->dosageForm}} /
            {{$printOrder->unitDescription}}
        </span>
    </div>
    <hr>

    <div class="container">
        @php
        $compName = json_decode($printOrder->compName);
        $compDesc = json_decode($printOrder->compDesc);
        $compCode = json_decode($printOrder->compCode);

        $countName = count($compName);
        $countDesc = count($compDesc);
        $countCode = count($compCode);

        $largestCount = max($countName, $countDesc, $countCode);
        @endphp

        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Components Name</th>
                    <th>Description</th>
                    <th>Code</th>
                </tr>
            </thead>
            <tbody>
                @for ($index = 0; $index < $largestCount; $index++) <tr>
                    <td>{{ $compName[$index] ?? 'N/A' }}</td>
                    <td>{{ $compDesc[$index] ?? 'N/A' }}</td>
                    <td>{{ $compCode[$index] ?? 'N/A' }}</td>
                    </tr>
                    @endfor
            </tbody>
        </table>

        <span class="font-weight-bold mt-3 ">Packaging Instruction:</span>

        <div class="border mt-2 p-2">
            {!! str_replace('.', '.<br>', $printOrder->packInstruction) !!}
        </div>

    </div>

    <!-- Footer Section -->
    <div class="footer mt-1 pt-3 ">
        <div class="row ">
            <div class="col-6">
                <div>
                    <span class="mr-1">
                        Form: <span># 003-1</span>
                    </span>
                    <span class="mr-1">
                        Rev: <span>{{$rev}}</span>
                    </span>
                    <span>
                        Issued: <span>{{ \Carbon\Carbon::parse($printOrder->created_at)->format('m/Y')}}</span>
                    </span>

                </div>
            </div>
            <div class="col-6 text-right">
                <div>Seq. No. <span> 1 of 13</span></div>
            </div>
        </div>
    </div>

    {{-- Second Page for print --}}

    <div class="page-break"></div> <!-- Page break -->
    <p class="no-print text-warning"> New Page Start </p>

    <div class="text-center mt-4">
        <h6>PACKAGING ORDER</h6>
    </div>
    <div class="text-right">
        <span class="font-weight-bold"> Order Id : {{$printOrder->orderId}}</span>
        <hr>
    </div>

    <div class="container">
        <span class="font-weight-bold ">Product Name : {{$printOrder->productName}}</span> <br>

        <span class="font-weight-bold ">Customer Name : {{$printOrder->customers->customer_name}}</span>

        <div class="d-flex justify-content-between flex-wrap mt-2">
            <span class="font-weight-bold">LOT : {{$printOrder->LOT}}</span> <br>
            <span class="font-weight-bold">Exp : {{$printOrder->Exp}}</span> <br>
        </div>
    </div>
    <hr>

    <div class="container">
        <div class="d-flex justify-content-between flex-wrap mt-2">
            <span class="font-weight-bold">Blister/ bottling-Tooling spec :
            </span> <br>
            <span class="font-weight-bold">Tooling : {{$printOrder->toolingNumber}}</span> <br>
        </div>




        <div class="border mt-2 p-2">
            {!! str_replace(',', '.<br>', $printOrder->testToolingSpecfication) !!}

        </div>



        <p class="font-weight-bold mt-2 mb-0">Process Parameter:</p>

        <div class="border p-2">
            {!! str_replace('.', '.<br>', $printOrder->processParameter) !!}

        </div>




        <p class="font-weight-bold mt-2 mb-0">Inspection Instruction:</p>

        <div class="border p-2">
            {!! str_replace('.', '.<br>', $printOrder->inspectionInst) !!}

        </div>


        <div class="row mt-5">
            <div class="col-8">
                <p>Reviewed By : <span>_________________________________</span></p>

                <p>Approved By : <span>_________________________________</span></p>
            </div>
            <div class="col-4">
                <p>Date: <span>__________________________</span></p>
                <p>Date: <span>__________________________</span></p>
            </div>
        </div>

        <p class="font-weight-bold">Document: {{$printOrder->document}}</p>

    </div>


    <!-- Footer Section -->
    <div class="footer mt-1 pt-3 ">
        <div class="row ">
            <div class="col-6">
                <div>
                    <span class="mr-1">
                        Form: <span># 003-1</span>
                    </span>
                    <span class="mr-1">
                        Rev: <span>{{$rev}}</span>
                    </span>
                    <span>
                        Issued: <span>{{ \Carbon\Carbon::parse($printOrder->created_at)->format('m/Y')}}</span>
                    </span>

                </div>
            </div>
            <div class="col-6 text-right">
                <div>Seq. No. <span> 1 of 13</span></div>
            </div>
        </div>
    </div>


</div>


<!-- Print Button -->
<div class="text-center mt-5">
    <button class="btn btn-primary" onclick="printOrder()">Print</button>
</div>


<script>
    function printOrder() {
        var printContents = document.getElementById('printableArea').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>
@endif



@endsection
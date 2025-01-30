@extends('layouts.masterLayout')

@section('title','Print forms')

@section('content')
<div class="section-header">
    <h1>Print All Forms</h1>
</div>


<style>
    #portraitDiv,
    #landscapeDiv {
        /* border: 2px solid black; */
        margin: 20px;
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    #portraitDiv {
        /* background-color: #f0f8ff; */
    }

    #landscapeDiv {
        background-color: #f0f8ff;
    }

    .page-break {
        page-break-before: always;
    }

    /* Elements with this class will not be printed */
    .no-print {
        display: none !important;
    }
</style>


<div class="row mb-5">

    <div class="col col-6">
        <form id="orderForm" action="{{route('PrintAllFormsFetch')}}" method="get">
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
        <form id="orderForm" action="{{route('PrintAllFormsFetch')}}" method="get">
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




{{-- if data has fetch from db --}}
@if($data)

<div class="row">
    <div class="col-6 ">
        <!-- Print Button 1 -->
        <div class="d-flex justify-content-end  mt-5">
            <button onclick="printElement('portraitDiv', 'portrait')" class="btn btn-primary">Print Portrait
                Forms</button>
        </div>
    </div>

    <div class="col-6 ">
        <!-- Print Button 2 -->
        <div class=" mt-5 d-flex justify-content-start">
            <button onclick="printElement('landscapeDiv', 'landscape')" class="btn btn-primary">Print Landscape
                Forms</button>
        </div>
    </div>
</div>

{{------------------------------------------ Portrait Form Print Div Start-----------------------------------------}}

<div id="portraitDiv">



    {{------------------------------------------ Packaging order Satrt-----------------------------------------}}
    <div id="PackagingOrder">

        <div class="text-center">
            <h6>NUTRA-MED PACKAGING</h6>
            <h6>PACKAGING ORDER</h6>
        </div>
        <div class="text-right">
            <span class="font-weight-bold"> Order Id : {{$data['orderDetails']->orderId}}</span>
            <hr>
        </div>

        <div class="container">
            {{-- <div class="d-flex justify-content-between mb-2">
                <span class="font-weight-bold">Customer: {{$data['orderDetails']->customers->customer_name}}</span>
                <span class="font-weight-bold">PO: {{$data['orderDetails']->PO}}</span>
            </div> --}}
            <div class="row">
                <div class="col-9">
                    <span class="font-weight-bold">Customer : {{$data['orderDetails']->customers->customer_name}}</span>
                </div>
                <div class="col-3">
                    <span class="font-weight-bold">PO : {{$data['orderDetails']->PO}}</span>
                </div>
            </div>

            <div class="row m-1">
                <div class="col-9 border p-2">
                    ph : {{$data['orderDetails']->customers->phone}}<br>
                    Address : {{ $data['orderDetails']->customers->shipping_street }},
                    @if($data['orderDetails']->customers->shipping_street_2)
                    {{ $data['orderDetails']->customers->shipping_street_2 }},
                    @endif

                    {{ $data['orderDetails']->customers->shipping_town }}, {{
                    $data['orderDetails']->customers->shipping_state }} {{
                    $data['orderDetails']->customers->shipping_zipcode }}

                </div>

                <div class="col-3">
                    <span class="font-weight-bold">WO : {{$data['orderDetails']->WO}}</span> <br>
                    <span class="font-weight-bold">Order Qty : {{$data['orderDetails']->orderQty}}</span> <br>
                    <span class="font-weight-bold">LOT : {{$data['orderDetails']->LOT}}</span> <br>
                    <span class="font-weight-bold">Exp : {{$data['orderDetails']->Exp}}</span> <br>
                </div>
            </div>
        </div>
        <hr>

        <div class="container">
            <span class="font-weight-bold ">Product Name : {{$data['orderDetails']->productName}}</span>

            <div class="d-flex justify-content-between flex-wrap mt-2">
                <span class="font-weight-bold mr-5">F. Prod: {{$data['orderDetails']->fProduct}}</span>
                <span class="font-weight-bold mr-5">Bulk Prod Lot: {{$data['orderDetails']->bluckProdLot}}</span>
                <span class="font-weight-bold mr-5">Dosage Form: {{$data['orderDetails']->dosageForm}}</span>
                <span class="font-weight-bold mr-5">Of Tablet/ Unit: {{$data['orderDetails']->ofDosesUnit}}</span>
                <span class="font-weight-bold mr-5">NDC/UPC: {{$data['orderDetails']->ndcUpc}}</span>
            </div>
        </div>
        <hr>

        <div class="container">
            <span class="font-weight-bold">Description : {{$data['orderDetails']->ofDosesUnit}}
                {{$data['orderDetails']->dosageForm}} /
                {{$data['orderDetails']->unitDescription}}
            </span>
        </div>
        <hr>



        <div class="container">
            @php
            $compName = json_decode($data['orderDetails']->compName);
            $compDesc = json_decode($data['orderDetails']->compDesc);
            $compCode = json_decode($data['orderDetails']->compCode);

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
                {!! str_replace('.', '.<br>', $data['orderDetails']->packInstruction) !!}
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
                            Rev: <span>{{$data['rev']}}</span>
                        </span>
                        <span>
                            Issued: <span>{{
                                \Carbon\Carbon::parse($data['orderDetails']->created_at)->format('m/Y')}}</span>
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
            <span class="font-weight-bold"> Order Id : {{$data['orderDetails']->orderId}}</span>
            <hr>
        </div>

        <div class="container">
            <span class="font-weight-bold ">Product Name : {{$data['orderDetails']->productName}}</span> <br>

            <span class="font-weight-bold ">Customer Name : {{$data['orderDetails']->customers->customer_name}}</span>

            <div class="d-flex justify-content-between flex-wrap mt-2">
                <span class="font-weight-bold">LOT : {{$data['orderDetails']->LOT}}</span> <br>
                <span class="font-weight-bold">Exp : {{$data['orderDetails']->Exp}}</span> <br>
            </div>
        </div>
        <hr>

        <div class="container">
            <div class="d-flex justify-content-between flex-wrap mt-2">
                <span class="font-weight-bold">Blister/ bottling-Tooling spec :
                </span> <br>
                <span class="font-weight-bold">Tooling : {{$data['orderDetails']->toolingNumber}}</span> <br>
            </div>




            <div class="border mt-2 p-2">
                {!! str_replace(',', '.<br>', $data['orderDetails']->testToolingSpecfication) !!}

            </div>

            <p class="font-weight-bold mt-2 mb-0">Process Parameter:</p>

            <div class="border p-2">
                {!! str_replace('.', '.<br>', $data['orderDetails']->processParameter) !!}

            </div>

            <p class="font-weight-bold mt-2 mb-0">Inspection Instruction:</p>

            <div class="border p-2">
                {!! str_replace('.', '.<br>', $data['orderDetails']->inspectionInst) !!}

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

            <p class="font-weight-bold">Document: {{$data['orderDetails']->document}}</p>

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
                            Rev: <span>{{$data['rev']}}</span>
                        </span>
                        <span>
                            Issued: <span>{{
                                \Carbon\Carbon::parse($data['orderDetails']->created_at)->format('m/Y')}}</span>
                        </span>

                    </div>
                </div>
                <div class="col-6 text-right">
                    <div>Seq. No. <span> 1 of 13</span></div>
                </div>
            </div>
        </div>
    </div>
    {{----------------------------- Packaging order close------------------------------------------------------}}




    {{---------------------------------- Inspection 2-3-5 form start--------------------------------------------}}
    <div class="Inspection 2-3-5">
        <div class="page-break mb-5"></div> <!-- Page break -->
        <p class="no-print text-warning"> Inspection2-3-5 Form Start </p>


        <div class="container">
            <div class="text-center">
                <p class="" style="font-size: 25px">NUTRA-MED PACKAGING </p>
                <p class="font-weight-bold text-uppercase" style="font-size:25px">Equipment/room cleaning report
                    <br> major clean-up
                </p>
            </div>
            <div class="text-right">
                <span> Order Id : <span class="font-weight-bold">{{$data['orderDetails']->orderId}}</span> </span>
            </div>

            <div class="border p-2">
                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> PRODUCT: <span>{{ $data['orderDetails']->productName}}</span> </p>
                    <p class="font-weight-bold ">RM#: <span>____________</span></p>
                </div>

                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> CUSTOMER:
                        <span>{{$data['orderDetails']->customers->customer_name}}</span>
                    </p>
                    <p class="font-weight-bold ">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                    <p class="font-weight-bold ">Exp: <span>{{$data['orderDetails']->Exp}}</span></p>
                </div>

                <div class="text-right">
                    <span class="font-weight-bold">Machine#: ____________</span>
                </div>
            </div>




            <div class="mt-4">
                <h6 class="text-left font-weight-bold">ALL CLEANING IS PERFORMED ACCORDING TO SOP # 008</h6>

                <div class="text-right">
                    <h6 class="">Cleaning performed By</h6>
                </div>


                <div class="row m-0 ">
                    <div class="col-10">
                        <p><strong class="mr-2">1</strong>
                            <span class="font-weight-bold">EQUIPMENT AND ROOM CLEANING :</span> <br>
                            All machine parts that come in contact with the product have been cleaned and
                            sanitized in accordance with the written procedures. Machine is cleaned and body of the
                            machine
                            is wiped with 70% Isopropyl alcohol.
                        </p>
                    </div>
                    <div class="col-2 d-flex align-items-center">
                        <div class="border " style="width: 100%; height:50px;"></div>
                    </div>
                </div>
                <hr class="mt-0">


                <div class="row m-0">
                    <div class="col-10">
                        <p><strong>2</strong> <span class="font-weight-bold">BLISTER MACHINE PRODUCT CONTACT PARTS LIST
                                WHERE APPLICABLE:</span> <br>
                            Product Hopper, feeding tray, vibrator tray, feeder box with
                            brushes, paddles, scoops, bowl, etc.</p>
                    </div>
                    <div class="col-2 d-flex align-items-center">
                        <div class="border " style="width: 100%; height:50px;"></div>
                    </div>
                </div>

                <div class="row m-0">
                    <div class="col-10">
                        <p><strong>3</strong> <span class="font-weight-bold">MACHINE AND AUXILIARY EQUIPMENT:</span>
                            <br> Tracks,
                            scoops, body of the machine, film and foil rollers, scrap rollers, door and cover of the
                            machine, unwind and rewind rollers, cables connected to machine and printer, etc., are all
                            cleaned as per the SOP and wiped with 70% Isopropyl alcohol. Waste blank blisters, rejected
                            product and blister cards, previous film and foil rolls, film web from the machine is
                            removed.
                        </p>
                    </div>
                    <div class="col-2 d-flex align-items-center">
                        <div class="border " style="width: 100%; height:50px;"></div>
                    </div>
                </div>

                <hr class="mt-0">



                <div class="row m-0">
                    <div class="col-10">
                        <p><strong>4</strong> <span class="font-weight-bold">BOTTLING MACHINE PRODUCT CONTACT PARTS LIST
                                WHERE APPLICABLE:</span>
                            <br>
                            Product Hopper, Product feeding tray, slats, feeding chutes,
                            counting head, eye bank, funnels, hopper tray, spredder tube, clear chute cover, etc.
                        </p>
                    </div>
                    <div class="col-2 d-flex align-items-center">
                        <div class="border " style="width: 100%; height:50px;"></div>
                    </div>
                </div>

                <div class="row m-0">
                    <div class="col-10">
                        <p> <strong>5</strong> <span class="font-weight-bold">MACHINE AND AUXILIARY EQUIPMENT:</span>
                            <br>
                            Body
                            of the machine,
                            cotton machine, induction sealer, capper, metal detector, labeler, shrink-wrapper, neck
                            bander,
                            cables connected to the machine and ink-jet printer, glue machine, etc., are all cleaned as
                            per
                            the SOP and wiped with 70% Isopropyl alcohol where applicable. The conveyor below the bottle
                            filler is disassembled, cleaned, and wiped with 70% Isopropyl alcohol.
                        </p>
                    </div>
                    <div class="col-2 d-flex align-items-center">
                        <div class="border " style="width: 100%; height:50px;"></div>
                    </div>
                </div>

                <hr class="mt-0">

                <p class="font-weight-bold">PACKAGING ROOM AND CARTONING MACHINE ROOM CLEANING :</p>


                <div class="row m-0">
                    <div class="col-10">
                        <p><strong>6</strong> All previous finished product, excess bulk, waste product, components,
                            labeling, identification, documents, printmat, samples, are removed from the room.</p>
                    </div>
                    <div class="col-2 d-flex align-items-center">
                        <div class="border " style="width: 100%; height:50px;"></div>
                    </div>
                </div>



                <div class="row m-0">
                    <div class="col-10">
                        <p><strong>7</strong> The entire area, floor, is swept, mopped and cleaned. The trash and other
                            containers, are emptied and cleaned.</p>
                    </div>
                    <div class="col-2 d-flex align-items-center">
                        <div class="border " style="width: 100%; height:50px;"></div>
                    </div>
                </div>



                <div class="row m-1">
                    <div class="col-10">
                        <p><strong>8</strong> The wall, ceiling tiles, hanging cables, conveyor, tables, stools,
                            mechanic
                            tool box, shelves to keep the file and documents are cleaned.</p>
                    </div>
                    <div class="col-2 d-flex align-items-center">
                        <div class="border " style="width: 100%; height:50px;"></div>
                    </div>
                </div>

                {{--
                <hr class="mt-0"> --}}



                <p><strong>Cleaning verified by :</strong> <span class="border-bottom w-50 d-inline-block"></span>
                    <strong>Date:</strong> <span class="border-bottom w-25 d-inline-block"></span>
                </p>

                {{--
                <hr class="mt-0"> --}}

                <p class="font-weight-bold">I have thoroughly inspected the entire area, the machine and machine parts
                    for
                    proper cleaning. The packaging
                    line is properly cleaned and the line is free from previous product components. I am approving this
                    area
                    and
                    the machine for packaging next product.</p>

                <p><strong>Production:</strong> <span class="border-bottom w-50 d-inline-block"></span>
                    <strong>Date:</strong>
                    <span class="border-bottom w-25 d-inline-block"></span>
                </p>

                <p><strong>Quality Assurance:</strong> <span class="border-bottom w-50 d-inline-block"></span>
                    <strong>Date:</strong> <span class="border-bottom w-25 d-inline-block"></span>
                </p>
            </div>

            <!-- Footer Section -->
            <div class="footer mt-1 pt-3 ">
                <div class="row ">
                    <div class="col-6">
                        <div>
                            <span class="mr-1">
                                Form: <span># 008-1</span>
                            </span>
                            <span class="mr-1">
                                Rev: <span>{{$data['rev']}}</span>
                            </span>
                            <span>
                                Issued: <span>{{
                                    \Carbon\Carbon::parse($data['orderDetails']->created_at)->format('m/Y')}}</span>
                            </span>

                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <div>Seq. No. <span> 2 of 13</span></div>
                    </div>
                </div>
            </div>
        </div>


        {{-- Second Page for Printmat Inspection and Destruction Report--}}

        <div class="page-break"></div> <!-- Page break -->
        <p class="no-print text-warning font-weight-bold"> New Page Start </p>

        <div class="container mt-5">

            <div class="text-center">
                <p class="" style="font-size: 25px">NUTRA-MED PACKAGING </p>
                <p class="font-weight-bold text-uppercase" style="font-size:25px">Printmat Inspection and Destruction
                    Report
                </p>
            </div>

            <div class="text-right">
                <span> Order Id : <span class="font-weight-bold">{{$data['orderDetails']->orderId}}</span> </span>
            </div>

            <div class="border p-2">
                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> PRODUCT: <span>{{ $data['orderDetails']->productName}}</span> </p>
                    <p class="font-weight-bold ">RM#: <span>____________</span></p>
                </div>

                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> CUSTOMER:
                        <span>{{$data['orderDetails']->customers->customer_name}}</span>
                    </p>
                    <p class="font-weight-bold ">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                    <p class="font-weight-bold ">Exp: <span>{{$data['orderDetails']->Exp}}</span></p>
                </div>

                <div class="text-right">
                    <span class="font-weight-bold">Machine#: ____________</span>
                </div>
            </div>


            <div class="row mb-4">
                <div class="col-12">
                    <span># of Printmat Received: <span class="border-bottom d-inline-block"
                            style="width: 100px;">&nbsp;</span></span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <strong>INSPECTION RESULTS:</strong>
                </div>
                <div class="col-3 text-center">
                    <strong>Accept</strong>
                </div>
                <div class="col-3 text-center">
                    <strong>Reject</strong>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">1. Correct Copy and Spelling</div>
                <div class="col-3 text-center">
                    <span class="border-bottom d-inline-block w-75">&nbsp;</span>
                </div>
                <div class="col-3 text-center">
                    <span class="border-bottom d-inline-block w-75">&nbsp;</span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">2. Correct Lot# and Exp. Date</div>
                <div class="col-3 text-center">
                    <span class="border-bottom d-inline-block w-75">&nbsp;</span>
                </div>
                <div class="col-3 text-center">
                    <span class="border-bottom d-inline-block w-75">&nbsp;</span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">3. Quality of Characters</div>
                <div class="col-3 text-center">
                    <span class="border-bottom d-inline-block w-75">&nbsp;</span>
                </div>
                <div class="col-3 text-center">
                    <span class="border-bottom d-inline-block w-75">&nbsp;</span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">4. Lot# and Exp. date Compared against the Information supplied by the customer</div>
                <div class="col-3 text-center">
                    <span class="border-bottom d-inline-block w-75">&nbsp;</span>
                </div>
                <div class="col-3 text-center">
                    <span class="border-bottom d-inline-block w-75">&nbsp;</span>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <div>COMMENTS:

                        <span class="border-bottom d-inline-block w-75">&nbsp;</span> <br>
                        <span class="border-bottom d-inline-block w-75 mt-1">&nbsp;</span>

                    </div>

                </div>
            </div>

            <div class="row mb-3">
                <div class="col-2">Inspected By:</div>
                <div class="col-4 border-bottom"></div>
                <div class="col-2">Date:</div>
                <div class="col-4 border-bottom"></div>
            </div>

            <div class="row mb-4">
                <div class="col-2">Approved By:</div>
                <div class="col-4 border-bottom"></div>
                <div class="col-2">Date:</div>
                <div class="col-4 border-bottom"></div>
            </div>

            <div class="row mb-3">
                <div class="col-12 text-center">
                    <h5>PRINTMAT DESTRUCTION REPORT</h5>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-2"># of Printmat Destroyed:</div>
                <div class="col-10 border-bottom"></div>
            </div>

            <div class="row mb-3">
                <div class="col-2">Destroyed By:</div>
                <div class="col-4 border-bottom"></div>
                <div class="col-2">Date:</div>
                <div class="col-4 border-bottom"></div>
            </div>

            <div class="row mb-3">
                <div class="col-2">Witnessed By:</div>
                <div class="col-4 border-bottom"></div>
                <div class="col-2">Date:</div>
                <div class="col-4 border-bottom"></div>
            </div>


            <!-- Footer Section -->
            <div class="footer mt-5 pt-3 ">
                <div class="row ">
                    <div class="col-6">
                        <div>
                            <span class="mr-1">
                                Form: <span># 007-1</span>
                            </span>
                            <span class="mr-2">
                                Rev: <span>{{$data['rev']}}</span>
                            </span>
                            <span>
                                Issued: <span>{{
                                    \Carbon\Carbon::parse($data['orderDetails']->created_at)->format('m/Y')}}</span>
                            </span>

                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <div>Seq. No. <span> 3 of 13</span></div>
                    </div>
                </div>
            </div>
        </div>




        {{-- Third Page for Equipment/room cleaning report minorclean-up--}}

        <div class="page-break"></div> <!-- Page break -->
        <p class="no-print text-warning font-weight-bold"> New Page Start </p>


        <div class="container">
            <div class="text-center">
                <p class="" style="font-size: 25px">NUTRA-MED PACKAGING </p>
                <p class="font-weight-bold text-uppercase" style="font-size:25px">Equipment/room cleaning report
                    <br> minor clean-up
                </p>
            </div>
            <div class="text-right">
                <span> Order Id : <span class="font-weight-bold">{{$data['orderDetails']->orderId}}</span> </span>
            </div>

            <div class="border p-2">
                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> PRODUCT: <span>{{ $data['orderDetails']->productName}}</span> </p>
                    <p class="font-weight-bold ">RM#: <span>____________</span></p>
                </div>

                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> CUSTOMER:
                        <span>{{$data['orderDetails']->customers->customer_name}}</span>
                    </p>
                    <p class="font-weight-bold ">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                    <p class="font-weight-bold ">Exp: <span>{{$data['orderDetails']->Exp}}</span></p>
                </div>

                <div class="text-right">
                    <span class="font-weight-bold">Machine#: ____________</span>
                </div>
            </div>




            <div class="mt-4">
                <h6 class="text-left font-weight-bold">ALL CLEANING IS PERFORMED ACCORDING TO SOP # 008</h6>

                <div class="text-right">
                    <h6 class="">Cleaning performed By</h6>
                </div>


                <div class="row m-0 ">
                    <div class="col-10">
                        <p><strong class="mr-2">1</strong>
                            <span class="font-weight-bold">EQUIPMENT AND ROOM CLEANING :</span> <br>
                            All machine parts that come in contact with the product have been cleaned in accordance with
                            the
                            Minor clean-up written procedures. Product and product residue is removed from all parts of
                            the
                            machine. (Product hopper, vibrator, feeder, brush feeder and all other parts of the
                            machine.)
                        </p>
                    </div>
                    <div class="col-2 d-flex align-items-center">
                        <div class="border " style="width: 100%; height:50px;"></div>
                    </div>
                </div>
                <hr class="mt-0">


                <div class="row m-0">
                    <div class="col-10">
                        <p><strong class="mr-2">2</strong> <span class="font-weight-bold">MACHINE AND AUXILIARY
                                EQUIPMENT</span>
                            <br>All auxiliary equipment are cleaned as per the minor cleaning SOP.
                        </p>
                    </div>
                    <div class="col-2 d-flex align-items-center">
                        <div class="border " style="width: 100%; height:50px;"></div>
                    </div>
                </div>

                <hr class="mt-0">



                <p class="font-weight-bold">PACKAGING ROOM AND CARTONING ROOM CLEANING :</p>


                <div class="row m-0">
                    <div class="col-10">
                        <p><strong class="mr-2">3</strong> All previous finished product, excess bulk, waste product,
                            components, labeling, identification, documents, printmat, samples, empty blisters, previous
                            film
                            and foil rolls, film and foil web from the machine are removed from the room.</p>
                    </div>
                    <div class="col-2 d-flex align-items-center">
                        <div class="border " style="width: 100%; height:50px;"></div>
                    </div>
                </div>



                <div class="row m-0">
                    <div class="col-10">
                        <p><strong class="mr-2">4</strong> The entire area, floor, is swept, mopped and cleaned. The
                            trash
                            and
                            other
                            containers, are emptied and cleaned.</p>
                    </div>
                    <div class="col-2 d-flex align-items-center">
                        <div class="border " style="width: 100%; height:50px;"></div>
                    </div>
                </div>



                <div class="row m-1">
                    <div class="col-10">
                        <p><strong class="mr-2">5</strong> The wall, ceiling tiles, hanging cables, conveyor, tables,
                            stools,
                            mechanic
                            tool box, shelves to keep the file and documents are cleaned.</p>
                    </div>
                    <div class="col-2 d-flex align-items-center">
                        <div class="border " style="width: 100%; height:50px;"></div>
                    </div>
                </div>

                <hr class="mt-0 ">


                <div class="border p-2 mt-5 mb-5">

                    <p><strong>Cleaning verified by :</strong> <span class="border-bottom w-50 d-inline-block"></span>
                        <strong>Date:</strong> <span class="border-bottom w-25 d-inline-block"></span>
                    </p>
                </div>


                <p class="font-weight-bold">I have thoroughly inspected the entire area, the machine and machine parts
                    for
                    proper cleaning. The packaging line is properly cleaned and the line is free from previous product
                    components. I am approving this area and the machine for packaging next product.</p>

                <p><strong>Production:</strong> <span class="border-bottom w-50 d-inline-block"></span>
                    <strong>Date:</strong>
                    <span class="border-bottom w-25 d-inline-block"></span>
                </p>

                <p><strong>Quality Assurance:</strong> <span class="border-bottom w-50 d-inline-block"></span>
                    <strong>Date:</strong> <span class="border-bottom w-25 d-inline-block"></span>
                </p>
            </div>


            <!-- Footer Section -->
            <div class="footer mt-5 pt-3 ">
                <div class="row ">
                    <div class="col-6">
                        <div>
                            <span class="mr-1">
                                Form: <span># 008-2</span>
                            </span>
                            <span class="mr-1">
                                Rev: <span>{{$data['rev']}}</span>
                            </span>
                            <span>
                                Issued: <span>{{
                                    \Carbon\Carbon::parse($data['orderDetails']->created_at)->format('m/Y')}}</span>
                            </span>

                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <div>Seq. No. <span>1 of 13</span></div>
                    </div>
                </div>
            </div>



        </div>


        {{-- Fourth Page for LABEL ISSUANCE AND RECONCILIATION REPORT --}}

        <div class="page-break"></div> <!-- Page break -->
        <p class="no-print text-warning font-weight-bold"> New Page Start </p>


        <div class="container">
            <div class="text-center">
                <p class="" style="font-size: 25px">NUTRA-MED PACKAGING </p>
                <p class="font-weight-bold text-uppercase" style="font-size:25px">LABEL ISSUANCE AND RECONCILIATION
                    REPORT
                </p>
            </div>

            <div class="text-right">
                <span> Order Id : <span class="font-weight-bold">{{$data['orderDetails']->orderId}}</span> </span>
            </div>

            <div class="border p-2">
                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> PRODUCT: <span>{{ $data['orderDetails']->productName}}</span> </p>
                    <p class="font-weight-bold ">RM#: <span>____________</span></p>
                </div>

                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> CUSTOMER:
                        <span>{{$data['orderDetails']->customers->customer_name}}</span>
                    </p>
                    <p class="font-weight-bold ">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                    <p class="font-weight-bold ">Exp: <span>{{$data['orderDetails']->Exp}}</span></p>
                </div>

                <div class="text-right">
                    <span class="font-weight-bold">F Prod.#: <span>{{$data['orderDetails']->fProduct}}</span></span>
                </div>
            </div>


            <hr class="mt-0">

            <div class=" border-top border-bottom p-4 mb-3 ">
                <div class="row font-weight-bold">
                    <div class="col-6">LABELS USED FOR: <span
                            class="border-bottom d-inline-block w-50 mt-1">&nbsp;</span>
                    </div>
                    <div class="col-6">QUANTITY REQUIRED: <span
                            class="border-bottom d-inline-block w-50 mt-1">&nbsp;</span>
                    </div>
                </div>

                <div class="row font-weight-bold">
                    <div class="col-4">Quantity Issued: <span
                            class="border-bottom d-inline-block w-50 mt-1">&nbsp;</span>
                    </div>
                    <div class="col-4">By: <span class="border-bottom d-inline-block w-50 mt-1">&nbsp;</span>
                    </div>
                    <div class="col-4">Date: <span class="border-bottom d-inline-block w-50 mt-1">&nbsp;</span>
                    </div>
                </div>

                <div class="row font-weight-bold">
                    <div class="col-4">Quantity Issued: <span
                            class="border-bottom d-inline-block w-50 mt-1">&nbsp;</span>
                    </div>
                    <div class="col-4">By: <span class="border-bottom d-inline-block w-50 mt-1">&nbsp;</span>
                    </div>
                    <div class="col-4">Date: <span class="border-bottom d-inline-block w-50 mt-1">&nbsp;</span>
                    </div>
                </div>

                <div class="row font-weight-bold">
                    <div class="col-4">Quantity Issued: <span
                            class="border-bottom d-inline-block w-50 mt-1">&nbsp;</span>
                    </div>
                    <div class="col-4">By: <span class="border-bottom d-inline-block w-50 mt-1">&nbsp;</span>
                    </div>
                    <div class="col-4">Date: <span class="border-bottom d-inline-block w-50 mt-1">&nbsp;</span>
                    </div>
                </div>

                <div class="row font-weight-bold">
                    <div class="col-6">TOTAL ISSUED: <span class="border-bottom d-inline-block w-75 mt-1">&nbsp;</span>
                    </div>

                </div>

            </div>


            <div class="row mt-2 font-weight-bold">
                <div class="col-6">Quantity used for Packaging :
                </div>
                <div class="col-6">
                    <span class="border-bottom d-inline-block w-75 mt-1">&nbsp;</span>
                </div>
            </div>


            <div class="row mt-2 font-weight-bold">
                <div class="col-6">Quantity waste :
                </div>
                <div class="col-6">
                    <span class="border-bottom d-inline-block w-75 mt-1">&nbsp;</span>
                </div>
            </div>


            <div class="row mt-2 font-weight-bold">
                <div class="col-6">Quantity Returned :
                </div>
                <div class="col-6">
                    <span class="border-bottom d-inline-block w-75 mt-1">&nbsp;</span>
                </div>
            </div>

            <div class="row mt-2 font-weight-bold ">
                <div class="col-6">Retain + Q A Sample :
                </div>
                <div class="col-6">
                    <span class="border-bottom d-inline-block w-75 mt-1">&nbsp;</span>
                </div>
            </div>

            <div class="row mt-2 font-weight-bold ">
                <div class="col-6">Customer Sample :
                </div>
                <div class="col-6">
                    <span class="border-bottom d-inline-block w-75 mt-1">&nbsp;</span>
                </div>
            </div>

            <div class="row mt-2 font-weight-bold ">
                <div class="col-6">Other :
                </div>
                <div class="col-6">
                    <span class="border-bottom d-inline-block w-75 mt-1">&nbsp;</span>
                </div>
            </div>

            <div class="row mt-2 font-weight-bold ">
                <div class="col-6">Quantity Accounted:
                </div>
                <div class="col-6">
                    <span class="border-bottom d-inline-block w-75 mt-1">&nbsp;</span>
                </div>
            </div>

            <div class="row mt-2 font-weight-bold ">
                <div class="col-6">Quantity Destroyed:
                </div>
                <div class="col-6">
                    <span class="border-bottom d-inline-block w-75 mt-1">&nbsp;</span>
                </div>
            </div>



            <div class="mt-5">
                <div class="row mb-3 font-weight-bold">
                    <div class="col-2">PERFORMED By:</div>
                    <div class="col-4 border-bottom"></div>
                    <div class="col-2">DATE:</div>
                    <div class="col-4 border-bottom"></div>
                </div>

                <div class="row mb-4 font-weight-bold">
                    <div class="col-2">REVIEWED By:</div>
                    <div class="col-4 border-bottom"></div>
                    <div class="col-2">DATE:</div>
                    <div class="col-4 border-bottom"></div>
                </div>
            </div>

            <!-- Footer Section -->
            <div class="footer mt-5 pt-3 ">
                <div class="row ">
                    <div class="col-6">
                        <div>
                            <span class="mr-1">
                                Form: <span># 007-2</span>
                            </span>
                            <span class="mr-1">
                                Rev: <span>{{$data['rev']}}</span>
                            </span>
                            <span>
                                Issued: <span>{{
                                    \Carbon\Carbon::parse($data['orderDetails']->created_at)->format('m/Y')}}</span>
                            </span>

                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <div>Seq. No. <span>5 of 13</span></div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    {{---------------------------------- Inspection 2-3-5 form close--------------------------------------------}}





    {{---------------------------------- Inspection 6-8-10 form start--------------------------------------------}}
    <div class="page-break mb-5"></div> <!-- Page break -->

    <div class="Inspection 6-8-10 form">

        <div class="container mb-5">

            <div class="page_heading">
                <div class="text-center">
                    <p class="" style="font-size: 25px">NUTRA-MED PACKAGING</p>
                    <p class="font-weight-bold text-uppercase" style="font-size:25px">LINE CLEARANCE FORM</p>
                </div>
                <div class="text-right">
                    <span> Order Id: <span class="font-weight-bold"> {{$data['orderDetails']->orderId}} </span> </span>
                </div>

                <div class="border p-2">
                    <div class="d-flex justify-content-between">
                        <p class="font-weight-bold"> PRODUCT: <span>{{$data['orderDetails']->productName}}</span> </p>
                        <p class="font-weight-bold">RM#: <span>____________</span></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="font-weight-bold"> CUSTOMER: <span>
                                {{$data['orderDetails']->customers->customer_name}}
                            </span>
                        </p>
                        <p class="font-weight-bold">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                        <p class="font-weight-bold">Exp: <span>{{$data['orderDetails']->Exp}}</span></p>
                    </div>
                </div>
            </div>


            <div class=" mt-1">
                <table class="table table-bordered table-sm text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>Component</th>
                            <th>Lot#</th>
                            <th>Exp. Date</th>
                            <th>Code #</th>
                        </tr>
                    </thead>
                    <tbody>


                        @php
                        $compName = json_decode($data['orderDetails']->compName, true);
                        $compCode=json_decode($data['orderDetails']->compCode, true);
                        @endphp

                        @if($compName)
                        @foreach($compName as $key => $value)
                        <tr>
                            <td>{{$compName[$key]}}</td>
                            <td class="">___________________</td>
                            <td class="">___________________</td>
                            <td>{{$compCode[$key]}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td class="">___________________</td>
                            <td class="">___________________</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="">___________________</td>
                            <td class="">___________________</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="">___________________</td>
                            <td class="">___________________</td>
                            <td></td>
                        </tr>
                        @endif



                    </tbody>
                </table>
            </div>

            <hr>

            <div class="row font-weight-bold text-center">
                <div class="col-8"></div>
                <div class="col-2">PRODUCTION</div>
                <div class="col-2">QA</div>
            </div>
            <br>
            <div class="row font-weight-bold">
                <div class="col-8">
                    1. The room machine and other equipment are clean. Floor is swept and mopped. Walls and ceiling
                    tiles
                    are
                    clean.
                </div>
                <div class="col-2 ">
                    <div class="p-2 border-bottom w-100"> </div>
                </div>
                <div class="col-2">
                    <div class="p-2 border-bottom w-100"></div>
                </div>
            </div>
            <br>
            <div class="row font-weight-bold">
                <div class="col-8">
                    2. Equipment has been cleaned and clean-up form is approved by QA (for Product change only).
                </div>
                <div class="col-2 ">
                    <div class="p-2 border-bottom w-100"> </div>
                </div>
                <div class="col-2">
                    <div class="p-2 border-bottom w-100"></div>
                </div>
            </div>

            <br>
            <div class="row font-weight-bold">
                <div class="col-8">
                    3. The product, packages and all the components listed above Have been checked and they meet
                    required
                    specification.
                </div>
                <div class="col-2 ">
                    <div class="p-2 border-bottom w-100"> </div>
                </div>
                <div class="col-2">
                    <div class="p-2 border-bottom w-100"></div>
                </div>
            </div>

            <br>
            <div class="row font-weight-bold">
                <div class="col-8">
                    4. All labels, hand stamp, machine plates and other lot#/Exp.date are correct on all components.
                </div>
                <div class="col-2 ">
                    <div class="p-2 border-bottom w-100"> </div>
                </div>
                <div class="col-2">
                    <div class="p-2 border-bottom w-100"></div>
                </div>
            </div>
            <br>
            <hr style="border: 0.5px solid ;">

            <div class="row font-weight-bold">
                <div class="col-8">
                    Bulk Product visual ID test performed using product reference standard by QA.
                </div>
                <div class="col-4">
                    <div class="p-2 border-bottom w-100"></div>
                </div>
            </div>

            <hr style="border: 0.5px solid ;">
            <div class="border font-weight-bold">
                <p class="p-1">I have checked all the attached components and verified all the lot#, Exp.date and
                    code#s.
                    All
                    components
                    meet required specification. A copy of all labeling is attached.</p>
            </div>

            <hr style="border: 0.5px solid ;">


            <div class="mt-3">
                <div class="row mb-3 font-weight-bold">
                    <div class="col-2">APPROVED BY:</div>
                    <div class="col-4 border-bottom"></div>
                    <div class="col-2">DATE:</div>
                    <div class="col-4 border-bottom"></div>
                </div>

                <div class="row mb-4 font-weight-bold">
                    <div class="col-2">APPROVED BY QA:</div>
                    <div class="col-4 border-bottom"></div>
                    <div class="col-2">DATE:</div>
                    <div class="col-4 border-bottom"></div>
                </div>
            </div>



            <!-- Footer Section -->
            <div class="footer mt-5 pt-3 ">
                <div class="row ">
                    <div class="col-6">
                        <div>
                            <span class="mr-1">
                                Form: <span># 015-1</span>
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
                    <div class="col-6 text-right">
                        <div>Seq. No. <span>06 of 13</span></div>
                    </div>
                </div>
            </div>


        </div>

        {{-- Second page of Pallet Release Form --}}
        <div class="page-break"></div> <!-- Page break -->


        <div class="container mt-5">

            <div class="page_heading">
                <div class="text-center">
                    <p class="" style="font-size: 25px">NUTRA-MED PACKAGING</p>
                    <p class="font-weight-bold text-uppercase" style="font-size:25px">PALLET RELEASE FORM</p>
                </div>
                <div class="text-right">
                    <span> Order Id: <span class="font-weight-bold"> {{$data['orderDetails']->orderId}} </span> </span>
                </div>

                <div class="border p-2">
                    <div class="d-flex justify-content-between">
                        <p class="font-weight-bold"> PRODUCT: <span>{{$data['orderDetails']->productName}}</span> </p>
                        <p class="font-weight-bold">RM#: <span>____________</span></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="font-weight-bold"> CUSTOMER: <span>
                                {{$data['orderDetails']->customers->customer_name}}
                            </span>
                        </p>
                        <p class="font-weight-bold">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                        <p class="font-weight-bold">Exp: <span>{{$data['orderDetails']->Exp}}</span></p>
                    </div>
                </div>
            </div>


            <div class=" mt-1">
                <table class="table table-bordered table-md text-center">
                    <thead class="thead-light">
                        <tr>
                            <th class="border">Pallet#</th>
                            <th class="border">DATE</th>
                            <th class="border">Time</th>
                            <th class="border">CASE # TO CASE #</th>
                            <th class="border">Cases/Pallet</th>
                            <th class="border">QA Inspector</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i=1; $i<=20; $i++) <tr>
                            <td class="border">{{$i}}</td>
                            <td class="border"></td>
                            <td class="border"></td>
                            <td class="border"></td>
                            <td class="border"></td>
                            <td class="border"></td>
                            </tr>
                            @endfor

                    </tbody>
                </table>

            </div>



            <!-- Footer Section -->
            <div class="footer mt-5 pt-3 ">
                <div class="row ">
                    <div class="col-6">
                        <div>

                            <span class="mr-1">
                                Form: <span># 017-13</span>
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
                    {{-- <div class="col-6 text-right">
                        <div>Seq. No. <span> </span></div>
                    </div> --}}
                </div>
            </div>


        </div>


        {{-- Third page of Material Waste Report --}}
        <div class="page-break"></div> <!-- Page break -->

        <div class="container mt-5">

            <div class="page_heading">
                <div class="text-center">
                    <p class="" style="font-size: 25px">NUTRA-MED PACKAGING</p>
                    <p class="font-weight-bold text-uppercase" style="font-size:25px">Material Waste Report</p>
                </div>
                <div class="text-right">
                    <span> Order Id: <span class="font-weight-bold"> {{$data['orderDetails']->orderId}} </span> </span>
                </div>

                <div class="border p-2">
                    <div class="d-flex justify-content-between">
                        <p class="font-weight-bold"> PRODUCT: <span>{{$data['orderDetails']->productName}}</span> </p>
                        <p class="font-weight-bold">RM#: <span>____________</span></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="font-weight-bold"> CUSTOMER: <span>
                                {{$data['orderDetails']->customers->customer_name}}
                            </span>
                        </p>
                        <p class="font-weight-bold">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                        <p class="font-weight-bold">Exp: <span>{{$data['orderDetails']->Exp}}</span></p>
                    </div>
                </div>
            </div>

            <div class=" mt-1">
                <table class="table table-bordered table-md text-center">
                    <thead class="thead-light">
                        <tr>
                            <th class="border">Component</th>
                            <th class="border">Quantity</th>
                            <th class="border">Disposition</th>
                            <th class="border">Counted by and Date</th>
                            <th class="border">Verified by and Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php
                        $compName= json_decode($data['orderDetails']->compName);
                        @endphp

                        @foreach ($compName as $item)
                        <tr>
                            <td class="border">{{$item}}</td>
                            <td class="border"></td>
                            <td class="border"></td>
                            <td class="border"></td>
                            <td class="border"></td>
                        </tr>
                        @endforeach
                        <tr>
                            <td class="border">.</td>
                            <td class="border"></td>
                            <td class="border"></td>
                            <td class="border"></td>
                            <td class="border"></td>
                        </tr>
                        <tr>
                            <td class="border">.</td>
                            <td class="border"></td>
                            <td class="border"></td>
                            <td class="border"></td>
                            <td class="border"></td>
                        </tr>
                        <tr>
                            <td class="border">.</td>
                            <td class="border"></td>
                            <td class="border"></td>
                            <td class="border"></td>
                            <td class="border"></td>
                        </tr>
                        <tr>
                            <td class="border">.</td>
                            <td class="border"></td>
                            <td class="border"></td>
                            <td class="border"></td>
                            <td class="border"></td>
                        </tr>
                        <tr>
                            <td class="border">.</td>
                            <td class="border"></td>
                            <td class="border"></td>
                            <td class="border"></td>
                            <td class="border"></td>
                        </tr>


                    </tbody>
                </table>
            </div>

            <div class="mt-5">
                <div class="row mb-3 font-weight-bold">
                    <div class="col-2">APPROVED BY:</div>
                    <div class="col-4 border-bottom"></div>
                    <div class="col-2">DATE:</div>
                    <div class="col-4 border-bottom"></div>
                </div>
            </div>



            <!-- Footer Section -->
            <div class="footer mt-5 pt-3 ">
                <div class="row ">
                    <div class="col-6">
                        <div>
                            <span class="mr-1">
                                Form: <span># 020-1</span>
                            </span>
                            <span class="mr-2">
                                Rev: <span id="revision">{{$data['rev']}}</span>
                            </span>
                            <span>
                                Issued: <span>{{
                                    \Carbon\Carbon::parse($data['orderDetails']->created_at)->format('m/Y')}}</span>
                            </span>

                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <div>Seq. No. <span>8 of 13</span></div>
                    </div>
                </div>
            </div>

        </div>


        {{-- Fourt page of Lot release Report --}}
        <div class="page-break"></div> <!-- Page break -->

        <div class="container mt-5">

            <div class="page_heading">
                <div class="text-center">
                    <p class="" style="font-size: 25px">NUTRA-MED PACKAGING</p>
                    <p class="font-weight-bold text-uppercase" style="font-size:25px">LOT RELEASE Report</p>
                </div>
                <div class="text-right">
                    <span> Order Id: <span class="font-weight-bold"> {{$data['orderDetails']->orderId}} </span> </span>
                </div>

                <div class="border p-2">
                    <div class="d-flex justify-content-between">
                        <p class="font-weight-bold"> PRODUCT: <span>{{$data['orderDetails']->productName}}</span> </p>
                        <p class="font-weight-bold">RM#: <span>____________</span></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="font-weight-bold"> CUSTOMER: <span>
                                {{$data['orderDetails']->customers->customer_name}}
                            </span>
                        </p>
                        <p class="font-weight-bold">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                        <p class="font-weight-bold">Exp: <span>{{$data['orderDetails']->Exp}}</span></p>
                    </div>
                </div>
            </div>

            <div class="mt-1">

                <h6 class="text-center mb-5">
                    The following is released by Quality Assurance for the following: <br>
                    Shipment[ ] Secondary Packaging [ ]
                </h6>

                <div class="row">
                    <div class="col-2 font-weight-bold">
                        Full Pallets
                    </div>
                    <div class="col-8">

                        <table class=" table-sm text-center">
                            <thead>
                                <tr>
                                    <th>________________________X</th>
                                    <th>________________________X</th>
                                    <th>________________________=</th>
                                    <th>________________________</th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr>

                                    <td># of Full Pallets</td>
                                    <td># of Cases/Pallet</td>
                                    <td>Units/Case</td>
                                    <td>Units (a)</td>

                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col-2 font-weight-bold">
                        Partial Pallets
                    </div>
                    <div class="col-8 d-flex justify-content-end">
                        <table class=" table-sm text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>________________________X</th>
                                    <th>________________________=</th>
                                    <th>________________________</th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr>

                                    <td></td>
                                    <td># of Cases</td>
                                    <td>Units/Case</td>
                                    <td>Units (b)</td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-2 font-weight-bold">
                        Partial Case
                    </div>
                    <div class="col-8 d-flex justify-content-end">
                        <table class=" table-sm text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>________________________=</th>
                                    <th>________________________</th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Units/Case</td>
                                    <td>Units (c)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-2 font-weight-bold">
                        Total (a)+(b)+(c)=
                    </div>
                    <div class="col-8 d-flex justify-content-start font-weight-bold">
                        <p>__________________________On__________________________Pallets.</p>
                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col-2 font-weight-bold">
                        Comments:
                    </div>
                    <div class="col-8 d-flex justify-content-start">
                        <div class="border-bottom w-100 border-dark"></div>
                    </div>

                    <div class="col-12 mt-5 d-flex justify-content-start">
                        <div class="border-bottom w-100 border-dark"></div>
                    </div>

                    <div class="col-12 mt-5 d-flex justify-content-start">
                        <div class="border-bottom w-100 border-dark"></div>
                    </div>

                </div>


                <div class="mt-3">
                    <p class="font-weight-bold">Are samples to accompany this shipment? Yes / No</p>
                    <p class="font-weight-bold">All related investigations closed? Na / Yes / No</p>
                </div>

                <div class="mt-3">
                    <div class="row font-weight-bold">
                        <div class="col-2">RELEASED BY:</div>
                        <div class="col-4 border-bottom border-dark"></div>
                        <div class="col-2">DATE:</div>
                        <div class="col-4 border-bottom border-dark"></div>
                    </div>
                    <div class="row font-weight-bold text-center">
                        <div class="col-2"></div>
                        <div class="col-4 ">Quality Assurance</div>
                        <div class="col-2"></div>
                        <div class="col-4"></div>
                    </div>
                </div>
            </div>


            <!-- Footer Section -->
            <div class="footer mt-5 pt-3 ">
                <div class="row ">
                    <div class="col-6">
                        <div>
                            <span class="mr-1">
                                Form: <span># 019-5</span>
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
                    <div class="col-6 text-right">
                        <div>Seq. No. <span>10 of 13</span></div>
                    </div>
                </div>
            </div>


        </div>

    </div>
    {{---------------------------------- Indecption 6-8-10 form close--------------------------------------------}}



    {{---------------------- Inspection 11-12 line/pallet form start--------------------------------------}}
    <div class="page-break mb-5"></div> <!-- Page break -->

    <div class="Inspection 11-12 ">

        <div class="container mb-5">

            <div class="page_heading">
                <div class="text-center">
                    <p class="" style="font-size: 25px">NUTRA-MED PACKAGING</p>
                    <p class="font-weight-bold text-uppercase" style="font-size:25px">Certificate of Compliance</p>
                </div>
                <div class="text-right">
                    <span> Order Id: <span class="font-weight-bold"> {{$data['orderDetails']->orderId}} </span> </span>
                </div>

                <div class="border p-2">
                    <div class="d-flex justify-content-between">
                        <p class="font-weight-bold"> PRODUCT: <span>{{$data['orderDetails']->productName}}</span> </p>
                        <p class="font-weight-bold">RM#: <span>____________</span></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="font-weight-bold"> CUSTOMER: <span>
                                {{$data['orderDetails']->customers->customer_name}}
                            </span>
                        </p>
                        <p class="font-weight-bold">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                        <p class="font-weight-bold">Exp: <span>{{$data['orderDetails']->Exp ? $data['orderDetails']->Exp
                                :'NA'}}</span>
                        </p>
                    </div>
                </div>
            </div>



            <div class="mt-3">
                <p>This is to certify that the above product was produced in compliance with cGMP standards and meets
                    established Nutra-Med and/or customer specifications.</p>

                <p>Following batch records were reviewed and have been found to be in compliance with the cGMP and
                    Nutra-Med
                    and/or customer's specifications.</p>

                <p>Package Type: [ ] Blister [ ] Bottle [ ] Primary [ ] Secondary</p>
            </div>

            <div class="mt-2">

                <div class="container mt-4">
                    <table class="table table-sm table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Sr No</th>
                                <th>Document Name</th>
                                <th># Form</th>
                                <th>QA Check</th>
                                <th># of Pages</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>1</td>
                                <td>Packaging Order</td>
                                <td># 003-1</td>
                                <td>________</td>
                                <td>________</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Equipment/Room Cleaning Report (Major)</td>
                                <td># 008-1</td>
                                <td>________</td>
                                <td>________</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Equipment/Room Cleaning Report (Minor)</td>
                                <td># 008-2</td>
                                <td>________</td>
                                <td>________</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>PrintMat Inspection & Destruction</td>
                                <td># 007-1</td>
                                <td>________</td>
                                <td>________</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Material Transfer Report</td>
                                <td># 014-2</td>
                                <td>________</td>
                                <td>________</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Label Issuance & Reconciliation Report</td>
                                <td># 007-2</td>
                                <td>________</td>
                                <td>________</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Line Clearance Form</td>
                                <td># 015-1</td>
                                <td>________</td>
                                <td>________</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>In-Process Inspection Report</td>
                                <td># 017-3</td>
                                <td>________</td>
                                <td>________</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Material Waste Report</td>
                                <td># 020-1</td>
                                <td>________</td>
                                <td>________</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Reconciliation Report</td>
                                <td># 019-1</td>
                                <td>________</td>
                                <td>________</td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Lot Release Report</td>
                                <td># 019-5</td>
                                <td>________</td>
                                <td>________</td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td>Certificate of Compliance</td>
                                <td># 019-4</td>
                                <td>________</td>
                                <td>________</td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td>Event Log</td>
                                <td># 017-7</td>
                                <td>________</td>
                                <td>________</td>
                            </tr>
                            <tr>
                                <td>13</td>
                                <td>Process Parameters Report</td>
                                <td># 017-06</td>
                                <td>________</td>
                                <td>________</td>
                            </tr>
                            <tr class="font-weight-bold">
                                <td>14</td>
                                <td>Ancillary Documents</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>


                            <tr>
                                <td>14.1</td>
                                <td>Counting Scale Setup</td>
                                <td># F017-10/11</td>
                                <td>________</td>
                                <td>________</td>
                            </tr>
                            <tr>
                                <td>14.2</td>
                                <td>Weight Verification</td>
                                <td># F005-6</td>
                                <td>________</td>
                                <td>________</td>
                            </tr>
                            <tr>
                                <td>14.3</td>
                                <td>Printed Material Issuance</td>
                                <td># 014-3</td>
                                <td>________</td>
                                <td>________</td>
                            </tr>
                            <tr>
                                <td>14.4</td>
                                <td>Other</td>
                                <td>________</td>
                                <td>________</td>
                                <td>________</td>
                            </tr>
                            <tr>
                                <td>14.5</td>
                                <td>Other</td>
                                <td>________</td>
                                <td>________</td>
                                <td>________</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <p>
                    Any/All Cross outs are Initialed and Dated <span class="ml-5">Initial and
                        Date:_______________________</span>
                </p>

                <h6>
                    All Pages are Included and in Proper Order. Total # of Pages in Batch Records: _________
                </h6>

                <div class="mt-3">
                    <div class="row mb-3 font-weight-bold">
                        <div class="col-2">Quality Assurance:</div>
                        <div class="col-4 border-bottom"></div>
                        <div class="col-2">DATE:</div>
                        <div class="col-4 border-bottom"></div>
                    </div>
                </div>


                <!-- Footer Section -->
                <div class="footer mt-5 pt-3 ">
                    <div class="row ">
                        <div class="col-6">
                            <div>

                                <span class="mr-1">
                                    Form: <span># 019-4</span>
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
                        <div class="col-6 text-right">
                            <div>Seq. No. <span>11 of 13</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Second page of Line Identification Form --}}
        <div class="page-break"></div> <!-- Page break -->

        <div class="container mb-5">
            <div class="page_heading">
                <div class="text-center">
                    <p class="" style="font-size: 25px">NUTRA-MED PACKAGING</p>
                    <p class="font-weight-bold text-uppercase" style="font-size:25px">Line Identification</p>
                </div>


                <div class=" mt-5">
                    <h6> Order Id: {{$data['orderDetails']->orderId}} </h6>


                    <p class="font-weight-bold"> PRODUCT: <span>{{$data['orderDetails']->productName}}</span> </p><br>

                    <p class="font-weight-bold"> CUSTOMER: <span> {{$data['orderDetails']->customers->customer_name}}
                        </span>
                    </p>

                    <p class="font-weight-bold">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                    <p class="font-weight-bold">Exp: <span>{{$data['orderDetails']->Exp ? $data['orderDetails']->Exp
                            :'NA' }}</span></p>



                </div>
            </div>


            <div class="mt-5 font-weight-bold">

                <p>Total People: &nbsp; 6 + 1 line leader </p>

                <table class="table table text-center">
                    <tr>
                        <td>Machine Speed: </td>
                        <td>Target</td>
                        <td>Good</td>
                        <td>Very Good</td>
                        <td>Excellent</td>
                    </tr>
                    <tr>
                        <td> </td>
                        <td>____</td>
                        <td>____</td>
                        <td>____</td>
                        <td>____</td>
                    </tr>
                    <tr>
                        <td>Total/Shift </td>
                        <td>____</td>
                        <td>____</td>
                        <td>____</td>
                        <td>____</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Third page of Event Form --}}
        <div class="page-break"></div> <!-- Page break -->

        <div class="container mb-5">
            <div class="page_heading">
                <div class="text-center">
                    <p class="" style="font-size: 25px">NUTRA-MED PACKAGING</p>
                    <p class="font-weight-bold text-uppercase" style="font-size:25px">Event Log</p>
                </div>
                <div class="text-right">
                    <span> Order Id: <span class="font-weight-bold"> {{$data['orderDetails']->orderId}} </span> </span>
                </div>

                <div class="border p-2">
                    <div class="d-flex justify-content-between">
                        <p class="font-weight-bold"> PRODUCT: <span>{{$data['orderDetails']->productName}}</span> </p>
                        <p class="font-weight-bold">RM#: <span>____________</span></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="font-weight-bold"> CUSTOMER: <span>
                                {{$data['orderDetails']->customers->customer_name}}
                            </span>
                        </p>
                        <p class="font-weight-bold">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                        <p class="font-weight-bold">Exp: <span>{{$data['orderDetails']->Exp ? $data['orderDetails']->Exp
                                :'NA'}}</span>
                        </p>
                    </div>
                </div>
            </div>


            <div class="mt-5">
                <table class="table text-center table-sm text-uppercase table-border">
                    <thead>
                        <tr class="border">
                            <th class="border" style="width: 15%;">Date</th>
                            <th class="border" style="width: 15%;">Stop Time</th>
                            <th class="border" style="width: 15%;">Start Time</th>
                            <th class="border" style="width: 40%;">Reason</th>
                            <th class="border" style="width: 15%;">Initials</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= 20; $i++) <tr class="border">
                            <td class="border">&nbsp;</td>
                            <td class="border">&nbsp;</td>
                            <td class="border">&nbsp;</td>
                            <td class="border">&nbsp;</td>
                            <td class="border">&nbsp;</td>
                            </tr>
                            @endfor
                    </tbody>
                </table>
            </div>

            <!-- Footer Section -->
            <div class="footer mt-5 pt-3 ">
                <div class="row ">
                    <div class="col-6">
                        <div>
                            <span class="mr-1">
                                Form: <span># F017-7</span>
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
                    <div class="col-6 text-right">
                        <div>Seq. No. <span>12 of 13</span></div>
                    </div>
                </div>
            </div>
        </div>



        {{-- Fourth page of Pallet Label --}}
        <div class="page-break"></div> <!-- Page break -->

        <div class="container mb-5">

            <div class="page_heading">
                <div class="text-center">
                    <p class="" style="font-size: 25px">NUTRA-MED PACKAGING</p>
                    <p class="font-weight-bold text-uppercase" style="font-size:25px">Pallet Label</p>
                </div>

                <p class="text-center mt-5" style="font-size: 25px">Order#</p>

                <div class="text-center p-5 mt-5 mb-5">
                    <p class="font-weight-bold" style="font-size: 200px"> {{$data['orderDetails']->orderId}} </p>
                </div>


                <p class="font-weight-bold"> PRODUCT: <span>{{$data['orderDetails']->productName}}</span> </p><br>

                <p class="font-weight-bold"> CUSTOMER: <span> {{$data['orderDetails']->customers->customer_name}}
                    </span>
                </p>

                <p class="font-weight-bold">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                <p class="font-weight-bold">Exp: <span>{{$data['orderDetails']->Exp ? $data['orderDetails']->Exp :'NA'
                        }}</span></p>
            </div>


            <div class="container-fluid mt-5">
                <p>QUANTITY: <span>____________________________</span></p>

                <p>PALLET # <span>____________________________</span>OF <span>____________________________</span></p>

            </div>
        </div>

    </div>
    {{---------------------- Indecption 11-12 line/pallet form close--------------------------------------}}





    {{---------------------- Inspection scale weight start--------------------------------------}}
    <div class="page-break mb-5"></div> <!-- Page break -->

    <div class="Inspection Scale Weight ">


        <div class="container mb-5">

            <div class="text-center">
                <p class="" style="font-size: 25px">NUTRA-MED PACKAGING </p>
                <p class="font-weight-bold text-uppercase" style="font-size:25px">Counting Scale Set-Up form
                </p>
            </div>
            <div class="text-right">
                <span> Order Id : <span class="font-weight-bold">{{$data['orderDetails']->orderId}}</span> </span>
            </div>

            <div class="border p-2">
                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> PRODUCT: <span>{{$data['orderDetails']->productName}}</span> </p>
                    <p class="font-weight-bold ">RM#: <span>____________</span></p>
                </div>

                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> CUSTOMER:
                        <span>{{$data['orderDetails']->customers->customer_name}}</span>
                    </p>
                    <p class="font-weight-bold ">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                    <p class="font-weight-bold ">Exp: <span>{{$data['orderDetails']->Exp}}</span></p>
                </div>
            </div>



            <div class="border d-flex justify-conetent-each mt-5 p-2 font-weight-bold border-dark">
                <p>Scale Serial#:
                <p class="border-bottom w-25 border-dark">&nbsp;</p>
                </p>

                <p class="ml-5">Scale Calibration :
                <p class="border-bottom w-25 border-dark">&nbsp;</p>
                </p>
            </div>

            <div class="mt-3 font-weight-bold">
                <p>Procedure to Set-up <span class="text-dark">A & d </span>GF 200 scale:</p>
                <p>Scale used for: [ &nbsp;] Production [&nbsp; ] Quality Assurance</p>
                <div class="ml-5">

                    <ul>
                        <span>Ensure scale is level (bubble in the center) if applicable</span>
                        <li>Press the ON/OFF key.</li>
                        <li>Place one blank (empty) blister card on the pan.</li>
                        <li>Record the weight of the empty blister card.</li>
                        <li>Press the Re-Zero key (Tare the scale).</li>
                        <li>Place 10 pieces with the empty blister card and record the weight of 10 pieces.</li>
                        <li>Remove the pieces from the pan but leave the empty blister card on the pan.</li>
                        <li>Press the Tare key, and the balance will show 00.0000.</li>
                        <li>Press the MODE key. "PC" will be displayed.</li>
                        <li>Press the SAMPLE key. "10" will be displayed.</li>
                        <li>Place 10 pieces on the pan with the empty blister card.</li>
                        <li>Press the PRINT key, and the scale will display "10".</li>
                        <li>The scale is set to show the number of pieces per blister card.</li>
                    </ul>
                </div>
            </div>

            <table class="table border">
                <tr>
                    <th class="border">DATE</th>
                    <th class="border">TIME</th>
                    <th class="border">Weight of Empty Blister Card</th>
                    <th class="border">Weight of 10 pcs</th>
                    <th class="border">Weight of One Piece</th>
                    <th class="border">Set-up By</th>
                    <th class="border">Verified By</th>
                </tr>
                <tbody>

                    @for($i=1; $i<=7; $i++) <tr>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        </tr>

                        @endfor

                </tbody>
            </table>

            <!-- Footer Section -->
            <div class="footer mt-5 pt-3 ">
                <div class="row ">
                    <div class="col-6">
                        <div>
                            <span class="mr-2">
                                Form: <span># 017-11</span>
                            </span>
                            <span class="mr-2">
                                Rev: <span>{{$data['rev']}}</span>
                            </span>
                            <span>
                                Issued:
                                <span>{{\Carbon\Carbon::parse($data['orderDetails']->created_at)->format('m/Y')}}</span>
                            </span>

                        </div>
                    </div>

                </div>
            </div>

        </div>


        {{-- Second Page for Weight Verfication Report--}}

        <div class="page-break"></div> <!-- Page break -->
        <p class="no-print text-warning font-weight-bold"> New Page Start </p>

        <div class="container mb-5">

            <div class="text-center">
                <p class="" style="font-size: 25px">NUTRA-MED PACKAGING </p>
                <p class="font-weight-bold text-uppercase" style="font-size:25px">Weight Verification Report
                </p>
            </div>
            <div class="text-right">
                <span> Order Id : <span class="font-weight-bold">{{$data['orderDetails']->orderId}}</span> </span>
            </div>

            <div class="border p-2">
                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> PRODUCT: <span>{{$data['orderDetails']->productName}}</span> </p>
                    <p class="font-weight-bold ">RM#: <span>____________</span></p>
                </div>

                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> CUSTOMER:
                        <span>{{$data['orderDetails']->customers->customer_name}}</span>
                    </p>
                    <p class="font-weight-bold ">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                    <p class="font-weight-bold ">Exp: <span>{{$data['orderDetails']->Exp}}</span></p>
                </div>

                <div class="d-flex justify-content-between ">
                    <p class=" "> Bulk Prod Lot#: <span id="bluckProdLot"></span> </p>
                    <p class=" "> Sqaure root +1 container: <span>____________</span> </p>

                </div>
            </div>

            <div class="border d-flex justify-conetent-each mt-1 mb-3 p-2 font-weight-bold border-dark">
                <p>Scale Serial#:
                <p class="border-bottom w-25 border-dark">&nbsp;</p>
                </p>

                <p class="ml-5">Scale Calibration :
                <p class="border-bottom w-25 border-dark">&nbsp;</p>
                </p>
            </div>


            @for($i = 0; $i <4; $i++) <table class="table table-border table-md">
                <thead>
                    <tr>
                        <th class="border ">Cont #</th>
                        <th class="border "> </th>
                        <th class="border ">Customer</th>
                        <th class="border ">Nutra-Med</th>
                        <th class="border ">Diff.</th>
                        <th class="border ">Cont #</th>
                        <th class="border ">Customer</th>
                        <th class="border ">Nutra-Med</th>
                        <th class="border ">Diff.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border ">&nbsp;</td>
                        <td class="border ">Gross</td>
                        <td class="border "></td>
                        <td class="border "></td>
                        <td class="border "></td>
                        <td class="border "></td>
                        <td class="border "></td>
                        <td class="border "></td>
                        <td class="border "></td>
                    </tr>
                    <tr>
                        <td class="border ">&nbsp;</td>
                        <td class="border ">Tare</td>
                        <td class="border "></td>
                        <td class="border "></td>
                        <td class="border "></td>
                        <td class="border "></td>
                        <td class="border "></td>
                        <td class="border "></td>
                        <td class="border "></td>
                    </tr>
                    <tr>
                        <td class="border ">&nbsp;</td>
                        <td class="border ">Net</td>
                        <td class="border "></td>
                        <td class="border "></td>
                        <td class="border "></td>
                        <td class="border "></td>
                        <td class="border "></td>
                        <td class="border "></td>
                        <td class="border "></td>
                    </tr>
                </tbody>
                </table>
                @endfor



                <p><strong>Performed By:</strong> <span class="border-bottom w-50 d-inline-block"></span>
                    <strong>Date:</strong>
                    <span class="border-bottom w-25 d-inline-block"></span>
                </p>

                <p><strong>Reviewed By:</strong> <span class="border-bottom w-50 d-inline-block"></span>
                    <strong>Date:</strong> <span class="border-bottom w-25 d-inline-block"></span>
                </p>

                <div class="row">
                    <div class="col-2 font-weight-bold">
                        Comments:
                    </div>
                    <div class="col-12 d-flex justify-content-start">
                        <div class="border-bottom w-100 border-dark"></div>
                    </div>

                    <div class="col-12 mt-4 d-flex justify-content-start">
                        <div class="border-bottom w-100 border-dark"></div>
                    </div>

                    <div class="col-12 mt-4 d-flex justify-content-start">
                        <div class="border-bottom w-100 border-dark"></div>
                    </div>
                </div>


                <!-- Footer Section -->
                <div class="footer mt-5 pt-3 ">
                    <div class="row ">
                        <div class="col-6">
                            <div>
                                <span class="mr-1">
                                    Form: <span># 005-6</span>
                                </span>
                                <span class="mr-1">
                                    Rev: <span>{{$data['rev']}}</span>
                                </span>
                                <span>
                                    Issued:
                                    <span>{{\Carbon\Carbon::parse($data['orderDetails']->created_at)->format('m/Y')}}</span>
                                </span>

                            </div>
                        </div>

                    </div>
                </div>

        </div>


        {{-- Third Page for Counting Scale Setup form --}}

        <div class="page-break"></div> <!-- Page break -->
        <p class="no-print text-warning font-weight-bold"> New Page Start </p>

        <div class="container mb-5">

            <div class="text-center">
                <p class="" style="font-size: 25px">NUTRA-MED PACKAGING </p>
                <p class="font-weight-bold text-uppercase" style="font-size:25px">Counting Scale Set-Up form
                </p>
            </div>
            <div class="text-right">
                <span> Order Id : <span class="font-weight-bold">{{$data['orderDetails']->orderId}}</span> </span>
            </div>

            <div class="border p-2">
                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> PRODUCT: <span>{{$data['orderDetails']->productName}}</span> </p>
                    <p class="font-weight-bold ">RM#: <span>____________</span></p>
                </div>

                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> CUSTOMER:
                        <span>{{$data['orderDetails']->customers->customer_name}}</span>
                    </p>
                    <p class="font-weight-bold ">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                    <p class="font-weight-bold ">Exp: <span>{{$data['orderDetails']->Exp}}</span></p>
                </div>
            </div>



            <div class="border d-flex justify-conetent-each mt-5 p-2 font-weight-bold border-dark">
                <p>Scale Serial#:
                <p class="border-bottom w-25 border-dark">&nbsp;</p>
                </p>

                <p class="ml-5">Scale Calibration :
                <p class="border-bottom w-25 border-dark">&nbsp;</p>
                </p>
            </div>

            <div class="mt-3 font-weight-bold">
                <p>Procedure to Set-up <span class="text-dark">A & d </span>scale:</p>
                <p>
                    Scale used for:
                    [ &nbsp;] Production [&nbsp; ] QA
                    <span class="border-bottom d-inline-block w-50 border-dark"></span>
                </p>

                <div class="ml-5">

                    <ul>
                        <span>Ensure scale is level (bubble in the center) if applicable</span>
                        <li>Press STANDBY/OPERATE key to turn the scale on. Press RESET key to clear any previous
                            operation.
                        </li>
                        <li>The UNIT WEIGHT BY light should be blinking at this point.</li>
                        <li>Press the SAMPLE key. Any tare container will be automatically tared.</li>
                        <li>The display will show " ADD SAMPLE AND 10 PCS".</li>
                        <li>Use 0 TO 9 KEY PAD to display the sample size desired.</li>
                        <li>Place the selected number of sample pieces (accurately counted) on the weighing pan or in
                            the
                            tared
                            container.</li>
                        <li>The weight of the pieces will be displayed.</li>
                        <li>Press ENTER key. The display will show the desired number</li>
                        <li>Enter the date, time and unit weight in the form.</li>

                    </ul>
                </div>
            </div>

            <table class="table border">
                <tr>
                    <th class="border">DATE</th>
                    <th class="border">TIME</th>
                    <th class="border">Unit Weight</th>
                    <th class="border">Set-up By</th>
                    <th class="border">Verified By</th>
                </tr>
                <tbody>

                    @for($i=1; $i<=8; $i++) <tr>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        </tr>
                        @endfor
                </tbody>
            </table>

            <!-- Footer Section -->
            <div class="footer mt-5 pt-3 ">
                <div class="row ">
                    <div class="col-6">
                        <div>
                            <span class="mr-1">
                                Form: <span># 017-10</span>
                            </span>

                            <span class="mr-1">
                                Rev: <span>{{$data['rev']}}</span>
                            </span>
                            <span>
                                Issued:
                                <span>{{\Carbon\Carbon::parse($data['orderDetails']->created_at)->format('m/Y')}}</span>
                            </span>

                        </div>
                    </div>

                </div>
            </div>

        </div>



        {{-- Fourth Page for Printed material Issuance form --}}

        <div class="page-break"></div> <!-- Page break -->
        <p class="no-print text-warning font-weight-bold"> New Page Start </p>

        <div class="container mb-5">
            <div class="text-center">
                <p class="" style="font-size: 25px">NUTRA-MED PACKAGING</p>
                <p class="font-weight-bold text-uppercase" style="font-size:25px">Printed Material Issuance Form</p>
            </div>

            <div class="text-right">
                <span> Order Id : <span class="font-weight-bold">{{$data['orderDetails']->orderId}}</span> </span>
            </div>

            <div class="border p-2">
                <div class="d-flex justify-content-between">
                    <p class="font-weight-bold"> PRODUCT: <span>{{$data['orderDetails']->productName}}</span> </p>
                    <p class="font-weight-bold">RM#: <span>____________</span></p>
                </div>

                <div class="d-flex justify-content-between">
                    <p class="font-weight-bold"> CUSTOMER:
                        <span>{{$data['orderDetails']->customers->customer_name}}</span>
                    </p>
                    <p class="font-weight-bold">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                    <p class="font-weight-bold">Exp: <span>{{$data['orderDetails']->Exp}}</span></p>
                </div>
            </div>

            <h6 class="mt-3">COMPONENT NAME: <span class="border-bottom w-25 border-dark d-inline-block"></span></h6>

            <div class="d-flex justify-content-between">
                <p> Receipt#: <span>________________________________</span> </p>
                <p>Lot# / Batch#: <span>________________________________</span></p>
                <p>Code# / Item#: <span>________________________________</span></p>
            </div>

            <div class="d-flex justify-content-between font-weight-bold">
                <p> Total Quantity Issued: <span>________________________________</span> </p>
                <p>Date Issued: <span>________________________________</span></p>
                <p>Issued By: <span>________________________________</span></p>
            </div>

            <p class="font-weight-bold">Break Down of the Total Quantity:</p>

            <div class="mt-0">
                @for($i = 0; $i < 6; $i++) <div class="row">
                    <div class="col-6">
                        <p>
                            <span>- _________________</span>
                            <span>X _________________</span>
                            <span>= _________________</span>
                        </p>
                    </div>
                    <div class="col-6">
                        <p>
                            <span>- _________________</span>
                            <span>X _________________</span>
                            <span>= _________________</span>
                        </p>
                    </div>
            </div> <!-- Closing .row -->
            @endfor

            <div class="row">
                <div class="col-6"></div>
                <div class="col-6">
                    <span>Total Quantity: _______________________________________</span>
                </div>
            </div>
        </div>
        <hr>

        <div class="d-flex justify-content-between font-weight-bold">
            <p> Quantity Returned: <span>________________________________</span> </p>
            <p>Date Returned: <span>________________________________</span></p>
            <p>Returned By: <span>________________________________</span></p>
        </div>

        <small class="font-weight-bold">Break Down of the Quantity Returned:</small>

        <div class="mt-0">
            @for($i = 0; $i < 4; $i++) <div class="row mt-2">
                <div class="col-6">
                    <p>
                        <span>- _________________</span>
                        <span>X _________________</span>
                        <span>= _________________</span>
                    </p>
                </div>

        </div> <!-- Closing .row -->
        @endfor

        <div class="row">
            <div class="col-6">
                Received and Verified By: <span>__________________________________</span>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-2 font-weight-bold">
                Comments:
            </div>
            <div class="col-12 d-flex justify-content-start">
                <div class="border-bottom w-100 border-dark"></div>
            </div>

            <div class="col-12 mt-4 d-flex justify-content-start">
                <div class="border-bottom w-100 border-dark"></div>
            </div>

            <div class="col-12 mt-4 d-flex justify-content-start">
                <div class="border-bottom w-100 border-dark"></div>
            </div>

            <div class="col-12 mt-4 d-flex justify-content-start">
                <div class="border-bottom w-100 border-dark"></div>
            </div>
        </div>

        <!-- Footer Section -->
        <div class="footer mt-5 pt-3">
            <div class="row">
                <div class="col-6">
                    <div>
                        <span class="mr-1">
                            Form: <span># 014-3</span>
                        </span>
                        <span class="mr-2">
                            Rev: <span>{{$data['rev']}}</span>
                        </span>
                        <span>
                            Issued: <span>
                                {{\Carbon\Carbon::parse($data['orderDetails']->created_at)->format('m/Y')}}</span>
                        </span>
                    </div>
                </div>
            </div>
        </div> <!-- Closing main container -->
    </div>












</div>


{{---------------------- Inspection scale weight end--------------------------------------}}








</div>




{{----------------------A Inspection start--------------------------------------}}
<div class="page-break mb-5"></div> <!-- Page break -->

<div class="A Inspection Form">

    <div class="container mb-5">

        <div class="text-center">
            <p class="" style="font-size: 25px">NUTRA-MED PACKAGING </p>
            <p class="font-weight-bold text-uppercase" style="font-size:25px">Line approval form
                for inspection/re-inspection/carton printing
            </p>
        </div>
        <div class="text-right">
            <span> Order Id : <span class="font-weight-bold">{{$data['orderDetails']->orderId}}</span> </span>
        </div>

        <div class="border p-2">
            <div class="d-flex justify-content-between ">
                <p class="font-weight-bold "> PRODUCT: <span> {{$data['orderDetails']->productName}}</span> </p>
                <p class="font-weight-bold ">RM#: <span>____________</span></p>
            </div>

            <div class="d-flex justify-content-between ">
                <p class="font-weight-bold "> CUSTOMER: <span>{{$data['orderDetails']->customers->customer_name}}</span>
                </p>
                <p class="font-weight-bold ">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                <p class="font-weight-bold ">Exp: <span>{{$data['orderDetails']->Exp}}</span></p>
            </div>
        </div>

        <h6 class="mt-3">Reason: <span class="border-bottom w-75 border-dark d-inline-block"></span> </h6>

        <p class="font-weight-bold mt-5 mb-5">INSPECT THE AREA FOR: </p>

        <ol class="font-weight-bold">
            <li>Free of all product, components, and Labeling material from previous lot.</li>
            <li>Entire room/arca is properly cleaned, floor is swept and cleaned and trash cans are emptied and cleaned.
            </li>
            <li>All equipment in the room is properly cleaned, all previous tags are removed.</li>
        </ol>
        <br><br><br><br>


        <h6 class="mt-5 mb-5">I have thoroughly inspected the entire area, the equipment for proper cleaning. I am
            approving
            this area for
            the next product.</h6>
        <br><br><br><br>

        <div class="mt-5 mb-5">
            <div class="row mb-3 font-weight-bold">
                <div class="col-2">PRODUCTION:</div>
                <div class="col-4 border-bottom"></div>
                <div class="col-2">DATE:</div>
                <div class="col-4 border-bottom"></div>
            </div>

            <div class="row mb-4 font-weight-bold">
                <div class="col-2">QUALITY ASSURANCE:</div>
                <div class="col-4 border-bottom"></div>
                <div class="col-2">DATE:</div>
                <div class="col-4 border-bottom"></div>
            </div>
        </div>



        <!-- Footer Section -->
        <div class="footer mt-5 pt-3 ">
            <div class="row ">
                <div class="col-6">
                    <div>
                        <span class="mr-1">
                            Form: <span># 054-6</span>
                        </span>
                        <span class="mr-1">
                            Rev: <span>{{$data['rev']}}</span>
                        </span>
                        <span>
                            Issued:
                            <span>{{\Carbon\Carbon::parse($data['orderDetails']->created_at)->format('m/Y')}}</span>
                        </span>

                    </div>
                </div>

            </div>
        </div>


    </div>

    {{-- Second Page for Inspection Report for random sampling/cartoon printing --}}

    <div class="page-break"></div> <!-- Page break -->
    <p class="no-print text-warning font-weight-bold"> New Page Start </p>


    <div class="container mb-5">

        <div class="text-center">
            <p class="" style="font-size: 25px">NUTRA-MED PACKAGING </p>
            <p class="font-weight-bold text-uppercase" style="font-size:25px">Inspection Report for random
                sampling/cartoon printing
            </p>
        </div>
        <div class="text-right">
            <span> Order Id : <span class="font-weight-bold">{{$data['orderDetails']->orderId}}</span> </span>
        </div>

        <div class="border p-2">
            <div class="d-flex justify-content-between ">
                <p class="font-weight-bold "> PRODUCT: <span>{{$data['orderDetails']->productName}}</span> </p>
                <p class="font-weight-bold ">RM#: <span>____________</span></p>
            </div>

            <div class="d-flex justify-content-between ">
                <p class="font-weight-bold "> CUSTOMER: <span>
                        {{$data['orderDetails']->customers->customer_name}}</span> </p>
                <p class="font-weight-bold ">Lot#: <span> {{$data['orderDetails']->LOT}}</span></p>
                <p class="font-weight-bold ">Exp: <span>{{$data['orderDetails']->Exp}}</span></p>
            </div>
        </div>

        <h6 class="mt-3">
            Reason for Inspection: <span class="border-bottom w-75 border-dark d-inline-block"></span> <br><br>
            <span class="border-bottom w-100 border-dark d-inline-block"></span>
        </h6>


        <p class="mt-3 mb-5">
            Sample Size and Frequency: <span class="border-bottom w-75 border-dark d-inline-block"></span>
        </p>


        <table class="table table-bordered table-md text-center">
            <thead>
                <tr class="font-weight-bold">
                    <th class="border">#</th>
                    <th class="border">Date</th>
                    <th class="border"> Time</th>
                    <th class="border" style="width: 9rem">Case#</th>
                    <th class="border" style="width: 7rem"># Visual Defects</th>
                    <th class="border"> &nbsp; &nbsp;&nbsp;&nbsp;</th>
                    <th class="border">&nbsp;&nbsp;&nbsp;</th>
                    <th class="border">A/R </th>
                    <th class="border">Inspector</th>
                </tr>
            </thead>
            <tbody>
                @for ($i=1; $i<=15; $i++) <tr>
                    <td class="border">{{$i}}</td>
                    <td class="border">&nbsp;</td>
                    <td class="border">&nbsp;</td>
                    <td class="border">&nbsp;</td>
                    <td class="border">&nbsp;</td>
                    <td class="border">&nbsp;</td>
                    <td class="border">&nbsp;</td>
                    <td class="border">&nbsp;</td>
                    <td class="border">&nbsp;</td>
                    <td class="border">&nbsp;</td>
                    </tr>

                    @endfor
            </tbody>
        </table>

        <div class="row">
            <div class="col-2 font-weight-bold">
                Notes:
            </div>
            <div class="col-12 d-flex justify-content-start">
                <div class="border-bottom w-100 border-dark"></div>
            </div>

            <div class="col-12 mt-4 d-flex justify-content-start">
                <div class="border-bottom w-100 border-dark"></div>
            </div>
            <div class="col-12 mt-4 d-flex justify-content-start">
                <div class="border-bottom w-100 border-dark"></div>
            </div>
            <div class="col-12 mt-4 d-flex justify-content-start">
                <div class="border-bottom w-100 border-dark"></div>
            </div>


        </div>

        <!-- Footer Section -->
        <div class="footer mt-5 pt-3 ">
            <div class="row ">
                <div class="col-6">
                    <div>
                        <span class="mr-1">
                            Form: <span># 054-7</span>
                        </span>
                        <span class="mr-1">
                            Rev: <span> {{$data['rev']}}</span>
                        </span>
                        <span>
                            Issued:
                            <span>{{\Carbon\Carbon::parse($data['orderDetails']->created_at)->format('m/Y')}}</span>
                        </span>

                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

{{----------------------A Inspection Close--------------------------------------}}





{{----------------------B Inspection Start--------------------------------------}}
<div class="page-break mb-5"></div> <!-- Page break -->

<div class="B Inspection Form ">

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

{{----------------------B Inspection Close--------------------------------------}}




{{----------------------VIsion setup challengae Start--------------------------------------}}
<div class="page-break mb-5"></div> <!-- Page break -->

<div class="Vision setup challengae">

    <div class="container mb-5">

        <div class="text-center">
            <p class="" style="font-size: 25px">NUTRA-MED PACKAGING </p>
            <p class="font-weight-bold text-uppercase" style="font-size:25px">Vision system setup and challenge
                verification</p>
        </div>
        <div class="text-right">
            <span> Order Id : <span class="font-weight-bold">{{$data['orderDetails']->orderId}}</span> </span>
        </div>

        <div class="border p-2">
            <div class="d-flex justify-content-between ">
                <p class="font-weight-bold "> PRODUCT: <span>{{$data['orderDetails']->productName}}</span> </p>
                <p class="font-weight-bold ">RM#: <span>____________</span></p>
            </div>

            <div class="d-flex justify-content-between ">
                <p class="font-weight-bold "> CUSTOMER: <span>
                        {{$data['orderDetails']->customers->customer_name}}</span> </p>
                <p class="font-weight-bold ">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                <p class="font-weight-bold ">Exp: <span>{{$data['orderDetails']->Exp}}</span></p>
            </div>
        </div>


        <table class="table table-bordered mt-5">
            <thead>
                <tr class="text-center">
                    <th class="border" colspan="3">steps</th>
                    <th class="border">Performed by: (Initial & Date)</th>
                    <th class="border">Verified by: (Initial & Date)</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border">1</td>
                    <td class="border font-weight-bold">Equipment Setup</td>
                    <td class="border">Vision equipment(s) are setup as per SOP-015. Setup is verified by a qualified
                        person. Equipment Setup: <br><br>
                        ________ Part Code Barcode Scanner <br><br>
                        ________ Serialization and Aggregation System <br><br><br>
                    </td>
                    <td class="border">
                        <span class="border-bottom w-100 d-inline-block mb-3 mb-3"></span>
                        <span class="border-bottom w-100 d-inline-block"></span>
                    </td>
                    <td class="border">
                        <span class="border-bottom w-100 d-inline-block mb-3 mb-3"></span>
                        <span class="border-bottom w-100 d-inline-block"></span>
                    </td>

                </tr>

                <tr>
                    <td class="border">2</td>
                    <td class="border font-weight-bold">Initial Equipment Challenge</td>
                    <td class="border">Vision Equipment(s) were challenged according to SOP-015 to ensure proper
                        functionality. Equipment Challenged: <br> <br>
                        ________ Part Code Barcode Scanner <br><br>
                        ________ Serialization and Aggregation System<br><br><br>

                    </td>
                    <td class="border">
                        <span class="border-bottom w-100 d-inline-block mb-3 mb-3"></span>
                        <span class="border-bottom w-100 d-inline-block"></span>
                    </td>
                    <td class="border">
                        <span class="border-bottom w-100 d-inline-block mb-3 mb-3"></span>
                        <span class="border-bottom w-100 d-inline-block"></span>
                    </td>

                </tr>
            </tbody>
        </table>


        <!-- Footer Section -->
        <div class="footer mt-5 pt-3 ">
            <div class="row ">
                <div class="col-6">
                    <div>
                        <span class="mr-1">
                            Form: <span># 015-02</span>
                        </span>
                        <span class="mr-1">
                            Rev: <span>{{$data['rev']}}</span>
                        </span>
                        <span>
                            Issued:
                            <span>{{\Carbon\Carbon::parse($data['orderDetails']->created_at)->format('m/Y')}}</span>
                        </span>

                    </div>
                </div>
                <div class="col-6 text-right">
                    <div>Seq. No. <span>1 of 1</span></div>
                </div>
            </div>
        </div>


    </div>
</div>
{{----------------------VIsion setup challengae Close--------------------------------------}}




{{----------------------Product specification Start--------------------------------------}}
<div class="page-break mb-5"></div> <!-- Page break -->

<div class="Product Specificatio Form">

    <div class="container mb-5">

        <div class="text-center">
            <p class="" style="font-size: 25px">NUTRA-MED PACKAGING </p>
            <p class="font-weight-bold text-uppercase" style="font-size:25px">Packaging Specification</p>
        </div>
        <div class="text-right">
            <span> Order Id : <span class="font-weight-bold">{{$data['orderDetails']->orderId}}</span> </span>
        </div>


        <div class="border-bottom border-dark pl-3 pr-3 pt-1 pb-3">
            <div class=" ">
                <span class=" font-weight-bold "> Customer:
                    <span>{{$data['orderDetails']->customers->customer_name}}</span> </span> <br>
                <span class="font-weight-bold "> Product Name: <span>{{$data['orderDetails']->productName}}</span>
                </span>
            </div>

            <div class="d-flex justify-content-between mt-1">
                <span class="font-weight-bold ">F.Prod #: <span>{{$data['orderDetails']->fProduct}}</span></span>
                <span class="font-weight-bold ">NDC/UPC Code #: <span>{{$data['orderDetails']->ndcUpc}}</span></span>
                <span class="font-weight-bold ">Dosage Form: <span>{{$data['orderDetails']->dosageForm}}</span></span>
            </div>

            <div class="d-flex justify-content-start ">
                <span class="font-weight-bold ">Description:
                    <span>{{$data['orderDetails']->unitDescription}}</span></span>
            </div>

        </div>


        <table class="table table-sm text-center">
            <thead>
                <tr>
                    <th>Components: &nbsp; Name</th>
                    <th> Description</th>
                    <th> Code</th>
                </tr>
            </thead>

            <tbody>
                @php
                $compCode= json_decode($data['orderDetails']->compCode, true);
                $compName=json_decode($data['orderDetails']->compName, true);
                $compDesc=json_decode($data['orderDetails']->compDesc, true);
                @endphp

                @foreach ($compName as $key=> $item)
                <tr>
                    <td>{{$item}}</td>
                    <td>{{$compDesc[$key]}}</td>
                    <td>{{$compCode[$key]}}</td>
                </tr>
                @endforeach
            </tbody>

        </table>

        <span class="font-weight-bold">Packaging Instruction:</span>
        <div class="border p-2">
            {!! nl2br(e($data['orderDetails']->packInstruction)) !!}

        </div>


        <div class="row mt-2">
            <div class="col-8">
                Approved By Customer: <span class="border-bottom w-75 d-inline-block"></span> <br>
                Approved By Nutra-Med : <span class="border-bottom w-75 d-inline-block"></span>
            </div>
            <div class="col-4">
                Date: <span class="border-bottom w-75 d-inline-block"></span> <br>
                Date: <span class="border-bottom w-75 d-inline-block"></span>
            </div>
        </div>




        <!-- Footer Section -->
        <div class="footer mt-5 pt-3 ">
            <div class="row ">
                <div class="col-6">
                    <div>
                        <span class="mr-1">
                            Document # <span>{{$data['orderDetails']->masterOrd}}</span>
                        </span>
                        <span class="mr-1">
                            Rev: <span>{{$data['rev']}}</span>
                        </span>
                        <span>
                            Issued:
                            <span>{{\Carbon\Carbon::parse($data['orderDetails']->created_at)->format('m/Y')}}</span>
                        </span>

                    </div>
                </div>
                <div class="col-6 text-right">
                    <div>Seq. No. <span> -</span></div>
                </div>
            </div>
        </div>


    </div>

</div>

{{----------------------Product specification Close--------------------------------------}}




</div>

{{------------------------------------------ Portrait Form Print Div End-----------------------------------------}}








{{------------------------------------------ LandScapeDiv Form Print DivStart-------------------------------------}}

<div id="landscapeDiv">


    {{---------------------------------- Material tranfer 4 form Start--------------------------------------------}}
    <div class="Material transfer 4 form mt-5">

        <div class="page_heading">
            <div class="text-center">
                <p class="" style="font-size: 25px">NUTRA-MED PACKAGING</p>
                <p class="font-weight-bold text-uppercase" style="font-size:25px">Material Transfer Report</p>
            </div>
            <div class="text-right">
                <span> Order Id: <span class="font-weight-bold"> {{$data['orderDetails']->orderId}} </span> </span>
            </div>

            <div class="border p-2">
                <div class="d-flex justify-content-between">
                    <p class="font-weight-bold"> PRODUCT: <span>{{$data['orderDetails']->productName}}</span> </p>
                    <p class="font-weight-bold">RM#: <span>____________</span></p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="font-weight-bold"> CUSTOMER: <span>
                            {{$data['orderDetails']->customers->customer_name}}
                        </span>
                    </p>
                    <p class="font-weight-bold">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                    <p class="font-weight-bold">Exp: <span>{{$data['orderDetails']->Exp}}</span></p>
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




                {{-- <tbody id="table-body"> --}}
                    @php
                    $compName = json_decode($data['orderDetails']->compName, true);
                    $compCode = json_decode($data['orderDetails']->compCode, true);
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
                                    <p class="font-weight-bold text-uppercase" style="font-size:25px">Material
                                        Transfer
                                        Report</p>
                                </div>
                                <div class="text-right">
                                    <span>Order Id: <span
                                            class="font-weight-bold">{{$data['orderDetails']->orderId}}</span></span>
                                </div>
                                <div class="border p-2">
                                    <div class="d-flex justify-content-between">
                                        <p class="font-weight-bold">PRODUCT:
                                            <span>{{$data['orderDetails']->productName}}</span>
                                        </p>
                                        <p class="font-weight-bold">RM#: <span>____________</span></p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="font-weight-bold">CUSTOMER:
                                            <span>{{$data['orderDetails']->customers->customer_name}}</span>
                                        </p>
                                        <p class="font-weight-bold">Lot#:
                                            <span>{{$data['orderDetails']->LOT}}</span>
                                        </p>
                                        <p class="font-weight-bold">Exp: <span>{{$data['orderDetails']->Exp}}</span>
                                        </p>
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
                                Rev: <span id="revision">{{$data['rev']}}</span>
                            </span>
                            <span>
                                Issued: <span>{{
                                    \Carbon\Carbon::parse($data['orderDetails']->created_at)->format('m/Y')}}</span>
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
    {{---------------------------------- Material tranfer 4 form Close--------------------------------------------}}



    {{---------------------------------- Material tranfer 4.1 form Start--------------------------------------------}}
    <div class="page-break"></div> <!-- Page break -->
    <div class="Material Transfer 4_1">

        <div class="container-fluid">
            <div class="text-center">
                <p class="" style="font-size: 25px">NUTRA-MED PACKAGING </p>
                <p class="font-weight-bold text-uppercase" style="font-size:25px">Material Transfer Report
            </div>
            <div class="text-right">
                <span> Order Id : <span class="font-weight-bold"> {{$data['orderDetails']->orderId}}</span> </span>
            </div>


            <div class="border p-2">
                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> PRODUCT: <span>{{$data['orderDetails']->productName}}</span> </p>
                    <p class="font-weight-bold ">RM#: <span>____________</span></p>
                </div>

                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> CUSTOMER:
                        <span>{{$data['orderDetails']->customers->customer_name}}</span>
                    </p>
                    <p class="font-weight-bold ">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                    <p class="font-weight-bold ">Exp: <span>{{$data['orderDetails']->Exp}}</span></p>
                </div>
            </div>



            <div class="mt-1">
                <table class="table table-bordered border table-md">
                    <thead>
                        <tr class="border">
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
                    </thead>
                    <tbody>
                        <tr>
                            <th colspan="9" class="border p-3"></th>

                        </tr>
                        <tr>
                            <th scope="row" class="border"></th>
                            <td class="border"></td>
                            <td class="border"></td>
                            <td class="border">

                            </td>
                            <td class="border"></td>
                            <td class="border"></td>
                            <td class="border"></td>
                            <td class="border"></td>
                            <td class="border"></td>
                        </tr>

                        <tr>
                            <th scope="row" class="border"></th>
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
                            <th scope="row" class="border"></th>
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
                            <th scope="row" class="border"></th>
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
                            <th colspan="9" class="border text-left ">
                                Total:
                            </th>

                        </tr>

                        <tr>
                            <td colspan="9" class="border p-3"> </td>
                        </tr>


                        <tr>
                            <th scope="row" class="border"></th>
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
                            <th scope="row" class="border"></th>
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
                            <th scope="row" class="border"></th>
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
                            <th scope="row" class="border"></th>
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
                            <th colspan="9" class="border  ">
                                Total: <br>
                            </th>
                        </tr>

                    </tbody>
                </table>

                <!-- Footer Section -->
                <div class="footer pt-1 ">
                    <div class="row ">
                        <div class="col-6">
                            <div>
                                <span class="mr-1">
                                    Form: <span> # 014-2</span>
                                </span>
                                <span class="mr-1">
                                    Rev: <span>{{$data['rev']}}</span>
                                </span>
                                <span>
                                    Issued:
                                    <span>{{\Carbon\Carbon::parse($data['orderDetails']->created_at)->format('m/Y')}}</span>

                                </span>

                            </div>
                        </div>
                        <div class="col-6 text-right">
                            <div>Seq. No. <span>4 of 13</span></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>




        {{-- 2nd page --}}
        <div class="page-break"></div> <!-- Page break -->

        <div class="container-fluid ">
            <div class="text-center">
                <p class="" style="font-size: 25px">NUTRA-MED PACKAGING </p>
                <p class="font-weight-bold text-uppercase" style="font-size:25px">Material Transfer Report
            </div>
            <div class="text-right">
                <span> Order Id : <span class="font-weight-bold"> {{$data['orderDetails']->orderId}}</span> </span>
            </div>


            <div class="border p-2">
                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> PRODUCT: <span>{{$data['orderDetails']->productName}}</span> </p>
                    <p class="font-weight-bold ">RM#: <span>____________</span></p>
                </div>

                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> CUSTOMER:
                        <span>{{$data['orderDetails']->customers->customer_name}}</span>
                    </p>
                    <p class="font-weight-bold ">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                    <p class="font-weight-bold ">Exp: <span>{{$data['orderDetails']->Exp}}</span></p>
                </div>
            </div>



            <div class="mt-3">
                <table class="table table-bordered border table-md">
                    <thead>
                        <tr class="border">
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
                    </thead>
                    <tbody>

                        <tr>
                            <th scope="row" class="border"></th>
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
                            <th scope="row" class="border"></th>
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
                            <th scope="row" class="border"></th>
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
                            <th colspan="9" class="border  ">
                                Total: <br>

                            </th>
                        </tr>

                        <tr>
                            <th scope="row" class="border"></th>
                            <td class="border"></td>
                            <td class="border"></td>
                            <td class="border">
                            </td>
                            <td class="border"></td>
                            <td class="border"></td>
                            <td class="border"></td>
                            <td class="border"></td>
                            <td class="border"></td>
                        </tr>

                        <tr>
                            <th scope="row" class="border"></th>
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
                            <th scope="row" class="border"></th>
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
                            <th colspan="9">Total:</th>
                        </tr>

                    </tbody>
                </table>

                <!-- Footer Section -->
                <div class="footer mt-5 pt-3 ">
                    <div class="row ">
                        <div class="col-6">
                            <div>
                                <span class="mr-1">
                                    Form: <span> # 014-2</span>
                                </span>
                                <span class="mr-1">
                                    Rev: <span>{{$data['rev']}}</span>
                                </span>
                                <span>
                                    Issued:
                                    <span>{{\Carbon\Carbon::parse($data['orderDetails']->created_at)->format('m/Y')}}</span>
                                </span>

                            </div>
                        </div>
                        <div class="col-6 text-right">
                            <div>Seq. No. <span>4 of 13</span></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    {{------------------------------ Material tranfer 4.1 form Close--------------------------------------------}}



    {{---------------------- Inspection 7-13 start--------------------------------------}}
    <div class="page-break mb-5"></div> <!-- Page break -->

    <div class="Inspection 7-13">

        <div class="container mb-5">
            <div class="text-center">
                <p class="" style="font-size: 25px">NUTRA-MED PACKAGING </p>
                <p class="font-weight-bold text-uppercase" style="font-size:25px">in-process inspection report
                </p>
            </div>
            <div class="text-right">
                <span> Order Id : <span class="font-weight-bold">{{$data['orderDetails']->orderId}}</span> </span>
            </div>

            <div class="border p-2">
                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> PRODUCT: <span>{{$data['orderDetails']->productName}}</span> </p>
                    <p class="font-weight-bold ">RM#: <span>____________</span></p>
                </div>

                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> CUSTOMER: <span> {{$data['orderDetails']->customers->customer_name}}
                        </span> </p>
                    <p class="font-weight-bold ">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                    <p class="font-weight-bold ">Exp: <span>{{$data['orderDetails']->Exp}}</span></p>
                </div>
            </div>

            <div class="mt-1 border" style="height: 220px">
                <span class="p-1" style="font-size: 10px">{{$data['orderDetails']->visualInspection}}
                </span>
            </div>

            <table class="table table-bordered table-sm text-center">
                <thead>
                    <tr>
                        <th class="border">#</th>
                        <th class="border">Date</th>
                        <th class="border"> Time</th>
                        <th class="border" style="width: 7rem">Case#</th>
                        <th class="border">Visual Defects</th>
                        <th class="border">
                            {{ $data['orderDetails']->testOne ? $data['orderDetails']->testOne : 'N/A' }}
                        </th>

                        <th class="border">{{$data['orderDetails']->testTwo ? $data['orderDetails']->testTwo : 'N/A'}}
                        </th>
                        <th class="border">{{$data['orderDetails']->testThree ? $data['orderDetails']->testThree :
                            'N/A'}}
                        </th>
                        <th class="border">{{$data['orderDetails']->testFour ? $data['orderDetails']->testFour : 'N/A'}}
                        </th>
                        <th class="border">{{$data['orderDetails']->testFive ? $data['orderDetails']->testFive : 'N/A'}}
                        </th>
                        <th class="border">A/R 35</th>
                        <th class="border">QA Inspector</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i=1; $i<=3; $i++) <tr>
                        <td class="border">{{$i}}</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        </tr>

                        @endfor
                </tbody>
            </table>
            <!-- Footer Section -->
            <div class="footer">
                <div class="row ">
                    <div class="col-6">
                        <div>
                            <span class="mr-1">
                                Form: <span># 017-3</span>
                            </span>
                            <span class="mr-1">
                                Rev: <span>{{$data['rev']}}</span>
                            </span>
                            <span>
                                Issued: <span>{{
                                    \Carbon\Carbon::parse($data['orderDetails']->created_at)->format('m/Y')}}</span>
                            </span>

                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <div>Seq. No. <span>7 of 13</span></div>
                    </div>
                </div>
            </div>

            {{-- 2nd page --}}
            <div class="page-break"></div> <!-- Page break -->

            <div class="text-center">
                <p class="" style="font-size: 25px">NUTRA-MED PACKAGING </p>
                <p class="font-weight-bold text-uppercase" style="font-size:25px">in-process inspection report
                </p>
            </div>
            <div class="text-right">
                <span> Order Id : <span class="font-weight-bold">{{$data['orderDetails']->orderId}}</span> </span>
            </div>

            <div class="border p-2">
                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> PRODUCT: <span>{{$data['orderDetails']->productName}}</span> </p>
                    <p class="font-weight-bold ">RM#: <span>____________</span></p>
                </div>

                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> CUSTOMER: <span> {{$data['orderDetails']->customers->customer_name}}
                        </span> </p>
                    <p class="font-weight-bold ">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                    <p class="font-weight-bold ">Exp: <span>{{$data['orderDetails']->Exp}}</span></p>
                </div>
            </div>

            <table class="table table-bordered table-sm text-center">
                <thead>
                    <tr>
                        <th class="border">#</th>
                        <th class="border">Date</th>
                        <th class="border"> Time</th>
                        <th class="border" style="width: 7rem">Case#</th>
                        <th class="border">Visual Defects</th>
                        <th class="border">
                            {{ $data['orderDetails']->testOne ? $data['orderDetails']->testOne : 'N/A' }}
                        </th>

                        <th class="border">{{$data['orderDetails']->testTwo ? $data['orderDetails']->testTwo : 'N/A'}}
                        </th>
                        <th class="border">{{$data['orderDetails']->testThree ? $data['orderDetails']->testThree :
                            'N/A'}}
                        </th>
                        <th class="border">{{$data['orderDetails']->testFour ? $data['orderDetails']->testFour : 'N/A'}}
                        </th>
                        <th class="border">{{$data['orderDetails']->testFive ? $data['orderDetails']->testFive : 'N/A'}}
                        </th>
                        <th class="border">A/R 35</th>
                        <th class="border">QA Inspector</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i=4; $i<=12; $i++) <tr>
                        <td class="border">{{$i}}</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        </tr>

                        @endfor
                </tbody>
            </table>

            <div class="row">
                <div class="col-2 font-weight-bold">
                    Notes:
                </div>
                <div class="col-12 d-flex justify-content-start">
                    <div class="border-bottom w-100 border-dark"></div>
                </div>

                <div class="col-12 mt-4 d-flex justify-content-start">
                    <div class="border-bottom w-100 border-dark"></div>
                </div>

                <div class="col-12 mt-4 d-flex justify-content-start">
                    <div class="border-bottom w-100 border-dark"></div>
                </div>
            </div>

            <!-- Footer Section -->
            <div class="footer mt-1 pt-2 ">
                <div class="row ">
                    <div class="col-6">
                        <div>
                            <span class="mr-1">
                                Form: <span># 017-3</span>
                            </span>
                            <span class="mr-1">
                                Rev: <span>{{$data['rev']}}</span>
                            </span>
                            <span>
                                Issued: <span>{{
                                    \Carbon\Carbon::parse($data['orderDetails']->created_at)->format('m/Y')}}</span>
                            </span>

                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <div>Seq. No. <span>7 of 13</span></div>
                    </div>
                </div>
            </div>


        </div>





        {{-- Second Page for Process Parameter Report--}}

        <div class="page-break"></div> <!-- Page break -->
        <p class="no-print text-warning font-weight-bold"> New Page Start </p>


        <div class="container mb-5">

            <div class="text-center">
                <p class="" style="font-size: 25px">NUTRA-MED PACKAGING </p>
                <p class="font-weight-bold text-uppercase" style="font-size:25px">Process Parameters Report
                </p>
            </div>
            <div class="text-right">
                <span> Order Id : <span class="font-weight-bold">{{$data['orderDetails']->orderId}}</span> </span>
            </div>

            <div class="border p-2">
                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> PRODUCT: <span>{{$data['orderDetails']->productName}}</span> </p>
                    <p class="font-weight-bold ">RM#: <span>____________</span></p>
                </div>

                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> CUSTOMER: <span> {{$data['orderDetails']->customers->customer_name}}
                        </span> </p>
                    <p class="font-weight-bold ">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                    <p class="font-weight-bold ">Exp: <span>{{$data['orderDetails']->Exp}}</span></p>
                </div>
            </div>


            <div class="mt-1">
                <span class="mr-2 font-weight-bold">Process Parameter:</span> <span>
                    Moniter Machine Paramters once / shift </span><br>

                <div class="border p-1" style="height: 200px">
                    <span class="" style="font-size: 10px">{{$data['orderDetails']->processParameter}} </span>

                </div>
            </div>

            @php
            $indexSetting = [];
            if (!empty($data['orderDetails']->indexSetting)) {
            $indexSetting = json_decode($data['orderDetails']->indexSetting, true);
            }
            @endphp



            <table class="table table-bordered table-sm text-center">
                <thead>
                    <tr>
                        <th class="border">#</th>
                        <th class="border">Date</th>
                        <th class="border"> Time</th>
                        <th class="border" style="width: 7rem">Case#</th>
                        <th class="border">Machine Speed</th>
                        @foreach ($indexSetting as $item)
                        <th class="border">{{$item}} </th>
                        @endforeach
                        <th class="border">A/R </th>
                        <th class="border">QA Inspector</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i=1; $i<=3; $i++) <tr>
                        <td class="border">{{$i}}</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        @foreach ($indexSetting as $item)
                        <td class="border">&nbsp;</td>
                        @endforeach
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        </tr>

                        @endfor
                </tbody>
            </table>

            <!-- Footer Section -->
            <div class="footer  pt-1 ">
                <div class="row ">
                    <div class="col-6">
                        <div>

                            <div>
                                <span class="mr-1">
                                    Form: <span># 017-06</span>
                                </span>
                                <span class="mr-1">
                                    Rev: <span>{{$data['rev']}}</span>
                                </span>
                                <span>
                                    Issued: <span>{{
                                        \Carbon\Carbon::parse($data['orderDetails']->created_at)->format('m/Y')}}</span>
                                </span>

                            </div>

                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <div>Seq. No. <span>13 of 3</span></div>
                    </div>
                </div>
            </div>


            {{-- 2nd page --}}
            <div class="page-break"></div> <!-- Page break -->

            <div class="text-center">
                <p class="" style="font-size: 25px">NUTRA-MED PACKAGING </p>
                <p class="font-weight-bold text-uppercase" style="font-size:25px">Process Parameters Report
                </p>
            </div>
            <div class="text-right">
                <span> Order Id : <span class="font-weight-bold">{{$data['orderDetails']->orderId}}</span> </span>
            </div>

            <div class="border p-2">
                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> PRODUCT: <span>{{$data['orderDetails']->productName}}</span> </p>
                    <p class="font-weight-bold ">RM#: <span>____________</span></p>
                </div>

                <div class="d-flex justify-content-between ">
                    <p class="font-weight-bold "> CUSTOMER: <span> {{$data['orderDetails']->customers->customer_name}}
                        </span> </p>
                    <p class="font-weight-bold ">Lot#: <span>{{$data['orderDetails']->LOT}}</span></p>
                    <p class="font-weight-bold ">Exp: <span>{{$data['orderDetails']->Exp}}</span></p>
                </div>
            </div>

            <table class="table table-bordered table-sm text-center">
                <thead>
                    <tr>
                        <th class="border">#</th>
                        <th class="border">Date</th>
                        <th class="border"> Time</th>
                        <th class="border" style="width: 7rem">Case#</th>
                        <th class="border">Machine Speed</th>
                        @foreach ($indexSetting as $item)
                        <th class="border">{{$item}} </th>
                        @endforeach
                        <th class="border">A/R </th>
                        <th class="border">QA Inspector</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i=4; $i<=12; $i++) <tr>
                        <td class="border">{{$i}}</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        @foreach ($indexSetting as $item)
                        <td class="border">&nbsp;</td>
                        @endforeach
                        <td class="border">&nbsp;</td>
                        <td class="border">&nbsp;</td>
                        </tr>

                        @endfor
                </tbody>
            </table>




            <div class="row">
                <div class="col-2 font-weight-bold">
                    Notes:
                </div>
                <div class="col-12 d-flex justify-content-start">
                    <div class="border-bottom w-100 border-dark"></div>
                </div>

                <div class="col-12 mt-4 d-flex justify-content-start">
                    <div class="border-bottom w-100 border-dark"></div>
                </div>


            </div>

            <!-- Footer Section -->
            <div class="footer mt-1 pt-1 ">
                <div class="row ">
                    <div class="col-6">
                        <div>

                            <div>
                                <span class="mr-1">
                                    Form: <span># 017-06</span>
                                </span>
                                <span class="mr-1">
                                    Rev: <span>{{$data['rev']}}</span>
                                </span>
                                <span>
                                    Issued: <span>{{
                                        \Carbon\Carbon::parse($data['orderDetails']->created_at)->format('m/Y')}}</span>
                                </span>

                            </div>

                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <div>Seq. No. <span>13 of 3</span></div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    {{---------------------- Inspection 7-13 Close--------------------------------------}}





    {{----------------------Warehouse material form Start--------------------------------------}}
    <div class="page-break mb-5"></div> <!-- Page break -->

    <div class="WareHouse Materia form">

        <div class="container">

            <div class="text-center">
                <p class="" style="font-size: 25px">NUTRA-MED PACKAGING </p>
                <p class="font-weight-bold text-uppercase" style="font-size:25px">Warehouse material Transfer form</p>
            </div>
            <div class="text-right">
                <span> Order Id : <span class="font-weight-bold">{{$data['orderDetails']->orderId}}</span> </span>
            </div>

            <div class="customer">
                <div class="border pl-3 pr-3 pt-1 pb-4">
                    <div class="d-flex justify-content-between ">
                        <span class="font-weight-bold "> Customer:
                            <span>{{$data['orderDetails']->customers->customer_id}}</span>
                        </span>
                        <span class="font-weight-bold ">PO#: <span>{{$data['orderDetails']->PO}}</span></span>
                    </div>
                    <div class="d-flex justify-content-between ">
                        <span class=" "> Name: <span
                                class="mr-5">{{$data['orderDetails']->customers->customer_name}}</span>
                            ph: <span>{{$data['orderDetails']->customers->phone}}</span>
                        </span>
                        <span class="font-weight-bold ">WO#: <span>{{$data['orderDetails']->WO}}</span></span>
                    </div>
                    <div class="d-flex justify-content-end ">
                        <span class="font-weight-bold ">Order Qty:
                            <span>{{$data['orderDetails']->orderQty}}</span></span>
                    </div>
                    <div class="d-flex justify-content-end ">
                        <span class="font-weight-bold ">Blister/Bottel Qty: <input type="text"></span>
                    </div>
                </div>
            </div>

            <div class="product mt-0">
                <div class="border  pl-3 pr-3 pt-1 pb-1">
                    <div class="d-flex justify-content-between ">
                        <span class="font-weight-bold "> Product Name:
                            <span>{{$data['orderDetails']->productName}}</span> </span>
                        <span class="font-weight-bold ">F.Prod #:
                            <span>{{$data['orderDetails']->fProduct}}</span></span>
                    </div>

                    <div class="d-flex justify-content-between ">
                        <span class="font-weight-bold ">Lot#: <span>{{$data['orderDetails']->LOT}}</span></span>
                        <span class="font-weight-bold ">Exp: <span>{{$data['orderDetails']->Exp}}</span></span>
                        <span class="font-weight-bold ">NDC/UPC#:
                            <span>{{$data['orderDetails']->ndcUpc}}</span></span>
                    </div>

                    <div class="d-flex justify-content-between mt-1">
                        <span class="font-weight-bold ">Dosage Form:
                            <span>{{$data['orderDetails']->dosageForm}}</span></span>
                        <span class="font-weight-bold "># of <span>{{$data['orderDetails']->dosageForm}}</span>/ unit:
                            <span>{{$data['orderDetails']->ofDosesUnit}}</span></span>
                        <span class="font-weight-bold ">Product supplied by:
                            <span>{{$data['orderDetails']->prodSuplyBy}}</span></span>
                    </div>
                    <div class="d-flex justify-content-start ">
                        <span class="font-weight-bold ">Description:
                            <span>{{$data['orderDetails']->unitDescription}}</span></span>
                    </div>
                </div>
            </div>


            <hr class="mt-1 mb-3">

            <h4 class="text-center">Bulk Prod lot # : <span>{{$data['orderDetails']->bluckProdLot}}</span></h4>


            <table class="table table-sm">
                <tbody>
                    @php
                    $compCode= json_decode($data['orderDetails']->compCode, true);
                    $compName=json_decode($data['orderDetails']->compName, true);
                    $compDesc=json_decode($data['orderDetails']->compDesc, true);
                    @endphp

                    @foreach ($compName as $key=> $item)
                    <tr>
                        <td>{{$item}}</td>
                        <td>{{$compDesc[$key]}}</td>
                        <td>{{$compCode[$key]}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Footer Section -->
            <div class="footer">
                <div class="row ">
                    <div class="col-6">
                        <div>
                            <span class="mr-1">
                                Form: <span># 014-4</span>
                            </span>
                            <span class="mr-1">
                                Rev: <span>{{$data['rev']}}</span>
                            </span>
                            <span>
                                Issued:
                                <span>{{\Carbon\Carbon::parse($data['orderDetails']->created_at)->format('m/Y')}}</span>
                            </span>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    {{----------------------Warehouse material form Close--------------------------------------}}



</div>
{{------------------------------------- LandScapeDiv Form Print Div End-----------------------------------------}}



{{-- <script>
    function printElement(elementId, orientation = 'portrait') {
  const printContent = document.getElementById(elementId).outerHTML;
  const originalContent = document.body.innerHTML;

  // Define styles for page orientation and include .page-break and .no-print
  const orientationStyle = `
    <style>
      @page { size: ${orientation}; }
      .page-break { page-break-before: always; }
      .no-print { display: none !important; }
    </style>`;

  // Replace body content with the selected element and inject orientation styles
  document.body.innerHTML = orientationStyle + printContent;

  // Trigger print
  window.print();

  // Restore the original content after printing
  document.body.innerHTML = originalContent;
}
</script> --}}


<script>
    function printElement(elementId, orientation = 'portrait') {
  const printContent = document.getElementById(elementId).outerHTML;

  // Create a temporary iframe for printing
  const printFrame = document.createElement('iframe');
  printFrame.style.position = 'absolute';
  printFrame.style.top = '-10000px';
  printFrame.style.left = '-10000px';

  // Append the iframe to the body
  document.body.appendChild(printFrame);

  const printDoc = printFrame.contentDocument || printFrame.contentWindow.document;

  // Copy all styles from the main document to the iframe
  const styles = Array.from(document.styleSheets)
    .map((styleSheet) => {
      try {
        return Array.from(styleSheet.cssRules).map((rule) => rule.cssText).join('\n');
      } catch (e) {
        return ''; // Skip inaccessible styles
      }
    })
    .join('\n');

  // Write content and styles to the iframe
  printDoc.open();
  printDoc.write(`
    <html>
    <head>
      <title>Print</title>
      <style>
        @page { size: ${orientation} !important; }
        .page-break { page-break-before: always; }
        .no-print { display: none !important; }
        ${styles} /* Include all styles from the main document */
      </style>
    </head>
    <body>${printContent}</body>
    </html>
  `);
  printDoc.close();

  // Wait for content to load and trigger the print
  printFrame.onload = function () {
    printFrame.contentWindow.focus();
    printFrame.contentWindow.print();

    // Remove the iframe after printing
    document.body.removeChild(printFrame);
  };
}




</script>

@else

<h4 class="text-center text-muted">
    Kindly select a <strong>Packaging Order</strong> or <strong>Duplicate Packaging Order</strong> to print
    all
    forms.
</h4>


@endif















@endsection
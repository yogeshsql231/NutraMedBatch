@extends('layouts.masterLayout')

@section('title','inspection_7_13')

@section('content')

<div class="section-header">
    <h1>Inspection 7-13</h1>
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
            size: A4 landscape;
            /* Landscape orientation */
            margin: 20mm;
        }
    }
</style>





<div class="row mb-5">
    <div class="col col-6">
        <form id="orderForm" action="{{route('inspection_7_13_print')}}" method="post">
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
        <form id="orderForm" action="{{route('inspection_7_13_print')}}" method="post">
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

                    <th class="border">{{$data['orderDetails']->testTwo ? $data['orderDetails']->testTwo : 'N/A'}}</th>
                    <th class="border">{{$data['orderDetails']->testThree ? $data['orderDetails']->testThree : 'N/A'}}
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
        <div class="footer  ">
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

                    <th class="border">{{$data['orderDetails']->testTwo ? $data['orderDetails']->testTwo : 'N/A'}}</th>
                    <th class="border">{{$data['orderDetails']->testThree ? $data['orderDetails']->testThree : 'N/A'}}
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

{{-- =======================================================================================----}}

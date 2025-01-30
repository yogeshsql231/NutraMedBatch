@extends('layouts.masterLayout')

@section('title','inspection 6-8-10')

@section('content')

<div class="section-header">
    <h1>Inspection 6-8-10 </h1>
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
    }
</style>

<div class="row mb-5">
    <div class="col col-6">
        <form id="orderForm" action="{{route('inspection_6_8_10_Print')}}" method="post">
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
        <form id="orderForm" action="{{route('inspection_6_8_10_Print')}}" method="post">
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

@if ($orderDetails)


<div class="printtableDiv">

    <div class="container mb-5">

        <div class="page_heading">
            <div class="text-center">
                <p class="" style="font-size: 25px">NUTRA-MED PACKAGING</p>
                <p class="font-weight-bold text-uppercase" style="font-size:25px">LINE CLEARANCE FORM</p>
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
                    $compName = json_decode($orderDetails->compName, true);
                    $compCode=json_decode($orderDetails->compCode, true);
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
                1. The room machine and other equipment are clean. Floor is swept and mopped. Walls and ceiling tiles
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
                3. The product, packages and all the components listed above Have been checked and they meet required
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
            <p class="p-1">I have checked all the attached components and verified all the lot#, Exp.date and code#s.
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
                            Rev: <span id="revision">{{$rev}}</span>
                        </span>
                        <span>
                            Issued: <span>{{
                                \Carbon\Carbon::parse($orderDetails->created_at)->format('m/Y')}}</span>
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
                            Rev: <span id="revision">{{$rev}}</span>
                        </span>
                        <span>
                            Issued: <span>{{
                                \Carbon\Carbon::parse($orderDetails->created_at)->format('m/Y')}}</span>
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
                    $compName= json_decode($orderDetails->compName);
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
                            Rev: <span id="revision">{{$rev}}</span>
                        </span>
                        <span>
                            Issued: <span>{{
                                \Carbon\Carbon::parse($orderDetails->created_at)->format('m/Y')}}</span>
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
                            Rev: <span id="revision">{{$rev}}</span>
                        </span>
                        <span>
                            Issued: <span>{{
                                \Carbon\Carbon::parse($orderDetails->created_at)->format('m/Y')}}</span>
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
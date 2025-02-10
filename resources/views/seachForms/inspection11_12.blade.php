@extends('layouts.masterLayout')

@section('title','inspection 11-12')

@section('content')

<div class="section-header">
    <h1>Inspection 11-12 Line / Pallet Id</h1>
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
        <form id="orderForm" action="{{route('inspection11_12_Print')}}" method="post">
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
        <form id="orderForm" action="{{route('inspection11_12_Print')}}" method="post">
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


@if($orderDetails)
<div class="printtableDiv">

    <div class="container mb-5">

        <div class="page_heading">
            <div class="text-center">
                <p class="" style="font-size: 25px">NUTRA-MED PACKAGING</p>
                <p class="font-weight-bold text-uppercase" style="font-size:25px">Certificate of Compliance</p>
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
                    <p class="font-weight-bold">Exp: <span>{{$orderDetails->Exp ? $orderDetails->Exp :'NA'}}</span></p>
                </div>
            </div>
        </div>



        <div class="mt-3">
            <p>This is to certify that the above product was produced in compliance with cGMP standards and meets
                established Nutra-Med and/or customer specifications.</p>

            <p>Following batch records were reviewed and have been found to be in compliance with the cGMP and Nutra-Med
                and/or customer's specifications.</p>

            <p>Package Type: [ ] Blister [ ] Bottle [ ] Primary [ ] Secondary</p>
        </div>

        <div class="mt-2">
            {{-- <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Batch Record Document</th>
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
                    <tr>
                        <td>14</td>
                        <td>Ancillary Documents:</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <div class="ml-4">

                <table class="table table-sm">
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Counting Scale Setup</td>
                            <td># F017-10/11</td>
                            <td>________</td>
                            <td>________</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Weight Verification</td>
                            <td># F005-6</td>
                            <td>________</td>
                            <td>________</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Printed Material Issuance</td>
                            <td># 014-3</td>
                            <td>________</td>
                            <td>________</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Other</td>
                            <td>________</td>
                            <td>________</td>
                            <td>________</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Other</td>
                            <td>________</td>
                            <td>________</td>
                            <td>________</td>
                        </tr>
                    </tbody>
                </table>

            </div> --}}



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
                                Rev: <span id="revision">{{$rev}}</span>
                            </span>
                            <span>
                                Issued: <span>{{
                                    \Carbon\Carbon::parse($orderDetails->created_at)->format('m/Y')}}</span>
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
                <h6> Order Id: {{$orderDetails->orderId}} </h6>


                <p class="font-weight-bold"> PRODUCT: <span>{{$orderDetails->productName}}</span> </p><br>

                <p class="font-weight-bold"> CUSTOMER: <span> {{$orderDetails->customers->customer_name}} </span>
                </p>

                <p class="font-weight-bold">Lot#: <span>{{$orderDetails->LOT}}</span></p>
                <p class="font-weight-bold">Exp: <span>{{$orderDetails->Exp ? $orderDetails->Exp :'NA' }}</span></p>



            </div>
        </div>


        <div class="mt-5 font-weight-bold">

            <p>Total People: &nbsp; {{$orderDetails->peopleAssigment}} line leader </p>

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
                    <p class="font-weight-bold">Exp: <span>{{$orderDetails->Exp ? $orderDetails->Exp :'NA'}}</span></p>
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
                            Rev: <span id="revision">{{$rev}}</span>
                        </span>
                        <span>
                            Issued: <span>{{
                                \Carbon\Carbon::parse($orderDetails->created_at)->format('m/Y')}}</span>
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
                <p class="font-weight-bold" style="font-size: 200px"> {{$orderDetails->orderId}} </p>
            </div>


            <p class="font-weight-bold"> PRODUCT: <span>{{$orderDetails->productName}}</span> </p><br>

            <p class="font-weight-bold"> CUSTOMER: <span> {{$orderDetails->customers->customer_name}} </span>
            </p>

            <p class="font-weight-bold">Lot#: <span>{{$orderDetails->LOT}}</span></p>
            <p class="font-weight-bold">Exp: <span>{{$orderDetails->Exp ? $orderDetails->Exp :'NA' }}</span></p>
        </div>


        <div class="container-fluid mt-5">
            <p>QUANTITY: <span>____________________________</span></p>

            <p>PALLET # <span>____________________________</span>OF <span>____________________________</span></p>

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
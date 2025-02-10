@extends('layouts.masterLayout')

@section('title','Inspection 2-3-5')

@section('content')

<div class="section-header">
    <h1>Inspections 2-3-5 </h1>
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

{{-- <div class="row mb-5">
    <div class="col col-4">
        <form id="orderForm" action="{{route('chnageControlePackagingOrder')}}" method="post">
            @csrf
            <label for="orderSelect" class="fw-bold">Select an Order:</label>
            <select id="orderSelect" class="form-control" name="orderId" onchange="this.form.submit()">
                <option value="">Select an order</option>
                @foreach ($orders as $item)
                <option value="{{$item->id}}">{{$item->orderId .' - '. $item->productName}}</option>
                @endforeach
            </select>
        </form>
    </div>
</div> --}}


<div class="row mb-5">
    <div class="col col-6">
        <form id="orderForm">
            @csrf
            <label for="orderSelect" class="fw-bold">Select an Order(4 Digit Order Id):</label>
            <select id="orderSelect" class="form-control" name="orderId">
                <option value="">Select an Customer order</option>
                @foreach ($orders as $item)
                <option value="{{$item->id}}">{{$item->orderId .' - '. $item->productName}}</option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="col col-6">
        <form id="orderFormDuplicatePackaging">
            @csrf
            <label for="orderSelect1" class="fw-bold">Select an Order(5 Digit Order Id):</label>
            <select id="orderSelect1" class="form-control" name="orderId">
                <option value="">Select an Production order</option>
                @foreach ($duplicatePackagigOrder as $item)
                <option value="{{$item->id}}">{{$item->orderId .' - '. $item->productName}}</option>
                @endforeach
            </select>
        </form>
    </div>
</div>



{{-- Equipment/room cleaning report major clean-up --}}

<div class="printtableDiv">

    <div class="container">
        <div class="text-center">
            <p class="" style="font-size: 25px">NUTRA-MED PACKAGING </p>
            <p class="font-weight-bold text-uppercase" style="font-size:25px">Equipment/room cleaning report
                <br> major clean-up
            </p>
        </div>
        <div class="text-right">
            <span> Order Id : <span id="orderId" class="font-weight-bold"></span> </span>
        </div>

        <div class="border p-2">
            <div class="d-flex justify-content-between ">
                <p class="font-weight-bold "> PRODUCT: <span id="productName"></span> </p>
                <p class="font-weight-bold ">RM#: <span>____________</span></p>
            </div>

            <div class="d-flex justify-content-between ">
                <p class="font-weight-bold "> CUSTOMER: <span id="customerName"></span> </p>
                <p class="font-weight-bold ">Lot#: <span id='lot'></span></p>
                <p class="font-weight-bold ">Exp: <span id="exp"></span></p>
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
                        sanitized in accordance with the written procedures. Machine is cleaned and body of the machine
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
                        product and blister cards, previous film and foil rolls, film web from the machine is removed.
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
                        cotton machine, induction sealer, capper, metal detector, labeler, shrink-wrapper, neck bander,
                        cables connected to the machine and ink-jet printer, glue machine, etc., are all cleaned as per
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
                    <p><strong>8</strong> The wall, ceiling tiles, hanging cables, conveyor, tables, stools, mechanic
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

            <p class="font-weight-bold">I have thoroughly inspected the entire area, the machine and machine parts for
                proper cleaning. The packaging
                line is properly cleaned and the line is free from previous product components. I am approving this area
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
                            Rev: <span id="rev"></span>
                        </span>
                        <span>
                            Issued: <span id="Issued"></span>
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
            <p class="font-weight-bold text-uppercase" style="font-size:25px">Printmat Inspection and Destruction Report
            </p>
        </div>

        <div class="text-right">
            <span> Order Id : <span id="orderId1" class="font-weight-bold"></span> </span>
        </div>



        <div class="border p-2">
            <div class="d-flex justify-content-between ">
                <p class="font-weight-bold "> PRODUCT: <span id="productName1"></span> </p>
                <p class="font-weight-bold ">RM#: <span>____________</span></p>
            </div>

            <div class="d-flex justify-content-between ">
                <p class="font-weight-bold "> CUSTOMER: <span id="customerName1"></span> </p>
                <p class="font-weight-bold ">Lot#: <span id='lot1'></span></p>
                <p class="font-weight-bold ">Exp: <span id="exp1"></span></p>
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
                            Rev: <span id="rev1"></span>
                        </span>
                        <span>
                            Issued: <span id="Issued1"></span>
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
            <span> Order Id : <span id="orderId2" class="font-weight-bold"></span> </span>
        </div>



        <div class="border p-2">
            <div class="d-flex justify-content-between ">
                <p class="font-weight-bold "> PRODUCT: <span id="productName2"></span> </p>
                <p class="font-weight-bold ">RM#: <span>____________</span></p>
            </div>

            <div class="d-flex justify-content-between ">
                <p class="font-weight-bold "> CUSTOMER: <span id="customerName2"></span> </p>
                <p class="font-weight-bold ">Lot#: <span id='lot2'></span></p>
                <p class="font-weight-bold ">Exp: <span id="exp2"></span></p>
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
                        All machine parts that come in contact with the product have been cleaned in accordance with the
                        Minor clean-up written procedures. Product and product residue is removed from all parts of the
                        machine. (Product hopper, vibrator, feeder, brush feeder and all other parts of the machine.)
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
                    <p><strong class="mr-2">4</strong> The entire area, floor, is swept, mopped and cleaned. The trash
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


            <p class="font-weight-bold">I have thoroughly inspected the entire area, the machine and machine parts for
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
                            Rev: <span id="rev2"></span>
                        </span>
                        <span>
                            Issued: <span id="Issued2"></span>
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
            <p class="font-weight-bold text-uppercase" style="font-size:25px">LABEL ISSUANCE AND RECONCILIATION REPORT
            </p>
        </div>
        <div class="text-right">
            <span> Order Id : <span id="orderId3" class="font-weight-bold"></span> </span>
        </div>



        <div class="border p-2">
            <div class="d-flex justify-content-between ">
                <p class="font-weight-bold "> PRODUCT: <span id="productName3"></span> </p>
                <p class="font-weight-bold ">RM#: <span>____________</span></p>
            </div>

            <div class="d-flex justify-content-between ">
                <p class="font-weight-bold "> CUSTOMER: <span id="customerName3"></span> </p>
                <p class="font-weight-bold ">Lot#: <span id='lot3'></span></p>
                <p class="font-weight-bold ">Exp: <span id="exp3"></span></p>
            </div>

            <div class="text-right">
                <span class="font-weight-bold">F Prod.#: <span id="fProd3"></span></span>
            </div>
        </div>

        <hr class="mt-0">

        <div class=" border-top border-bottom p-4 mb-3 ">
            <div class="row font-weight-bold">
                <div class="col-6">LABELS USED FOR: <span class="border-bottom d-inline-block w-50 mt-1">&nbsp;</span>
                </div>
                <div class="col-6">QUANTITY REQUIRED: <span class="border-bottom d-inline-block w-50 mt-1">&nbsp;</span>
                </div>
            </div>

            <div class="row font-weight-bold">
                <div class="col-4">Quantity Issued: <span class="border-bottom d-inline-block w-50 mt-1">&nbsp;</span>
                </div>
                <div class="col-4">By: <span class="border-bottom d-inline-block w-50 mt-1">&nbsp;</span>
                </div>
                <div class="col-4">Date: <span class="border-bottom d-inline-block w-50 mt-1">&nbsp;</span>
                </div>
            </div>

            <div class="row font-weight-bold">
                <div class="col-4">Quantity Issued: <span class="border-bottom d-inline-block w-50 mt-1">&nbsp;</span>
                </div>
                <div class="col-4">By: <span class="border-bottom d-inline-block w-50 mt-1">&nbsp;</span>
                </div>
                <div class="col-4">Date: <span class="border-bottom d-inline-block w-50 mt-1">&nbsp;</span>
                </div>
            </div>

            <div class="row font-weight-bold">
                <div class="col-4">Quantity Issued: <span class="border-bottom d-inline-block w-50 mt-1">&nbsp;</span>
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
                            Rev: <span id="rev3"></span>
                        </span>
                        <span>
                            Issued: <span id="Issued3"></span>
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


<!-- Print Button -->
<div class="text-center mt-5">
    <button class="btn btn-primary" onclick="printDiv()">Print</button>
</div>

<script>
    function printDiv() {
        window.print();
    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $('#orderSelect').on('change', function() {
        var orderId = $(this).val();

        if(orderId) {
            $.ajax({
                url: "{{ route('fetchPackagingOrderDetails') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    orderId: orderId,
                },

                success: function(response) {
                    console.log(response);
                    if(response.success) {

                        console.log(response);
                        $('#orderId').text(response.data.orderId);
                        $('#productName').text(response.data.productName)
                        $('#customerName').text(response.data.customers.customer_name)
                        $('#lot').text(response.data.LOT)
                        $('#exp').text(response.data.Exp ? response.data.Exp : 'Na')
                        $('#rev').text(response.rev)
                        const createdAt = new Date(response.data.created_at);
                        const options = { month: 'numeric', year: 'numeric' };
                       $('#Issued').text(createdAt.toLocaleDateString('en-US', options));



                        $('#orderId1').text(response.data.orderId);
                        $('#productName1').text(response.data.productName)
                        $('#customerName1').text(response.data.customers.customer_name)
                        $('#lot1').text(response.data.LOT)
                        $('#exp1').text(response.data.Exp ? response.data.Exp : 'Na')
                        $('#rev1').text(response.rev)
                        $('#Issued1').text(createdAt.toLocaleDateString('en-US', options));

                        $('#orderId2').text(response.data.orderId);
                        $('#productName2').text(response.data.productName)
                        $('#customerName2').text(response.data.customers.customer_name)
                        $('#lot2').text(response.data.LOT)
                        $('#exp2').text(response.data.Exp ? response.data.Exp : 'Na')
                        $('#rev2').text(response.rev)
                        $('#Issued2').text(createdAt.toLocaleDateString('en-US', options));

                        $('#orderId3').text(response.data.orderId);
                        $('#productName3').text(response.data.productName)
                        $('#customerName3').text(response.data.customers.customer_name)
                        $('#lot3').text(response.data.LOT)
                        $('#exp3').text(response.data.Exp ? response.data.Exp : 'Na')
                        $('#fProd3').text(response.data.fProduct)
                        $('#rev3').text(response.rev)
                        $('#Issued3').text(createdAt.toLocaleDateString('en-US', options));

                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    alert("An error occurred: " + xhr.status + " " + xhr.statusText);
                }
            });
        }
    });
</script>


{{-- new ajax for duplicate packaging order fetch record --}}

<script>
    $('#orderSelect1').on('change', function() {
        var orderId = $(this).val();

        if(orderId) {
            $.ajax({
                url: "{{ route('fetchDuplicatePackagingOrderDetails') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    orderId: orderId,
                },

                success: function(response) {
                    console.log(response);
                    if(response.success) {

                        console.log(response);
                        $('#orderId').text(response.data.orderId);
                        $('#productName').text(response.data.productName)
                        $('#customerName').text(response.data.customers.customer_name)
                        $('#lot').text(response.data.LOT)
                        $('#exp').text(response.data.Exp ? response.data.Exp : 'Na')
                        $('#rev').text(response.rev)
                        const createdAt = new Date(response.data.created_at);
                        const options = { month: 'numeric', year: 'numeric' };
                       $('#Issued').text(createdAt.toLocaleDateString('en-US', options));



                        $('#orderId1').text(response.data.orderId);
                        $('#productName1').text(response.data.productName)
                        $('#customerName1').text(response.data.customers.customer_name)
                        $('#lot1').text(response.data.LOT)
                        $('#exp1').text(response.data.Exp ? response.data.Exp : 'Na')
                        $('#rev1').text(response.rev)
                        $('#Issued1').text(createdAt.toLocaleDateString('en-US', options));

                        $('#orderId2').text(response.data.orderId);
                        $('#productName2').text(response.data.productName)
                        $('#customerName2').text(response.data.customers.customer_name)
                        $('#lot2').text(response.data.LOT)
                        $('#exp2').text(response.data.Exp ? response.data.Exp : 'Na')
                        $('#rev2').text(response.rev)
                        $('#Issued2').text(createdAt.toLocaleDateString('en-US', options));

                        $('#orderId3').text(response.data.orderId);
                        $('#productName3').text(response.data.productName)
                        $('#customerName3').text(response.data.customers.customer_name)
                        $('#lot3').text(response.data.LOT)
                        $('#exp3').text(response.data.Exp ? response.data.Exp : 'Na')
                        $('#fProd3').text(response.data.fProduct)
                        $('#rev3').text(response.rev)
                        $('#Issued3').text(createdAt.toLocaleDateString('en-US', options));

                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    alert("An error occurred: " + xhr.status + " " + xhr.statusText);
                }
            });
        }
    });
</script>




@endsection

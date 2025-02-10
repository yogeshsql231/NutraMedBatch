@extends('layouts.masterLayout')

@section('title','Inspection scale weight printed mat')

@section('content')

<div class="section-header">
    <h1>Inspection scale weight printed mat</h1>
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


<div class="row mb-5">
    <div class="col col-6">
        <form id="orderForm">
            @csrf
            <label for="orderSelect" class="fw-bold">Select an Order:</label>
            <select id="orderSelect" class="form-control" name="orderId">
                <option value="">Select an order</option>
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


<div class="printtableDiv">



    <div class="container mb-5">

        <div class="text-center">
            <p class="" style="font-size: 25px">NUTRA-MED PACKAGING </p>
            <p class="font-weight-bold text-uppercase" style="font-size:25px">Counting Scale Set-Up form
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
                            Rev: <span id="rev"></span>
                        </span>
                        <span>
                            Issued: <span id="Issued"></span>
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
                                Rev: <span id="rev1"></span>
                            </span>
                            <span>
                                Issued: <span id="Issued1"></span>
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
                    <li>Press STANDBY/OPERATE key to turn the scale on. Press RESET key to clear any previous operation.
                    </li>
                    <li>The UNIT WEIGHT BY light should be blinking at this point.</li>
                    <li>Press the SAMPLE key. Any tare container will be automatically tared.</li>
                    <li>The display will show " ADD SAMPLE AND 10 PCS".</li>
                    <li>Use 0 TO 9 KEY PAD to display the sample size desired.</li>
                    <li>Place the selected number of sample pieces (accurately counted) on the weighing pan or in the
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
                            Rev: <span id="rev2"></span>
                        </span>
                        <span>
                            Issued: <span id="Issued2"></span>
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
            <p class="" style="font-size: 25px">NUTRA-MED PACKAGING </p>
            <p class="font-weight-bold text-uppercase" style="font-size:25px">Printed material Issuance form
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
        </div>

        <h6 class="mt-3">COMPONENT NAME: <span class="border-bottom w-25 border-dark d-inline-block"></span></h6>

        <div class="d-flex justify-content-between ">
            <p> Receipt#: <span>________________________________</span> </p>
            <p>Lot# / Batch#: <span>________________________________</span></p>
            <p>Code# / Item#: <span>________________________________</span></p>
        </div>

        <div class="d-flex justify-content-between font-weight-bold ">
            <p> Total Quantity Issued: <span>________________________________</span> </p>
            <p>Date Issued: <span>________________________________</span></p>
            <p>Issued By: <span>________________________________</span></p>
        </div>


        <p class="font-weight-bold">Break Down of the total quantity:</p>

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
        </div>
        @endfor

        <div class="row">
            <div class="col-6"></div>
            <div class="col-6">
                <Span>Toatl Quantity: _______________________________________</Span>
            </div>
        </div>
        <hr>

        <div class="d-flex justify-content-between font-weight-bold ">
            <p> Quantity Returned: <span>________________________________</span> </p>
            <p>Date Returned: <span>________________________________</span></p>
            <p>Returned By: <span>________________________________</span></p>
        </div>

        <small class="font-weight-bold">Break Down of the Quantity Returned:</small>

        @for($i = 0; $i < 4; $i++) <div class="row mt-2">
            <div class="col-6">
                <p>
                    <span>- _________________</span>
                    <span>X _________________</span>
                    <span>= _________________</span>
                </p>
            </div>

    </div>
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
    <div class="footer mt-5 pt-3 ">
        <div class="row ">
            <div class="col-6">
                <div>
                    <span class="mr-1">
                        Form: <span># 014-3</span>
                    </span>
                    <span class="mr-2">
                        Rev: <span id="rev3"></span>
                    </span>
                    <span>
                        Issued: <span id="Issued3"></span>
                    </span>

                </div>
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
                    orderId: orderId
                },
                success: function(response) {
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
                        $('#bluckProdLot').text(response.data.bluckProdLot)
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
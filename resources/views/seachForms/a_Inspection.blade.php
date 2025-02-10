@extends('layouts.masterLayout')

@section('title','A-Inspectoin')

@section('content')

<div class="section-header">
    <h1>A-Inspection- RE-inspection/Random sampling</h1>
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
            <p class="font-weight-bold text-uppercase" style="font-size:25px">Line approval form
                for inspection/re-inspection/carton printing
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
                        $('#visualInspection').text(response.data.visualInspection)
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
                        $('#processParameter').text(response.data.processParameter)
                        $('#rev1').text(response.rev)
                        $('#Issued1').text(createdAt.toLocaleDateString('en-US', options));



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

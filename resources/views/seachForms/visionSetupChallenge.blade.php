@extends('layouts.masterLayout')

@section('title','Vision Setup Challenge')

@section('content')

<div class="section-header">
    <h1> vision Setup Challenge</h1>
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
            <label for="orderSelect" class="fw-bold">Select an Order(4 Digit order Id):</label>
            <select id="orderSelect" class="form-control" name="orderId">
                <option value="">Select an customer order</option>
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
            <p class="font-weight-bold text-uppercase" style="font-size:25px">Vision system setup and challenge
                verification</p>
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
                            Rev: <span id="rev"></span>
                        </span>
                        <span>
                            Issued: <span id="Issued"></span>
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
@extends('layouts.masterLayout')

@section('title','Material Transfer 4.1')


@section('content')

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
            margin: 1cm;

        }
    }
</style>


<div class="section-header">
    <h1>Material Transfer 4.1 </h1>
</div>


<div class="row mb-5">
    <div class="col col-6">
        <form id="orderForm">
            @csrf
            <label for="orderSelect" class="fw-bold">Select an Order(4 Digit Order Id):</label>
            <select id="orderSelect" class="form-control" name="orderId">
                <option value="">Select an customer order</option>
                @foreach ($orders as $item)
                <option value="{{$item->id}}">{{$item->orderId .' - '. $item->productName}}</option>
                @endforeach
            </select>
            <input type="hidden" name="tbName" value="Customer Order">
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

    <div class="container-fluid">
        <div class="text-center">
            <p class="" style="font-size: 25px">NUTRA-MED PACKAGING </p>
            <p class="font-weight-bold text-uppercase" style="font-size:25px">Material Transfer Report
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
                                Rev: <span id="rev"></span>
                            </span>
                            <span>
                                Issued: <span id="Issued"></span>
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
                                Rev: <span id="rev1"></span>
                            </span>
                            <span>
                                Issued: <span id="Issued1"></span>
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

                        // console.log(response);
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
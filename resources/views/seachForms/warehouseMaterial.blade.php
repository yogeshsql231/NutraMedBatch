@extends('layouts.masterLayout')

@section('title','WareHouse Material')

@section('content')

<div class="section-header">
    <h1>Warehouse Material</h1>
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
            size: landscape;
            margin: 1cm;
        }

    }
</style>

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




<div class="printtableDiv">

    <div class="container">

        <div class="text-center">
            <p class="" style="font-size: 25px">NUTRA-MED PACKAGING </p>
            <p class="font-weight-bold text-uppercase" style="font-size:25px">Warehouse material Transfer form</p>
        </div>
        <div class="text-right">
            <span> Order Id : <span id="orderId" class="font-weight-bold"></span> </span>
        </div>

        <div class="customer">
            <div class="border pl-3 pr-3 pt-1 pb-4">
                <div class="d-flex justify-content-between ">
                    <span class="font-weight-bold "> Customer: <span id="customerId"></span> </span>
                    <span class="font-weight-bold ">PO#: <span id="po"></span></span>
                </div>
                <div class="d-flex justify-content-between ">
                    <span class=" "> Name: <span id="customerName" class="mr-5"></span>
                        ph: <span id="phone"></span>
                    </span>
                    <span class="font-weight-bold ">WO#: <span id="wo"></span></span>
                </div>
                <div class="d-flex justify-content-end ">
                    <span class="font-weight-bold ">Order Qty: <span id="orderQty"></span></span>
                </div>
                <div class="d-flex justify-content-end ">
                    <span class="font-weight-bold ">Blister/Bottel Qty: <input type="text"></span>
                </div>
            </div>
        </div>

        <div class="product mt-0">
            <div class="border  pl-3 pr-3 pt-1 pb-1">
                <div class="d-flex justify-content-between ">
                    <span class="font-weight-bold "> Product Name: <span id="productName"></span> </span>
                    <span class="font-weight-bold ">F.Prod #: <span id="fProd"></span></span>
                </div>

                <div class="d-flex justify-content-between ">
                    <span class="font-weight-bold ">Lot#: <span id='lot'></span></span>
                    <span class="font-weight-bold ">Exp: <span id="exp"></span></span>
                    <span class="font-weight-bold ">NDC/UPC#: <span id="ndcUpc"></span></span>
                </div>

                <div class="d-flex justify-content-between mt-1">
                    <span class="font-weight-bold ">Dosage Form: <span id='dosageForm'></span></span>
                    <span class="font-weight-bold "># of <span id="dosageForm1"></span>/ unit: <span
                            id="dosageUnit"></span></span>
                    <span class="font-weight-bold ">Product supplied by: <span id="prodSuplyBy"></span></span>
                </div>
                <div class="d-flex justify-content-start ">
                    <span class="font-weight-bold ">Description: <span id="unitDescription"></span></span>
                </div>
            </div>
        </div>


        <hr class="mt-2 mb-3">

        <h4 class="text-center">Bulk Prod lot # : <span id="bluckProdLot"></span></h4>


        <table id="componentTable" class="table table-sm">
            {{-- <thead>
                <tr>
                    <th>#</th>
                    <th>Component Name</th>
                    <th>Component Description</th>
                    <th>Component Code</th>
                </tr>
            </thead> --}}
            <tbody>
                <!-- Dynamic rows will be appended here -->
            </tbody>
        </table>






        <!-- Footer Section -->
        <div class="footer  pt-1">
            <div class="row ">
                <div class="col-6">
                    <div>
                        <span class="mr-1">
                            Form: <span># 014-4</span>
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
                        $('#customerId').text(response.data.customers.customer_id)
                        $('#phone').text(response.data.customers.phone)
                        $('#po').text(response.data.PO)
                        $('#wo').text(response.data.WO)
                        $('#orderQty').text(response.data.orderQty)
                        $('#fProd').text(response.data.fProduct ? response.data.fProduct : 'Na')
                        $('#ndcUpc').text(response.data.ndcUpc ? response.data.ndcUpc : 'Na')
                        $('#dosageForm').text(response.data.dosageForm ? response.data.dosageForm : 'Na')
                        $('#dosageForm1').text(response.data.dosageForm ? response.data.dosageForm : 'Na')
                        $('#dosageUnit').text(response.data.ofDosesUnit ? response.data.ofDosesUnit : 'Na')
                        $('#prodSuplyBy').text(response.data.prodSuplyBy ? response.data.prodSuplyBy : 'Na')
                        $('#unitDescription').text(response.data.unitDescription ? response.data.unitDescription : 'Na')
                        $('#bluckProdLot').text(response.data.bluckProdLot ? response.data.bluckProdLot : 'Na')

                        let compCodes = JSON.parse(response.data.compCode);
                        let compDescs = JSON.parse(response.data.compDesc);
                        let compNames = JSON.parse(response.data.compName);

                        let componentTable = $('#componentTable tbody');
                        componentTable.empty();
                        compCodes.forEach((code, index) => {
                            let row = `<tr>
                                <td>${compNames[index] ? compNames[index] : 'N/A'}</td>
                                <td>${compDescs[index] ? compDescs[index] : 'N/A'}</td>
                                <td>${code ? code : 'N/A'}</td>
                            </tr>`;
                            componentTable.append(row);
                        });





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

                        $('#orderId').text(response.data.orderId);
                        $('#productName').text(response.data.productName)
                        $('#customerName').text(response.data.customers.customer_name)
                        $('#lot').text(response.data.LOT)
                        $('#exp').text(response.data.Exp ? response.data.Exp : 'Na')
                        $('#customerId').text(response.data.customers.customer_id)
                        $('#phone').text(response.data.customers.phone)
                        $('#po').text(response.data.PO)
                        $('#wo').text(response.data.WO)
                        $('#orderQty').text(response.data.orderQty)
                        $('#fProd').text(response.data.fProduct ? response.data.fProduct : 'Na')
                        $('#ndcUpc').text(response.data.ndcUpc ? response.data.ndcUpc : 'Na')
                        $('#dosageForm').text(response.data.dosageForm ? response.data.dosageForm : 'Na')
                        $('#dosageForm1').text(response.data.dosageForm ? response.data.dosageForm : 'Na')
                        $('#dosageUnit').text(response.data.ofDosesUnit ? response.data.ofDosesUnit : 'Na')
                        $('#prodSuplyBy').text(response.data.prodSuplyBy ? response.data.prodSuplyBy : 'Na')
                        $('#unitDescription').text(response.data.unitDescription ? response.data.unitDescription : 'Na')
                        $('#bluckProdLot').text(response.data.bluckProdLot ? response.data.bluckProdLot : 'Na')

                        let compCodes = JSON.parse(response.data.compCode);
                        let compDescs = JSON.parse(response.data.compDesc);
                        let compNames = JSON.parse(response.data.compName);

                        let componentTable = $('#componentTable tbody');
                        componentTable.empty();
                        compCodes.forEach((code, index) => {
                            let row = `<tr>
                                <td>${compNames[index] ? compNames[index] : 'N/A'}</td>
                                <td>${compDescs[index] ? compDescs[index] : 'N/A'}</td>
                                <td>${code ? code : 'N/A'}</td>
                            </tr>`;
                            componentTable.append(row);
                        });





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




@endsection
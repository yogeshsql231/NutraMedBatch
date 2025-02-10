@extends('layouts.masterLayout')

@section('title','Product Specification')

@section('content')

<div class="section-header">
    <h1>Product Specification</h1>
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

    <div class="container mb-5">

        <div class="text-center">
            <p class="" style="font-size: 25px">NUTRA-MED PACKAGING </p>
            <p class="font-weight-bold text-uppercase" style="font-size:25px">Packaging Specification</p>
        </div>
        <div class="text-right">
            <span> Order Id : <span id="orderId" class="font-weight-bold"></span> </span>
        </div>


        <div class="border-bottom border-dark pl-3 pr-3 pt-1 pb-3">
            <div class=" ">
                <span class=" font-weight-bold "> Customer: <span id="customerName"></span> </span> <br>
                <span class="font-weight-bold "> Product Name: <span id="productName"></span> </span>
            </div>

            <div class="d-flex justify-content-between mt-1">
                <span class="font-weight-bold ">F.Prod #: <span id="fProd"></span></span>
                <span class="font-weight-bold ">NDC/UPC Code #: <span id="ndcUpc"></span></span>
                <span class="font-weight-bold ">Dosage Form: <span id='dosageForm'></span></span>
            </div>

            <div class="d-flex justify-content-start ">
                <span class="font-weight-bold ">Description: <span id="unitDescription"></span></span>
            </div>

        </div>


        <table id="componentTable" class="table table-sm text-center">
            <thead>
                <tr>
                    <th>Components: &nbsp; Name</th>
                    <th> Description</th>
                    <th> Code</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dynamic rows will be appended here -->
            </tbody>
        </table>

        <span class="font-weight-bold">Packaging Instruction:</span>
        <div id="packInstruction" class="border p-2">
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
                            Document # <span id="masterOrder"></span>
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
                    <div>Seq. No. <span> -</span></div>
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
                        $('#masterOrder').text(response.data.masterOrd);
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




                     // Apply logic to add <br> after every period
                      let packInstruction = response.data.packInstruction;
                        if (packInstruction) {
                            packInstruction = packInstruction.replace(/\./g, '.<br>');
                            $('#packInstruction').html(packInstruction); // Use .html() to render the <br> tags
                        } else {
                            $('#packInstruction').html('No instructions available');
                        }


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
                        $('#masterOrder').text(response.data.masterOrd);
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




                     // Apply logic to add <br> after every period
                      let packInstruction = response.data.packInstruction;
                        if (packInstruction) {
                            packInstruction = packInstruction.replace(/\./g, '.<br>');
                            $('#packInstruction').html(packInstruction); // Use .html() to render the <br> tags
                        } else {
                            $('#packInstruction').html('No instructions available');
                        }


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
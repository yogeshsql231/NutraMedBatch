@extends('layouts.masterLayout')

@section('title', 'View Orders') {{-- Set your dynamic title here --}}

@section('content')


<div class="section-header">
    <h1>Master Batch Records</h1>
</div>





<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-2">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                            class="custom-control-input" id="checkbox-all">
                                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </th>
                                <th scope="col">S.R.</th>
                                <th scope="col">Order Id</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Customer Id</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Customer_Info</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Generic Name</th>
                                <th scope="col">PO Date</th>
                                <th scope="col">F Product</th>
                                <th scope="col">Formula</th>
                                <th scope="col">WO</th>
                                <th scope="col">LOT</th>
                                <th scope="col">Exp</th>
                                <th scope="col">Order Qty</th>
                                <th scope="col">PO Qty</th>
                                <th scope="col">Dosage Form</th>
                                <th scope="col">Of Dosage Unit</th>
                                <th scope="col">Bulk Prod Lot</th>
                                <th scope="col">Product Supply By</th>
                                <th scope="col">NDC/UPC</th>
                                <th scope="col">Unit Description</th>

                                <th scope="col">Component_Name</th>
                                <th scope="col">Component_Desc</th>
                                <th scope="col">Component_Code</th>

                                <th scope="col">Pack Instruction </th>
                                <th scope="col">Tooling Number</th>
                                <th scope="col">Tooling Drawing</th>
                                <th scope="col">Tooling Specification</th>
                                <th scope="col">Pkg Size</th>
                                <th scope="col">Mat. Width</th>
                                <th scope="col">Foil Yield</th>
                                <th scope="col">Foil Code</th>
                                <th scope="col">PVC Yield</th>
                                <th scope="col">PVC Code</th>
                                <th scope="col">Visual Inspection</th>
                                <th scope="col">Test One</th>
                                <th scope="col">Test Two</th>
                                <th scope="col">Test Three</th>
                                <th scope="col">Test Four</th>
                                <th scope="col">Test Five</th>
                                <th scope="col">Process Parameter</th>
                                <th scope="col">Index Setting</th>

                                <th scope="col">People Assignment</th>
                                <th scope="col">Inspection Inst</th>
                                <th scope="col">Document</th>
                                <th scope="col">Master Ord</th>
                                <th scope="col">New Order Created By</th>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach ($OderRecords as $item)
                            <tr>
                                <td>
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                            id="checkbox-1">
                                        <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </td>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->orderId }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->orderDate)->format('d F Y') }}</td>
                                <td>{{ $item->customers->customer_id }}</td>
                                <td>{{ $item->customers->customer_name }}</td>

                                <td>
                                    {{-- <strong>Cus. Add.:</strong><br>
                                    {{ $item->customers->address_street }}, {{ $item->customers->address_street_2 ?? ''
                                    }}<br>
                                    {{ $item->customers->town }}, {{ $item->customers->state }} - {{
                                    $item->customers->zipcode }}<br> --}}

                                    <strong>Ship. Add:</strong><br>
                                    {{ $item->customers->shipping_street }}, {{ $item->customers->shipping_street_2 ??
                                    '' }}<br>
                                    {{ $item->customers->shipping_town }}, {{ $item->customers->shipping_state }} - {{
                                    $item->customers->shipping_zipcode }}<br>

                                    <strong>Phone:</strong> {{ $item->customers->phone }}
                                </td>

                                <td>{{ $item->productName }}</td>
                                <td>{{ $item->genericName }}</td>
                                <td>{{ $item->PO }}</td>
                                <td>{{ $item->fProduct }}</td>
                                <td>{{ $item->formula }}</td>
                                <td>{{ $item->WO }}</td>
                                <td>{{ $item->LOT }}</td>
                                <td>{{ $item->Exp }}</td>
                                <td>{{ $item->orderQty }}</td>
                                <td>{{ $item->poQty }}</td>
                                <td>{{ $item->dosageForm }}</td>
                                <td>{{ $item->ofDosesUnit }}</td>
                                <td>{{ $item->bluckProdLot }}</td>
                                <td>{{ $item->prodSuplyBy }}</td>
                                <td>{{ $item->ndcUpc }}</td>
                                <td>{{ $item->unitDescription }}</td>




                                <td>
                                    @php
                                    $decodedCompName = json_decode($item->compName);
                                    @endphp
                                    @if (is_array($decodedCompName))
                                    @foreach ($decodedCompName as $index => $name)
                                    {{ $index + 1 }}. {{ $name }}@if (!$loop->last), @endif
                                    @endforeach
                                    @else
                                    {{ $decodedCompName }}
                                    @endif
                                </td>

                                <td>
                                    @php
                                    $decodedCompDesc = json_decode($item->compDesc);
                                    @endphp
                                    @if (is_array($decodedCompDesc))
                                    @foreach ($decodedCompDesc as $index => $desc)
                                    {{ $index + 1 }}. {{ $desc }}@if (!$loop->last), @endif
                                    @endforeach
                                    @else
                                    {{ $decodedCompDesc }}
                                    @endif
                                </td>

                                <td>
                                    @php
                                    $decodedCompCode = json_decode($item->compCode);
                                    @endphp
                                    @if (is_array($decodedCompCode))
                                    @foreach ($decodedCompCode as $index => $code)
                                    {{ $index + 1 }}. {{ $code }}@if (!$loop->last), @endif
                                    @endforeach
                                    @else
                                    {{ $decodedCompCode }}
                                    @endif
                                </td>


                                {{-- <td>{{ $item->packInstruction }}</td> --}}
                                <td>
                                    <div class="pack-instruction">
                                        <p class="short-text mb-0">{{ Str::limit($item->packInstruction, 100) }}</p>
                                        <p class="full-text mb-0 d-none">{{ $item->packInstruction }}</p>
                                        <button class="btn btn-link btn-sm toggle-text">Read More</button>
                                    </div>
                                </td>

                                <td>{{ $item->toolingNumber }}</td>
                                <td>{{ $item->toolingDrawing }}</td>
                                <td>{{ $item->testToolingSpecfication }}</td>
                                <td>{{ $item->pkgSize }}</td>
                                <td>{{ $item->matWidth }}</td>
                                <td>{{ $item->foilYield }}</td>
                                <td>{{ $item->foilcode }}</td>
                                <td>{{ $item->PvcYield }}</td>
                                <td>{{ $item->PbvCode }}</td>
                                {{-- <td>{{ $item->visualInspection }}</td> --}}

                                <td>
                                    <div class="visual-inspection">
                                        <p class="short-text mb-0">{{ Str::limit($item->visualInspection, 100) }}</p>
                                        <p class="full-text mb-0 d-none">{{ $item->visualInspection }}</p>
                                        <button class="btn btn-link btn-sm toggle-text">Read More</button>
                                    </div>
                                </td>

                                <td>{{ $item->testOne }}</td>
                                <td>{{ $item->testTwo }}</td>
                                <td>{{ $item->testThree }}</td>
                                <td>{{ $item->testFour }}</td>
                                <td>{{ $item->testFive }}</td>
                                <td>{{ $item->processParameter }}</td>

                                <td>
                                    @php
                                    $decodedindexSetting = json_decode($item->indexSetting);
                                    @endphp
                                    @if (is_array($decodedindexSetting))
                                    @foreach ($decodedindexSetting as $index => $name)
                                    {{ $index + 1 }}. {{ $name }}@if (!$loop->last), @endif
                                    @endforeach
                                    @else
                                    {{ $decodedindexSetting }}
                                    @endif
                                </td>

                                <td>{{ $item->peopleAssigment }}</td>
                                <td>{{ $item->inspectionInst }}</td>
                                <td>{{ $item->document }}</td>
                                <td>{{ $item->masterOrd }}</td>
                                <td>{{ $item->newOrderCreatedBy }}</td>

                            </tr>
                            @endforeach



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.toggle-text').forEach(function (button) {
            button.addEventListener('click', function () {
                // Find the closest parent div (this works for both .visual-inspection and .pack-instruction)
                const parent = button.closest('div');

                // Select the short and full text elements within the parent div
                const shortText = parent.querySelector('.short-text');
                const fullText = parent.querySelector('.full-text');

                if (shortText.classList.contains('d-none')) {
                    // Show the full text and hide the short text
                    shortText.classList.remove('d-none');
                    fullText.classList.add('d-none');
                    button.textContent = 'Read More';
                } else {
                    // Show the short text and hide the full text
                    shortText.classList.add('d-none');
                    fullText.classList.remove('d-none');
                    button.textContent = 'Read Less';
                }
            });
        });
    });
</script>




@endsection

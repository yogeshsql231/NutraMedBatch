@extends('layouts.masterLayout')

@section('title','Chnage Controle Form')

@section('content')

<div class="section-header">
    <h1>Change Control Form</h1>
</div>

<div class="row mb-5">
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
</div>


<div class="container bg-warning">

    <div class="text-center p-1">
        <h4>NUTRA-MED PACKAGING</h4>
        <span class="font-weight-bold">Change Control Form </span>
    </div>

    <div class="text-right">
        <p> Date <span class="bg-light p-1"> {{ \Carbon\Carbon::now()->format('Y-m-d') }} </span></p>
    </div>

    <div class="text-right mt-2">
        <p> Order Id : <span class="bg-light p-1">{{ $AuditOrderDetails->orderId ?? '' }}</span></p>

    </div>

    <div class="text-left mt-2">
        <h5> Product Name : <span class="bg-light p-1  ">{{$AuditOrderDetails->productName ?? ''}}</span></h5>
    </div>

    <div class="text-left mt-2">
        <p> Product Code : <span class="bg-light p-1 ">{{$AuditOrderDetails->PO ?? ''}}</span></p>
    </div>

    <div class="text-left mt-2">
        <p> Customer Id : <span class="bg-light p-1 ">{{$AuditOrderDetails->customers->customer_id ?? ''}}</span></p>
    </div>



    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="table-2">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Old Value</th>
                                    <th scope="col">New Value</th>
                                    <th scope="col">Changed by</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($AuditOrders)
                                @foreach ($AuditOrders as $item)
                                <tr>
                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>

                                    <td>
                                        @foreach ($item->old_values as $key => $value)
                                        <strong>{{ $key }}:</strong> {{ $value ?? 'N/A' }}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($item->new_values as $key => $value)
                                        <strong>{{ $key }}:</strong> {{ $value ?? 'N/A' }}<br>
                                        @endforeach
                                    </td>

                                    <td>{{ $item->user->name }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>





@endsection
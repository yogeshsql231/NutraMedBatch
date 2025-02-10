@extends('layouts.masterLayout')

@section('title','Create Order')

@section('content')

<div class="section-header">
    <h1>Select Order Template</h1>
</div>


@error('selectedOrder')
<div class="alert alert-danger alert-dismissible fade show  mt-2" role="alert">
    {{ $message }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@enderror




<form action="{{route('TemplateSubmit')}}" method="GET">
    @csrf
    <div class="table-responsive">
        <table class="table table-striped table-sm" id="table-2">
            <thead>
                <tr>
                    <th>Select </th>
                    <th>Order No.</th>
                    <th>Customer Name</th>
                    <th>Product Name</th>
                    <th>Finished Product No.</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderTemplate as $item)
                <tr onclick="selectRow(this)">
                    <td>
                        <input type="radio" name="selectedOrder" value="{{ $item->id }}">

                    </td>
                    <td>{{$item->orderId}}</td>
                    <td>{{$item->customers->customer_name}}</td>
                    <td>{{$item->productName}}</td>
                    <td>{{$item->fProduct}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>



    <div class="text-center">
        <input type="submit" class="btn btn-primary " value="Enter New Order Data">
    </div>
</form>

<script>
    function selectRow(row) {
        const radioButton = row.querySelector('input[type="radio"]');
        if (radioButton) {
            radioButton.checked = true;
        }
    }
</script>


@endsection
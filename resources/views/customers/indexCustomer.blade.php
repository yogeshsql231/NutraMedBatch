@extends('layouts.masterLayout')

@section('title','View Customer')

@section('content')




<div class="section-header">
    <h1> Customer List</h1>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="table-2">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col"> S.R.</th>
                                <th scope="col"> Customer ID</th>
                                <th scope="col"> Customer Name</th>
                                <th scope="col"> Contact Person</th>
                                <th scope="col"> Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col"> Address</th>
                                <th scope="col"> Shipping Address</th>
                                @canany(['Customer-update','Customer-delete'])
                                <th scope="col">Action </th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $customer->customer_id }}</td>
                                <td>{{ $customer->customer_name }}</td>
                                <td>{{ $customer->contact_person }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{$customer->email ? $customer->email :'Na' }} </td>
                                <td>
                                    {{ $customer->address_street }}
                                    @if ($customer->address_street_2 != 'na')
                                    , {{ $customer->address_street_2 }}
                                    @endif
                                    , {{ $customer->town }}, {{ $customer->state }} - {{ $customer->zipcode }}
                                </td>
                                <td>
                                    {{ $customer->shipping_street }}
                                    @if ($customer->shipping_street_2 != 'na')
                                    , {{ $customer->shipping_street_2 }}
                                    @endif
                                    , {{ $customer->shipping_town }}, {{ $customer->shipping_state }} - {{
                                    $customer->shipping_zipcode }}
                                </td>

                                @canany(['Customer-update','Customer-delete'])
                                <td>

                                    @can('Customer-update')
                                    <a href="{{ route('customer.edit', ['customer' => $customer->id]) }}"
                                        title="Edit Customer">
                                        <i class="fas fa-edit fa-1x"></i>
                                    </a>
                                    @endcan

                                    @can('Customer-delete')
                                    <form action="{{ route('customer.delete',['customer'=>$customer->id])}}"
                                        method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="border:none; background:none;"
                                            title="Delete Customer"
                                            onclick="return confirm('Are you sure you want to delete this customer?')">
                                            <i class="fas fa-trash fa-1x text-danger"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </td>
                                @endcan


                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
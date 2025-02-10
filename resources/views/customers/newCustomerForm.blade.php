@extends('layouts.masterLayout')


@section('title', isset($customer) ? 'Edit Customer' : 'Add Customer')


@section('content')

<div class="section-header">
    <h1>{{ isset($customer) ? 'Edit Customer' : 'Add Customer' }}</h1>

</div>



<div class="container my-4">

    <form
        action="{{ isset($customer) ?  route('customer.update',['customer'=>$customer->id]) : route('storeCustomer') }}"
        method="POST">

        @csrf


        <div class="row mb-3">
            <div class="col-md-6">
                <label for="customerId" class="form-label">Customer ID <span
                        class="text-danger fw-bold">*</span></label>
                <input type="text" class="form-control" id="customerId" name="customer_id"
                    placeholder="Enter Customer ID"
                    value="{{ old('customer_id', isset($customer)? $customer->customer_id: '')}}">
                @error('customer_id')
                <span class="text-danger"> {{$message}}</span>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="customerName" class="form-label">Customer Name <span
                        class="text-danger fw-bold">*</span></label>
                <input type="text" class="form-control" id="customerName" name="customer_name"
                    placeholder="Enter Customer Name"
                    value="{{ old('customer_name', isset($customer)? $customer->customer_name : '')}}">
                @error('customer_name')
                <span class="text-danger"> {{$message}}</span>
                @enderror
            </div>

        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="contactPerson" class="form-label">Contact Person <span
                        class="text-danger fw-bold">*</span></label>
                <input type="text" class="form-control" id="contactPerson" name="contact_person"
                    placeholder="Enter Contact Person"
                    value="{{ old('contact_person', isset($customer)? $customer->contact_person: '')}}">
                @error('contact_person')
                <span class="text-danger"> {{$message}}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="phone" class="form-label">Phone <span class="text-danger fw-bold">*</span></label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number"
                    value="{{ old('phone' , isset($customer) ? $customer->phone : '')}}">
                @error('phone')
                <span class="text-danger"> {{$message}}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="email" class="form-label">Email </label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email Id"
                    value="{{ old('email' , isset($customer) ? $customer->email : '')}}">
                @error('email')
                <span class="text-danger"> {{$message}}</span>
                @enderror
            </div>




        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="addressStreet" class="form-label">Address Street <span
                        class="text-danger fw-bold">*</span></label>
                <input type="text" class="form-control" id="addressStreet" name="address_street"
                    placeholder="Enter Street"
                    value="{{ old('address_street' , isset($customer)? $customer->address_street : '')}}">
                @error('address_street')
                <span class="text-danger"> {{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="addressStreet2" class="form-label">Address Street 2</label>
                <input type="text" class="form-control" id="addressStreet2" name="address_street_2"
                    placeholder="Enter Street 2 (optional)"
                    value="{{ old('address_street_2', isset($customer)? $customer->address_street_2 :'')}}">
                @error('address_street_2')
                <span class="text-danger"> {{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="town" class="form-label">Town <span class="text-danger fw-bold">*</span></label>
                <input type="text" class="form-control" id="town" name="town" placeholder="Enter Town"
                    value="{{old('town', isset($customer)? $customer->town:'')}}">
                @error('town')
                <span class="text-danger"> {{$message}}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="state" class="form-label">State <span class="text-danger fw-bold">*</span></label>
                <input type="text" class="form-control" id="state" name="state" placeholder="Enter State"
                    value="{{ old('state', isset($customer)? $customer->state : '')}}">
                @error('state')
                <span class="text-danger"> {{$message}}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="zipcode" class="form-label">Zip Code <span class="text-danger fw-bold">*</span></label>
                <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Enter Zip Code"
                    value="{{ old('zipcode', isset($customer)? $customer->zipcode: '')}}">
                @error('zipcode')
                <span class="text-danger"> {{$message}}</span>
                @enderror
            </div>
        </div>

        <h5 class="mb-3">Shipping Address</h5>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="shippingStreet" class="form-label">Shipping Street <span
                        class="text-danger fw-bold">*</span></label>
                <input type="text" class="form-control" id="shippingStreet" name="shipping_street"
                    placeholder="Enter Shipping Street"
                    value="{{old('shipping_street', isset($customer)? $customer->shipping_street:'')}}">
                @error('shipping_street')
                <span class="text-danger"> {{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="shippingStreet2" class="form-label">Shipping Street 2</label>
                <input type="text" class="form-control" id="shippingStreet2" name="shipping_street_2"
                    placeholder="Enter Shipping Street 2 (optional)"
                    value="{{ old('shipping_street_2', isset($customer)? $customer->shipping_street_2 : '')}}">
                @error('shipping_street_2')
                <span class="text-danger"> {{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="shippingTown" class="form-label">Shipping Town <span
                        class="text-danger fw-bold">*</span></label>
                <input type="text" class="form-control" id="shippingTown" name="shipping_town"
                    placeholder="Enter Shipping Town"
                    value="{{ old('shipping_town' , isset($customer)? $customer->shipping_town : '')}}">
                @error('shipping_town')
                <span class="text-danger"> {{$message}}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="shippingState" class="form-label">Shipping State <span
                        class="text-danger fw-bold">*</span></label>
                <input type="text" class="form-control" id="shippingState" name="shipping_state"
                    placeholder="Enter Shipping State"
                    value="{{ old('shipping_state' , isset($customer)? $customer->shipping_state : '')}}">
                @error('shipping_state')
                <span class="text-danger"> {{$message}}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="shippingZipcode" class="form-label">Shipping Zip Code <span
                        class="text-danger fw-bold">*</span></label>
                <input type="text" class="form-control" id="shippingZipcode" name="shipping_zipcode"
                    placeholder="Enter Shipping Zip Code"
                    value="{{ old('shipping_zipcode' , isset($customer)? $customer->shipping_zipcode : '')}}">
                @error('shipping_zipcode')
                <span class="text-danger"> {{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col text-center">
                <button type="submit" class="btn btn-primary"> {{isset($customer) ? 'Update' : 'Submit'}} </button>
            </div>
        </div>


    </form>

</div>



@endsection
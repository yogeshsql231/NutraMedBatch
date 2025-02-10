@extends('layouts.masterLayout')

@section('title','Upload Customer')

@section('content')


<div class="section-header">
    <h1>Upload Customers from Excel</h1>
</div>


<form action="{{ route('uploadCustomerExcel')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="container-fluid d-flex align-items-center">
        <div class="mb-3">
            <label for="formFile" class="form-label ">Import Customer from Excel</label>
            <input class="form-control" type="file" id="file" name="file" accept=".xlsx, .xls">
        </div>
        @error('file')
        <span class="text-danger"> {{$message}}</span>
        @enderror
        <button type="submit" class="btn btn-outline-warning ms-4">Upload Excel</button>
    </div>
</form>

@endsection

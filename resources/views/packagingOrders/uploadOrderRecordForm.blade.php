@extends('layouts.masterLayout')

@section('title', 'Upload Orders') {{-- Set your dynamic title here --}}

@section('content')

<div class="section-header">
    <h1>Upload Order Data from CSV</h1>
</div>


{{-- import order list form excel --}}

<form action="{{ route('uploadOrderRecord')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="container-fluid d-flex align-items-center">
        <div class="mb-3">
            <label for="formFile" class="form-label ">Import Order from Excel</label>
            <input class="form-control" type="file" id="file" name="file" accept=".csv">
        </div>
        @error('file')
        <span class="text-danger"> {{$message}}</span>
        @enderror
        <button type="submit" class="btn btn-outline-warning ms-4">Upload Excel</button>
    </div>
</form>

@endsection
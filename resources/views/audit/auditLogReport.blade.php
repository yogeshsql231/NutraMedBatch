@extends('layouts.masterLayout')

@section('title','Audit Log Report')

@section('content')




{{-- <style>
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
        }

        .no-print {
            display: none !important;
        }

        @page {
            size: A4 landscape;
            margin: 5mm;
            /* Reduced margin to maximize space */
        }

        /* Hide DataTable's pagination, search bar, and length selection in print view */
        #table-2_paginate,
        #table-2_length,
        #table-2_filter {
            display: none !important;
        }

        /* Ensure the table fits within the page */
        table {
            width: 100%;
            table-layout: fixed;
            /* Ensures columns don’t expand beyond their defined width */
            border-collapse: collapse;
            page-break-inside: auto;
            /* Prevents breaking inside the table */
        }

        /* Fixed header for every page */
        .header {
            position: fixed;
            top: 0;
            margin-bottom: 30px;
            left: 0;
            width: 100%;
            background-color: white;
            border-bottom: 2px solid #000;
            padding: 10px 20px;
            z-index: 1000;
        }


        th,
        td {
            padding: 2px;
            text-align: left;
            border: 1px solid #ddd;
            word-wrap: break-word;
            white-space: normal;
            /* Prevents content from overflowing */
        }

        th:nth-child(1),
        td:nth-child(1) {
            width: 15%;
        }

        th:nth-child(2),
        td:nth-child(2) {
            width: 18%;
        }

        th:nth-child(3),
        td:nth-child(3) {
            width: 15%;
        }

        th:nth-child(4),
        td:nth-child(4) {
            width: 10%;
        }

        th:nth-child(5),
        td:nth-child(5) {
            width: 7%;
        }

        th:nth-child(6),
        td:nth-child(6) {
            width: 15%;
        }

        th:nth-child(7),
        td:nth-child(7) {
            width: 30%;
        }

        th:nth-child(8),
        td:nth-child(8) {
            width: 30%;
        }

        td {
            padding: 6px 8px;
            /* Adjust padding to ensure content fits better */
        }
    }
</style> --}}


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
        }

        .no-print {
            display: none !important;
        }

        @page {
            size: A4 landscape;
            margin: 5mm;
        }

        /* .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: rgb(178, 14, 14);
            z-index: 1000;
            padding: 10px 20px;
            border-bottom: 2px solid #000;
            height: 150px;
        } */


        /* Apply padding to avoid content overlapping with header */
        /* .printtableDiv .table-responsive {
            margin-top: 150px;

        } */


        /* Table styles for better printing layout */
        table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            page-break-inside: auto;
        }

        th,
        td {
            padding: 6px 8px;
            text-align: left;
            border: 1px solid #ddd;
            word-wrap: break-word;
            white-space: normal;
        }

        th:nth-child(1),
        td:nth-child(1) {
            width: 15%;
        }

        th:nth-child(2),
        td:nth-child(2) {
            width: 18%;
        }

        th:nth-child(3),
        td:nth-child(3) {
            width: 15%;
        }

        th:nth-child(4),
        td:nth-child(4) {
            width: 10%;
        }

        th:nth-child(5),
        td:nth-child(5) {
            width: 7%;
        }

        th:nth-child(6),
        td:nth-child(6) {
            width: 15%;
        }

        th:nth-child(7),
        td:nth-child(7) {
            width: 30%;
        }

        th:nth-child(8),
        td:nth-child(8) {
            width: 30%;
        }
    }
</style>







<div class="section-header">
    <h1>Audit Log Report</h1>
</div>

<form action="{{route('generateAuditReport')}}" method="get">

    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="startDate">Select Start Date</label>
            <input type="date" class="form-control" name="startDate">
            @error('startDate')
            <span class="text-danger">{{$message }}</span>
            @enderror
        </div>

        <div class="form-group col-md-3">
            <label for="endDate">Select End Date</label>
            <input type="date" class="form-control" name="endDate">
            @error('endDate')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 d-flex justify-content-center">
        <button type="submit" class="btn btn-primary mt-3 mb-3">Generate Audit Report</button>
    </div>
</form>

@if($auditReport && $auditReport->isNotEmpty())
<div class="printtableDiv">
    <div class="container-fluid ">
        @php
        $auditReportCollection = collect($auditReport);
        $firstItem = $auditReportCollection->first();
        $lastItem = $auditReportCollection->last();
        @endphp

        <div class="header mb-3">
            <div class="row">
                <div class="col-2 d-flex align-items-center justify-content-center border p-3">
                    <h5>Nutra-Med</h5>
                </div>
                <div class="col-8 border p-3">
                    <div class="text-center mb-2">
                        <h1 class="mb-0">Audit Log Report</h1>
                    </div>
                    <div class="d-flex justify-content-between ml-5 mr-5">
                        <span class="mb-0">
                            <span class="font-weight-bold">Start Date/Time:</span>
                            <span>{{ $firstItem->created_at ?? 'N/A' }}</span>
                        </span>
                        <span class="mb-0">
                            <span class="font-weight-bold">End Date/Time:</span>
                            <span>{{ $lastItem->created_at ?? 'N/A' }}</span>
                        </span>
                    </div>
                </div>
                <div class="col-2 d-flex flex-column align-items-center border p-3">
                    <div class="text-center">
                        <span class="mb-2">
                            <span class="font-weight-bold">Date Printed:</span><br>
                            <span>{{ now()->format('Y-m-d')}}</span>
                        </span><br><br>
                        <span class="mb-0">
                            <span class="font-weight-bold">Time Printed:</span><br>
                            <span>{{ now()->format('H:i:s') }}</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered" id="table-2">
                <thead class="thead-dark">
                    <tr>
                        {{-- <th scope="col" style="width: 10%;">SR</th> --}}
                        <th scope="col" style="width: 10%;">Date/Time</th>
                        <th scope="col" style="width: 10%;">Update By</th>
                        <th scope="col" style="width: 10%;">User Role</th>
                        <th scope="col" style="width: 10%;">Event</th>
                        <th scope="col" style="width: 10%;">Table</th>
                        <th scope="col" style="width: 10%;">Auditable Id</th>
                        <th scope="col" style="width: 20%;">Old Value</th>
                        <th scope="col" style="width: 20%;">New Value</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($auditReportCollection as $item)
                    <tr>
                        {{-- <td> {{$loop->iteration}}</td> --}}
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>
                            @foreach($item->user->roles as $role)
                            {{ $role->name }},
                            @endforeach
                        </td>
                        <td>{{ $item->event }}</td>
                        <td>{{ Str::afterLast($item->auditable_type, '\\') }}</td>
                        <td>{{ $item->auditable_id }}</td>
                        <td>
                            @php
                            $oldValues = is_string($item->old_values) ? json_decode($item->old_values, true) :
                            $item->old_values;
                            @endphp
                            @if(is_array($oldValues) && !empty($oldValues))
                            @foreach($oldValues as $key => $value)
                            @if(is_array($value))
                            <strong>{{ ucfirst($key) }}:</strong>
                            @foreach($value as $subValue)
                            {{ $subValue }},
                            @endforeach
                            <br>
                            @else
                            <strong>{{ ucfirst($key) }}:</strong> {{ $value ?? 'N/A' }}<br>
                            @endif
                            @endforeach
                            @else
                            No old values
                            @endif
                        </td>
                        <td>
                            @php
                            $newValues = is_string($item->new_values) ? json_decode($item->new_values, true) :
                            $item->new_values;
                            @endphp
                            @if(is_array($newValues) && !empty($newValues))
                            @foreach($newValues as $key => $value)
                            @if(is_array($value))
                            <strong>{{ ucfirst($key) }}:</strong>
                            @foreach($value as $subValue)
                            {{ $subValue }},
                            @endforeach
                            <br>
                            @else
                            <strong>{{ ucfirst($key) }}:</strong> {{ $value ?? 'N/A' }}<br>
                            @endif
                            @endforeach
                            @else
                            No new values
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- Print Button -->
<div class="text-center mt-5">
    <button class="btn btn-primary" onclick="printDiv()">Print</button>
</div>

<script>
    function printDiv() {
        // Remove pagination, search and other DataTable elements
        $('#table-2').DataTable().destroy(); // Destroy the DataTable instance
        window.print(); // Initiate the print command
    }


</script>




@else
<div class="mt-3">
    <h6>Please select a date range to generate the audit log report.</h6>
</div>
@endif
@endsection

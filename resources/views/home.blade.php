@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'ass')
@section('content_header_title', 'Home')
@section('content_header_subtitle',  'Cost Manage' )

{{-- Content body: main page content --}}

@section('content_body')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 pb-4 card">
                <h3 class="m-3">Today Date: {{ $month->format('M-Y') }}</h3>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Earning Balance</h5>
                        <p class="card-text">{{ $earning }}</p>
                        <a href="#" class="btn btn-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Loan</h5>
                        <p class="card-text">{{ $loan }}</p>
                        <a href="#" class="btn btn-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Cost</h5>
                        <p class="card-text">{{ $cost }}</p>
                        <a href="#" class="btn btn-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

@stop

{{-- Push extra CSS --}}

@push('css')

@endpush

{{-- Push extra scripts --}}

@push('js')
    <script>
        $('#example').DataTable();
    </script>
@endpush

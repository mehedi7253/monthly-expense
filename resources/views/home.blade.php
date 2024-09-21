@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'ass')
@section('content_header_title', 'Home')
@section('content_header_subtitle',  'Cost Manage' )

{{-- Content body: main page content --}}

@section('content_body')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                  
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
        //data table
        $('#example').DataTable();
    </script>
@endpush

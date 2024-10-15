@extends('layouts.app')
@section('subtitle', 'ass')
@section('content_header_title', 'Home')
@section('content_header_subtitle',  'Earn & Loan' )

{{-- Content body: main page content --}}

@section('content_body')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-gradient-blue">
                        <h4>Month Wise Report</h4>
                    </div>
                    <div class="card-body">
                        <form id="searchForm" action="{{ route('get-month-data') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-4 col-sm-8">
                                    <select class="form-control" name="month">
                                        <option>Select Month</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October </option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-sm-8">
                                    <input class="form-control" type="number" name="year" placeholder="2024">
                                </div>
                                <div class="form-group col-md-3 col-sm-8">
                                    <button class="btn btn-info" type="submit"><i class="fa fa-search"></i> serach</button>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive" id="table_report" style="display: none">
                            <table class="table table-bordered" id="example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Amount</th>
                                        <th>Reason</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
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
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#searchForm').on('submit', function(e) {
                e.preventDefault();
                let url = $(this).attr("action");
                let formData = new FormData(this);
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if(response)
                        {
                            $('#table_report').show();
                            $('#example').DataTable({
                                'paging': true,
                                'ordering': true,
                                'data': response,
                                'paging': true,
                                'lengthChange': true,
                                'searching': true,
                                'info': true,
                                'autoWidth': true,
                                columns: [
                                    { data: 'id' },
                                    { data: 'amount' },
                                    { data: 'reason' },
                                    { data: 'created_at'},
                                ],
                            });
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });


        });

        //serach data month and year data

    </script>
@endpush

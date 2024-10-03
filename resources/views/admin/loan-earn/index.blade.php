@extends('layouts.app')

{{-- Customize layout sections --}}

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
                        <h4>All Loan & Earn Data
                            <button type="button" class="btn btn-sm btn-dark float-right" data-toggle="modal" data-target="#addEarnLoanModal">
                                <i class="fa fa-plus-circle"></i> Add New Record
                            </button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered data-table" id="example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Reason</th>
                                    <th>Earn/Loan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loan_earns as $i=>$loan)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $loan->created_at->format('d-m-Y') }}</td>
                                        <td>{{ number_format($loan->loan_amount,2) }}</td>
                                        <td>{{ $loan->reason }}</td>
                                        <td>
                                            @if($loan->type == 'loan')
                                                <span class="badge badge-danger">Loan</span>
                                            @else
                                                <span class="badge badge-success">Earn</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('costs.destroy', $loan->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addEarnLoanModal" tabindex="-1" role="dialog" aria-labelledby="addCostModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Cost</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formLoanEarnSubmit" action="{{ route('earn-loans.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Amount <sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" id="loan_amount" name="loan_amount" placeholder="Enter Amount">
                        </div>
                        <div class="form-group">
                            <label for="description">Type<sup class="text-danger">*</sup></label>
                            <select class="form-control" id="type" name="type">
                                <option value="">Select Type</option>
                                <option value="loan">Loan</option>
                                <option value="earn">Earn</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Reason<sup class="text-danger">*</sup></label>
                            <textarea class="form-control" id="reason" name="reason" rows="3" placeholder="Enter Reason"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Date<sup class="text-danger">*</sup></label>
                            <input class="form-control" type="date" id="date" name="date">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
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
        $(document).ready(function() {
            $('#example').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false,
            });
        });

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });
        //add cost
        $('#formLoanEarnSubmit').on('submit', function(e) {
            e.preventDefault();
            var url = $(this).attr("action");
            let formData = new FormData(this);
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire(
                        'success!',
                        'addede successfully',
                        'success'
                    );
                    $('#formLoanEarnSubmit')[0].reset();
                    location.reload();
                },
                error: function(response) {
                    $('.invalid-feedback').remove();
                    $('.is-invalid').removeClass('is-invalid');

                    let errors = response.responseJSON.errors;
                    for (let field in errors) {
                        let input = $('[name=' + field + ']');
                        input.addClass('is-invalid');
                        input.after('<span class="invalid-feedback">' + errors[field][0] +'</span>');
                    }
                }
            });
        });
    </script>
@endpush

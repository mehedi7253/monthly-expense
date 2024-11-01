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
                    <div class="card-header bg-gradient-blue">
                        <h4>All Cost Data
                            <button type="button" class="btn btn-sm btn-dark float-right" data-toggle="modal" data-target="#addCostModal">
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($costs as $i=>$cost)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $cost->created_at->format('d-m-Y') }}</td>
                                        <td>{{ number_format($cost->amount,2) }}</td>
                                        <td>{{ $cost->reason }}</td>
                                        <td>
                                            <form action="{{ route('costs.destroy', $cost->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td>Total:</td>
                                    <td>{{ number_format($costs->SUM('amount'),2) }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addCostModal" tabindex="-1" role="dialog" aria-labelledby="addCostModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Cost</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formSubmit" action="{{ route('costs.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Amount <sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Amount">
                        </div>
                        <div class="form-group">
                            <label for="description">Reason<sup class="text-danger">*</sup></label>
                            <textarea class="form-control" id="reason" name="reason" rows="3" placeholder="Enter Reason"></textarea>
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
        $('#formSubmit').on('submit', function(e) {
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
                    location.reload();
                    // window.location.href = "{{ route('costs.index') }}";
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

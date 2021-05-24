@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebars.admin-sidebar')
@endsection

@section('content')

    @if(session('success'))
        <div class="alert alert-success alert-dismissible show fade">
            {{session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible show fade">
            {{session('error')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="page-heading">
        <div class="page-title">
        </div>
        <section class="section">
            <div class="card">
                <div class="card-content">
                    <div class="card-header">
                        <h3>Invitation Page</h3>
                        <p class="text-subtitle text-muted">You can see all invitations here. Click the 'Edit' button to accept or decline the invitation. </p>
                    </div>
                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Status</label>
                                    <fieldset class="form-group">
                                        <select class="form-select filter-data" id="status-filter">
                                            <option value="">Choose one</option>
                                            <option value="pending">Pending</option>
                                            <option value="accepted">Accept</option>
                                            <option value="declined">Decline</option>
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Event Date</label>
                                    <input type="date" id="event-date-filter" class="form-control filter-data">
                                </div>
                            </div>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Search</label>
                                    <input type="text" id="search" class="form-control" placeholder="Type something...">
                                </div>
                            </div>
                        </div>
                        <!-- Table with outer spacing -->
                        <div class="table-responsive">
                            @include('vos.table')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Modal Update --}}
    <div class="modal fade text-left" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Edit Invitation Form</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form id="update-invitation-form" method="POST">
                @csrf @method('patch')
                    <div class="modal-body">
                        <label id="event-name-lable" class="mb-2"></label><br>
                        <label id="additional-info-lable" class="mb-2"></label><br>
                        <label id="event-date-lable" class="mb-2"></label><br>
                        <label id="sent-by-lable" class="mb-2"></label><br>
                        <label>Status: </label>
                        <fieldset class="form-group">
                            <select class="form-select" id="status-form" name="status">
                                <option value="">Choose one</option>
                                <option value="pending">Pending</option>
                                <option value="accepted">Accept</option>
                                <option value="declined">Decline</option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Update</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.edit-invitation', function() {
                var invitationId = $(this).data('invitation-id');
                var eventName = $(this).data('event-name');
                var additionalInfo = $(this).data('additional-info');
                var eventDate = $(this).data('event-date');
                var sentBy = $(this).data('sent-by');
                var status = $(this).data('status');

                $('#event-name-lable').text('Event name : '+eventName);
                $('#additional-info-lable').text('Additional info : '+additionalInfo);
                $('#event-date-lable').text('Event date : '+ eventDate);
                $('#sent-by-lable').text('Sent by : '+sentBy);

                if (status == 'pending') {
                    $('#status-form option[value=pending]').attr('selected', 'selected');
                }

                if (status == 'accepted') {
                    $('#status-form option[value=accepted]').attr('selected', 'selected');
                }

                if (status == 'declined') {
                    $('#status-form option[value=declined]').attr('selected', 'selected');
                }

                $('#update-invitation-form').attr('action', '/vos/invitation/'+invitationId);
                
            });

            $(document).on('change', '.filter-data', function() {
                var data = {
                    status : $('#status-filter').val(),
                    eventDate : $('#event-date-filter').val(),
                    search : $('#search').val(),
                };

                fetch_data(data);
            })

            $(document).on('keyup', '#search', function() {
                var data = {
                    status : $('#status-filter').val(),
                    eventDate : $('#event-date-filter').val(),
                    search : $('#search').val(),
                };

                fetch_data(data);
            })

            function fetch_data(data) {
                $.ajax({
                    type:'get',
                    data: data,
                    url:'/vos/invitation/filter',
                    error: function() {
                        console.log('failed to retrieve data');
                    },
                    success: function(response) {
                        // console.log(data);
                        // console.log(response);
                        $('.table-responsive').html(response)
                    }
                });
            };
        });
    </script>
@endpush
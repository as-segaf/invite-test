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
                        <p class="text-subtitle text-muted">You can see all invitations here. Click the 'Edit' button to see the invitation detail and accept or decline the invitation. </p>
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
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Plakat Status</label>
                                    <fieldset class="form-group">
                                        <select class="form-select filter-data" id="plakat-status-filter">
                                            <option value="">Choose one</option>
                                            <option value="sudah">Sudah dikirim</option>
                                            <option value="belum">Belum dikirim</option>
                                            <option value="tanpa plakat">Tanpa Plakat</option>
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
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
                <div class="modal-body">
                    <p><b>Full Name</b> : <span id="full-name"></span></p>
                    <p><b>Nick Name</b> : <span id="nick-name"></span></p>
                    <p><b>No. Handphone</b> : <span id="wa-number"></span></p>
                    <p><b>Name of Organization</b> : <span id="organization-name"></span></p>
                    <p><b>Type of Organization</b> : <span id="organization-type"></span></p>
                    <p><b>Invite VOS As</b> : <span id="invite-vos-as"></span></p>
                    <p><b>Type of Event</b> : <span id="event-type"></span></p>
                    <p><b>Date of Event</b> : <span id="event-date"></span></p>
                    <p><b>Date of Event (Option 2)</b> : <span id="event-date2"></span></p>
                    <p><b>Duration Event</b> : <span id="event-duration"></span></p>
                    <p><b>Platform or Place</b> : <span id="event-place"></span></p>
                    <p><b>Detail Event</b> : <span id="event-detail"></span></p>
                    <p><b>Participant</b> : <span id="participant"></span></p>
                    <p><b>Note for VOS</b> : <span id="additional-note"></span></p>
                    <p><b>Sent by</b> : <span id="sent-by"></span></p>
                    <form id="update-invitation-form" method="POST">
                        @csrf @method('patch')
                        <div class="from-group">
                            <label for="status"><b>Status</b></label>
                            <select name="status" id="status-form" class="form-select">
                                <option value="">Choose one</option>
                                <option value="pending">Pending</option>
                                <option value="accepted">Accept</option>
                                <option value="declined">Decline</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1" id="submitButton">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Update</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.edit-invitation', function() {
                var invitationId = $(this).data('invitation-id');
                var fullName = $(this).data('fullname');
                var nickName = $(this).data('nickname');
                var waNumber = $(this).data('wa-number');
                var organizationType = $(this).data('organization-type');
                var organizationName = $(this).data('organization-name');
                var inviteVosAs = $(this).data('invite-vos-as');
                var eventType = $(this).data('event-type');
                var eventDate = $(this).data('event-date');
                var eventDate2 = $(this).data('event-date2');
                var eventDuration = $(this).data('event-duration');
                var eventPlace = $(this).data('event-place');
                var eventDetail = $(this).data('event-detail');
                var participant = $(this).data('participant');
                var additionalNote = $(this).data('additional-note');
                var sentBy = $(this).data('sent-by');
                var status = $(this).data('status');

                $('#full-name').text(fullName);
                $('#nick-name').text(nickName);
                $('#wa-number').text(waNumber);
                $('#organization-name').text(organizationName);
                $('#organization-type').text(organizationType);
                $('#invite-vos-as').text(inviteVosAs);
                $('#event-type').text(eventType);
                $('#event-date').text(eventDate);
                $('#event-date2').text(eventDate2);
                $('#event-duration').text(eventDuration);
                $('#event-place').text(eventPlace);
                $('#event-detail').text(eventDetail);
                $('#participant').text(participant);
                $('#additional-note').text(additionalNote);
                $('#sent-by').text(sentBy);

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
                $('#submitButton').click(function() {
                    $('#update-invitation-form').submit();
                });
            });

            $(document).on('change', '.filter-data', function() {
                var data = {
                    status : $('#status-filter').val(),
                    eventDate : $('#event-date-filter').val(),
                    plakatStatus : $('#plakat-status-filter').val(),
                    search : $('#search').val(),
                };

                fetch_data(data);
            })

            $(document).on('keyup', '#search', function() {
                var data = {
                    status : $('#status-filter').val(),
                    eventDate : $('#event-date-filter').val(),
                    plakatStatus : $('#plakat-status-filter').val(),
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
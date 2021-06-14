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
            <div class="row">
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title">Total Invitations</h4>
                                <hr>
                                <h5>{{$datas->count()}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title">Pending Invitations</h4>
                                <hr>
                                <h5>{{$datas->where('status', 'pending')->count()}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title">Accepted Invitations</h4>
                                <hr>
                                <h5>{{$datas->where('status', 'accepted')->count()}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title">Declined Invitations</h4>
                                <hr>
                                <h5>{{$datas->where('status', 'declined')->count()}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="card-header">
                        <h4>Upcoming Invitations</h4>
                    </div>
                    <div class="card-body">
                        <!-- Table with outer spacing -->
                        <div class="table-responsive">
                            <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Invited As</th>
                                        <th>Event Type</th>
                                        <th>Event Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach($datas->where('status', 'accepted')->where('event_date', '>=', date('Y-m-d 00:00:00'))->sortBy('event_date') as $key => $data)
                                        <tr>
                                            <td class="text-bold-500">{{$no++}}</td>
                                            <td class="text-bold-500">{{$data->invite_vos_as}}</td>
                                            <td class="text-bold-500">{{$data->event_type}}</td>
                                            <td class="text-bold-500">{{$data->event_date}}</td>
                                            <td class="text-bold-500">
                                                @if($data->status == 'pending')
                                                    <span class="badge bg-secondary">pending</span>
                                                @elseif($data->status == 'accepted')
                                                    <span class="badge bg-success">accepted</span>
                                                @elseif($data->status == 'declined')
                                                    <span class="badge bg-danger">declined</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-primary btn-sm edit-invitation" data-bs-toggle="modal" data-bs-target="#modalEdit" data-invitation-id="{{$data->id}}" data-fullname="{{$data->full_name}}" data-nickname="{{$data->nick_name}}" data-wa-number="{{$data->wa_number}}" data-organization-type="{{$data->organization_type}}" data-organization-name="{{$data->organization_name}}" data-invite-vos-as="{{$data->invite_vos_as}}" data-event-type="{{$data->event_type}}" data-event-date="{{$data->event_date}}" data-event-date2="{{$data->event_date2}}" data-event-duration="{{$data->event_duration}}" data-event-place="{{$data->event_place}}" data-event-detail="{{$data->event_detail}}" data-participant="{{$data->participant}}" data-additional-note="{{$data->additional_note}}" data-sent-by="{{$data->user->email}}" data-status="{{$data->status}}">Edit</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
        });
    </script>
@endpush
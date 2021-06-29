@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebars.user-sidebar')
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
                <div class="card-header">
                    <h3>Invitations</h3>
                    <p class="text-subtitle text-muted">You can create an invitation by clicking 'Create' button. And you can see the detail of your invitation by clicking 'Detail' button.<br>You have to change the plakat status when you have sent plakat. To change plakat status, click the plakat status button.</p>
                    <a href="/invitation/create"><button type="button" class="btn btn-outline-success float-end">Create</button></a>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <!-- Table with outer spacing -->
                        <div class="table-responsive">
                            <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Invite VOS As</th>
                                        <th>Event Type</th>
                                        <th>Event Date</th>
                                        <th>Status</th>
                                        <th>Plakat Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datas as $key => $data)
                                        <tr>
                                            <td class="text-bold-500">{{$key+1}}</td>
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
                                            <td class="text-bold-500">
                                                @if($data->plakat_status == 'belum')
                                                    <button class="btn btn-sm btn-danger update-plakat" data-bs-toggle="modal" data-bs-target="#modalPlakat" data-invitation-id="{{$data->id}}" data-invite-vos-as="{{$data->invite_vos_as}}" data-event-type="{{$data->event_type}}" data-event-date="{{$data->event_date}}" data-plakat-status="{{$data->plakat_status}}">Belum dikirim</button>
                                                @elseif($data->plakat_status == 'sudah')
                                                    <button class="btn btn-sm btn-success">Sudah dikirim</button>
                                                @elseif($data->plakat_status == 'tanpa plakat')
                                                    <button class="btn btn-sm btn-secondary">Tanpa Plakat</button>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-primary btn-sm detail-invitation" data-bs-toggle="modal" data-bs-target="#modalDetail" data-invitation-id="{{$data->id}}" data-fullname="{{$data->full_name}}" data-nickname="{{$data->nick_name}}" data-wa-number="{{$data->wa_number}}" data-organization-type="{{$data->organization_type}}" data-organization-name="{{$data->organization_name}}" data-invite-vos-as="{{$data->invite_vos_as}}" data-event-type="{{$data->event_type}}" data-event-date="{{$data->event_date}}" data-event-date2="{{$data->event_date2}}" data-event-duration="{{$data->event_duration}}" data-event-place="{{$data->event_place}}" data-event-detail="{{$data->event_detail}}" data-participant="{{$data->participant}}" data-additional-note="{{$data->additional_note}}" data-status="{{$data->status}}">Detail</button>
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

    {{-- Modal Detail --}}
    <div class="modal fade text-left" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Detail Invitation</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Plakat --}}
    <div class="modal fade text-left" id="modalPlakat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Plakat Status</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>Invite VOS As</b> : <span id="invite-vos-as"></span></p>
                    <p><b>Type of Event</b> : <span id="event-type"></span></p>
                    <p><b>Date of Event</b> : <span id="event-date"></span></p>
                    <form id="update-plakat-form" method="POST">
                        @csrf @method('patch')
                        <div class="from-group">
                            <label for="plakat-status"><b>Plakat Status</b></label>
                            <select name="plakat_status" id="status-plakat-form" class="form-select">
                                <option value="">Choose one</option>
                                <option value="sudah">Sudah dikirim</option>
                                <option value="belum">Belum dikirim</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">
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

    {{-- Modal Update --}}
    {{--
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
                        <label>Event Name: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Event name" class="form-control" name="event_name" id="event-name-input">
                            @if($errors->has('event_name'))
                                <p><small class="text-danger">{{$errors->first('event_name')}}.</small></p>
                            @endif
                        </div>
                        <label>Additional Info: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Additional info" class="form-control" name="additional_info" id="additional-info-input">
                            @if($errors->has('additional_info'))
                                <p><small class="text-danger">{{$errors->first('additional_info')}}.</small></p>
                            @endif
                        </div>
                        <label>Event Date: </label>
                        <div class="form-group">
                            <input type="date" placeholder="Event Date" class="form-control" name="event_date" id="event-date-input">
                            @if($errors->has('event_date'))
                                <p><small class="text-danger">{{$errors->first('event_date')}}.</small></p>
                            @endif
                        </div>
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
    --}}
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.detail-invitation', function() {
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

                $('#modalDetail #full-name').text(fullName);
                $('#modalDetail #nick-name').text(nickName);
                $('#modalDetail #wa-number').text(waNumber);
                $('#modalDetail #organization-name').text(organizationName);
                $('#modalDetail #organization-type').text(organizationType);
                $('#modalDetail #invite-vos-as').text(inviteVosAs);
                $('#modalDetail #event-type').text(eventType);
                $('#modalDetail #event-date').text(eventDate);
                $('#modalDetail #event-date2').text(eventDate2);
                $('#modalDetail #event-duration').text(eventDuration);
                $('#modalDetail #event-place').text(eventPlace);
                $('#modalDetail #event-detail').text(eventDetail);
                $('#modalDetail #participant').text(participant);
                $('#modalDetail #additional-note').text(additionalNote);
            });


            $(document).on('click', '.update-plakat', function() {
                var invitationId = $(this).data('invitation-id');
                var inviteVosAs = $(this).data('invite-vos-as');
                var eventType = $(this).data('event-type');
                var eventDate = $(this).data('event-date');
                var plakatStatus = $(this).data('plakat-status');
                console.log(plakatStatus)


                $('#modalPlakat #invite-vos-as').text(inviteVosAs);
                $('#modalPlakat #event-type').text(eventType);
                $('#modalPlakat #event-date').text(eventDate);

                if (plakatStatus == 'belum') {
                    $('#status-plakat-form option[value=belum]').attr('selected', 'selected');
                }

                if (plakatStatus == 'sudah') {
                    $('#status-plakat-form option[value=sudah]').attr('selected', 'selected');
                }

                $('#update-plakat-form').attr('action', '/invitation/plakat/'+invitationId);
                $('#modalPlakat #submitButton').click(function() {
                    $('#update-plakat-form').submit();
                });
            });

            // $(document).on('click', '.edit-invitation', function() {
            //     var invitationId = $(this).data('invitation-id');
            //     var eventName = $(this).data('event-name');
            //     var additionalInfo = $(this).data('additional-info');
            //     var eventDate = $(this).data('event-date');

            //     $('#event-name-input').val(eventName);
            //     $('#additional-info-input').val(additionalInfo);
            //     $('#event-date-input').val(eventDate);
            //     $('#update-invitation-form').attr('action', '/invitation/'+invitationId);
            // })
        });
    </script>
@endpush
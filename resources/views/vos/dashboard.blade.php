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
                                        <th>Event Name</th>
                                        <th>Additional Info</th>
                                        <th>Event Date</th>
                                        <th>Sent By</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 0;
                                    @endphp
                                    @foreach($datas->where('status', 'accepted')->where('event_date', '>=', date('Y-m-d')) as $key => $data)
                                        <tr>
                                            <td class="text-bold-500">{{$no+1}}</td>
                                            <td class="text-bold-500">{{$data->event_name}}</td>
                                            <td class="text-bold-500">{{$data->additional_info}}</td>
                                            <td class="text-bold-500">{{$data->event_date}}</td>
                                            <td class="text-bold-500">{{$data->user->name}}</td>
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
                                                <button class="btn btn-primary btn-sm edit-invitation" data-bs-toggle="modal" data-bs-target="#modalEdit" data-invitation-id="{{$data->id}}" data-event-name="{{$data->event_name}}" data-additional-info="{{$data->additional_info}}" data-event-date="{{$data->event_date}}" data-sent-by="{{$data->user->name}}" data-status="{{$data->status}}">Edit</button>
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
        });
    </script>
@endpush
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
                    <p class="text-subtitle text-muted">You can create an invitation by clicking 'Create' button. And you can update your invitation by clicking 'Edit' button. </p>
                    <button type="button" class="btn btn-outline-success float-end" data-bs-toggle="modal" data-bs-target="#modalCreate">Create</button>
                </div>
                <div class="card-content">
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
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datas as $key => $data)
                                        <tr>
                                            <td class="text-bold-500">{{$key+1}}</td>
                                            <td class="text-bold-500">{{$data->event_name}}</td>
                                            <td class="text-bold-500">{{$data->additional_info}}</td>
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
                                                <button class="btn btn-primary btn-sm edit-invitation" data-bs-toggle="modal" data-bs-target="#modalEdit" data-invitation-id="{{$data->id}}" data-event-name="{{$data->event_name}}" data-additional-info="{{$data->additional_info}}" data-event-date="{{$data->event_date}}">Edit</button>
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

    {{-- Modal Create --}}
    <div class="modal fade text-left" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Create Invitation Form</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="/invitation" method="POST">
                @csrf
                    <div class="modal-body">
                        <label>Event Name: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Event name" class="form-control" name="event_name">
                            @if($errors->has('event_name'))
                                <p><small class="text-danger">{{$errors->first('event_name')}}.</small></p>
                            @endif
                        </div>
                        <label>Additional Info: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Additional info" class="form-control" name="additional_info">
                            @if($errors->has('additional_info'))
                                <p><small class="text-danger">{{$errors->first('additional_info')}}.</small></p>
                            @endif
                        </div>
                        <label>Event Date: </label>
                        <div class="form-group">
                            <input type="date" placeholder="Event Date" class="form-control" min="{{date('Y-m-d')}}" name="event_date">
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
                            <span class="d-none d-sm-block">Create</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
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
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.edit-invitation', function() {
                var invitationId = $(this).data('invitation-id');
                var eventName = $(this).data('event-name');
                var additionalInfo = $(this).data('additional-info');
                var eventDate = $(this).data('event-date');

                $('#event-name-input').val(eventName);
                $('#additional-info-input').val(additionalInfo);
                $('#event-date-input').val(eventDate);
                $('#update-invitation-form').attr('action', '/invitation/'+invitationId);
            })
        });
    </script>
@endpush
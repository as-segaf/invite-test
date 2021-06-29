<table class="table table-lg">
    <thead>
        <tr>
            <th>No</th>
            <th>Invited As</th>
            <th>Event Type</th>
            <th>Event Date</th>
            <th>Plakat Status</th>
            <th>Status</th>
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
                    @if($data->plakat_status == 'belum')
                        <span class="badge bg-danger">Belum dikirim</span>
                    @elseif($data->plakat_status == 'sudah')
                        <span class="badge bg-success">Sudah dikirim</span>
                    @elseif($data->plakat_status == 'tanpa plakat')
                        <span class="badge bg-secondary">Tanpa plakat</span>
                    @endif
                </td>
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
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
        @foreach($datas as $key => $data)
            <tr>
                <td class="text-bold-500">{{$key+1}}</td>
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
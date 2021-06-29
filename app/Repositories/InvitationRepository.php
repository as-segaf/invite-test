<?php

namespace App\Repositories;

use App\Interfaces\InvitationRepositoryInterface;
use App\Models\Invitation;
use Carbon\Carbon;
use Exception;

class InvitationRepository implements InvitationRepositoryInterface
{
    public function getAll()
    {
        return Invitation::orderBy('status', 'desc')->get();
    }

    public function getUserInvitations()
    {
        return Invitation::orderBy('id', 'desc')->where('sent_by', auth()->id())->get();
    }

    public function getFilteredInvitations($request)
    {
        $invitations = Invitation::orderBy('id')->with('user');

        if ($request->filled('status')) {
            $invitations->where('status', $request->status);
        }

        if ($request->filled('eventDate')) {
            $invitations->whereDate('event_date', '=', Carbon::parse($request->eventDate)->toDateString());
        }

        if ($request->filled('plakatStatus')) {
            $invitations->where('plakat_status', $request->plakatStatus);
        }

        if ($request->filled('search')) {
            $invitations->where('invite_vos_as', 'ilike', '%'.$request->search.'%')
                ->orWhere('event_type', 'ilike', '%'.$request->search.'%')
                ->orWhereHas('user', function($query) use($request) {
                    $query->where('email', 'ilike', '%'.$request->search.'%');
                });
        }

        $invitations = $invitations->get();

        return $invitations;
    }

    public function store($request)
    {
        $invitation = Invitation::create([
            'full_name' => $request->full_name,
            'nick_name' => $request->nick_name,
            'wa_number' => $request->wa_number,
            'organization_type' => $request->organization_type,
            'organization_name' => $request->organization_name,
            'invite_vos_as' => $request->invite_vos_as,
            'event_type' => $request->event_type,
            'event_date' => $request->event_date,
            'event_date2' => $request->event_date2,
            'event_duration' => $request->event_duration,
            'event_place' => $request->event_place,
            'event_detail' => $request->event_detail,
            'participant' => implode(",", $request->participant),
            'additional_note' => $request->additional_note,
            'status' => 'pending',
            'plakat_status' => 'tanpa plakat',
            'sent_by' => auth()->id(),
        ]);

        if (!$invitation) {
            throw new Exception("Failed to save invitation", 1);
        }

        return $invitation;
    }

    public function update($request, $invitation)
    {
        $invitation->event_name = $request->event_name;
        $invitation->additional_info = $request->additional_info;
        $invitation->event_date = $request->event_date;

        if (!$invitation->save()) {
            throw new Exception("Failed to update invitation", 1);
        }

        return $invitation;
    }

    public function updateStatus($request, $invitation)
    {
        $invitation->status = $request->status;

        if ($request->status == 'accepted') {
            $invitation->plakat_status = 'belum';
        }

        if (!$invitation->save()) {
            throw new Exception("Failed to update invitation status", 1);
        }
        
        return $invitation;
    }

    public function updatePlakatStatus($request, $invitation)
    {
        $invitation->plakat_status = $request->plakat_status;

        if (!$invitation->save()) {
            throw new Exception("Failed to update plakat status", 1);
        }

        return $invitation;
    }

    public function destroy($id)
    {
        $invitation = Invitation::findOrFail($id);

        if (!$invitation->delete()) {
            throw new Exception("Failed to delete data", 1);
        }

        return $invitation;
    }
}

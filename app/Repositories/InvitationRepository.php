<?php

namespace App\Repositories;

use App\Interfaces\InvitationRepositoryInterface;
use App\Models\Invitation;
use Exception;

class InvitationRepository implements InvitationRepositoryInterface
{
    public function getAll()
    {
        return Invitation::orderBy('status', 'desc')->get();
    }

    public function getUserInvitations()
    {
        return Invitation::where('sent_by', auth()->id())->get();
    }

    public function getFilteredInvitations($request)
    {
        $invitations = Invitation::orderBy('id')->with('user');

        if ($request->filled('status')) {
            $invitations->where('status', $request->status);
        }

        if ($request->filled('eventDate')) {
            $invitations->where('event_date', $request->eventDate);
        }

        if ($request->filled('search')) {
            $invitations->where('event_name', 'ilike', '%'.$request->search.'%')
                ->orWhere('additional_info', 'ilike', '%'.$request->search.'%')
                ->orWhereHas('user', function($query) use($request) {
                    $query->where('name', 'ilike', '%'.$request->search.'%');
                });
        }

        $invitations = $invitations->get();

        return $invitations;
    }

    public function store($request)
    {
        $invitation = Invitation::create([
            'event_name' => $request->event_name,
            'additional_info' => $request->additional_info,
            'event_date' => $request->event_date,
            'status' => 'pending',
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

        if (!$invitation->save()) {
            throw new Exception("Failed to update invitation status", 1);
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

<?php

namespace App\Repositories;

use App\Interfaces\InvitationRepositoryInterface;
use App\Models\Invitation;
use Exception;

class InvitationRepository implements InvitationRepositoryInterface
{
    public function getAll()
    {
        return Invitation::all();
    }

    public function getUserInvitations()
    {
        return Invitation::where('sent_by', auth()->id())->get();
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

    public function updateStatus($request, $id)
    {
        $invitation = Invitation::findOrFail($id);

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

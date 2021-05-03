<?php

namespace App\Repositories;

use App\Interfaces\InvitationRepositoryInterface;
use App\Models\Invitation;

class InvitationRepository implements InvitationRepositoryInterface
{
    public function getAll()
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
}

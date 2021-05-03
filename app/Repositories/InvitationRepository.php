<?php

namespace App\Repositories;

use App\Interfaces\InvitationRepositoryInterface;
use App\Models\Invitation;

class InvitationRepository implements InvitationRepositoryInterface
{
    public function getAll()
    {
        return Invitation::all();
    }
}

<?php

namespace App\Services;

use App\Interfaces\InvitationRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Gate;

class InvitationService
{
    protected $invitationRepository;

    public function __construct(InvitationRepositoryInterface $invitationRepository)
    {
        return $this->invitationRepository = $invitationRepository;
    }

    public function index()
    {
        if (Gate::allows('isAdmin')) {
            return $this->invitationRepository->getAll();
        }

        return $this->invitationRepository->getUserInvitations();
    }

    public function store($request)
    {
        return $this->invitationRepository->store($request);
    }

    public function update($request, $invitation)
    {
        if (!auth()->user()->can('update', $invitation)) {
            throw new Exception("You are not allowed to do this actions", 1);
        }

        return $this->invitationRepository->update($request, $invitation);
    }

    public function updateStatus($request, $invitation)
    {
        if (!auth()->user()->can('update', $invitation)) {
            throw new Exception("You are not allowed to do this actions", 1);
        }
        
        return $this->invitationRepository->updateStatus($request, $invitation);
    }

    public function destroy($id)
    {
        return $this->invitationRepository->destroy($id);
    }
}

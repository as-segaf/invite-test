<?php

namespace App\Services;

use App\Interfaces\InvitationRepositoryInterface;

class InvitationService
{
    protected $invitationRepository;

    public function __construct(InvitationRepositoryInterface $invitationRepository)
    {
        return $this->invitationRepository = $invitationRepository;
    }

    public function getAll()
    {
        return $this->invitationRepository->getAll();
    }

    public function getUserInvitations()
    {
        return $this->invitationRepository->getUserInvitations();
    }

    public function store($request)
    {
        return $this->invitationRepository->store($request);
    }

    public function update($request, $id)
    {
        return $this->invitationRepository->update($request, $id);
    }

    public function updateStatus($request, $id)
    {
        return $this->invitationRepository->updateStatus($request, $id);
    }

    public function destroy($id)
    {
        return $this->invitationRepository->destroy($id);
    }
}

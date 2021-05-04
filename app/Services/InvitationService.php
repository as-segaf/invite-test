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

    public function index()
    {
        return $this->invitationRepository->getAll();
    }

    public function store($request)
    {
        return $this->invitationRepository->store($request);
    }

    public function updadate($request, $id)
    {
        return $this->invitationRepository->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->invitationRepository->destroy($id);
    }
}

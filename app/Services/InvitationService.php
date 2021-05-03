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
}

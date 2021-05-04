<?php

namespace App\Http\Controllers;

use App\Interfaces\InvitationRepositoryInterface;
use Illuminate\Http\Request;

class VosController extends Controller
{
    protected $invitationService; 

    public function __construct(InvitationRepositoryInterface $invitationRepository)
    {
        return $this->invitationService = $invitationRepository;
    }
}

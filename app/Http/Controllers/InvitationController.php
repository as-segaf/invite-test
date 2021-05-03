<?php

namespace App\Http\Controllers;

use App\Services\InvitationService;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    protected $invitationService;

    public function __construct(InvitationService $invitationService)
    {
        return $this->invitationService = $invitationService;
    }

    public function index()
    {
        $datas = $this->invitationService->index();

        return view('invitation.index', compact('datas'));
    }
}

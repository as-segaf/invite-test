<?php

namespace App\Http\Controllers\Vos;

use App\Http\Controllers\Controller;
use App\Services\InvitationService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $invitationService;

    public function __construct(InvitationService $invitationService)
    {
        return $this->invitationService = $invitationService;
    }

    public function index()
    {
        $datas = $this->invitationService->index();

        return view('vos.dashboard', compact('datas'));
    }
}

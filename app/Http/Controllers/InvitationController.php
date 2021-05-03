<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvitationRequest;
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

    public function store(InvitationRequest $request)
    {
        try {
            $data = $this->invitationService->store($request);
        } catch (\Throwable $th) {
            return redirect('/home')->with('error', $th->getMessage());
        }

        return redirect('home')->with('success', 'Invitation sent successfully');
    }
}

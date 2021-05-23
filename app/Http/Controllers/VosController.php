<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Services\InvitationService;
use Illuminate\Http\Request;

class VosController extends Controller
{
    protected $invitationService; 

    public function __construct(InvitationService $invitationService)
    {
        return $this->invitationService = $invitationService;
    }

    public function index()
    {
        $datas = $this->invitationService->index();

        return view('vos.index', compact('datas'));
    }

    public function filter(Request $request)
    {
        $datas = $this->invitationService->filter($request);
        
        return view('vos.table', compact('datas'))->render();
    }

    public function update(Request $request,Invitation $invitation)
    {
        try {
            $data = $this->invitationService->updateStatus($request, $invitation);
        } catch (\Throwable $th) {
            return redirect('/vos/invitation')->with('error', $th->getMessage());
        }

        return redirect('/vos/invitation')->with('success', 'Invitation updated successfully');
    }
}

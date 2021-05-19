<?php

namespace App\Http\Controllers;

use App\Interfaces\InvitationRepositoryInterface;
use App\Models\Invitation;
use Illuminate\Http\Request;

class VosController extends Controller
{
    protected $invitationService; 

    public function __construct(InvitationRepositoryInterface $invitationRepository)
    {
        return $this->invitationService = $invitationRepository;
    }

    public function index()
    {
        $datas = $this->invitationService->getAll();

        return view('vos.index', compact('datas'));
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

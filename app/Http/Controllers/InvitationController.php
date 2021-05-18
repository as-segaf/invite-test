<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvitationRequest;
use App\Models\Invitation;
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

        return view('user.index', compact('datas'));
    }

    public function store(InvitationRequest $request)
    {
        try {
            $data = $this->invitationService->store($request);
        } catch (\Throwable $th) {
            return redirect('/invitation')->with('error', $th->getMessage());
        }

        return redirect('/invitation')->with('success', 'Invitation sent successfully');
    }

    public function update(InvitationRequest $request,Invitation $invitation)
    {
        try {
            $data = $this->invitationService->update($request, $invitation);
        } catch (\Throwable $th) {
            return redirect('/invitation')->with('error', $th->getMessage());
        }

        return redirect('/invitation')->with('success', 'Invitation updated successfully');
    }

    public function destroy(Request $id)
    {
        try {
            $data = $this->invitationService->destroy($id);
        } catch (\Throwable $th) {
            return redirect('/invitation')->with('error', $th->getMessage());
        }

        return redirect('/invitation')->with('success', 'Invitation deleted successfully');
    }
}

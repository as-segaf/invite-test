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

    public function index()
    {
        $datas = $this->invitationService->getAll();

        return view('vos.index', compact('datas'));
    }
}

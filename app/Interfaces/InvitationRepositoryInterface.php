<?php

namespace App\Interfaces;

interface InvitationRepositoryInterface
{
    public function getAll();

    public function getUserInvitations();

    public function store($request);

    public function update($request, $invitation);

    public function updateStatus($request, $invitation);

    public function destroy($id);
}

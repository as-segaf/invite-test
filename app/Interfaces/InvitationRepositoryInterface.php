<?php

namespace App\Interfaces;

interface InvitationRepositoryInterface
{
    public function getAll();

    public function getUserInvitations();

    public function store($request);

    public function update($request, $id);

    public function updateStatus($request, $id);

    public function destroy($id);
}

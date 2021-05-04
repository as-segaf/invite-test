<?php

namespace App\Interfaces;

interface InvitationRepositoryInterface
{
    public function getUserInvitations();

    public function store($request);

    public function update($request, $id);

    public function destroy($id);
}

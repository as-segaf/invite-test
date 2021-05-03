<?php

namespace App\Interfaces;

interface InvitationRepositoryInterface
{
    public function getAll();

    public function store($request);

    public function update($request, $id);
}

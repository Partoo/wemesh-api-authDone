<?php

namespace App\Http\Controllers;


use App\Http\Resources\UserResource;
use App\Repository\Eloquent\UserRepository;

class MeController extends Controller
{
    protected $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function profile()
    {
        return new UserResource($this->repo->find(auth()->id()));
    }
}

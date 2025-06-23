<?php

namespace App\Services;
use App\Http\Resources\UserResource;

class UserService
{
      public function returnProfile():array
      {
             return [
                'user' => new UserResource(auth()->user())
             ];
      }
}
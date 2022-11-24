<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class TestController extends Controller
{
    public function index()
    {
        $user = User::findorfail(1);
        $data = json_decode($user, true);
        $data['user_profile'] = $user->user_profile;
        unset($data['user_profile_id']);
        return response()->json(['name' => $user->name, 'data' => $data], 202);
    }
}

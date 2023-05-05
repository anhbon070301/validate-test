<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function checkMail(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        if ($user) {
          return response()->json(false); // Giá trị đã tồn tại
        } else {
          return response()->json(true); // Giá trị là duy nhất
        }
    }
}

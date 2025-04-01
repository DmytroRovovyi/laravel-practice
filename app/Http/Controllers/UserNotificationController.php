<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\UserNotificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserNotificationController extends Controller
{
    /**
     * Send a letter to the user.
     *
     * @param int $userId
     * @param string $messageContent
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendEmail($userId, $messageContent)
    {
        $user = User::find($userId);

        if ($user) {
            Mail::to($user->email)->send(new UserNotificationMail($user, $messageContent));

            return response()->json(['message' => 'Email sent successfully!']);
        }

        // Якщо користувач не знайдений, повертаємо помилку
        return response()->json(['message' => 'User not found!'], 404);
    }
}

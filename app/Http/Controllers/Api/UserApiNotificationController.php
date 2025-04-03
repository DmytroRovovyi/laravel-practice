<?php

namespace App\Http\Controllers\Api;

use App\Mail\UserNotificationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class UserApiNotificationController extends Controller
{
    /**
     * Send mail to all users.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendEmailToAll(Request $request)
    {
        // Перевірка наявності тексту листа в запиті
        $validator = Validator::make($request->all(), [
            'messageContent' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Message content is required'], 400);
        }

        $users = User::all();

        foreach ($users as $user) {
            try {
                Mail::to($user->email)
                    ->queue(new UserNotificationMail($user, $request->messageContent));
            } catch (\Exception $e) {
                return response()->json(['error' => 'Error sending email to user ' . $user->id], 500);
            }
        }

        return response()->json(['message' => 'Emails are queued for sending'], 200);
    }

    /**
     * Sending an email to a user.
     *
     * @param int $userId
     * @param string $messageContent
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendEmail($userId, $messageContent)
    {
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        try {
            Mail::to($user->email)->queue(new UserNotificationMail($user, $messageContent));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error sending email to user ' . $userId], 500);
        }

        return response()->json(['message' => 'Email queued for sending'], 200);
    }
}

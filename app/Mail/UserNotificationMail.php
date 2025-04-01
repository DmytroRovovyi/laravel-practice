<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;

class UserNotificationMail extends Mailable
{
    public $user;
    public $messageContent;

    /**
     * Creating a new message instance.
     *
     * @param User $user
     * @param string $messageContent
     * @return void
     */
    public function __construct(User $user, $messageContent)
    {
        $this->user = $user;
        $this->messageContent = $messageContent;
    }

    /**
     * Determine what should be sent in the email.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.user_notification')
            ->with([
                'name' => $this->user->name,
                'messageContent' => $this->messageContent,
            ]);
    }
}

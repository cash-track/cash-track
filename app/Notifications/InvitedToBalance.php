<?php

namespace App\Notifications;

use App\Models\Balance;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class InvitedToBalance extends Notification
{
    use Queueable;

    /**
     * Man, who made invite
     *
     * @var \App\Models\User
     */
    public $initiator;

    /**
     * Balance, where invited user
     *
     * @var \App\Models\Balance
     */
    public $balance;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $initiator, Balance $balance)
    {
        $this->initiator = $initiator;
        $this->balance = $balance;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via() :array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) :MailMessage
    {
        $balance = $this->balance;
        $initiator = $this->initiator;

        return (new MailMessage)
            ->subject('Invited to balance')
            ->view('email.user-invited', compact('balance', 'initiator', 'notifiable'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array
     */
    public function toArray() :array
    {
        return [
            //
        ];
    }
}

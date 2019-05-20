<?php

namespace App\Channels;

use Exception;
use Illuminate\Notifications\Notification;

class SmsChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed $notifiable
     * @param  \Illuminate\Notifications\Notification $notification
     * @throws \Exception
     */
    public function send($notifiable, Notification $notification)
    {
        $phone = $notifiable->routeNotificationFor('sms');

        $message = $notification->toSms($notifiable);
        (new \App\Services\Sms())->sendMessage($phone, $message);
    }
}

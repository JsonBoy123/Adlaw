<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
class SubscriptionReminder extends Notification
{
    use Queueable;
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'id' => $this->data['id'],
            'title' => $this->data['title'],
            'url' => $this->data['url'],
            'message' => $this->data['message'],
        ];
    }
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'id' => $this->data['id'],
            'title' => $this->data['title'],
            'url' => $this->data['url'],
            'message' => $this->data['message'],
        ]);
    }
}

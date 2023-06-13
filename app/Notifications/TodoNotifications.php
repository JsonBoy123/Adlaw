<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class TodoNotifications extends Notification
{
    use Queueable;
    public $todo;
  
    public function __construct($todo)
    {
        $this->todo = $todo;
    }

    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'id' => $this->todo->id,
            'title' => $this->todo->title,
            'url' => $this->todo->status == 'P' ? 'todos' : 'todos/'.$this->todo->id,
            'message' => $this->todo->status == 'A' ? 'Todo completed by: '.$this->todo->assigned_user->namespace : ($this->todo->status == 'C' ? 'Your awaiting todo successfully approved' : ($this->todo->status == 'P' ? $this->todo->created_user->name.' has assigned todo to you' : ' Task missed please give the reason')),
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'id' => $this->todo->id,
            'title' => $this->todo->title,
            'url' => $this->todo->status == 'P' ? 'todos' : 'todos/'.$this->todo->id,
            'message' => $this->todo->status == 'A' ? 'Todo completed by: '.$this->todo->assigned_user->namespace : ($this->todo->status == 'C' ? 'Your awaiting todo successfully approved' : ($this->todo->status == 'P' ? $this->todo->created_user->name.' has assigned todo to you' : ' Task missed please give the reason')),        
        ]);
    }
}

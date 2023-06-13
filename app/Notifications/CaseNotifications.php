<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
class CaseNotifications extends Notification
{
    use Queueable;
    public $case;
    
    public function __construct($case)
    {
        $this->case = $case;
    }

    
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'id' => $this->case->case_id,
            'title' => $this->case->case_title,  
            'url' => $this->case->notify_type == 'case_create' ? 'case_mast' : 'case_mast/'.$this->case->case_id.',case_diary',
            'message' => $this->case->notify_type == 'case_create' ? ' Case assigned to you ' : ($this->case->notify_type == 'case_hearing' ? $this->case->date.' hearing date assigned to you' : ($this->case->notify_type == 'early_hearing' ? $this->case->date.' Tommorrow your case hearing announced' : ' Today your case hearing')),  
            //'date' => $this->case->date, 
                           
        ];
    }

  public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'id' => $this->case->case_id,
            'title' => $this->case->case_title,  
            'url' => $this->case->notify_type == 'case_create' ? 'case_mast' : 'case_mast/'.$this->case->case_id.',case_diary',
            'message' => $this->case->notify_type == 'case_create' ? ' Case assigned to you ' : ($this->case->notify_type == 'case_hearing' ? $this->case->date.' hearing date assigned to you' : ($this->case->notify_type == 'early_hearing'   ? $this->case->date.' Tommorrow your case hearing announced' : ' Today your case hearing')),  
        ]);
    }
}

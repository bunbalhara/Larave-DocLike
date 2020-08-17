<?php

namespace App\Notifications;

use App\Channels\Messages\WhatsAppMessage;
use App\Channels\WhatsAppChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class JobExist extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $link;

    public function __construct()
    {
        if(env('PRODUCTION')){
            $this->link = 'https://doclike.fr/job/post?token=';
        }else{
            $this->link = 'http://localhost:8000/job/post?token=';
        }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if($notifiable->offerBy == "Email"){
            return ['mail'];
        }else{
            return [WhatsAppChannel::class];
        }
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hello! '.$notifiable->patient_name)
            ->line('Your already have an active request in your system. You can have only one request per contact. If you want new request, please cancel current request.')
            ->action('View Request', url($this->link.$notifiable->token))
            ->line('Thanks for trusting DocLike with your medical care!');
    }

    public function toWhatsApp($notifiable)
    {
        return (new WhatsAppMessage())
            ->content("Hello ".$notifiable->patient_name." Thanks for contracting DocLike, You can be looking for your doctor by clicking following url ".$this->link.$notifiable->token);
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

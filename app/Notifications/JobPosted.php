<?php

namespace App\Notifications;

use App\Channels\Messages\WhatsAppMessage;
use App\Channels\WhatsAppChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class JobPosted extends Notification implements ShouldQueue
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
            $this->link = 'https://book.doclike.fr?bookid=';
        }else{
            $this->link = 'http://book.localhost?bookid=';
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
        return $notifiable->offerBy=='Email'?['mail']:[WhatsAppChannel::class];
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
                    ->greeting('Hello, '.$notifiable->patient_name)
                    ->line("Thanks for contracting DocLike.")
                    ->line("You can find your doctor by clicking following button.")
                    ->action('View Request', url($this->link.$notifiable->token))
                    ->line('Thank you for using DocLike!');
    }

    /**
     * @param $notifiable
     * @return mixed
     */

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

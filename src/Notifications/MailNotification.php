<?php

namespace Classiebit\Eventmie\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Classiebit\Eventmie\Notifications\CustomDb;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;


class MailNotification extends Notification
{
    use Queueable;

    public  $mail_data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($mail_data)
    {
        $this->mail_data =  (object) $mail_data;
    }

    /**
     * Check if all mail credentials are available
     *
     * @return boolean
     */
    private function checkMailCreds()
    {
        if(
            setting('mail.mail_driver') &&
            setting('mail.mail_host') && 
            setting('mail.mail_port') &&
            setting('mail.mail_username') &&
            setting('mail.mail_sender_email') && 
            setting('mail.mail_sender_name')
        )
            return true;

        return false;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // check mail creds
        if($this->checkMailCreds())
            return ['mail', CustomDb::class];
            
        // if mail creds not set then send only database notifications
        return [CustomDb::class];
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
                    ->subject($this->mail_data->mail_subject)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line($this->mail_data->line);
                    
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'notification'  => $this->mail_data,
            'n_type'        => $this->mail_data->n_type,
        ];
        
    }
}

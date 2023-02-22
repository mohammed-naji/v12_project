<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewProposal extends Notification
{
    use Queueable;

    protected $msg;
    protected $url;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($msg, $url)
    {
        $this->msg = $msg;
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // 'main'
        // ['mail']
        $via = explode(',', $notifiable->channel_type);

        return $via;
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
                    ->line('There is new proposal submitted to your project')
                    ->action('Projects Admin', url('/admin/projects'))
                    ->line('Thank you for using our application!');
    }

    // public function toDatabase($notifiable)
    // {
    //     return [
    //         'msg' => $this->msg,
    //         'url' => $this->url
    //     ];
    // }

    // public function toBroadcast($notifiable)
    // {
    //     return [
    //         'msg' => $this->msg,
    //         'url' => $this->url
    //     ];
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'msg' => $this->msg,
            'url' => $this->url
        ];
    }
}

<?php

namespace App\Notifications\Customer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramFile;
use NotificationChannels\Telegram\TelegramMessage;

class TelegramNewProjectNotification extends Notification
{
    use Queueable;
    private $id_channel;
    private $content;
    private $gif;
    private $url;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($id_channel, $content, $gif, $url)
    {
        $this->id_channel = $id_channel;
        $this->content = $content;
        $this->gif = $gif;
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
        return [TelegramChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toTelegram($notifiable)
    {

        return TelegramFile::create()
            ->to($this->id_channel)
            ->content($this->content)
            ->animation($this->gif)
            ->options(['parse_mode' => 'HTML'])
             ->button('Ver proyecto', $this->url);

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

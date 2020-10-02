<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class SolvedNotification extends Notification
{
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
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

    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            ->content('*'.$this->data['user_name'] . " finalizou um processo!\n\nCódigo do processo: ". $this->data['process_id'] ."\nCliente: ".$this->data['customer_name'] ." ". $this->data['customer_surname']."\nCidade: ".$this->data['customer_city']."\nÚltima atualização em: ".$this->data['process_update'].'*');
    }
}

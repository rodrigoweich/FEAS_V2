<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class RequestNotification extends Notification
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
        if($this->data['requests'] == 1) {
            return TelegramMessage::create()
            ->content('*'. $this->data['user_name'] . " está aguardando liberação!\n\nEsta é a primeira solicitação para este processo.\n\nCódigo do processo: ". $this->data['process_id'] ."\nCliente: ".$this->data['customer_name'] ." ". $this->data['customer_surname']."\nCidade: ".$this->data['customer_city']."\nAtualizado em: ".$this->data['process_update'].'*');
        } else if ($this->data['requests'] == 2) {
            return TelegramMessage::create()
            ->content('*'. $this->data['user_name'] . " está aguardando liberação!\n\nEsta é a segunda solicitação para este processo.\n\nCódigo do processo: ". $this->data['process_id'] ."\nCliente: ".$this->data['customer_name'] ." ". $this->data['customer_surname']."\nCidade: ".$this->data['customer_city']."\nAtualizado em: ".$this->data['process_update'].'*');
        } else if ($this->data['requests'] == 3) {
            return TelegramMessage::create()
            ->content('*'. $this->data['user_name'] . " está aguardando liberação!\n\nEstá é a terceira solicitação para este processo.\n\nCódigo do processo: ". $this->data['process_id'] ."\nCliente: ".$this->data['customer_name'] ." ". $this->data['customer_surname']."\nCidade: ".$this->data['customer_city']."\nAtualizado em: ".$this->data['process_update'].'*');
        } else {
            return null;
        }
    }
}

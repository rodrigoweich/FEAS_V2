<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class TaskComplete extends Notification
{
    protected $user;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    public function toTelegram($notifiable)
    {
        //return dd($this->data);
        return TelegramMessage::create()
            // Markdown supported.
            ->content($this->data['user_name'] . " está aguardando liberação!\n\nCódigo do processo: ". $this->data['process_id'] ."\nCliente: ".$this->data['customer_name'] ." ". $this->data['customer_surname']."\nCidade: ".$this->data['customer_city']."\nAtualizado em: ".$this->data['process_update'])
            ->button('Liberação SAC', route('default.process_stage_five.edit', $this->data['process_id']));
    }
}

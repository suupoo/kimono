<?php

namespace App\Notifications\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class CustomMailNotification extends Notification
{
    use Queueable;

    protected array $data;

    /**
     * Create a new notification instance.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail content definition.
     * @note 命名規則によりbladeファイル名を取得する
     * @note SampleVerifiedEmailNotification であれば emails.sample_verified_email を取得する
     * @return MailMessage
     */
    public function toMail(object $notifiable): MailMessage
    {
        $class = str_replace(__NAMESPACE__ . '\\', '', $this::class);
        $view = 'emails.'.Str::snake($class);
        return (new MailMessage)
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->subject(__('mail.'.$this::class))
            ->markdown($view, $this->data);
    }
}

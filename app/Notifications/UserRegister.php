<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class UserRegister extends Notification {
  use Queueable;

  public function __construct() {
    //
  }

  public function via($notifiable) {
    return ['mail'];
  }

  public function toMail($notifiable) {

    $verificationUrl = $this->verificationUrl($notifiable);

    return (new MailMessage)
        ->view('emails.verifyEmail')
        ->from('test@gmail.com', 'CryptoAgent')
        ->subject('Активация аккаунта.')
        ->action('Notification Action', url($verificationUrl));
  }

  protected function verificationUrl($notifiable)
  {
    return URL::temporarySignedRoute(
        'verification.verify',
        Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
        [
            'id' => $notifiable->getKey(),
            'hash' => sha1($notifiable->getEmailForVerification()),
        ]
    );
  }

  public function toArray($notifiable) {
    return [
      //
    ];
  }
}

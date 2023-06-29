<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreationClient extends Notification
{
    use Queueable;

    protected $params;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $params)
    {
        $this->params = $params;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                    ->subject('Bienvenu chez Epistrophe !')
                    ->greeting("Bonjour $notifiable->username !")
                    ->line('Nous vous annoncons que votre compte client Epistrophe a été créé')
                    ->line('Ce compte vous permettra de consulter et gérer les services souscris chez Epistrophe')
                    ->line('Voici ci-dessous vos accès par défaut :')
                    ->line("Nom d\'utilisateur : $notifiable->email")
                    ->line('Mot de passe : HJKH9887KJ')
                    ->line('Nous vous invitons à vous connecter à votre espace client pour modifier votre mot de passe')
                    ->action('CONNECTION A MON ESPACE CLIENT', url(env('APP_URL')));
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

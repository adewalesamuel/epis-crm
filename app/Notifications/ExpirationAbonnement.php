<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

    class ExpirationAbonnement extends Notification
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
        $service = $this->params[0];
        $periode = $this->params[1];
        $facture = $this->params[2];
        $domaine = $this->params[3];

        return (new MailMessage)
                    ->subject("Votre Abonnement $domaine Expire Bientôt !")
                    ->cc(env('SERVICE_CLIENT_MAIL', 'serviceclient@epistrophe.ci'))
                    ->greeting("Bonjour $notifiable->username !")
                    ->line("Nous tenons à vous signifier que votre $service arrive à expiration le $periode")
                    ->line("Veullez trouver ci-joint votre facture pour le renouvellement de votre service.")
                    ->line("Vous pouvez régler votre facture par différents moyens :")
                    ->line("(1- Chèque à l'ordre de EPISTROPHE, 2- Espèces (dans nos locaux), 
                    3- Orange Money (07 57 292 017), 4- MTN Mobile Money (05 55 87 74 91), 5- Paypal (En Euro)
                    https://www.paypal.me/EpistropheCI), 6- Wave (07 57 292 017)")
                    ->attach($facture, [
                                          'as' => 'FACTURE_PROFORMA.pdf',
                                          'mime' => 'text/pdf',
                                      ]);
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

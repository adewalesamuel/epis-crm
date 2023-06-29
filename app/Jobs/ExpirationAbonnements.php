<?php

namespace App\Jobs;

use App\Models\Abonnement;
use App\Models\Client;
use App\Models\Service;
use Exception;
use DateTime;
use App\Notifications\ExpirationAbonnement;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Pdf\FactureProforma;

class ExpirationAbonnements implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $day = 1;
        $week = 15;
        $month = 30;

        $today = date('Y-m-d');

        $month_date = date('Y-m-d', strtotime("$today +$month day"));
        $week_date = date('Y-m-d', strtotime("$today +$week day"));
        $day_date = date('Y-m-d', strtotime("$today +$day day"));

        $abonnements = Abonnement::all();

        foreach ($abonnements as $abonnement) {
            $client = $abonnement->client;
            $domaine = isset(json_decode($abonnement->details)->domaine) ? "( " . json_decode($abonnement->details)->domaine . " )" : ""; 
            $params = [
                ucfirst($abonnement->service->designation) . ' ' . $abonnement->service->designation_spe, 
                '', '', $domaine];

            if ($month_date == $abonnement->date_fin) {
                $params[1] = $abonnement->date_fin;
                $params[2] = $this->createFactureProforma($abonnement);
                $client->notify(new ExpirationAbonnement($params));
            }elseif ($week_date == $abonnement->date_fin) {
                $params[1] = $abonnement->date_fin;
                $params[2] = $this->createFactureProforma($abonnement);
                $client->notify(new ExpirationAbonnement($params));
            }elseif ($day_date == $abonnement->date_fin) {
                $params[1] = $abonnement->date_fin;
                $params[2] = $this->createFactureProforma($abonnement);
                $client->notify(new ExpirationAbonnement($params));
            }
        }
    }

    public function createFactureProforma($abonnement) {
        $service = ($abonnement->service->designation == 'domaine') ? json_decode($abonnement->details)->domaine : $abonnement->service->designation_spe;
		$date_debut = date_format(new DateTime($abonnement->date_debut), 'd-m-Y');
		$date_fin = date_format(new DateTime($abonnement->date_fin), 'd-m-Y');
        $prix = isset(json_decode($abonnement->service->details)->prix_renouv) ? json_decode($abonnement->service->details)->prix_renouv : $abonnement->prix; 
        $data = [
                  [utf8_decode(ucfirst($abonnement->service->designation) . ' ' . $service),
                  "Du " . $date_debut, $prix],
                  ["TOTAL HT", 'au ' . $date_fin, $prix],
                  ["TVA 0%", " ", $prix * 0],
                  ["TOTAL TTC", " ", $prix ],
              ];

        $pdf = new FactureProforma('P','mm','A4');

        $pdf->AddPage();
        $pdf->InfoClient($abonnement->client);
        $pdf->Ln();
        $pdf->Table($data);
        $pdf->Ln(10);
        $pdf->writeLine("SERVICE COMMERCIAL");
        $pdf->Signature();

        $filepath = $pdf->save();

        return $filepath;
    }
}

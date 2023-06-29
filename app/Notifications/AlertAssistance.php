<?php

namespace App\Notifications;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AlertAssistance
{

    public static function sendMail(array $_array){
        
        $mail = new PHPMailer(true);
        
        $mail->setFrom('episcrm@epistrophe.ci', 'EPIS CRM');
        $mail->addAddress($_array['email']);
        $mail->addReplyTo($_array['email_client'], $_array['nom_client']);
    
        $mail->isHTML(true);                                  
        $mail->Subject = $_array['subject'];
        // $mail->Body    = $_array['title'].'<br>'.$_array['message'].'<br><br>Accédez au ticket <a href="'.$_array['link'].'">ici</a>';
        $mail->Body = '
        <style>

            *{
                font-family:sans-serif;
            }
        </style>

        <div style="background:url('.url('/assets/images/tic-tac-toe.png').');width:600px;margin:auto;padding:10px">

            <div style="margin:auto;background:#fff;width:500px;padding:5px">
                <img src="'.url('/assets/images/logo.png').'" alt=""><br>
                <p style="margin:auto;text-align:center"><strong>'.$_array['subject'].'</strong></p> <br>
                <p style="margin:auto;text-align:center"><small>'.$_array['title'].':</p>

                <br><br>
                <small>Message du ticket</small>
                <p><strong>'.$_array['message'].'</strong></p>
                
                <br><br>
                <br><br>
                <p>Accédez au ticket <a href="'.$_array['link'].'">ici</a></p>
                
                <p style="float:right"><small><b>Depuis EpisCRM</b></small></p>
            </div>

        </div>';
    
        $mail->send();
    }
    
    public static function sendResponse(array $_array){
        
        $mail = new PHPMailer(true);
        
        $mail->setFrom('episcrm@epistrophe.ci', 'EPIS CRM');
        $mail->addAddress($_array['email']);
        $mail->addReplyTo($_array['email_response'], $_array['account']);
    
        $mail->isHTML(true);                                  
        $mail->Subject = $_array['subject'];
        // $mail->Body    = $_array['title'].'<br>'.$_array['message'].'<br><br>Accédez au ticket <a href="'.$_array['link'].'">ici</a>';
        
        $mail->Body = '
        <style>

            *{
                font-family:sans-serif;
            }
        </style>

        <div style="background:url('.url('/assets/images/tic-tac-toe.png').');width:600px;margin:auto;padding:10px">

            <div style="margin:auto;background:#fff;width:500px;padding:5px">
                <img src="'.url('/assets/images/logo.png').'" alt=""><br>
                <p style="margin:auto;text-align:center"><strong>'.$_array['subject'].'</strong></p> <br>
                <p style="margin:auto;text-align:center"><small>'.$_array['title'].':</p>

                <br><br>
                <small>Message du ticket</small>
                <p><strong>'.$_array['message'].'</strong></p>
                
                <br><br>
                <br><br>
                <p>Accédez au ticket <a href="'.$_array['link'].'">ici</a></p>
                
                <p style="float:right"><small><b>Depuis EpisCRM</b></small></p>
            </div>

        </div>';


    
        $mail->send();
    }
   
}

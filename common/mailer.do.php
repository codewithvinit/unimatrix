<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require(INSTALL_PATH . '/assets/fellow/phpmailer/Exception.php');
require(INSTALL_PATH . '/assets/fellow/phpmailer/PHPMailer.php');

function delivermail($ntcode, $toid, $cntaddarr = '') {
    global $db, $cfgrow, $bpprow;

    if (!defined('ISDEMOMODE')) {

        // load message
        $msgRow = array();
        $row = $db->getAllRecords(DB_TBLPREFIX . '_notifytpl', '*', ' AND ntcode = "' . $ntcode . '"');
        foreach ($row as $value) {
            $msgRow = array_merge($msgRow, $value);
        }

        // populate array
        $cntarr = array();
        $cntarr = array_merge($bpprow, $cntarr);
        $cntarr = array_merge($cfgrow, $cntarr);
        if ($toid > 0) {
            // Get member details
            $mbrdata = getmbrinfo($toid);
            $cntarr = array_merge($mbrdata, $cntarr);
            $emailtoname = $mbrdata['firstname'] . ' ' . $mbrdata['lastname'];
            $emailtoaddr = $mbrdata['email'];
        } else {
            $emailtoname = $cfgrow['site_emailname'];
            $emailtoaddr = $cfgrow['site_emailaddr'];
        }
        $cntarr = array_merge((array) $cntaddarr, $cntarr);

        if ($toid < 1 || $mbrdata['optinme'] == 1) {

            // parse content
            $msgsubject = parsenotify($cntarr, $msgRow['ntsubject']);
            $msgtext = parsenotify($cntarr, $msgRow['nttext']);
            $msghtml = parsenotify($cntarr, $msgRow['nthtml']);

            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Set who the message is to be sent from
                $mail->setFrom($cfgrow['site_emailaddr'], $cfgrow['site_emailname']);
                //Set an alternative reply-to address
                //$mail->addReplyTo($cfgrow['site_emailaddr'], $cfgrow['site_emailname']);
                //Set who the message is to be sent to
                $mail->addAddress($emailtoaddr, $emailtoname);
                //Set the subject line
                $mail->Subject = $msgsubject;
                //Read an HTML message body from an external file, convert referenced images to embedded,
                //convert HTML into a basic plain-text alternative body
                $mail->msgHTML($msghtml, __DIR__);
                //Replace the plain text body with one created manually
                $mail->AltBody = $msgtext;
                //Attach an image file
                //$mail->addAttachment('images/phpmailer_mini.png');
                //send the message, check for errors
                if (!$mail->send()) {
                    printlog('mailer.do', "Mailer Error ({$msgsubject}): {$mail->ErrorInfo}");
                } else {
                    printlog('mailer.do', "Message sent ({$msgsubject})!");
                }
            } catch (Exception $e) {
                printlog('mailer.do', "Message ({$msgsubject}) could not be sent. Mailer Error: {$mail->ErrorInfo}");
            }
        }
    }
}

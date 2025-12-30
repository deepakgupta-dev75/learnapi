<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
    use Twilio\Rest\Client;

    function hasPermission() {

    }

    function hasRole ()
    {

    }

    function hasAnyRole ()
    {

    }

    function sendEmail ($to,$subject,$body,$attachment=null)
    {
        $mail = new PHPMailer(true);
        
        try {
            // SMTP Settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'gdeepak2075@gmail.com';  // your SMTP email
            $mail->Password   = 'ivefzvreabngvncp';      // Gmail App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Sender
            $mail->setFrom('gdeepak2075@gmail.com', 'OBS');

            // Receiver
            $mail->addAddress($to);

            // Email Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            // Attachment
            if (!empty($attachment)) {
                $mail->addAttachment($attachment);
            }

            // Send E-Mail
            if($mail->send()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            // You can log this instead of echoing
            error_log("Mailer Error: " . $mail->ErrorInfo);
            return false;
        }
    }

    function sendSMS ($to,$body)
    {
        $sid    = env("TWILIO_SID");
        $authToken  = env("TWILIO_TOKEN");
        $twilioPhoneNumber   = env("TWILIO_FROM");

        try {
            $client = new Client($sid, $authToken);

            return $client->messages->create(
                // "+91".$to,
                env('COUNTRY_CODE').''.$to,
                [
                    'from' => $twilioPhoneNumber,
                    'body' => $body
                ]
            ); 

            return true;
        } catch (Exception $e) {
            error_log("Send SMS Error :: ",$e->getMessage());
        }
        // try {
        //     $sms = $this->client->messages->create(
        //         $to,
        //         [
        //             'from' => $this->from,
        //             'body' => $message,
        //             'statusCallback' => 'https://yourdomain.com/twilio/sms-status-callback' // Your status callback URL
        //         ]
        //     );
    
        //     Log('info', "SMS sent | SID: {$sms->sid} | To: {$to}");
    
        //     return $this->response()->setStatusCode(200)->setJSON(['message'   => 'SMS sent successfully', 'messageSid'=> $sms->sid ]);
    
        // } catch (Exception $e) {
        //     Log('error', "SMS send failed: {$e->getMessage()} ");
        //     return $this->response()->setStatusCode(200)->setJSON(['error' => 'Failed to send SMS', 'details' => $e->getMessage() ]);
        // }
    }



    function formatCurrency ($amount) {
        return "₹". number_format($amount);
    }

    function formatPrice ($amount) {
        return number_format($amount,2);
    }

    function formatDate ($date,$format = "d-m-Y") {
        return date($format,strtotime($date));
    }

    function generateOTP($length = 6)
    {
        if ($length < 4) {
            $length = 4;
        }
        return rand(pow(10, $length - 1), pow(10, $length) - 1);
    }

    function generateToken ($userId = null) {
        return hash('sha256', time() . $userId . bin2hex(random_bytes(40)));
    }

    function maskMobile ($mobile) {
        return substr($mobile, 0, 2) . '*****' . substr($mobile, -3);
    }

    function randomColor () {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }

    function encryptData ($data) {
        return base64_encode($data);
    }
    function decryptData ($data) {
        return base64_decode($data, true);
    }
    function generateUsername ($name) {
        return $name . '_' . rand(1000, 9999);
    }
    function generateOrderNumber ($amount) {
        return "ORD".date("Ymd").rand(100000, 999999);
    }
    function getIp ($amount) {
        return request()->ip();
    }
    function getLatLng ($address) {
        return "Rs". number_format($address);
    }
    function getDirection ($origin,$destination,$mode="Traveling") {
        return "Rs". number_format($origin);
    }
    function getAddress ($lat,$lng) {
        return "Rs". number_format($lng);
    }
    function getDistance ($lat1,$lat2,$lng1,$lng2,$unit = 'km') {
        return "Rs". number_format($lng1);
    }
    function getDistanceMatrix ($origin,$destination) {
        return "Rs". number_format($origin);
    }
    function getPlaces ($lat,$lng,$keyword,$radius,$type) {
        return "Rs". number_format($lng);
    }
    function detectDevice ($data) {
        return "Rs". number_format($data);
    }
    function generateQRCode($text, $path = null)
    {
        // If you want to save QR in storage
        if ($path) {
            $fileName = 'qr_' . time() . '.png';
            $fullPath = storage_path("app/public/" . $path . "/" . $fileName);

            // Create folder if not exists
            if (!file_exists(storage_path("app/public/" . $path))) {
                mkdir(storage_path("app/public/" . $path), 0777, true);
            }

            // Save QR Image
            QrCode::format('png')
                ->merge('/path/to/logo.png', .30) 
                ->size(300)
                ->margin(2)
                ->generate($text, $fullPath);

            return asset("storage/$path/$fileName"); // Return image URL
        }

        // If no saving → return Base64
        return base64_encode(
            QrCode::format('png')->size(300)->margin(2)->generate($text)
        );
    }
    function getAutoComplete ($amount) {
        return "Rs". number_format($amount);
    }
    function validateCoordinates($lat, $lng)
    {
        if (!is_numeric($lat) || !is_numeric($lng)) {
            return false;
        }

        $lat = floatval($lat);
        $lng = floatval($lng);

        return ($lat >= -90 && $lat <= 90) && ($lng >= -180 && $lng <= 180);
    }
    function getPlaceDetails ($amount) {
        return "Rs". number_format($amount);
    }

    function convertToUtc($dateTime, $fromTimeZone = 'Asia/Kolkata')
    {
        try {
            $date = new DateTime($dateTime, new DateTimeZone($fromTimeZone));
            $date->setTimezone(new DateTimeZone('UTC'));
            return $date->format('Y-m-d H:i:s');
        } catch (Exception $e) {
            return null; // invalid datetime
        }
    }

    function convertToLocalTimeZone($dateTimeUtc, $toTimeZone = 'Asia/Kolkata')
    {
        try {
            $date = new DateTime($dateTimeUtc, new DateTimeZone('UTC'));
            $date->setTimezone(new DateTimeZone($toTimeZone));
            return $date->format('Y-m-d H:i:s');
        } catch (Exception $e) {
            return null; // invalid datetime
        }
    }

    function maskName ($name)
    {
        $name = trim($name);

        $name = str_replace('  ', ' ', $name);
        $plain = str_replace(' ', '', $name);

        // First & last characters stay visible
        $masked = $plain[0] . str_repeat('*', strlen($plain) - 2) . substr($plain, -1);

        return $masked;
    }


?>

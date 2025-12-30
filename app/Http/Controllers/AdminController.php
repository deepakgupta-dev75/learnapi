<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AdminController extends Controller
{
    //




    function getLatLong($address) {
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($address) . "&key=AIzaSyCZPDb9EfI0ovGfe4SdT0LWX2-3Kd43a-Q";
        $json = file_get_contents($url);
        $data = json_decode($json);
        if ($data->status === "OK" && isset($data->results[0])) {
            $latitude = $data->results[0]->geometry->location->lat;
            $longitude = $data->results[0]->geometry->location->lng;
            return ['latitude' => $latitude, 'longitude' => $longitude];
        } else {
            return null;
        }
    }


    function test($test) {
        echo "<pre>";
        print_r($test);
        echo "</pre>";
        return $test;
    }


    function datefilter($filterVar, $from = null, $to = null)
    {
        if ($filterVar == 'custom_date_filter') { //custom
            if ($from && $to) {
                $from_date = date_create_from_format('m-d-Y', $from);
                $to_date = date_create_from_format('m-d-Y', $to);
                if ($from_date && $to_date) {
                    $from = $from_date->format('Y-m-d 00:00:00');
                    $to = $to_date->format('Y-m-d 23:59:59');
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } elseif ($filterVar == 1) { //today
            $from = date('Y-m-d 00:00:00');
            $to = date('Y-m-d 23:59:59');
        } elseif ($filterVar == 2) { //yesterday
            $from = date('Y-m-d 00:00:00', strtotime("-1 days"));
            $to = date('Y-m-d 23:59:59', strtotime("-1 days"));
        } elseif ($filterVar == 3) { //s-t
            $from = date('Y-m-d 00:00:00', strtotime("Last Sunday"));
            $to = date('Y-m-d 23:59:59');
        } elseif ($filterVar == 4) { //m-t
            $from = date('Y-m-d 00:00:00', strtotime("Last Monday"));
            $to = date('Y-m-d 23:59:59');
        } elseif ($filterVar == 5) { //last 7 days
            $from = date('Y-m-d 00:00:00', strtotime("-7 days"));
            $to = date('Y-m-d 23:59:59');
        } elseif ($filterVar == 6) { //lastweek(sun-sat)
            $to = date('Y-m-d 00:00:00', strtotime("last Saturday"));
            $from = date('Y-m-d 23:59:59', strtotime("-7 Days", strtotime($to)));
        } elseif ($filterVar == 7) { //lastweek(mon-sun)
            $to = date('Y-m-d 00:00:00', strtotime("last Sunday"));
            $from = date('Y-m-d 23:59:59', strtotime("-7 Days", strtotime($to)));
        } elseif ($filterVar == 8) { //last business week(mon-fri)
            $to = date('Y-m-d 00:00:00', strtotime("last Friday"));
            $from = date('Y-m-d 23:59:59', strtotime("-5 Days", strtotime($to)));
        } elseif ($filterVar == 9) { //last 14 days
            $from = date('Y-m-d 00:00:00', strtotime("-14 days"));
            $to = date('Y-m-d 23:59:59');
        } elseif ($filterVar == 10) { //this month
            $from = date('Y-m-d 00:00:00', strtotime('first day of this month'));
            $to = date("Y-m-d 23:59:59", strtotime('last day of this month'));
        } elseif ($filterVar == 11) { //last 30 days
            $from = date('Y-m-d 00:00:00', strtotime("-30 days"));
            $to = date('Y-m-d 23:59:59');
        } elseif ($filterVar == 12) { //last month
            $from = date('Y-m-d 00:00:00', strtotime('first day of last month'));
            $to = date('Y-m-d 23:59:59', strtotime('last day of last month'));
        } elseif ($filterVar == 13) { //This year
            $from = date('Y-01-01 00:00:00');
            $to = date('Y-m-d 23:59:59');
        } elseif ($filterVar == 14) { //1 last year
            $from = date("Y-m-d 00:00:00", strtotime("last year January 1st"));
            $to = date("Y-m-d 23:59:59", strtotime("last year December 31st"));
        } elseif ($filterVar == 14) { //last 2 year
            $from = date("Y-m-d 00:00:00", strtotime("last year January 1st"));
            $to = date("Y-m-d 23:59:59", strtotime("last year December 31st"));
        } elseif ($filterVar == 14) { //last 3 year
            $from = date("Y-m-d 00:00:00", strtotime("last year January 1st"));
            $to = date("Y-m-d 23:59:59", strtotime("last year December 31st"));
        }
        return ["from" => $from, "to" => $to];
    }


    public function log($level, $message, $data = null)
    {
        $environment = ENVIRONMENT;

        if (is_array($data)) {
            $data = json_encode($data);
            $data = preg_replace('/"password":"[^"]*"/', '"password":"****"', $data);
        }

        $logEntry = [
            "date" => date('Y-m-d H:i:s'),
            "level" => $level,
            "message" => $message,
            "data" => $data,
        ];

        $logText = json_encode($logEntry) . PHP_EOL;

        switch ($environment) {
            case 'development':
                $logFile = WRITEPATH . 'logs/development/' . strtolower($level) . '.log';
                break;
            case 'testing':
                $logFile = WRITEPATH . 'logs/testing/' . strtolower($level) . '.log';
                break;
            case 'production':
                $logFile = WRITEPATH . 'logs/production/' . strtolower($level) . '.log';
                break;
            default:
                $logFile = WRITEPATH . 'logs/debug.log';
                break;
        }

        file_put_contents($logFile, $logText . "\n\n", FILE_APPEND | LOCK_EX);
    }




    // Webhook

    public function stripeReceive()
    {
        $payload = file_get_contents('php://input');
        $data = json_decode($payload, true);
        log('info', 'Stripe Webhook payload: ' . print_r($data, true));
        
        $webhookSecret = 'your-stripe-webhook-secret';
        $sigHeader = $this->request->getHeaderLine('Stripe-Signature');
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sigHeader, $webhookSecret
            );
        } catch (\UnexpectedValueException $e) {
            return $this->sendError('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return $this->sendError('Invalid signature', 400);
        }

        switch ($event->type) {
            case 'payment_intent.succeeded':
            case 'payment_intent.payment_failed':
            case 'charge.succeeded':
            case 'charge.failed':
            case 'customer.subscription.created':
            case 'customer.subscription.updated':
            case 'customer.subscription.deleted':
            case 'customer.created':
            case 'customer.updated':
            case 'customer.deleted':
            case 'invoice.created':
            case 'invoice.payment_succeeded':
            case 'invoice.payment_failed':
                $this->handleStripeEvent($event);
                break;
            default:
                return $this->sendError('Unknown event type', 400);
        }
        return $this->sendResponse('Webhook received');
    }

    public function googleReceive()
    {
        return $this->sendResponse('Google Webhook received');
    }

    public function facebookReceive()
    {
        return $this->sendResponse('Facebook Webhook received');
    }

    private function handleStripeEvent($event)
    {
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                // Process successful payment intent
                break;
            case 'payment_intent.payment_failed':
                $paymentIntent = $event->data->object;
                // Process failed payment intent
                break;
            case 'charge.succeeded':
                $charge = $event->data->object;
                // Process successful charge
                break;
            case 'charge.failed':
                $charge = $event->data->object;
                // Process failed charge
                break;
            case 'customer.subscription.created':
                $subscription = $event->data->object;
                // Process subscription creation
                break;
            case 'customer.subscription.updated':
                $subscription = $event->data->object;
                // Process subscription update
                break;
            case 'customer.subscription.deleted':
                $subscription = $event->data->object;
                // Process subscription deletion
                break;
            case 'customer.created':
                $customer = $event->data->object;
                // Process customer creation
                break;
            case 'customer.updated':
                $customer = $event->data->object;
                // Process customer update
                break;
            case 'customer.deleted':
                $customer = $event->data->object;
                // Process customer deletion
                break;
            case 'invoice.created':
                $invoice = $event->data->object;
                // Process invoice creation
                break;
            case 'invoice.payment_succeeded':
                $invoice = $event->data->object;
                // Process successful invoice payment
                break;
            case 'invoice.payment_failed':
                $invoice = $event->data->object;
                // Process failed invoice payment
                break;
            default:
                log('error', 'Unhandled Stripe event type: ' . $event->type);
                break;
        }
    }

    private function handleTwilioEvent($data)
    {
        switch ($data['EventType']) {
            case 'incoming_call':
                // Process incoming call
                break;
            case 'call_completed':
                // Process completed call
                break;
            case 'message_sent':
                // Process sent message
                break;
            case 'message_failed':
                // Process failed message
                break;
            default:
                log('error', 'Unhandled Twilio event type: ' . $data['EventType']);
                break;
        }
    }


}

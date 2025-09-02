<?php

namespace App\Traits;
use Carbon\Carbon;

trait BhashSmsTrait
{
    private ?string $user = 'nwaresofttrans';
    private ?string $pass = '123456';
    private ?string $sender = 'OURONW';
    private ?string $priority = 'ndnd'; // Example priority
    private ?string $stype = 'normal'; // Example message type
    private ?string $text;
    private ?string $otp;
    private ?string $url;
    public function __construct()
    {
//        $this->otp = $this->generateOtp();
    }

    public function SendSms($phone, $link = '', $name = 'User', $var2 = 'Activate Device')
    {
        $otp = $link;
        $user = $this->user;
        $pass = $this->pass;
        $sender = $this->sender;
        $priority = $this->priority;
        $stype = $this->stype;

        $text = urlencode("Dear {$name}, You have requested to {$var2}. Please use the OTP {$otp} to proceed with this request.. Team Nwaresoft."); // URL encode the message

        $url = "http://bhashsms.com/api/sendmsg.php?user=$user&pass=$pass&sender=$sender&phone=$phone&text=$text&priority=$priority&stype=$stype";

        // Initialize cURL
        $ch = curl_init();


        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


        // Execute the request
        $response = curl_exec($ch);


        // Close cURL
        curl_close($ch);

        // Check for errors
        if (curl_errno($ch)) {
            return json_encode(["status" => false, 'message' => curl_error($ch)]);

            //            return false;
        } else {
            // Display the response
            return json_encode(["status" => true, 'message' => $response]);

            //            return true;
        }
    }


    public function generateOtp()
    {
        do {
            $random_char = str_shuffle("0123456789");
            $otp = substr($random_char, 0, 6); // Generate 6-digit OTP
        } while ((int)$otp < 100000); // Ensure OTP is always 6 digits (>= 100000)

        return $otp;
    }

    public function timeDiffenceInMinutes($lastUpdatedTime)
    {
        $anchorTime = Carbon::createFromFormat("Y-m-d H:i:s", $lastUpdatedTime);
        $currentTime = Carbon::createFromFormat("Y-m-d H:i:s", date("Y-m-d H:i:00"));
        return $anchorTime->diffInMinutes($currentTime);
    }
}

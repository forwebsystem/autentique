<?php

namespace ForWebSystem\Autentique;

use CURLFile;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;

class Api
{
    public static function request(string $token, string $query, string $contentType, string $pathFile = null)
    {
        $httpHeader = [
            "Authorization: Bearer {$token}"
        ];

        switch ($contentType) {
            case 'json':
                $postFields = '{"query":' . $query . '}';
                array_push($httpHeader, 'Content-Type: application/json');
                break;
            case 'form':
                $attributes = '{"query":' . $query . '}';
                $postFields = [
                    'operations' => $attributes,
                    'map' => '{"file": ["variables.file"]}',
                    'file' => new CURLFile($pathFile)
                ];
                break;
            default:
                $postFields = null;
                break;
        }

        if (is_null($postFields)) return "The postfield field cannot be null";

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => config('autentique.url'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postFields,
            CURLOPT_HTTPHEADER => $httpHeader,
        ]);

        $response = curl_exec($curl);
        
        if (curl_errno($curl)) {
            $error = curl_error($curl);
        }

        curl_close($curl);

        if (isset($error)) {
            return json_encode([
                'message' => !empty($error) ? $error : "CURL return false",
            ]);
        }

        return $response;
    }
}

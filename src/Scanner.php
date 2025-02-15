<?php

namespace Kutran\TestScannerPhp;
use GuzzleHttp\Client;

class Scanner
{
    protected $urls;
    protected $httpClient;
    public function __construct(array $urls){
        $this->urls = $urls;
        $httpClient = new \GuzzleHttp\Client();

    }
    public function getInvalidUrls(){
        $invalidUrls = [];
        foreach($this->urls as $url){
            try {
                $statusCode = $this->getStatusCodeForUrl($url);
            }catch (\Exception $e){
                $statusCode = 500;
            }
            if($statusCode >= 400){
                array_push($invalidUrls, ['url' => $url, 'status_code' =>$statusCode]);
            }

        }
    }
    public function getStatusCodeForUrl($url){
        $httpResponse = $this->httpClient->options($url);
        return $httpResponse->getStatusCode();
    }



}
<?php
namespace Tests\Scanner\src;

use GuzzleHttp\Client;

class Scanner
{
    protected $urls;

    protected $httpClient;

    public function __construct(array $urls)
    {
        $this->urls = $urls;
        $this->httpClient = new Client();
    }

    public function getInvalidUrls()
    {
        $invalidUrls = [];
        foreach ($this->urls as $url) {
            try {
                $statusCode = $this->getStatusCodeForUrl($url);
            }catch (\Exception $e){
                echo $e->getMessage() . PHP_EOL;
                $statusCode = 500;
            }

            if ($statusCode >= 400){
                array_push($invalidUrls, [
                    'url'   => $url,
                    'status'=> $statusCode,
                ]);
            }
        }
        return $invalidUrls;
    }

    protected function getStatusCodeForUrl($url){

        $httpResp = $this->httpClient->post($url);

        return $httpResp->getStatusCode();
    }
}

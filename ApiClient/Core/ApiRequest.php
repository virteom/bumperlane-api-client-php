<?php

namespace Virteom\ApiClient\Php\Core;
include_once(__DIR__ . '/../includes.php');

class ApiRequest extends \ODataQuery\ODataResourcePath {
    private $apiClient = null;
    private $property = null;
    private $accessToken = null;
    private $refreshToken = null;

    const ORDER_ASC = 'ASC';
    const ORDER_DESC = 'DESC';

    public function __construct($apiClient, $property){
        $this->apiClient = $apiClient;
        $this->property = $property;
        parent::__construct(rtrim($this->apiClient->GetUrl(), '/').'/'.$property);
    }

    private function getAccessTokenIfNeeded(){
        if(!$this->apiClient->UseCredentials || ($this->apiClient->ClientId == null && $this->apiClient->ClientSecret == null)){
            $this->accessToken = null;
            return;
        }

        if($this->accessToken === null){
            try {
                $client = new \GuzzleHttp\Client();
                $response = $client->request('POST', rtrim(IDENTIY_SITE_URL,"/") . '/core/connect/token', [
                    'form_params' => [
                        'grant_type' => 'client_credentials',
                        'scope' => 'apis virt.permissions',
                        'client_id' => $this->apiClient->ClientId,
                        'client_secret' => $this->apiClient->ClientSecret
                    ],
                    'verify' => $this->certificateAuthoritiesPath(),
                    'proxy' => $this->getProxyOverrideIfNeeded(),
                ]);

                if($response->getStatusCode() == 200){
                    $responseData = json_decode($response->getBody());
                    $accessToken = $responseData->access_token;
                    $this->accessToken = $accessToken;
                }
            } catch (RequestException $e) {
                echo \Psr7\str($e->getRequest());
                if ($e->hasResponse()) {
                    echo \Psr7\str($e->getResponse());
                }
            }
        }
    }

    protected function getClient(){
            $headers = [
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json'
            ];

            $this->getAccessTokenIfNeeded();
            if($this->accessToken === null){
                $headers['Authorization'] = 'Bearer ' . $this->accessToken;
            }

            $client = new \GuzzleHttp\Client([
                'timeout'  => 60.0,
                'proxy' => $this->getProxyOverrideIfNeeded(),
                'headers' => $headers
            ]);

        return $client;
    }

    public function setOrderByDesc($property = null){
        if($property == null){
            return;
        }

        return parent::setOrderBy($property . ' ' . ApiRequest::ORDER_DESC);
    }

    public function setOrderBy($property = null){
        if($property == null){
            return;
        }

        return parent::setOrderBy($property . ' ' . ApiRequest::ORDER_ASC);
    }

    public function Post($body){
        $client = $this->getClient();
        $response = $client->request('POST', (string)$this, [
            'json' => $body,
            'verify' => $this->certificateAuthoritiesPath()
        ]);
        return $response;
    }

    public function Patch($body){
        $client = $this->getClient();
        $response = $client->request('PATCH', (string)$this, [
            'json' => $body,
            'verify' => $this->certificateAuthoritiesPath()
        ]);

        return $response;
    }

    public function PatchGetCode($api, $body, $query = null){
        $responseCode = $this->Patch($api, $body, $query)->getStatusCode();
        return $responseCode;
    }

    public function PatchGetBody($api, $body, $query = null){
        $responseBody = json_decode($this->Patch($api, $body, $query)->getBody());
        return $responseBody;
    }

    public function Get(){
        $client = $this->getClient();
        $response = $client->request('GET', (string)$this, [
            'verify' => $this->certificateAuthoritiesPath()
        ]);

        return (string)$response->getBody();
    }

    public function GetPhpSerialized(){
        $responseBody = json_decode($this->Get());
        return $responseBody->value;
    }

    private function certificateAuthoritiesPath(){
        if(!defined('SSL_CA_PEM_FILE')){
            return null;
        }

        return SSL_CA_PEM_FILE != null && strlen(SSL_CA_PEM_FILE) > 0 ? SSL_CA_PEM_FILE : null;
    }

    private function getProxyOverrideIfNeeded(){
        if(!defined('HTTP_PROXY_OVERRIDE')){
            return null;
        }

        return HTTP_PROXY_OVERRIDE != null && strlen(HTTP_PROXY_OVERRIDE) > 0 ? HTTP_PROXY_OVERRIDE : null;
    }

    public function __toString() {
        return parent::__toString();
    }
}
<?php

namespace App\Services;
use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;


class GoogleDriveService
{
    
    public function __construct()
    {
        $this->googleClient = new Google_Client();
        $this->googleClient->setApplicationName('API Helpay - Integração com Drive');
        $this->googleClient->setScopes([Google_Service_Drive::DRIVE]);
        $this->googleClient->setAuthConfig(config('services.google'));
        $this->googleClient->setAccessType('offline');
        $this->googleClient->setApprovalPrompt('force');
    }
    /**
     * Configure google API client and log in
     * @param integer $authCode
     * @return array
    */
    function config($authenticationCode)
    {
        try {
            if ($this->googleClient->isAccessTokenExpired()) {

                $userCredentialsFile = storage_path('user_google_credentials.json');

                if (file_exists($userCredentialsFile)) {
                    $accessToken = json_decode(file_get_contents($userCredentialsFile), true);
                    $this->googleClient->setAccessToken($accessToken);
                }
            
                if ($this->googleClient->getRefreshToken()) {
                    $this->googleClient->fetchAccessTokenWithRefreshToken($this->googleClient->getRefreshToken());

                } else {
                    if (!$authenticationCode) {

                        /* create an authentication URL for the user */
                        $newAuthURL = $this->googleClient->createAuthUrl();
                        return ['data' => ['auth_url' => $newAuthURL, 'authenticated' => false], 'status' => 400];
                    }

                    $accessToken = $this->googleClient->fetchAccessTokenWithAuthCode($authenticationCode);

                    $this->googleClient->setAccessToken($accessToken);
                }

                if (!file_exists(dirname($userCredentialsFile))) {
                    mkdir(dirname($userCredentialsFile), 755, true);
                }
                
                file_put_contents($userCredentialsFile, json_encode($this->googleClient->getAccessToken()));
            }

            return ['data' => ['authenticated' => true], 'status' => 200];

        } catch (\Exception $error) {
            return ['data' => ['error_mesage' => $error->getMessage(), 'authenticated' => false], 'status' => 500];
        }
    }
}

<?php

namespace App\Http\Controllers;
use App\Services\GoogleDriveService;
use App\Http\Responses\ResponseMaker;

class GoogleDriveController extends Controller
{
    function __construct()
    {
        $this->googleDriveService = new GoogleDriveService();
    }

    /**
     * Receives feedback from google authentication
     * @return \Illuminate\Http\Response
    */
    public function callback()
    {
        $responseResult = $this->googleDriveService->config();
        return ResponseMaker::create($responseResult);
    }
}

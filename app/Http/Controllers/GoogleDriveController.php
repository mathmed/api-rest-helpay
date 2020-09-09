<?php

namespace App\Http\Controllers;
use App\Services\GoogleDriveService;
use Illuminate\Http\Request;
use App\Http\Responses\ResponseMaker;


class GoogleDriveController extends Controller
{
    function __construct()
    {
        $this->googleDriveService = new GoogleDriveService();
    }

    /**
     * Receives feedback from google authentication
     * @param Illuminate\Http\Request
     * @return \Illuminate\Http\Response
    */
    public function callback(Request $request)
    {
        $responseResult =  $this->googleDriveService->config($request->get('code'));
        return ResponseMaker::create($responseResult);
    }
}

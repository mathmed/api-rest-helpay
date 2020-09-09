<?php

namespace App\Http\Responses;

class ResponseMaker
{
    /**
     * Create and send a response
     * @return \Illuminate\Http\Response
    */
    public static function create($responseData){

        return response()
            ->json($responseData, $responseData['status'], [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                ->header('Content-Type', 'application/json');
    }
}

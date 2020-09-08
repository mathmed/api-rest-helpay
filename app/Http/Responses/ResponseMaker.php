<?php

namespace App\Http\Responses;

use Illuminate\Http\Response;

class ResponseMaker
{
    /**
     * Create and send a response
     * @return \Illuminate\Http\Response
    */
    public static function create($data){
        return (
            new Response(
                [
                    'data' => $data['data'],
                    'status' => $data['status']
                ], $data['status']))
        ->header('Content-Type', 'application/json');
    }
}
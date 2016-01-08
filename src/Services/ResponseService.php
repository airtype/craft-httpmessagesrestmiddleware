<?php

namespace HttpMessagesRestMiddleware\Services;

use HttpMessages\Http\Response;
use HttpMessagesRestMiddleware\Http\RestResponse;

class ResponseService
{
    /**
     * Get Response
     *
     * @return Response Response
     */
    public function getResponse(Response $response)
    {
        $response = new RestResponse($response);

        return $response;
    }

}

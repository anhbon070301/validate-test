<?php

namespace App\Supports;

use Symfony\Component\HttpFoundation\Response;

trait RespondResource
{
    public function respond(int $code = 0, string $message = '', $data = null, int $httpCode = Response::HTTP_OK, array $headers = [], int $options = 0)
    {
        $response = [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, $httpCode, $headers, $options);
    }

    public function handleRepond($data) {
        if(!empty($data)) {
            return $this->respond(0, "Success", $data, Response::HTTP_OK);
        } else {
            return $this->respond(1, "Fail", $data, Response::HTTP_EXPECTATION_FAILED);
        }
    }

    public function fail(string $message = "fail", int $httpCode = Response::HTTP_EXPECTATION_FAILED, array $headers = [], int $options = 0)
    {
        return $this->respond(1, $message, [], $httpCode, $headers, $options);
    }

}

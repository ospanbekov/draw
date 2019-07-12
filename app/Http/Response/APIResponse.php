<?php

namespace App\Http\Response;

use Illuminate\Http\Request;

class APIResponse
{
    /**
     * @param Request $request
     * @param array $data
     * @param string $app_code
     * @param int $http_code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success(Request $request, array $data = array(), $app_code = '0000', $http_code = 200)
    {
        return response()
            ->json(array_merge([
                'status' => 'success',
                'status_code' => (int)$app_code
            ], $data), $http_code);
    }

    /**
     * @param Request $request
     * @param array $errors
     * @param string $app_code
     * @param int $http_code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error(Request $request, array $errors = array(), $app_code = '0000', $http_code = 400)
    {
        return response()
            ->json([
                'status' => 'error',
                'status_code' => (int)$app_code,
                'errors' => $errors
            ], $http_code);
    }
}

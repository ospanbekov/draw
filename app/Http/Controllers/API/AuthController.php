<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models;
use App\Http\States;
use App\Http\Response\APIResponse;

use App\Exceptions as AppException;

use Hash;
use Validator;

class AuthController extends BaseController
{
    /**
     * Auth method
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function auth(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:6|max:20'
            ]);

            if ($validator->fails()) {
                throw new AppException\ValidatorException($validator);
            }

            /* get user by phone number */
            $user = Models\User::where(
                $request->only('email')
            )->firstOrFail();

            /* check password */
            if (!Hash::check($request->input('password'), $user->password)) {
                return APIResponse::error($request, [
                    'exception' => States\Authenticate::WRONG_PASSWORD_TEXT
                ], States\Authenticate::WRONG_PASSWORD_CODE);
            }

            /* */
            $token = Models\AccessToken::factory($user, NULL);

            return APIResponse::success($request, [
                'user' => $user,
                'access_token' => $token->access_token
            ]);
        } catch (AppException\ValidatorException $e) {
            return APIResponse::error($request, $e->getValidator()->errors()->messages(), States\Validation::VALIDATION_ERROR_CODE);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return APIResponse::error($request, ['exception' => States\Authenticate::USER_NOT_FOUND_TEXT], States\Authenticate::USER_NOT_FOUND_CODE);
        }
    }

    /**
     * Destroy token
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                throw new AppException\UserNotAuthorizedException();
            }

            $user->token->delete();

            return APIResponse::success($request);
        } catch (AppException\UserNotAuthorizedException $e) {
            return APIResponse::error($request, ['exception' => States\Authenticate::NOT_AUTHENTICATED_TEXT], States\Authenticate::NOT_AUTHENTICATED_CODE);
        }
    }
}

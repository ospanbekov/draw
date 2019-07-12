<?php

namespace App\Http\Controllers\API;

use App\Exceptions as AppException;

class AuthController extends BaseController
{
    /**
     * Auth method
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function auth(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:6|max:20'
            ]);
             if ($validator->fails()) {
                 throw new ValidatorException($validator);
             }

            /* get user by phone number */
            $user = Model\User::where(
                $request->only('phone', 'email')
            )->firstOrFail();
             /* check status client */
            if ($user->status === Enum\UserStatus::ENEW) {
                return APIResponse::error($request, [
                    'exception' => States\Authenticate::USER_IS_DISABLED_TEXT
                ], States\Authenticate::USER_IS_DISABLED_CODE);
            }
             /* check password */
            if (!Hash::check($request->input('password'), $user->password)) {
                return APIResponse::error($request, [
                    'exception' => States\Authenticate::WRONG_PASSWORD_TEXT
                ], States\Authenticate::WRONG_PASSWORD_CODE);
            }
             /* */
            $token = Model\AccessToken::factory($user, NULL);
             return APIResponse::success($request, [
                 'user' => $user,
                 'access_token' => $token->access_token
             ]);
        } catch (ValidatorException $e) {
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

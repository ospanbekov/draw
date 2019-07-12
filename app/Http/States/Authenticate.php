<?php

namespace App\Http\States;

class Authenticate
{
    const WRONG_PASSWORD_CODE = '0101';
    const WRONG_PASSWORD_TEXT = 'Wrong password';

    const NOT_AUTHENTICATED_CODE = '0102';
    const NOT_AUTHENTICATED_TEXT = 'Not authenticated';

    const USER_NOT_FOUND_CODE = '0103';
    const USER_NOT_FOUND_TEXT = 'User not found or wrong password';

    const ALREADY_AUTHENTICATE_CODE = '0104';
    const ALREADY_AUTHENTICATE_TEXT = 'Already authenticated';

    const USER_IS_DISABLED_CODE = '0105';
    const USER_IS_DISABLED_TEXT = 'Client is disabled / not activated.';

    const PHONE_NUMBER_EXISTS_CODE = '0106';
    const PHONE_NUMBER_EXISTS_TEXT = 'Phone number exists';

    const SUCCESSFUL_AUTHENTICATE_CODE = '0001';
    const SUCCESSFUL_AUTHENTICATE_TEXT = 'Success authenticate';

    const SUCCESSFUL_REGISTERED_CODE = '0002';
    const SUCCESSFUL_REGISTERED_TEXT = 'Register success';
}

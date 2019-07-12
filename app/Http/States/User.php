<?php

namespace App\Http\States;

final class User
{
    const USER_ALREADY_EXISTS_CODE = 1101;
    const USER_ALREADY_EXISTS_TEXT = 'User with current number already exists';

    const USER_NOT_EXISTS_CODE = 1102;
    const USER_NOT_EXISTS_TEXT = 'User not exists';

    const PASSWORD_SUCCESSFUL_CHANGED_CODE = 6001;
}

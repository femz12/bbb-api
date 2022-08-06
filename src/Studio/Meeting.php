<?php

namespace DavidO\BBBApi;

use Illuminate\Support\Facades\Facade;

class Meeting extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'bigbluebutton_meeting';
    }
}

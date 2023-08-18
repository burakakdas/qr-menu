<?php

namespace App\Helpers;

class FrontEndUrlHelper
{
    public static function generateUrl(string $route): string
    {
        return sprintf('%s/%s', config('app.frontend_url'), $route);
    }
}

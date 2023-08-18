<?php

namespace App\Http\Controllers;

use App\Http\Resources\SupportedLocaleCollection;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LocalizationController extends Controller
{
    public function index(): SupportedLocaleCollection
    {
        return new SupportedLocaleCollection(LaravelLocalization::getSupportedLocales());
    }
}

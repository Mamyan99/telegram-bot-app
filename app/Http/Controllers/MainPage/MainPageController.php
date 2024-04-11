<?php

namespace App\Http\Controllers\MainPage;

use App\Http\Controllers\Controller;
use App\Services\TelegramMessages\TelegramMessagesService;
use Illuminate\View\View;

class MainPageController extends Controller
{
    public function index(TelegramMessagesService $service): View
    {
        $data = $service->index();

        return view('welcome', compact('data'));
    }
}
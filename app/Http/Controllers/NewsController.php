<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $data = [
            'header_title' => 'Tin tức',
        ];
        return view('frontend.components.news', $data);
    }

    public function news_detail($id)
    {
        $data = [
            'header_title' => 'Tin tức',
        ];
        return view('frontend.components.news_detail', $data);
    } 
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        return response()->view('sitemap.index')->header('Content-Type', 'text/xml');
    }

    public function show()
    {
        return response()->view('sitemap.pages')->header('Content-Type', 'text/xml');
    }
}

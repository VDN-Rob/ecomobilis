<?php

namespace App\Http\Controllers\Web;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function page($slug)
    {
        $data['page'] = Page::where('slug', $slug)->first();

        if ($data['page']) {
            return view('web.pages.page', $data);
        } else {
            return redirect('/');
        }
    }

    public function aboutUs()
    {
        return view('about-us');
    }


}

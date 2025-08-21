<?php

namespace App\Http\Controllers\Web;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function index()
    {
        $data['page'] = Page::where('slug', 'homepage')->first();
        return view('home', $data);
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
        $data['page'] = Page::where('slug', 'about-us')->first();
        return view('about-us', $data);
    }


}

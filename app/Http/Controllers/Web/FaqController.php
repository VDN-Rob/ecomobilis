<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faq;

class FaqController extends Controller
{
    public function overview()
    {
        $data['faq'] = Faq::orderBy('category', 'asc')->get();
        return view('web.pages.faq', $data);
    }

}

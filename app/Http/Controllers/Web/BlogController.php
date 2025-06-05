<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
use Auth;
use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Slack;

class BlogController extends Controller
{

    public function overview()
    {
        $data['blogs'] = Blog::where('is_live', 1)->orderBy('created_at', 'desc')->get();
        return view('web.blog.overview', $data);
    }

    public function article($slug = '')
    {
        $data['blog'] = Blog::where('slug', $slug)->first();
        if ($data['blog']) {
            return view('web.blog.article', $data);
        } else {
            return redirect('/blog');
        }
    }



}

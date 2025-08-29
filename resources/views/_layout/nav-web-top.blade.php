<li class=" @if(Route::current()->getName() == 'web.faqOverview') active @endif">
    <a href="{{ url('/') }}/faq">{{ __('public-general.nav-faq-support') }}</a>
</li>
<li class=" @if(Route::current()->getName() == 'web.blogOverview') active @endif
    @if(Route::current()->getName() == 'web.blogDetail') active @endif ">
        <a href="{{ url('/') }}/blog">Blog</a>
</li>
@foreach(App\Models\Page::where('is_live', 1)->where('is_show_in_top_nav', 1)->get() as $page)
    <li class="@if(Request::segment(3) == $page->slug) active @endif ">
        <a href="{{ url('/') }}/page/{{ $page->slug }}">{{ $page->title }}</a>
    </li>
@endforeach
<li class=" @if(Route::current()->getName() == 'web.aboutUs') active @endif ">
    <a href="{{ url('/') }}/about-us">{{ __('public-general.nav-about-us') }}</a>
</li>
<li class=" @if(Route::current()->getName() == 'web.contact-us') active @endif ">
    <a href="{{ url('/') }}/page/contact-us">{{ __('public-general.nav-contact-us') }}</a>
</li>



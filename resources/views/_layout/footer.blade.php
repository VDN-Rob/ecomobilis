<footer class="site-footer" >
        <div class="grid stackable">

            <div class="col-desk-4 col-tab-3 general-info-footer-block">

                <h2 class="footer-accent">Ecomobilis</h2>
                Ecomobilis est un projet de la <a href="https://www.froidchapelle.be/" target="_blank">Commune de Froidchapelle</a><br>
                Place Albert 1er , 38 - 6440 Froidchapelle<br> en partenariat avec<br>
                <ul>
                    <li>
                        <a href="https://www.beaumont.be/" target="_blank">Commune de Beaumont</a>
                    </li>
                    <li>
                        <a href="https://www.chimayville.be/" target="_blank">Commune de Chimay</a>
                    </li>
                    <li>
                        <a href="https://www.couvin.be/" target="_blank">Commune de Couvin</a>
                    </li>
                    <li>
                        <a href="https://www.philippeville.be/" target="_blank">Commune de Philippeville</a>
                    </li>
                    <li>
                        <a href="https://www.viroinval.be/" target="_blank">Commune de Viroinval</a>
                    </li>
                </ul>
                <br>Avec le soutient de la Wallonie dans le cadre du programme Smart Region de Digital Wallonia<br>
                <img src="https://admin.ecomobilis.be/storage/soutien_wallonie.png">
                <img src="https://admin.ecomobilis.be/storage/dw_smartregion.png">

                <strong>{!!  __('footer.info-mail') !!}</strong>:  <a href="mailto:ecomobilis.be">info@ecomobilis.be</a><br>
                <br>
                {!!  __('footer.what-is-1') !!}<br>
                <br>
                {!!  __('footer.what-is-2') !!}<br>

            </div>

            <div class="col-desk-8 col-tab-3 more-info-footer-block">

                <div class="grid stackable">

                    <div class="col-desk-4 col-tab-3">
                        <h2 class="footer-accent">Sitemap</h2>
                        <ul>
                            <li>
                                <a href="{{ url('/') }}">{{ __('public-general.nav-home') }}</a>
                            </li>
                            <li class=" @if(Route::current()->getName() == 'web.carpooling') active @endif">
                                <a href="{{ url('/carpool') }}">{{ __('public-general.nav-carpooling') }}</a>
                            </li>
                            <li class=" @if(Route::current()->getName() == 'web.carpooling') active @endif">
                                <a href="{{ url('/sharing') }}">{{ __('public-general.nav-sharing') }}</a>
                            </li>
                            <li class=" @if(Route::current()->getName() == 'web.trafficOverview') active @endif">
                                <a href="{{ url('/traffic') }}">{{ __('public-general.nav-traffic') }}</a>
                            </li>
                            <li>
                                <a href="{{ url('/faq') }}" target="_blank" >{{ __('public-general.nav-faq-support') }}</a>
                            </li>
                            <li class=" @if(Route::current()->getName() == 'web.blogOverview') active @endif
                                @if(Route::current()->getName() == 'web.blogDetail') active @endif ">
                                <a href="{{ url('/') }}/blog">Blog</a>
                            </li>
                            <li class=" @if(Route::current()->getName() == 'web.aboutUs') active @endif ">
                                <a href="{{ url('/') }}/about-us">{{ __('public-general.nav-about-us') }}</a>
                            </li>
                            @foreach(App\Models\Page::where('is_live', 1)->where('is_show_in_footer_nav', 1)->get() as $page)
                                <li class="@if(Request::segment(3) == $page->slug) active @endif ">
                                    <a href="{{ url('/') }}/page/{{ $page->slug }}">{{ $page->title }}</a>
                                </li>
                            @endforeach
                            <li>
                                <a href="https://documenter.getpostman.com/view/12029054/2sB3HrnHiF#6039ffb3-d303-4833-b58c-43d088177f13" class="">Documentation de l'API</a>
                            </li>
                        </ul>
                        <br>
                        <ul>

                        </ul>
                    </div>
                    <div class="col-desk-8 col-tab-3">
                        <!--
                        <div id="mc_embed_signup">
                            <form
                                class="ui form grid validate"
                                method="POST"
                                action="#"
                            >
                                <div class="">
                                    <h2 class="footer-accent">{{ __('footer.subscribe') }}</h2>

                                    <div class="grid grid-with-row-margin email-form stackable" style="margin-bottom: 15px;">
                                        <div class="col-desk-3 col" style="">
                                            <input type="text" name="first_name" placeholder="Prénom" required >
                                        </div>
                                        <div class="col-desk-3 col"  style="">
                                            <input type="text" name="last_name" placeholder="Nom de famille" required >
                                        </div>
                                        <div class="col-desk-6 col">
                                            <input type="email" value="" name="email" class="required email"  placeholder="Email" required>
                                        </div>
                                    </div>
                                    <input type="hidden" name="tags" value="{{ Config::get('app.locale') }}" />
                                    <div class="clear ">
                                        <input type="submit" value="{{ __('footer.subscribe-btn') }}" name="subscribe" id="mc-embedded-subscribe"
                                               class="button big">
                                    </div>
                                </div>
                            </form>
                        </div>
                        -->
                        <h2 class="footer-accent">Apps</h2>
                        <div class="apps">
                            <a href="https://play.google.com/store/apps/details?id=com.davedriesmans.ecomobilis&hl=fr" target="_blank" style="display: inline-block"><img width="110" alt="Get it on Google Play" src="/images/icons/google-play-badge.png"></a>
                            <a href="https://apps.apple.com/be/app/ecomobilis/id6751275812" target="_blank" style="display: inline-block"><img width="100" src="/images/icons/Download_on_the_App_Store_Badge_US-UK_RGB_blk_092917.svg" alt="Download on the App Store"></a>
                        </div>

                            <!--
                        <h2 class="footer-accent">{{ __('footer.follow-us') }}</h2>

                        <a href="#" class="social">
                            <span class="screen-reader-text">Facebook</span>
                            <svg width="32" height="32" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.023 16L6 9H3V6h3V4c0-2.7 1.672-4 4.08-4 1.153 0 2.144.086 2.433.124v2.821h-1.67c-1.31 0-1.563.623-1.563 1.536V6H13l-1 3H9.28v7H6.023z" fill="#a5acb9"></path>
                            </svg>
                        </a>

                        <a href="#" class="social">
                            <span class="screen-reader-text">Bluesky</span>
                            <svg fill="none" viewBox="0 0 90 87" width="24" style="width: 24px; height: 22.5px; position: relative; top:-3px; left: -3px;"><path fill="#A5ACB9" d="M13.873 3.805C21.21 9.332 29.103 20.537 32 26.55v15.882c0-.338-.13.044-.41.867-1.512 4.456-7.418 21.847-20.923 7.944-7.111-7.32-3.819-14.64 9.125-16.85-7.405 1.264-15.73-.825-18.014-9.015C1.12 23.022 0 8.51 0 6.55 0-3.268 8.579-.182 13.873 3.805ZM50.127 3.805C42.79 9.332 34.897 20.537 32 26.55v15.882c0-.338.13.044.41.867 1.512 4.456 7.418 21.847 20.923 7.944 7.111-7.32 3.819-14.64-9.125-16.85 7.405 1.264 15.73-.825 18.014-9.015C62.88 23.022 64 8.51 64 6.55c0-9.818-8.578-6.732-13.873-2.745Z"></path></svg>
                        </a>

                        <a href="#" class="social" style="position: relative; top: -2px;">
                            <span class="screen-reader-text">Linkedin</span>
                            <svg width="32" height="32" xmlns="http://www.w3.org/2000/svg">
                                <path fill="#A5ACB9" d="M8,18H5V7h3V18z M6.5,5.7c-1,0-1.8-0.8-1.8-1.8s0.8-1.8,1.8-1.8S8.2,3,8.2,4S7.5,5.7,6.5,5.7z M20,18h-3v-5.6
            c0-3.4-4-3.1-4,0V18h-3V7h3v1.8c1.4-2.6,7-2.8,7,2.5V18z"/>
                            </svg>
                        </a>
                        -->
                    </div>

                </div> <!-- end grid grid -->
            </div> <!-- end  more-info-footer-block -->



        </div>


</footer>

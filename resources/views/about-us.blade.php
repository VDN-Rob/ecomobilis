@extends('_layout.app')
@section('content')

    <!-- top block with first paragraph -->
    <div class="block">
        <div class="grid">
            <div class="col-desk-12 ">
                <h1>About us</h1>
            </div>
        </div> <!--  grid -->
    </div>



    <div class="block">
        <div class="grid grid-with-row-margin stackable center-vertical-and-horizontal">

            <div class="col-mob-4 show-on-mobile-only text-center">
                <img src="{{ url('/') }}/images/photos/egor-myznik-5fuL1om_sc8-unsplash.jpg" class="size-70 rounded" style="margin-top:10px; margin-left: 15%;">
            </div>
            <div class="col-desk-6 col-mob-4">
                <div class="center-next-to-photo">
                    <h2>
                        Lorem ipsum dolor sit amet?
                    </h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                        reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt
                        in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <br>
                    <a href="#">Exercitation ullamco laboris nisi ut aliquip</a></p>
                </div>
            </div>
            <div class="col-desk-6 col-mob-4 show-on-desktop-only">
                <img src="{{ url('/') }}/images/photos/egor-myznik-5fuL1om_sc8-unsplash.jpg" class="size-70 rounded" style="margin-top:10px; margin-left: 15%;">
            </div>

            <div class="col-desk-5 col-mob-4">
                <div class="col-mob-4 show-on-desktop-only">
                    <img src="{{ url('/') }}/images/photos/lee-soo-hyun-x_Mff1nyIU0-unsplash.jpg" class="rounded">
                </div>
                <div class="show-on-mobile-only text-center">
                    <img src="{{ url('/') }}/images/photos/lee-soo-hyun-x_Mff1nyIU0-unsplash.jpg" class="size-70 rounded" style="margin-top:10px; margin-left: 15%;">
                </div>
            </div>
            <div class="col-desk-6 col-mob-4">
                <div class="center-next-to-photo">
                    <h2>
                        Sed do eiusmod tempor incididunt?
                    </h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                        reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt
                        in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>

            <div class="col-desk-6 col-desk-shift-1 col-mob-shift-0">
                <div class="col-mob-4 show-on-mobile-only text-center">
                    <img src="{{ url('/') }}/images/photos/yun-cho-eE4pjuqEPhk-unsplash.jpg" class="size-70 rounded" style="margin-top:10px; margin-left: 15%;">
                </div>
                <h2>
                    Voluptatem accusantium doloremque laudantium?
                </h2>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?</p>
                <p>Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?".</p>

                <p>Laboris nisi ut aliquip ex ea commodo consequat <a href="network">voluptate velit esse quam nihil molestiae</a>.</p>
            </div>
            <div class="col-desk-5 col-mob-4 show-on-desktop-only">
                <img src="{{ url('/') }}/images/photos//yun-cho-eE4pjuqEPhk-unsplash.jpg" class="size-90 rounded" style="margin-top:10px;">
            </div>


        </div> <!-- end grid -->
    </div> <!-- end block -->

@endsection

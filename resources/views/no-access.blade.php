@extends('_layout.app')
@section('content')

    <!-- top block with first paragraph -->
    <div class="block">
        <div class="grid">
            <div class="col-desk-12 ">
                <h1>{{ __('general.no-access-title') }}</h1>
            </div>
        </div> <!--  grid -->
    </div>

    <div class="block">
        <div class="grid grid-with-row-margin stackable center-vertical-and-horizontal">

            <div class="col-mob-4 show-on-mobile-only text-center">
                <img src="https://telraam.net/images/s2/S2-shot-02.jpg" class="size-70" style="margin-top:10px; margin-left: 15%;">
            </div>
            <div class="col-desk-6 col-mob-4">
                <div class="center-next-to-photo">
                    <h2>
                        Hoe werkt onze verkeersteller?
                    </h2>
                    <p>Telraam S2 is ons nieuwste toestel. Het telt en classificeert weggebruikers en levert anonieme, geaggregeerde gegevens
                        per verkeersmodus en per richting met een resolutie van
                        15 minuten. Daarnaast leidt het een geschatte snelheidsverdeling af (en de V85-snelheid) voor auto's.<br>
                        <br>
                        Telraam S2 maakt gebruik van een speciaal getrainde AI en een eigen volgalgoritme om weggebruikers met hoge precisie te detecteren, classificeren en
                        tellen in een breed scala van typische straatomgevingen.
                        Burgers plaatsen een Telraam-sensor op hun raam, waarna de verzamelde gegevens onmiddellijk als Open Data worden gedeeld met lokale
                        autoriteiten en beleidsmakers.<br>
                        <br>
                        Burgers kunnen op eigen intiatief een Telraam toestel in hun eigen straat installeren. Een andere optie is dat lokale actiegroepen en
                        overheidsinstanties burgernetwerken financieren om lokale verkeersgegevens te verzamelen.<br>
                        <br>
                        <a href="/nl/S2">Lees meer over de S2</a></p>
                </div>
            </div>
            <div class="col-desk-6 col-mob-4 show-on-desktop-only">
                <img src="https://telraam.net/images/s2/S2-shot-02.jpg">
            </div>
            <div class="col-desk-5 col-mob-4">
                <div class="col-mob-4 show-on-desktop-only">
                    <img src="https://telraam.net/images/common/dashboard-data-snippets.png">
                </div>
                <div class="show-on-mobile-only text-center">
                    <img src="https://telraam.net/images/common/dashboard-data-snippets.png" class="size-70" style="margin-top:10px; margin-left: 15%;">
                </div>
            </div>
            <div class="col-desk-6 col-mob-4">
                <div class="center-next-to-photo">
                    <h2>
                        Wat doet een Telraam S2 toestel?
                    </h2>
                    <p>Je hangt het toestel omhoog op het juiste raam en eenmaal het geïnstalleerd is, hoef je niets meer te doen.
                        Je kan de tellingen van het afgelopen kwartier, uur en dag op het Telraam zelf bekijken of op de website de data van de hele telperiode raadplegen en analyseren.<br>
                        <br>
                        De Telraam S2 heeft een lage resolutie camera (omwille van privacyredenen), een AI-chip voor het detecteren en categoriseren van straatgebruikers en
                        een ingebouwde mobiele dataverbinding die geaggregeerde, anonieme data doorstuurt naar de Telraam-servers.
                        Het toestel hoeft alleen maar van stroom te worden voorzien en aan de binnenkant van een raam te worden geplaatst op
                        een minimumhoogte van 3 meter, met vrij uitzicht over de straat.</p>
                </div>
            </div>

            <div class="col-desk-6 col-desk-shift-1 col-mob-shift-0">
                <div class="col-mob-4 show-on-mobile-only text-center">
                    <img src="https://telraam.net/images/illustrations/illustratie-home-girl-on-bike.jpg" class="size-70" style="margin-top:10px; margin-left: 15%;">
                </div>
                <h2>
                    Hoe start ik met Telraam in mijn buurt?
                </h2>
                <p></p><p>Je kunt ervoor kiezen om individueel aan de slag te gaan en je eigen straat te meten aan de hand van een Telraam toestel.
                    Of je kan ook samenwerken met een lokale overheid of actiegroep om een breder netwerk voor een hele groep straten op te zetten.</p>
                <p>Telraam levert de tools zodat gemotiveerde individuen hun eigen straat kunnen monitoren, maar ook kunnen samenwerken in een netwerk om met de hele buurt samen te werken.</p>

                <p>Lees alles over ons <a href="network">Netwerkabonnement en -tools</a> en ontdek hoe je zelf een kan opzetten.</p><p></p>
            </div>
            <div class="col-desk-5 col-mob-4 show-on-desktop-only">
                <img src="https://telraam.net/images/illustrations/illustratie-home-girl-on-bike.jpg" class="size-90" style="margin-top:10px;">
            </div>


        </div> <!-- end grid -->
    </div>
@endsection

<div class="auto-col-dep @if($layout == 'search') col-desk-4 col-mob-2 col-desk-search-dep-arr @else col-desk-6 col-mob-2 @endif">
    <div class="tiny light-grey" style="position: absolute; margin-top: -20px;">Départ *</div>
    <div class="field special-placeholder">
        <input id="autoCompleteDep" type="search" name="departure"  dir="ltr" spellcheck=false autocorrect="off" autocomplete="off" autocapitalize="off"
               @isset($departureIsFromGroup) @if($departureIsFromGroup == 1) disabled @endif @endisset
            @if(isset($ride->departure))
               value="{{ $ride->departure->street }}, {{ $ride->departure->city }}"
            @elseif(isset($searchDepValue))
               value="@isset($departureIsFromGroup) @if($departureIsFromGroup == 1) {{ $group->title }} - @endif @endisset{{ $searchDepValue }}"
            @else
               value=""
            @endif
            >
        @if($errors->has('DepJson'))
            <div class="error tiny red">{{ __('carpool.error-select-street') }}</div>
        @endif
        <input id="DepJson" name="DepJson" type="hidden"
               @if(isset($ride->departure))
                    value="{{ json_encode(['place_id' => $ride->departure->external_api_id]) }}"
               @elseif(isset($searchDepJson))
                    value="{{ $searchDepJson }}"
               @else
                    value=""
               @endif
         >
    </div>
</div>

<div class="auto-col-arr @if($layout == 'search') col-desk-4 col-mob-2 col-desk-search-dep-arr @else col-desk-6 col-mob-2 @endif">
    <div class="js-swap-dep-arr autocomplete-swap-dep-arr">	&#10231;</div>
    <div class="tiny light-grey" style="position: absolute; margin-top: -20px;">Arrivée </div>
    <div class="field special-placeholder">
        <input id="autoCompleteArr" type="search" name="arrival"  dir="ltr" spellcheck=false autocorrect="off" autocomplete="off" autocapitalize="off"
               @isset($arrivalIsFromGroup) @if($arrivalIsFromGroup == 1) disabled @endif @endisset
               @if(isset($ride->arrival))
                    value="{{ $ride->arrival->street }}, {{ $ride->arrival->city }}"
               @elseif(isset($searchArrValue))
                    value="@isset($arrivalIsFromGroup) @if($arrivalIsFromGroup == 1) {{ $group->title }} - @endif @endisset{{ $searchArrValue }}"
               @else
                   value=""
               @endif
        >
        @if($errors->has('ArrJson'))
            <div class="error tiny red">{{ __('carpool.error-select-street') }}</div>
        @endif
        <input id="ArrJson" name="ArrJson" type="hidden"
               @if(isset($ride->arrival))
                    value="{{ json_encode(['place_id' => $ride->arrival->external_api_id]) }}"
               @elseif(isset($searchArrJson))
                    value="{{ $searchArrJson }}"
               @else
                    value=""
               @endif >
    </div>
</div>


<script>

    var baseUrl = '{{ url('/') }}';
    @guest
        var pricePerKm = false;
    @else
        var pricePerKm = {{ Auth::user()->car->price_per_km_per_seat }};
    @endguest

    var DepValues = false;
    var ArrValues = false;

    $('.js-swap-dep-arr').click(function() {

        if($('#autoCompleteDep').is(':disabled')){
            $('#autoCompleteDep').removeAttr('disabled');
            $('#autoCompleteArr').attr('disabled', true);
        } else if($('#autoCompleteArr').is(':disabled')){
            $('#autoCompleteArr').removeAttr('disabled');
            $('#autoCompleteDep').attr('disabled', true);
        }

        DepVal =  $('#autoCompleteDep').val();
        ArrVal =  $('#autoCompleteArr').val();
        $('#autoCompleteDep').val(ArrVal);
        $('#autoCompleteArr').val(DepVal);

        DepJson =  $('#DepJson').val();
        ArrJson =  $('#ArrJson').val();
        $('#DepJson').val(ArrJson);
        $('#ArrJson').val(DepJson);


    });


    function computeDistance()
    {
        console.log(DepValues);
        console.log(ArrValues);
        lat1 = DepValues.lat;
        lon1 = DepValues.lon;
        lat2 = ArrValues.lat;
        lon2 = ArrValues.lon;

        if(lat1 && lat2) {
            const R = 6371; // Earth's radius in kilometers
            const toRadians = (degrees) => degrees * (Math.PI / 180);

            const dLat = toRadians(lat2 - lat1);
            const dLon = toRadians(lon2 - lon1);

            const a =
                Math.sin(dLat / 2) ** 2 +
                Math.cos(toRadians(lat1)) * Math.cos(toRadians(lat2)) *
                Math.sin(dLon / 2) ** 2;

            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

            distance = R * c; // Distance in kilometers
            priceSuggested  = distance*pricePerKm + (distance*pricePerKm)*0.20;

            $('.js-distance-container').show();
            $('.js-distance').html(distance.toFixed(2) +' km');
            $('#price_per_seat').val(priceSuggested.toFixed(0)+'.00');
        }

    }


    // baseurl/api/street/autocomplete/search
    // Docs: https://tarekraafat.github.io/autoComplete.js/
    configDep = {
        selector: "#autoCompleteDep",
        placeHolder: "Recherche d'une rue",
        data: {
            src: async (query) => {
                try {
                    // Loading placeholder text
                    document
                        .getElementById("autoCompleteDep")
                        .setAttribute("placeholder", "Loading...");
                    // Fetch External Data Source
                    const source = await fetch(
                        baseUrl+"/api/street/autocomplete/"+query,
                    );
                    const data = await source.json();
                    // Post Loading placeholder text
                    document
                        .getElementById("autoCompleteDep")
                        .setAttribute("placeholder", autoCompleteJSDep.placeHolder);
                    // Returns Fetched data
                    return data;
                } catch (error) {
                    console.log(error);
                    return error;
                }
            },
            keys: ["display_name"],
            cache: false,
            filter: (list) => {
                // Filter duplicates
                // incase of multiple data keys usage
                const filteredResults = Array.from(
                    new Set(list.map((value) => value.match))
                ).map((display_name) => {
                    return list.find((value) => value.match === display_name);
                });

                return filteredResults;
            }
        },
        resultItem: {
            highlight: true
        },
        searchEngine: "loose",
        threshold: 4,
        debounce: 1000, // Milliseconds value
        resultsList: {
            element: (list, data) => {
                if (!data.results.length) {
                    // Create "No Results" message list element
                    const message = document.createElement("div");
                    message.setAttribute("class", "no_result");
                    // Add message text content
                    message.innerHTML = `<span>Aucun résultat pour "${data.query}"</span>`;
                    // Add message list element to the list
                    list.appendChild(message);
                }
            },
            noResults: true,
        },
        events: {
            input: {
                selection: (event) => {
                    // selection
                    place = event.detail.selection.value.display_place;
                    city = '';
                    if(typeof event.detail.selection.value.address.city !== "undefined") {
                        city = event.detail.selection.value.address.city;
                    } else if(typeof event.detail.selection.value.address.state !== "undefined") {
                        city = event.detail.selection.value.address.state;
                    }
                    const selection = place + ', ' + city;
                    // another hidden field to store the full json
                    DepValues = event.detail.selection.value;
                    document.getElementById('DepJson').value = JSON.stringify(event.detail.selection.value);
                    autoCompleteJSDep.input.value = selection;
                    computeDistance();
                }
            }
        }
    };
    configArr = {
        selector: "#autoCompleteArr",
        placeHolder: "Recherche d'une rue",
        data: {
            src: async (query) => {
                try {
                    // Loading placeholder text
                    document
                        .getElementById("autoCompleteArr")
                        .setAttribute("placeholder", "Loading...");
                    // Fetch External Data Source
                    const source = await fetch(
                        baseUrl+"/api/street/autocomplete/"+query,
                    );
                    const data = await source.json();
                    // Post Loading placeholder text
                    document
                        .getElementById("autoCompleteArr")
                        .setAttribute("placeholder", autoCompleteJSArr.placeHolder);
                    // Returns Fetched data
                    return data;
                } catch (error) {
                    return error;
                }
            },
            keys: ["display_name"],
            cache: false,
            filter: (list) => {
                // Filter duplicates
                // incase of multiple data keys usage
                const filteredResults = Array.from(
                    new Set(list.map((value) => value.match))
                ).map((display_name) => {
                    return list.find((value) => value.match === display_name);
                });

                return filteredResults;
            }
        },
        resultItem: {
            highlight: true
        },
        searchEngine: "loose",
        threshold: 4,
        debounce: 1000, // Milliseconds value
        resultsList: {
            element: (list, data) => {
                if (!data.results.length) {
                    // Create "No Results" message list element
                    const message = document.createElement("div");
                    message.setAttribute("class", "no_result");
                    // Add message text content
                    message.innerHTML = `<span>Aucun résultat pour "${data.query}"</span>`;
                    // Add message list element to the list
                    list.appendChild(message);
                }
            },
            noResults: true,
        },
        events: {
            input: {
                selection: (event) => {
                    // selection
                    place = event.detail.selection.value.display_place;
                    city = '';
                    if(typeof event.detail.selection.value.address.city !== "undefined") {
                        city = event.detail.selection.value.address.city;
                    } else if(typeof event.detail.selection.value.address.state !== "undefined") {
                        city = event.detail.selection.value.address.state;
                    }
                    const selection = place + ', ' + city;
                    // another hidden field to store the full json
                    ArrValues = event.detail.selection.value;
                    document.getElementById('ArrJson').value = JSON.stringify(event.detail.selection.value);
                    autoCompleteJSArr.input.value = selection;
                    computeDistance();
                }
            }
        }
    };

    const autoCompleteJSDep = new autoComplete(configDep);
    const autoCompleteJSArr = new autoComplete(configArr);


</script>

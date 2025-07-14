<div class="col-desk-12">
    <div class="field special-placeholder">
        <label>{{ __('carpool.group-title') }}</label>
        <input id="title" type="text" class="{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"  placeholder="title"
            @if(isset($group))
                value="{{ $group->title }}"
            @else
               value=""
            @endif
         required>
    </div>
</div>

<div class="col-desk-12">
    <div class="field special-placeholder">
        <label>{{ __('carpool.group-description') }}</label>
        <textarea id="description" name="description" rows="4">@if(isset($group)){{ $group->description }}@endif</textarea>
    </div>
</div>

<div class="col-desk-12">
    <div class="tiny light-grey" style="position: absolute; margin-top: -20px;">{{ __('carpool.location') }} </div>
    <div class="field special-placeholder">
        <input id="autoCompleteLocation" type="search" name="location"  dir="ltr" spellcheck=false autocorrect="off" autocomplete="off" autocapitalize="off"
               @if(isset($group->location))
               value="{{ $group->location->street }}, {{ $group->location->city }}"
               @elseif(isset($searchLocationValue))
               value="{{ $searchLocationValue }}"
               @else
               value=""
            @endif
        >
        @if($errors->has('LocationJson'))
            <div class="error tiny red">{{ __('carpool.error-select-street') }}</div>
        @endif
        <input id="LocationJson" name="LocationJson" type="hidden"
               @if(isset($group->location))
               value="{{ json_encode(['place_id' => $group->location->external_api_id]) }}"
               @elseif(isset($searchLocationJson))
               value="{{ $searchLocationJson }}"
               @else
               value=""
            @endif
        >
    </div>
</div>

<!--
<div class="col-desk-6">
    <label class="normal">
        {{ Form::checkbox('authentication', null, (isset($group?->does_need_authentication)) ? $group?->does_need_authentication : 0, ['id'=>'authentication']) }}
        {!! __('carpool.user-must-be-logged-in') !!}
    </label>
</div>
-->

<div class="col-desk-6">
    <label class="normal">
        {{ Form::checkbox('private', null, (isset($group?->rides_are_private)) ? $group?->rides_are_private : 0, ['id'=>'private']) }}
        {!! __('carpool.rides-are-private') !!}
    </label>
</div>


<script>


    var baseUrl = '{{ url('/') }}';

    // baseUrl/api/street/autocomplete/search
    // Docs: https://tarekraafat.github.io/autoComplete.js/
    configLocation = {
        selector: "#autoCompleteLocation",
        placeHolder: "Recherche d'une rue",
        data: {
            src: async (query) => {
                try {
                    // Loading placeholder text
                    document
                        .getElementById("autoCompleteLocation")
                        .setAttribute("placeholder", "Loading...");
                    // Fetch External Data Source
                    const source = await fetch(
                        baseUrl+"/api/street/autocomplete/"+query,
                    );
                    const data = await source.json();
                    // Post Loading placeholder text
                    document
                        .getElementById("autoCompleteLocation")
                        .setAttribute("placeholder", autoCompleteJSLocation.placeHolder);
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
                    document.getElementById('LocationJson').value = JSON.stringify(event.detail.selection.value);
                    autoCompleteJSLocation.input.value = selection;
                }
            }
        }
    };

    const autoCompleteJSLocation = new autoComplete(configLocation);

</script>

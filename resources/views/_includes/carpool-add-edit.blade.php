
<div class="grid grid-with-row-margin stackable">
    <!--  dep and arrival autocomplete -->
    <div class="col-desk-12">

    </div>
    @include('_includes.carpool-dep-arr-autocomplete', ['layout' => 'add-edit'])

    <div class="col-desk-6">
        <div class="tiny light-grey" style="position: absolute; margin-top: -20px;">{{ __('carpool.date') }}</div>
        <div class="field special-placeholder">
            <input type="datetime-local" id="travel_start_datetime" name="travel_start_datetime"
                   @if(isset($ride))
                    value="{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ride->travel_start_datetime)->format('Y-m-d H:i') }}"
                   @else
                    value="{{ Carbon\Carbon::tomorrow()->format('Y-m-d h:00') }}"
                   @endif
            />
        </div>
    </div>
    <div class="col-desk-6">
        <div class="tiny light-grey" style="position: absolute; margin-top: -20px;">{{ __('carpool.seats_available') }}</div>
        <div class="field special-placeholder">
            <input type="text" id="seats_available" name="seats_available"
                @if(isset($ride))
                        value="{{ $ride->seats_available }}"
                @elseif(isset(Auth::user()->car))
                        value="{{ Auth::user()->car->default_seats_available }}"
                @else
                    value="2"
                @endif
            />
        </div>
    </div>

    <div class="col-desk-12">
        <h4>{{ __('carpool.details-title') }}</h4>
    </div>
    <div class="col-desk-6">
        <div class="tiny light-grey" style="position: absolute; margin-top: -20px;">{{ __('carpool.luggage') }}</div>
        <select name="luggage_id" class="dropdown" >
            @foreach($luggages as $luggage)
                <option value="{{ $luggage->id }}"
                     @if(isset($ride))
                        @if($ride->luggage_id == $luggage->id) selected @endif
                    @elseif(isset(Auth::user()->car))
                        @if(Auth::user()->car->default_luggage_id == $luggage->id) selected @endif
                    @endif
                >{{ $luggage->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-desk-6">
        <div class="tiny light-grey" style="position: absolute; margin-top: -20px;">{{ __('carpool.price') }}</div>
        <div class="field special-placeholder">
            <input type="text" id="price_per_seat" name="price_per_seat"
                @if(isset($ride))
                    value="{{ $ride->price_per_seat }}"
                @else
                   value="10.00"
                @endif/>
        </div>
    </div>

    <div class="col-desk-6">
        <div class="tiny light-grey" style="position: absolute; margin-top: -20px;">Remark</div>
        <div class="field special-placeholder">
            <input type="text" id="remark" name="remark"
                 @if(isset($ride))
                    value="{{ $ride->remark }}"
                 @else
                    value=""
                @endif/>
        </div>
    </div>

    <input type="hidden" id="group_id" name="group_id"
           @if(isset($group_id))
                value="{{ $group_id }}"
           @elseif(isset($ride))
                value="{{ $ride->group_id }}"
           @else
                value=""
           @endif
    >

    <div class="col-desk-12 col-mob-4 text-center">
        <input class="button big" name="submit" type="submit" @if(isset($ride)) value="{{ __('general.edit') }}"  @else  value="{{ __('general.add') }}" @endif style="width:250px">
    </div>

</div>

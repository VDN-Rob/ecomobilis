<div>
    <div class="block">
        <div class="col-desk-6 ">
            <div class="field special-placeholder">
                <select wire:model.live="typeFilter" id="typeFilter">
                    <option value="all" >{{ __('sharing.all') }}</option>
                    <option value="car" >{{ __('sharing.car') }}</option>
                    <option value="ecar">{{ __('sharing.ecar') }}</option>
                    <option value="bike">{{ __('sharing.bike') }}</option>
                    <option value="ebike">{{ __('sharing.ebike') }}</option>
                    <option value="cargobike">{{ __('sharing.cargobike') }}</option>
                    <option value="ecargobike">{{ __('sharing.ecargobike') }}</option>
                    <option value="step">{{ __('sharing.step') }}</option>
                </select>
            </div>
        </div>
    </div>

    <div class="block">
        @if(count($orgs) > 0)
            <div class="grid">
                @foreach($orgs as $org)
                    <div class="col-desk-4 text-left">
                        <h3>{{ $org->name }}</h3>
                        <div class="short-description">{{ $org->short_description }}</div> <br>
                        @if($org->website) <div class="website"><a href="{{ $org->website }}" target="_blank">{{ $org->website }}</a></div>    <br>@endif
                        <div class="filters">
                            @if($org->prop_vehicle_car) <span class="tiny label">{{ __('sharing.car') }}</span> @endif
                            @if($org->prop_vehicle_ecar) <span class="tiny label">{{ __('sharing.ecar') }}</span> @endif
                            @if($org->prop_vehicle_bike) <span class="tiny label">{{ __('sharing.bike') }}</span> @endif
                            @if($org->prop_vehicle_ebike) <span class="tiny label">{{ __('sharing.ebike') }}</span> @endif
                            @if($org->prop_vehicle_cargobike) <span class="tiny label">{{ __('sharing.cargobike') }}</span>@endif
                            @if($org->prop_vehicle_ecargobike) <span class="tiny label">{{ __('sharing.ecargobike') }}</span>@endif
                            @if($org->prop_vehicle_step) <span class="tiny label">{{ __('sharing.step') }}</span>@endif
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <div class="grid">
                <div class="col-desk-12 text-center">
                    <div class="nothing-found">{{ __('sharing.no-org-found') }}</div>
                </div>
            </div>
        @endif
    </div>
</div>

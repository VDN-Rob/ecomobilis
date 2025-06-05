<div class="block" style="padding-bottom: 0; margin-bottom: 0">
    <div class="page-sub-nav" style="">
        <ul>
            <li @class(['active' => request()->is('admin')])>
                <a href="{{ route('admin.carpoolOverview', []) }}">
                    <span class="show-on-desktop-only">{{ __('carpool.my-rides') }}</span>
                    <span class="show-on-mobile-only">{{ __('carpool.mobile-my-rides') }}</span>
                </a>
            </li>
            <li @class(['active' => request()->is('admin/carpool-as-passenger')])>
                <a href="{{ route('admin.carpoolOverviewAsPassenger', []) }}">
                    <span class="show-on-desktop-only">{{ __('carpool.my-rides-as-passenger') }}</span>
                    <span class="show-on-mobile-only">{{ __('carpool.mobile-my-rides-as-passenger') }}</span>
                </a>
            </li>
            <li @class(['active' => request()->is('admin/carpool-groups')])>
                <a href="{{ route('admin.carpoolGroupsOverview', []) }}">
                    <span class="show-on-desktop-only">{{ __('carpool.my-groups') }}</span>
                    <span class="show-on-mobile-only">{{ __('carpool.mobile-my-groups') }}</span>
                </a>
            </li>
            <li @class(['active' => request()->is('admin/carpool-messages/*')])>
                <a href="{{ route('admin.carpoolMessagesSender', [
                        'rideId'                => $currentCarRideId,
                        'conversationPartnerId' => $currentPartnerUserId
                    ]) }}">
                    <span class="show-on-desktop-only">{{ __('carpool.my-messages') }}</span>
                    <span class="show-on-mobile-only">{{ __('carpool.mobile-my-messages') }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>

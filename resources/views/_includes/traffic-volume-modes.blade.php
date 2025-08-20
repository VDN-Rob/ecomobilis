<div class="grid dashboard-numbers" id="graph-totalnumbers">
    <div class="col-desk-12 text-center">
        <h2>{{ __('traffic.title-average') }}</h2>
        <h4>{{ __('traffic.title-average-info') }} ({{ $lastHour->time_local }})</h4>
    </div>
    <div class="col-desk-3">
        <div class="box light-grey-bg">
            <div class="number-container">
                <div class="dashboard-number dashboard-number-only-one">
                    <div class="orange subtitle"><span class="icon icon-pedestrian"></span> Piétons</div>
                    <span class="js-pedestrian-values dashboard-number-big orange">
                        {{ round($lastHour->pedestrian_pctoftypical) }} %
                    </span>
                    <span class="js-pedestrian-values-perc tiny orange">
                          @if($lastHour->pedestrian_pctoftypical - $yesterdayHour->pedestrian_pctoftypical > 0)
                            ↑
                        @else
                            ↓
                        @endif
                        {{ abs(round($lastHour->pedestrian_pctoftypical - $yesterdayHour->pedestrian_pctoftypical)) }} %
                    </span>
                    <div id="loadbox" style="display: none;"><div class="loading"></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-desk-3">
        <div class="box light-grey-bg">
            <div class="number-container">
                <div class="dashboard-number dashboard-number-only-one">
                    <div class="green subtitle"><span class="icon icon-bike"></span> Deux-roues</div>
                    <span class="js-pedestrian-values dashboard-number-big green">
                        {{ round($lastHour->bike_pctoftypical) }} %
                    </span>
                    <span class="js-heavy-values-perc tiny green">
                         @if($lastHour->bike_pctoftypical - $yesterdayHour->bike_pctoftypical > 0)
                            ↑
                        @else
                            ↓
                        @endif
                        {{ abs(round($lastHour->bike_pctoftypical - $yesterdayHour->bike_pctoftypical)) }} %
                    </span>
                    <div id="loadbox" style="display: none;"><div class="loading"></div></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-desk-3">
        <div class="box light-grey-bg">
            <div class="number-container">
                <div class="dashboard-number dashboard-number-only-one">
                    <div class="blue subtitle"><span class="icon icon-car"></span> Voitures</div>
                    <span class="js-car-values dashboard-number-big blue">
                         {{ round($lastHour->car_pctoftypical) }} %
                    </span>
                    <span class="js-car-values-perc tiny blue">
                        @if($lastHour->car_pctoftypical - $yesterdayHour->car_pctoftypical > 0)
                            ↑
                        @else ↓
                        @endif
                        {{ abs(round($lastHour->car_pctoftypical - $yesterdayHour->car_pctoftypical)) }} %
                    </span>
                    <div id="loadbox" style="display: none;"><div class="loading"></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-desk-3">
        <div class="box light-grey-bg">
            <div class="number-container">
                <div class="dashboard-number dashboard-number-only-one">
                    <div class="dark-blue subtitle"><span class="icon icon-lorry"></span> Véhicules grands</div>
                    <span class="js-heavy-values dashboard-number-big dark-blue">
                         {{ round($lastHour->heavy_pctoftypical) }} %
                    </span>
                    <span class="js-heavy-values-perc tiny dark-blue">
                         @if($lastHour->heavy_pctoftypical - $yesterdayHour->heavy_pctoftypical > 0)
                            ↑
                        @else
                            ↓
                        @endif
                        {{ abs(round($lastHour->heavy_pctoftypical - $yesterdayHour->heavy_pctoftypical)) }} %
                    </span>
                    <div id="loadbox" style="display: none;"><div class="loading"></div></div>
                </div>
            </div>
        </div>
    </div>


</div>

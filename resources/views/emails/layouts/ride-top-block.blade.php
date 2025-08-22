

@if(isset($ride))
    @if($ride)
        <div style="@if($ride->is_cancelled == 1) background: #ffd4d4; @else background: #fff; @endif
         border-radius: 10px; border: 1px solid rgb(233.65, 233.65, 233.65); padding: 20px; margin: 20px 0;">
            <table width="100%" >
                <tr>
                    <td width="15%">
                        {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ride->travel_start_datetime)->format('d M y') }}<br>
                        <div class="tiny">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ride->travel_start_datetime)->format('h:i') }}</div>
                    </td>
                    <td width="15%">
                        <strong>{{ $ride->departure->city }}</strong><br>
                        <div class="tiny">{{ $ride->departure->street }}</div>
                    </td>
                    <td>
                        <div style="position: relative; top: 5px;"> → </div>
                    </td>
                    <td width="15%">
                        <strong>{{ $ride->arrival->city }}</strong><br>
                        <div class="tiny">{{ $ride->arrival->street }}</div>
                    </td>
                    <td width="15%">
                        <strong>€ {{ $ride->price_per_seat}}</strong>
                    </td>
                    <td width="15%">
                        <div class="tiny">{{ $ride->seats_available}} places disponibles</div>
                    </td>
                </tr>
            </table>
        </div>
    @endif
@endif

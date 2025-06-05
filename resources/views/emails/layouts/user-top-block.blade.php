

@if(isset($user))
    @if($user)
        <div style="background: #f5f5f5; border-radius: 10px; padding: 20px; margin: 20px 0;">
            <table width="100%">
                <tr>
                    <td  valign="top" style="text-align: center" colspan="3">
                        <strong>{{ $user->firstname }} {{ $user->lastname }}</strong>
                    </td>
                </tr>
                <tr>
                    <td  valign="top" style="" width="33%">
                        <a href="{{ $user->email }}">{{ $user->email }}</a>
                    </td>
                    <td  valign="top" style="" width="33%">
                        @if(!empty($user->birth_date))
                            Âge {{ Carbon\Carbon::parse($user->birth_date)->age }}
                        @endif
                    </td>
                    <td  valign="top" style="" width="33%">
                        Tel: {{ $user->phone_number }}
                    </td>
                </tr>
                <tr>
                    @if(isset($amount))
                        <td  valign="top" style="">
                            Nombre de sièges: {{ $amount }}
                        </td>
                    @endif
                    <td>

                    </td>
                    <td>

                    </td>
                </tr>
            </table>
        </div>
    @endif
@endif

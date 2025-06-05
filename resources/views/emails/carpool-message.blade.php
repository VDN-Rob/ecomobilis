@extends('emails.layouts.app-branded')
@section('content')


<tr>
    <td align="left" valign="top">

        @include('emails.layouts.user-top-block')

        @include('emails.layouts.ride-top-block')

        <div style="background: #fff; border-radius: 10px; padding: 20px; margin: 20px 0;">

            <table border="0" cellpadding="10" cellspacing="0" width="100%" id="emailBody">

                <tr>
                    <td align="left" valign="top">
                        {!! $bodyEmail !!}
                    </td>
                <tr>
                    <td align="central" valign="top">
                        <a href="{{ url('/') }}/admin/carpool-messages/ride/{{ $ride->id }}/sender/{{ $user->id }}" class="button"> {{ __('email.carpool-request-reservation-btn') }}</a>
                    </td>
                </tr>
            </table>
        </div>
    </td>
</tr>

@endsection

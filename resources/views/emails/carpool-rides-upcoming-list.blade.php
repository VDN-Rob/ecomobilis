@extends('emails.layouts.app-branded')
@section('content')

    <style>
        .show-on-mobile-only {
            display: none;
        }
    </style>

<tr>
    <td align="left" valign="top">


        <div style="background: #fff; border-radius: 10px; padding: 20px; margin: 20px 0;">

            <table border="0" cellpadding="10" cellspacing="0" width="100%" id="emailBody">
                <tr>
                    <td align="left" valign="top">
                        @foreach($rides as $ride)
                            @include('_includes.carpool-ride-block', ['layout' => 'email-listing', 'showReservations' => 1, 'showConversations' => 0])
                        @endforeach
                    </td>
                </tr>
            </table>
        </div>
    </td>
</tr>

@endsection

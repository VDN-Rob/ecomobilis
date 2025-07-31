<div class="block">
    <div class="grid stackable">

    @if(count($conversationsListArr) == 0 && Request::segment(4) == 0)
        <div class="nothing-found">{{ __('carpool.no-messages') }}</div>
    @else
    <!--- SIDE BAR W/ ALL YOUR RIDES --->
        <div class="col-desk-3">
            @if(count($conversationsListArr) == 0)
                <div class="box box-with-border list-of-chats extra-box-shadow">
                    <div class="grey extra-margin-top">{{ __('carpool.no-messages') }}</div>
                    <div class="bottom tiny"><a href="">Actuel</a> <a href="">Passé</a></div>
                </div>
            @else
                <div class="box box-with-border list-of-chats extra-box-shadow">
                    @foreach($conversationsListArr as $mes)
                        <a href="{{ url('/') }}/admin/carpool-messages/ride/{{ $mes['message']->car_ride_id }}/sender/{{ $mes['senderId'] }}"
                           class="list-of-chat-item   @if($mes['message']->car_ride_id == Request::segment(4) && $mes['senderId'] == Request::segment(6)) active @endif "
                        >
                            <strong>
                                {{ $mes['senderNameFirstName'] }} {{ $mes['senderNameLastName'] }}

                            </strong>
                            @if($mes['unreadTotal'] > 0)<span class="label unread-messages-count extra-box-shadow">{{ $mes['unreadTotal'] }}</span> @endif
                            <div class="tiny">
                                {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s',  $mes['ride']->travel_start_datetime)->format('d M y') }}:
                                {{ $mes['ride']->departure->city }} → {{ $mes['ride']->arrival->city }}
                            </div>
                        </a>
                    @endforeach
                        {{ $conversationsList->links() }}
                </div>
            @endif
        </div>

        <!-- MAIN CONTENT -->
        <div class="col-desk-9">


            @include('_includes.carpool-ride-block', ['layout' => 'header', 'showReservations' => 1, 'showConversations' => 0])

            @include('_includes.carpool-confirm-reject-block')

            <div class="chat-scrollable">
                <main class="msger-chat">
                    @if(count($conversations) > 0)
                        @foreach($conversations as $conversation)

                            @if($conversation->conversation_partner_user_id == Auth::user()->id)
                                <div class="msg left-msg" @if($loop->last) id="msg-last" @endif>
                                    <a href="{{ url('/') }}/user/profile/{{ $conversation->user->id }}" class="msg-img-link">
                                        <div class="msg-img">{{ strtoupper(substr($conversation->user->firstname, 0, 1)) }}{{ strtoupper(substr($conversation->user->lastname, 0, 1)) }}</div>
                                    </a>
                                    <div class="msg-bubble @if($conversation->message == 'auto-message') msg-bubble-auto-message @endif">
                                        <div class="msg-info">
                                            <div class="msg-info-name">{{ $conversation->user->firstname }} {{ $conversation->user->lastname }}</div>
                                            <div class="msg-info-time grey">{{ $conversation->created_at->format('d M y H:i') }}</div>
                                        </div>

                                        <div class="msg-text">
                                            @if($conversation->message == 'auto-message' && $conversation->is_request_for_reservation == '1')
                                                {{ __('carpool.auto-message-request-reservation') }}
                                            @else
                                                {{ $conversation->message }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="msg right-msg" @if($loop->last) id="msg-last" @endif>
                                    <a href="{{ url('/') }}/user/profile/{{ Auth::user()->id }}" class="msg-img-link">
                                        <div class="msg-img">{{ strtoupper(substr(Auth::user()->firstname, 0, 1)) }}{{ strtoupper(substr(Auth::user()->lastname, 0, 1)) }}</div>
                                    </a>

                                    <div class="msg-bubble @if($conversation->message == 'auto-message') msg-bubble-auto-message  @endif">
                                        <div class="msg-info">
                                            <div class="msg-info-name">You</div>
                                            <div class="msg-info-time white">{{ $conversation->created_at->format('d M y H:i') }}</div>
                                        </div>

                                        <div class="msg-text">
                                            @if($conversation->message == 'auto-message' && $conversation->is_request_for_reservation == '1')
                                                {{ __('carpool.auto-message-request-reservation') }}
                                            @else
                                                {{ $conversation->message }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif

                        @endforeach
                    @else
                        <div class="nothing-found text-center" style="opacity: 0.5">
                            {{ __('carpool.send-your-first-message') }}<br>
                            <br>
                             ↓
                        </div>
                    @endif

                </main>
            </div> <!-- end scrollable -->
            <div class="col-desk-12"  style="padding-right: 0;">
                <div class="chat-input-container">
                    <form wire:submit="save">
                        <input type="text" id="new_message" name="new_message" wire:model="newMessage" value="" style="width:  calc(100% - 140px); display: inline-block">
                        <input class="button big" name="submit" type="submit" value="Envoyer" style="width:120px; display: inline-block">
                    </form>
                </div>
            </div>
        </div>
    @endif

</div>
</div>
<script>

    // called from the Livewire component
    window.onload = function() {
        jumpToBottom();
        Livewire.on('LivewireScrollToBottom', () => {
            jumpToBottom();
        });

        function jumpToBottom() {
            if ( $('#msg-last').length ) {
                $('.chat-scrollable').animate({
                    scrollTop: $("#msg-last").offset().top
                }, 150);
            }

        }
    }


</script>

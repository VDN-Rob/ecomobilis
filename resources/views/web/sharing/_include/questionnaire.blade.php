
<div class="content">
        <div class="grid">

            <div id="chat-box" class="col-desk-12 text-center">
                <div class="bot-message chat-message">{{ $firstQuestion->question }}</div>
                <div class="answers  chat-message">
                    @foreach($firstQuestion->edges as $edge)
                        <button class="answer-btn btn btn-sm btn-primary me-2" data-node="{{ $firstQuestion->id }}" data-answer="{{ $edge->answer }}">
                            {{ $edge->answer }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
</div>

<script>
    $(document).on('click', '.answer-btn', function() {
        let answer = $(this).data('answer');
        let nodeId = $(this).data('node');
        let chatBox = $('#chat-box');

        // Append user answer
        chatBox.append('<div class="user-message  chat-message"><strong>Toi:</strong> ' + answer + '</div>');

        // Remove old buttons
        $(this).closest('.answers').remove();


        $.post("{{ route('web.questionnaire.answer') }}", {
            _token: "{{ csrf_token() }}",
            node_id: nodeId,
            answer: answer
        }, function(res) {

            $('.chat-message').fadeOut(1500);

            setTimeout(function() {

                if (res.done) {

                    if (res.result) {
                        let message = '<div class="bot-message  chat-message chat-final"><div class="final-answer-icon"><div class="heroicon-check-circle heroicon"></div></div>' + res.result + '';

                        if (res.organisations && res.organisations.length > 0) {
                            message += '<div class="bot-message  chat-message"><strong>{{ __('sharing-decision-tree.recommended-options') }}</strong><ul>';
                            res.organisations.forEach(function(org) {
                                message += '<a href="'+org.website+'" target="_blank">'+org.name+'</a> ';
                            });
                            message += '</ul></div>';
                        }
                        message += '<div class="try-again tiny grey" style="margin-top: 15px" onclick="location.reload()"><span class="heroicon-refresh heroicon"></span>Réessayer</div>';

                        message += '</div>';

                        chatBox.append(message);
                    } else {
                        chatBox.append('<div class="bot-message  chat-message">' + res.message + '</div>');
                    }
                } else {
                    // Add next question
                    chatBox.append('<div class="bot-message  chat-message">' + res.question + '</div>');
                    let buttons = '<div class="answers  chat-message">';
                    res.answers.forEach(function(ans) {
                        buttons += '<button class="answer-btn btn btn-primary" data-node="'+res.node_id+'" data-answer="'+ans+'">'+ans+'</button>';
                    });
                    buttons += '</div>';
                    chatBox.append(buttons);
                }

                // Auto-scroll
                chatBox.scrollTop(chatBox[0].scrollHeight);

            }, 1500);
        });
    });



</script>

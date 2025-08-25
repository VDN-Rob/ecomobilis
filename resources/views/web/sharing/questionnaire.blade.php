@extends('_layout.app')
@section('extraSeoTitle', __('public-general.seo-title-blog'))
@section('content')

    <style>
        .bot-message { background: #e9ecef; padding: 8px; border-radius: 10px; max-width: 70%; }
        .user-message { background: #007bff; color: white; padding: 8px; border-radius: 10px; max-width: 70%; margin-left:auto; }
    </style>

    <div class="container">
        <h2 class="mb-4">{{ __('sharing-decision-tree.title') }}</h2>

        <div id="chat-box" class="border rounded p-3 mb-3" style="height:400px; overflow-y:auto; background:#f9f9f9;">
            <div class="bot-message mb-2">{{ $firstQuestion->question }}</div>
            <div class="answers mb-2">
                @foreach($firstQuestion->edges as $edge)
                    <button class="answer-btn btn btn-sm btn-primary me-2" data-node="{{ $firstQuestion->id }}" data-answer="{{ $edge->answer }}">
                        {{ $edge->answer }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '.answer-btn', function() {
            let answer = $(this).data('answer');
            let nodeId = $(this).data('node');
            let chatBox = $('#chat-box');

            // Append user answer
            chatBox.append('<div class="user-message mb-2 text-end"><strong>You:</strong> ' + answer + '</div>');

            // Remove old buttons
            $(this).closest('.answers').remove();

            $.post("{{ route('web.questionnaire.answer') }}", {
                _token: "{{ csrf_token() }}",
                node_id: nodeId,
                answer: answer
            }, function(res) {
                if (res.done) {
                    if (res.result) {
                        let message = '<div class="bot-message mb-2"><strong>Bot:</strong> ' + res.result + '</div>';

                        if (res.organisations && res.organisations.length > 0) {
                            message += '<div class="bot-message mb-2"><strong>{{ __('sharing-decision-tree.recommended-options') }}</strong><ul>';
                            res.organisations.forEach(function(org) {
                                message += '<li><a href="'+org.website+'" target="_blank">'+org.name+'</a></li>';
                            });
                            message += '</ul></div>';
                        }

                        chatBox.append(message);
                    } else {
                        chatBox.append('<div class="bot-message mb-2"><strong>Bot:</strong> ' + res.message + '</div>');
                    }
                } else {
                    // Add next question
                    chatBox.append('<div class="bot-message mb-2"><strong>Bot:</strong> ' + res.question + '</div>');
                    let buttons = '<div class="answers mb-2">';
                    res.answers.forEach(function(ans) {
                        buttons += '<button class="answer-btn btn btn-sm btn-primary me-2" data-node="'+res.node_id+'" data-answer="'+ans+'">'+ans+'</button>';
                    });
                    buttons += '</div>';
                    chatBox.append(buttons);
                }

                // Auto-scroll
                chatBox.scrollTop(chatBox[0].scrollHeight);
            });
        });
    </script>

@endsection

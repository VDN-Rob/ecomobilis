@if(Session::has('message'))
    <div class="row notifications messages box block box-with-border success">
        <div class="medium-12 column">
            <div data-closable class="callout success {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
        </div>
    </div>
@endif

@if (!empty($errors->all()))
    <div class="row notifications messages error box block">
        <div class="medium-12 column">
            <div data-closable class="callout error {{ Session::get('alert-class', 'alert-info') }}">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        </div>
    </div>
@endif


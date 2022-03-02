@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <a href="/chat">Chat</a>
                    <div id="notification"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>

<script type="text/javascript">
        window.Echo.channel('user-channel')
        .listen('.UserEvent', (data) => {
            console.log(data);
        });
    </script>
@endsection

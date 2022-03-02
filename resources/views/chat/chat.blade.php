@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($users as $user)
                <a href="/chat/room/{{ $user->id }}">{{ $user->name }}</div>
            @endforeach
        </div>
    </div>
</div>
{{-- <script src="{{ asset('js/app.js') }}"></script>

<script type="text/javascript">
        window.Echo.channel('user-channel')
        .listen('.UserEvent', (data) => {
            console.log(data);
        });
    </script> --}}
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p>{{ $user->name }}</p>


            @foreach ($messages as $message)
                @if ($message->sender_id == Auth::user()->id)
                    <div class="w-100 d-flex justify-content-start">
                        <span>{{ $message->user->name }} :</span>
                        <span >{{ $message->message }}</span> <br>
                    </div>
                @elseif($message->user_id == $user->id)
                    <div class="w-100 d-flex justify-content-end">
                        <span>{{ $message->senderUser->name }} :</span>
                        <span >{{ $message->message }}</span> <br>
                    </div>
                @endif
            @endforeach
            <div class="message">
            </div>
            <br>
            <form id="send-message" method="post">
                @csrf
                <input type="text" name="message">
                <button>Send</button>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script>

$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#send-message").submit(function(event){
        event.preventDefault();

        let message_text = $("input[name=message]");

        $.ajax({
          url: "/chat/room/{{ $user->id }}",
          type:"POST",
          data:{
              message: message_text.val()
          },
          success:function(message){
              console.log(message);
            message_text.val('')
            if(message) {
                $('.message font-weigth-bold').append( `<div class="w-100 d-flex justify-content-start">
                    <span>${message.userName}:</span>
                    <span>${message.message}:</span>
                </div>` );

            }
          },
          error: function(error) {
           console.log(error);
          }
         });
    });
  </script>

<script type="text/javascript">
    window.Echo.channel('user-channel__'+'{{ Auth::user()->id }}')
        .listen('.UserEvent', ({message}) => {
            console.log(message);
            $('.message').append( `<div class="w-100 d-flex justify-content-start">
                    <span>${message.userName}:</span>
                    <span>${message.message}:</span>
                </div>` );
        });
    </script>
@endsection

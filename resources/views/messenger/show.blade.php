@extends('layouts.app')

@section('title', '| Messages')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Messages
        <small> dernier messages</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box box-primary direct-chat direct-chat-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ $thread->subject }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: block;">
            	<div class="direct-chat-messages" style="height: 100%">
	            	@foreach($thread->messages as $message)
	            	@if(Auth::user() == $message->user)
                <div class="direct-chat-msg right">
	                  <div class="direct-chat-info clearfix">
	                    <span class="direct-chat-name pull-right">{{ $message->user->name }}</span>
	                    <span class="direct-chat-timestamp pull-left">{{ $message->created_at->diffForHumans() }}</span>
	                  </div>
	                  <!-- /.direct-chat-info -->
	                  <img class="direct-chat-img" src="../dist/img/user6-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
	                  <div class="direct-chat-text">
	                    {{ $message->body }}
	                  </div>
	                  <!-- /.direct-chat-text -->
	              </div>
	            	@else
								<div class="direct-chat-msg">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left">{{ $message->user->name }}</span>
                    <span class="direct-chat-timestamp pull-right">{{ $message->created_at->diffForHumans() }}</span>
                  </div>
                  <!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
                  <div class="direct-chat-text">
                    {{ $message->body }}
                  </div>
                  <!-- /.direct-chat-text -->
                </div>	            		
	            	@endif
	            	@endforeach
	            </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer" style="display: block;">
              <form action="{{ route('messages.update', $thread->id) }}" method="post" id="respond">
							  {{ method_field('put') }}
							  {{ csrf_field() }}
                <div class="input-group">
                  <input name="message" placeholder="Reponce ..." class="form-control" value="{{ old('message') }}" type="text">
                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary btn-flat">Send</button>
                        <a id="get" class="btn btn-primary btn-flat">get</a>
                      </span>
                </div>
              </form>
            </div>
            <!-- /.box-footer-->
          </div>


    </section>
    <!-- /.content -->
  </div>
  <script type="text/javascript">
    $(document).ready(function(){        
      $("#get").click(function(){
      	console.log("louading ...");
        $.post("{{ route('messages.newmessages') }}",
        {
          "_token": $('#respond').find( 'input[name=_token]' ).val(),
          "thread" : "{{ $thread->id }}",
          "time" : "{{ $thread->getLatestMessageAttribute()->created_at }}",
        },
        function(data, status){
          console.log(JSON.stringify(data));
        });
      });
    });
	</script>
@endsection

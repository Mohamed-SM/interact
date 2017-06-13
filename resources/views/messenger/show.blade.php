@extends('layouts.app')

@section('title', '| Messages')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      	<i class="fa fa-envelope-o" aria-hidden="true"></i>
        Messages
        <small> dernier messages</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    	<div class="box box-primary direct-chat direct-chat-primary" id="loading">
        <div class="box-header with-border">
          <h3 class="box-title">{{ $thread->subject }}</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
              <i class="fa fa-comments"></i></button>
          </div>
        </div>
          <!-- /.box-header -->
          <div class="box-body" style="display: block;">
          	<div id="messages-box" class="direct-chat-messages" style="height: 320px;">
		        	<div id="messages-box-hight">
		        	<div class="text-center">
		        		<button type="button" class="btn btn-box-tool" id="getall">
		        		<i class="fa fa-envelope-open" aria-hidden="true"></i> telecharger tout les messages
		        		</button>
		        	</div>
		        	<?php 
		        		$n_messages = count($thread->messages);
		        		$i = 0;
		        	?>
		          @foreach($thread->messages as $message)
		          	<?php 
		          		$i++;
		          		if ($i < $n_messages - 4) {
		          		 	continue;
		          		 } 
		          	?>

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
            <div class="direct-chat-contacts" style="height: 320px;">
              <ul class="contacts-list">
                <li>
                  <a href="#">
                    <img class="contacts-list-img" src="../dist/img/user1-128x128.jpg" alt="User Image">

                    <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Count Dracula
                            <small class="contacts-list-date pull-right">2/28/2015</small>
                          </span>
                      <span class="contacts-list-msg">How have you been? I was...</span>
                      <hr>put in the user infomrations or profile
                    </div>
                    <!-- /.contacts-list-info -->
                  </a>
                </li>
                <!-- End Contact Item -->
              </ul>
              <!-- /.contatcts-list -->
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer" style="display: block;">
            <form action="{{ route('messages.update', $thread->id) }}" method="post" id="respond">
						  {{ method_field('put') }}
						  {{ csrf_field() }}
              <div class="input-group" id="input-group">
                <input name="message" placeholder="Reponce ..." class="form-control" value="{{ old('message') }}" type="text">
                    <span class="input-group-btn">
                    <a id="send" class="btn btn-primary btn-flat">Send</a>
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
  	var time = "{{ $thread->getLatestMessageAttribute()->created_at }}";

  	function scrtolltolastmessage() {
  		var scrollVal = $('#messages-box-hight').height();
  		$("#messages-box").scrollTop(scrollVal);       
    	console.log($("#messages-box").scrollTop());
  	}

    $(document).ready(function(){ 
    	
    	scrtolltolastmessage();
    	

      
      $("#get").click(function(){
      	console.log("louading ...");
        $.post("{{ route('messages.newmessages') }}",
        {
          "_token": $('#respond').find( 'input[name=_token]' ).val(),
          "thread" : "{{ $thread->id }}",
          "time" : time,
        },
        function(data, status){
          console.log(data);
          if (data != '') {
          	$("#messages-box").append(data);
          	scrtolltolastmessage();
          }
        });
      });

      $("#getall").click(function(){
      	console.log("loading ...");
      	$('#loading').prepend('<div class="overlay" id="don-loading"><i class="fa fa-circle-o-notch fa-spin"></i></div>')
        $.post("{{ route('messages.allmessages') }}",
        {
          "_token": $('#respond').find( 'input[name=_token]' ).val(),
          "thread" : "{{ $thread->id }}",
        },
        function(data, status){
          console.log(data , status);
          if (data != '') {
          	$("#messages-box").html(data);
          }
          $('#don-loading').remove();
        });
        $('#getall').remove();
      });

      $('#send').click(function(){
      	if($('#respond').find( 'input[name=message]' ).val() == ''){
      		$('#input-group').addClass('has-error');
      		console.log(" not louading ...");
      	}
      	else{
      		$('#input-group').removeClass('has-error');
	      	console.log("louading ...");
	        $.post("{{ route('messages.update', $thread->id) }}",
	        {
	        	"_method" : "put",
	          "_token"  : $('#respond').find( 'input[name=_token]' ).val(),
	          "message" : $('#respond').find( 'input[name=message]' ).val(),
	        },
	        function(data, status){
	          console.log(data);
	          $('#respond').find( 'input[name=message]' ).val('');
	          if (data != '') {
	          	$("#messages-box").append(data);
	          	scrtolltolastmessage();
	          }
	        });
	      }
      });

    });
	</script>
@endsection

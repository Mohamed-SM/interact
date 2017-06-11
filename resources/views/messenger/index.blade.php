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
      <div class="box box-default color-palette-box">
        <div class="box-header with-border">
          <a href="{{ route('messages.create')  }}" class="btn btn-success btn-flat pull-right">nouvelle message</a>
          <h3 class="box-title"><i class="fa fa-envelope-o"></i> {{ Auth::user()->newThreadsCount() }} messages non lu</h3>
        </div>
        @foreach($Threads as $thread)
        <?php $class = $thread->isUnread(Auth::id()) ? 'bg-gray' : ''; ?>
        <div class="box-body {{ $class }} ">
          <div class="post clearfix">
            <div class="user-block">
              <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                  <span class="username">
                    <a href="#">{{ $thread->latestMessage->user->name .' '.$thread->latestMessage->user->last_name }}</a>
                  </span>
              <span class="description">Sent you a message - {{ $thread->created_at->diffForHumans() }}</span>
            </div>
            <!-- /.user-block -->
            <p><b>{{ $thread->subject }} : </b> {{ $thread->latestMessage->body }}</p>
          </div>
          <a href="{{ route('messages.show', $thread->id) }}" class="btn btn-primary btn-flat">Voir de conversation</a>
        </div>
        <!-- /.box-body -->
        @endforeach
      </div>


    </section>
    <!-- /.content -->
  </div>
@endsection

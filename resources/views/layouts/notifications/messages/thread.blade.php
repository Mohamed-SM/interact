<?php $class = $thread->isUnread(Auth::id()) ? 'bg-gray' : ''; ?>
<li class="{{ $class }}"><!-- start message -->
  <a href="{{ route('messages.show', $thread->id) }}">
    <div class="pull-left">
      <!-- User Image -->
      <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
    </div>
    <!-- Message title and timestamp -->
    <h4>
      {{ $thread->latestMessage->user->name }}
      <small><i class="fa fa-clock-o"></i>{{ $thread->created_at->diffForHumans() }}</small>
    </h4>
    <!-- The message -->
    <p><b>{{ $thread->subject }} : </b> {{ $thread->latestMessage->body }}</p>
  </a>
</li>
<!-- end message -->
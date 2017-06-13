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
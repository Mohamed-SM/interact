@extends('layouts.app')

@section('title', '| Nouvel message')

@section('plugin')
<!-- Bootstrap Multiselect -->
<link rel="stylesheet" href="{{ asset('vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}">    
<script src="{{ asset('vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Nouvel message
      </h1>
    </section>

    <!-- Main content -->
  <section class="content">
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">information de permission</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {{ Form::open(array('url' => route('messages.store') , 'class' => 'form-horizontal')) }}

        <div class="box-body">
        <div class="form-group">
          {{ Form::label('subject', 'Sujet' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::text('subject', '', array('class' => 'form-control')) }}
          </div>
        </div>

        <div class="form-group">
          <label for="message" class="col-sm-2 control-label">paerticipants</label>
          <div class="col-sm-10">
                  <select id="recipients" name="recipients[]" multiple="multiple">
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name.' '.$user->last_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
          {{ Form::label('message', 'Message' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::text('message', '', array('class' => 'form-control')) }}
          </div>
        </div>
        

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {{ Form::submit('Enrigistre', array('class' => 'btn col-sm-offset-2 btn-primary')) }}
        <a href="{{ config('app.url') }}/messages" class="btn btn-link">Cancel</a>
      </div>
        
      <!-- /.box-footer -->
      {{ Form::close() }}
      </div>

  </section>
  <!-- /.content -->
  </div>


    <script type="text/javascript">
         $(document).ready(function() {
            $('#recipients').multiselect({
                checkboxName: function(option) {
                  return 'recipients[]';
                },
                nonSelectedText: 'Selectioner les paerticipants',
                enableFiltering: true,
                buttonWidth: '100%',
                enableCaseInsensitiveFiltering: true,
                filterPlaceholder: 'Search for something...',
                numberDisplayed: 5,
                maxHeight: 200,
                buttonClass: 'btn btn-default btn-block btn-flat',
            });
            $(".multiselect-container").css('width', '100%');
        });
    </script>


@endsection

@section('content')
    <h1>Create a new message</h1>
    <form action="{{ route('messages.store') }}" method="post">
        {{ csrf_field() }}
        <div class="col-md-6">
            <!-- Subject Form Input -->
            <div class="form-group">
                <label class="control-label">Subject</label>
                <input type="text" class="form-control" name="subject" placeholder="Subject"
                       value="{{ old('subject') }}">
            </div>

            <!-- Message Form Input -->
            <div class="form-group">
                <label class="control-label">Message</label>
                <textarea name="message" class="form-control">{{ old('message') }}</textarea>
            </div>

            @if($users->count() > 0)
                <div class="checkbox">
                    @foreach($users as $user)
                        <label title="{{ $user->name }}"><input type="checkbox" name="recipients[]"
                                                                value="{{ $user->id }}">{!!$user->name!!}</label>
                    @endforeach
                </div>
            @endif
    
            <!-- Submit Form Input -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary form-control">Submit</button>
            </div>
        </div>
    </form>
@stop

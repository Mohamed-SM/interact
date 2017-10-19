@extends('layouts.app')

@section('title', '| Ajoute Enseignant')

@section('plugin')
<!-- Bootstrap Multiselect -->
<link rel="stylesheet" href="{{ asset('vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}">    
<script src="{{ asset('vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<link rel="stylesheet" href="{{ asset('vendor/datepicker/datepicker3.css') }}">
<script src="{{ asset('vendor/datepicker/bootstrap-datepicker.js') }}"></script>

@endsection

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Ajoute Enseignant:
    </h1>
  </section>

    <!-- Main content -->
  <section class="content">
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">information de enseignant</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {{ Form::open(array('url' => 'enseignants' , 'class' => 'form-horizontal')) }}

        <div class="box-body">
        <div class="form-group">
          <label for="message" class="col-sm-2 control-label">User</label>
          <div class="col-sm-10">
                  <select id="user_id" name="user_id[]" multiple="multiple">
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name.' '.$user->last_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
          {{ Form::label('grade_id', 'Grade' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::select('grade_id', $grades, null, ['id'=> 'grade', 'placeholder' => 'Grades ...' , 'class' => 'form-control']) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('recruited_at', 'Recruité le' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::date('recruited_at', \Carbon\Carbon::now(), ['id'=>'datepicker' ,'class' => 'form-control']) }}
          </div>
        </div>

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {{ Form::submit('Enrigistre', array('class' => 'btn col-sm-offset-2 btn-primary')) }}
        <a href="{{ config('app.url') }}/enseignants" class="btn btn-link">Cancel</a>
      </div>
        
      <!-- /.box-footer -->
      {{ Form::close() }}
      </div>

  </section>
  <!-- /.content -->
</div>
<script type="text/javascript">
        $(document).ready(function() {
            $('#user_id').multiselect({
                checkboxName: function(option) {
                  return 'recipients[]';
                },
                nonSelectedText: 'Selectioner un Utilisateur',
                enableFiltering: true,
                buttonWidth: '100%',
                enableCaseInsensitiveFiltering: true,
                filterPlaceholder: 'Search for user...',
                numberDisplayed: 5,
                maxHeight: 200,
                onChange: function(option, checked) {
                    // Get selected options.
                    var selectedOptions = $('#user_id option:selected');
     
                    if (selectedOptions.length >= 1) {
                        // Disable all other checkboxes.
                        var nonSelectedOptions = $('#user_id option').filter(function() {
                            return !$(this).is(':selected');
                        });
     
                        nonSelectedOptions.each(function() {
                            var input = $('input[value="' + $(this).val() + '"]');
                            input.prop('disabled', true);
                            input.parent('li').addClass('disabled');
                        });
                    }
                    else {
                        // Enable all checkboxes.
                        $('#user_id option').each(function() {
                            var input = $('input[value="' + $(this).val() + '"]');
                            input.prop('disabled', false);
                            input.parent('li').addClass('disabled');
                        });
                    }
                }
            });
            $(".multiselect-container").css('width', '100%');
            $('#datepicker').datepicker({
              autoclose: true,
              format: 'yyyy-mm-dd',
            });
        });
</script>
@endsection
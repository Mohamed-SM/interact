@extends('layouts.app')

@section('title', '| Edit Module')

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
      Modifer : {{$module->title}}
    </h1>
  </section>

    <!-- Main content -->
  <section class="content">
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">information de Module</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {{ Form::model($module, array('route' => array('modules.update', $module->id), 'method' => 'PUT' , 'class' => 'form-horizontal')) }}

      <div class="box-body">

        <div class="form-group">
          {{ Form::label('title', 'Titre' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::text('title', null, array('class' => 'form-control')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('code', 'Code' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::text('code', null, array('class' => 'form-control')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('controle', 'controle' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::checkbox('multichoise','true', (count($module->group_modul->modules)-1), array('id' => 'multichoise' , 'onChange'=>'unhide()')) }}
          </div>
        </div>

        <?php
        if((count($module->group_modul->modules)-1) & $module->group_modul->modules[0]->id == $module->id)
        {
          $id = $module->group_modul->modules[1]->id;
          $class = '';
        }
        else{
          $id = $module->group_modul->modules[0]->id;
          $class = 'hidden';
        }
          
        ?>
        <div class="form-group {{ $class }}" id="module-div">
          {{ Form::label('module', 'Module dans le choix' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::select('module', $modules, $id , ['class' => 'form-control' , 'id'=>'modules']) }}
          </div>
        </div>

        <div class="form-group not-hidden">
          {{ Form::label('unit', 'Unité' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::select('unit', $units, null, ['class' => 'form-control']) }}
          </div>
        </div>

        <div class="form-group not-hidden">
          {{ Form::label('credits', 'crédits' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::number('credits', null, array('class' => 'form-control')) }}
          </div>
        </div>

        <div class="form-group not-hidden">
          {{ Form::label('coefficient', 'coefficient' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::number('coefficient', null, array('class' => 'form-control')) }}
          </div>
        </div>

        <div class="form-group not-hidden">
          {{ Form::label('time_course', 'durée de course(min)' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::number('time_course', null, array('class' => 'form-control','step'=>'15')) }}
          </div>
        </div>

        <div class="form-group not-hidden">
          {{ Form::label('time_td', 'durée de TD(min)' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::number('time_td', null, array('class' => 'form-control','step'=>'15')) }}
          </div>
        </div>

        <div class="form-group not-hidden">
          {{ Form::label('time_tp', 'durée de TP(min)' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::number('time_tp', null, array('class' => 'form-control','step'=>'15')) }}
          </div>
        </div>

        <div class="form-group not-hidden">
          {{ Form::label('exame', 'exame' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::checkbox('exame','true', null) }}
          </div>
        </div>

        <div class="form-group not-hidden">
          {{ Form::label('controle', 'controle' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::checkbox('controle','true', null) }}
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {{ Form::submit('Enrigistre', array('class' => 'btn col-sm-offset-2 btn-primary')) }}
        <a href="{{ config('app.url') }}/modules" class="btn btn-link">Cancel</a>
      </div>
        
      <!-- /.box-footer -->
      {{ Form::close() }}
      </div>

  </section>
  <!-- /.content -->
</div>
<script type="text/javascript">
        $(document).ready(function() {
            $('#modules').multiselect({
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
        });
        if ($("#multichoise").is(':checked')) {
          $('#module-div').removeClass("hidden");
          //$('.not-hidden').addClass("hidden");  
        }else{
          $('#module-div').addClass("hidden");
          //$('.not-hidden').removeClass("hidden");
        }
        function unhide(){
          if ($("#multichoise").is(':checked')) {
            $('#module-div').removeClass("hidden");
            //$('.not-hidden').addClass("hidden");  
          }else{
            $('#module-div').addClass("hidden");
            //$('.not-hidden').removeClass("hidden");
          }
        }
</script>

@endsection
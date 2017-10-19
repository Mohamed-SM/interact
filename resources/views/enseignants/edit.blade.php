@extends('layouts.app')

@section('title', '| Edit Enseignant')

@section('plugin')

<link rel="stylesheet" href="{{ asset('vendor/datepicker/datepicker3.css') }}">
<script src="{{ asset('vendor/datepicker/bootstrap-datepicker.js') }}"></script>

@endsection


@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Modifer Enseignant: {{$enseignant->name.' '.$enseignant->last_name}}
    </h1>
  </section>

    <!-- Main content -->
  <section class="content">
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">information de l'nseignant</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {{ Form::model($enseignant, array('route' => array('enseignants.update', $enseignant->id), 'method' => 'PUT' , 'class' => 'form-horizontal')) }}

        <div class="box-body">

        <div class="form-group">
          {{ Form::label('grade_id', 'Grade' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::select('grade_id', $grades, null, ['id'=> 'grade', 'placeholder' => 'Grades ...' , 'class' => 'form-control']) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('recruited_at', 'Recruité le' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::date('recruited_at', null, ['id'=>'datepicker' ,'class' => 'form-control']) }}
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
            $('#datepicker').datepicker({
              autoclose: true,
              format: 'yyyy-mm-dd',
            });
        });
</script>
@endsection
@extends('layouts.app')

@section('title', '| Edit Student')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Modifer Student: {{$student->user->name.' '.$student->user->last_name}}
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
    {{ Form::model($student, array('route' => array('students.update', $student->id), 'method' => 'PUT' , 'class' => 'form-horizontal')) }}

      <div class="box-body">

        <div class="form-group">
          {{ Form::label('promo_id', 'Promo' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::select('promo_id', $promos, null, ['id'=> 'promo', 'placeholder' => 'Promos ...' , 'class' => 'form-control']) }}
          </div>
        </div>
        
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {{ Form::submit('Enrigistre', array('class' => 'btn col-sm-offset-2 btn-primary')) }}
        <a href="{{ config('app.url') }}/students" class="btn btn-link">Cancel</a>
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
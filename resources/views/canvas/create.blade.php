@extends('layouts.app')

@section('title', '| Ajoute Canva')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Ajoute Canva:
    </h1>
  </section>

    <!-- Main content -->
  <section class="content">
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">information de canva</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {{ Form::open(array('url' => 'canvas' , 'class' => 'form-horizontal')) }}

      <div class="box-body">
        <div class="form-group">
          {{ Form::label('semester_id', 'Semester' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::select('semester_id', $semesters, null, ['placeholder' => 'Type d\'canvaé ...' , 'class' => 'form-control']) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('started_at', 'started_at' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::number('started_at', '', array('class' => 'form-control')) }}
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {{ Form::submit('Enrigistre', array('class' => 'btn col-sm-offset-2 btn-primary')) }}
        <a href="{{ config('app.url') }}/canvas" class="btn btn-link">Cancel</a>
      </div>
        
      <!-- /.box-footer -->
      {{ Form::close() }}
      </div>

  </section>
  <!-- /.content -->
</div>

@endsection
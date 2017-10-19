@extends('layouts.app')

@section('title', '| Edit Grade')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Modifer Grade: {{$grade->name}}
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
    {{ Form::model($grade, array('route' => array('grades.update', $grade->id), 'method' => 'PUT' , 'class' => 'form-horizontal')) }}

        <div class="box-body">
        <div class="form-group">
          {{ Form::label('title', 'Nom de grade' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::text('title', null, array('class' => 'form-control' , 'placeholder' => 'Grade des Sciences Exact')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('priority', 'Priority' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::number('priority', null, array('class' => 'form-control' , 'placeholder' => 'FSE')) }}
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {{ Form::submit('Enrigistre', array('class' => 'btn col-sm-offset-2 btn-primary')) }}
        <a href="{{ config('app.url') }}/grades" class="btn btn-link">Cancel</a>
      </div>
        
      <!-- /.box-footer -->
      {{ Form::close() }}
      </div>

  </section>
  <!-- /.content -->
</div>

@endsection
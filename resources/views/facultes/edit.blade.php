@extends('layouts.app')

@section('title', '| Edit Role')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Modifer Role: {{$faculte->name}}
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
    {{ Form::model($faculte, array('route' => array('facultes.update', $faculte->id), 'method' => 'PUT' , 'class' => 'form-horizontal')) }}

        <div class="box-body">
        <div class="form-group">
          {{ Form::label('title', 'Nom de faculte' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::text('title', null, array('class' => 'form-control' , 'placeholder' => 'Faculte des Sciences Exact')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('abreviation', 'Abriviation' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::text('abreviation', null, array('class' => 'form-control' , 'placeholder' => 'FSE')) }}
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {{ Form::submit('Enrigistre', array('class' => 'btn col-sm-offset-2 btn-primary')) }}
        <a href="{{ config('app.url') }}/facultes" class="btn btn-link">Cancel</a>
      </div>
        
      <!-- /.box-footer -->
      {{ Form::close() }}
      </div>

  </section>
  <!-- /.content -->
</div>

@endsection
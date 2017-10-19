@extends('layouts.app')

@section('title', '| Ajoute Grade')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Ajoute Grade:
    </h1>
  </section>

    <!-- Main content -->
  <section class="content">
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">information de grade</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {{ Form::open(array('url' => 'grades' , 'class' => 'form-horizontal')) }}

        <div class="box-body">
        <div class="form-group">
          {{ Form::label('title', 'Nom de grade' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::text('title', '', array('class' => 'form-control' , 'placeholder' => 'Grade des Sciences Exact')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('priority', 'Priority' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::number('priority', '', array('class' => 'form-control' , 'placeholder' => '0','min' => '1' , 'max' => '6')) }}
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
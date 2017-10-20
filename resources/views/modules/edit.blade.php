@extends('layouts.app')

@section('title', '| Edit Module')

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
          {{ Form::label('unit_id', 'Unité' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::select('unit_id', $units, null, ['placeholder' => 'Type d\'moduleé ...' , 'class' => 'form-control']) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('credits', 'crédits' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::number('credits', null, array('class' => 'form-control')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('coefficient', 'coefficient' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::number('coefficient', null, array('class' => 'form-control')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('time_course', 'durée de course(min)' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::number('time_course', null, array('class' => 'form-control','step'=>'15')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('time_td', 'durée de TD(min)' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::number('time_td', null, array('class' => 'form-control','step'=>'15')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('time_tp', 'durée de TP(min)' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::number('time_tp', null, array('class' => 'form-control','step'=>'15')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('exame', 'exame' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::checkbox('exame','true', null) }}
          </div>
        </div>

        <div class="form-group">
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

@endsection
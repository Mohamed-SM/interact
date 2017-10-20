@extends('layouts.app')

@section('title', '| Ajoute Module')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Ajoute Module:
    </h1>
  </section>

    <!-- Main content -->
  <section class="content">
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">information de module</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {{ Form::open(array('url' => 'modules' , 'class' => 'form-horizontal')) }}

        <div class="box-body">

        <div class="form-group">
          {{ Form::label('title', 'Titre' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::text('title', '', array('class' => 'form-control')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('code', 'Code' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::text('code', '', array('class' => 'form-control')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('unit', 'Unité' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::select('unit', $units, null, ['placeholder' => 'Type d\'moduleé ...' , 'class' => 'form-control']) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('credits', 'crédits' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::number('credits', '', array('class' => 'form-control')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('coefficient', 'coefficient' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::number('coefficient', '', array('class' => 'form-control')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('time_course', 'durée de course(min)' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::number('time_course', '', array('class' => 'form-control','step'=>'15')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('time_td', 'durée de TD(min)' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::number('time_td', '', array('class' => 'form-control','step'=>'15')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('time_tp', 'durée de TP(min)' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::number('time_tp', '', array('class' => 'form-control','step'=>'15')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('exame', 'exame' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::checkbox('exame','true', true) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('controle', 'controle' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::checkbox('controle','true', true) }}
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
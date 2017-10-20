@extends('layouts.app')

@section('title', '| Edit')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Modifer : {{$unit->title}}
    </h1>
  </section>

    <!-- Main content -->
  <section class="content">
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">information de Departement</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {{ Form::model($unit, array('route' => array('units.update', $unit->id), 'method' => 'PUT' , 'class' => 'form-horizontal')) }}

        <div class="box-body">
        <div class="form-group">
          {{ Form::label('code', 'Code de unit' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::text('code', null, array('class' => 'form-control')) }}
          </div>
        </div>

        <div class="form-group">
            {{ Form::label('unit_type_id', 'Type' , array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::select('unit_type_id', $types, null, ['class' => 'form-control']) }}
            </div>
        </div>

        <div class="form-group">
          {{ Form::label('canva_id', 'Canva' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::select('canva_id', $canvas, null, ['class' => 'form-control']) }}
          </div>
        </div>

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {{ Form::submit('Enrigistre', array('class' => 'btn col-sm-offset-2 btn-primary')) }}
        <a href="{{ config('app.url') }}/units" class="btn btn-link">Cancel</a>
      </div>
        
      <!-- /.box-footer -->
      {{ Form::close() }}
      </div>

  </section>
  <!-- /.content -->
</div>

@endsection
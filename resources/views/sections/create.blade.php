@extends('layouts.app')

@section('name', '| Ajoute section')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Ajoute section:
    </h1>
  </section>

    <!-- Main content -->
  <section class="content">
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-name">information de section</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {{ Form::open(array('url' => 'sections' , 'class' => 'form-horizontal')) }}

        <div class="box-body">

        <div class="form-group">
          {{ Form::label('promo', 'Promo' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::select('promo', $promos, null, ['placeholder' => 'Promos ...' , 'class' => 'form-control']) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('sections', 'Nombre de sections' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::number('sections', '', array('min'=>'0', 'class' => 'form-control')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('groups', 'Nombre de groups dans chaque section' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::number('groups', '', array('min'=>'0', 'class' => 'form-control')) }}
          </div>
        </div>

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {{ Form::submit('Enrigistre', array('class' => 'btn col-sm-offset-2 btn-primary')) }}
        <a href="{{ config('app.url') }}/sections" class="btn btn-link">Cancel</a>
      </div>
        
      <!-- /.box-footer -->
      {{ Form::close() }}
      </div>

  </section>
  <!-- /.content -->
</div>

@endsection
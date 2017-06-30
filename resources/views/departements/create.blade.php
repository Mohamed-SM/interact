@extends('layouts.app')

@section('title', '| Ajoute Departement')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Ajoute Departement:
    </h1>
  </section>

    <!-- Main content -->
  <section class="content">
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">information de departement</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {{ Form::open(array('url' => 'departements' , 'class' => 'form-horizontal')) }}

        <div class="box-body">
        <div class="form-group">
          {{ Form::label('title', 'Nom de departement' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::text('title', '', array('class' => 'form-control' , 'placeholder' => 'Faculte des Sciences Exact')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('abreviation', 'Abriviation' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::text('abreviation', '', array('class' => 'form-control' , 'placeholder' => 'FSE')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('faculte_id', 'Faculte' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::select('faculte_id', $facultes, null, ['placeholder' => 'Faculte ...' , 'class' => 'form-control']) }}
          </div>
        </div>

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {{ Form::submit('Enrigistre', array('class' => 'btn col-sm-offset-2 btn-primary')) }}
        <a href="{{ config('app.url') }}/departements" class="btn btn-link">Cancel</a>
      </div>
        
      <!-- /.box-footer -->
      {{ Form::close() }}
      </div>

  </section>
  <!-- /.content -->
</div>

@endsection
@extends('layouts.app')

@section('name', '| Ajoute filier')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Ajoute filier:
    </h1>
  </section>

    <!-- Main content -->
  <section class="content">
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-name">information de filier</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {{ Form::open(array('url' => 'filiers' , 'class' => 'form-horizontal')) }}

        <div class="box-body">
        <div class="form-group">
          {{ Form::label('name', 'Nom de filier' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::text('name', '', array('class' => 'form-control' , 'placeholder' => 'Faculte des Sciences Exact')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('domain', 'Domaine' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::select('domain', $domains, null, ['placeholder' => 'Domains ...' , 'class' => 'form-control']) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('code', 'Code' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::text('code', '', array('class' => 'form-control')) }}
          </div>
        </div>

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {{ Form::submit('Enrigistre', array('class' => 'btn col-sm-offset-2 btn-primary')) }}
        <a href="{{ config('app.url') }}/filiers" class="btn btn-link">Cancel</a>
      </div>
        
      <!-- /.box-footer -->
      {{ Form::close() }}
      </div>

  </section>
  <!-- /.content -->
</div>

@endsection
@extends('layouts.app')

@section('name', '| Ajoute Semester')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Ajoute Semester:
    </h1>
  </section>

    <!-- Main content -->
  <section class="content">
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-name">information de Semester</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {{ Form::open(array('url'=>'semesters','id'=>'create','class'=>'form-horizontal')) }}

        <div class="box-body">
          <div class="form-group">
            {{ Form::label('number', 'N° de semester' , array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::number('number', '', array('class' => 'form-control' , 'min' => '1' , 'max' => '6')) }}
            </div>
          </div>

          <div class="form-group">
            {{ Form::label('year', 'Année acc' , array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::select('year', $years, null, ['id'=> 'year', 'placeholder' => 'Année accadimic ...' , 'class' => 'form-control']) }}
            </div>
          </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          {{ Form::submit('Enrigistre', array('class' => 'btn col-sm-offset-2 btn-primary')) }}
          <a href="{{ config('app.url') }}/semesters" class="btn btn-link">Cancel</a>
        </div>
          
        <!-- /.box-footer -->
    {{ Form::close() }}
      </div>

  </section>
  <!-- /.content -->
</div>


@endsection
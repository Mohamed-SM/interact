@extends('layouts.app')

@section('title', '| Edit UniversityYear')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Modifer UniversityYear: {{$university_year->year}}
    </h1>
  </section>

    <!-- Main content -->
  <section class="content">
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">information de UniversityYear</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {{ Form::model($university_year, array('route' => array('university_years.update', $university_year->id), 'method' => 'PUT' , 'class' => 'form-horizontal')) }}

        <div class="box-body">
        <div class="form-group">
          {{ Form::label('year', 'university_year' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form:: number('year', null, array('class' => 'form-control' , 'placeholder' => 'UniversityYear des Sciences Exact')) }}
          </div>
        </div>

        </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {{ Form::submit('Enrigistre', array('class' => 'btn col-sm-offset-2 btn-primary')) }}
        <a href="{{ config('app.url') }}/university_years" class="btn btn-link">Cancel</a>
      </div>
        
      <!-- /.box-footer -->
      {{ Form::close() }}
      </div>

  </section>
  <!-- /.content -->
</div>

@endsection
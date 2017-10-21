@extends('layouts.app')

@section('title', '| Edit Promo')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Modifer : Promo {{ $promo->accadimic_year->year.$promo->accadimic_year->grade.' '.$promo->accadimic_year->domain->code.' '.$promo->accadimic_year->filier->code.' '.$promo->accadimic_year->spesialite->code.' '.$promo->university_year->year.'/'.($promo->university_year->year+1) }}
    </h1>
  </section>

    <!-- Main content -->
  <section class="content">
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">information de Promo</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {{ Form::model($promo, array('route' => array('promos.update', $promo->id), 'method' => 'PUT' , 'class' => 'form-horizontal')) }}

      <div class="box-body">
        <div class="form-group">
          {{ Form::label('accadimic_year_id', 'acc_year' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::select('accadimic_year_id', $acc_years, null, ['class' => 'form-control']) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('university_year_id', 'Univ Year' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::select('university_year_id', $univ_years, null, ['class' => 'form-control']) }}
          </div>
        </div>

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {{ Form::submit('Enrigistre', array('class' => 'btn col-sm-offset-2 btn-primary')) }}
        <a href="{{ config('app.url') }}/promos" class="btn btn-link">Cancel</a>
      </div>
        
      <!-- /.box-footer -->
      {{ Form::close() }}
      </div>

  </section>
  <!-- /.content -->
</div>

@endsection
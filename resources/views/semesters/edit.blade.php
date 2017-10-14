@extends('layouts.app')

@section('name', '| Edit Semester')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Modifer : {{$semester->code}}
    </h1>
  </section>

    <!-- Main content -->
  <section class="content">
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-name">information de semester</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {{ Form::model($semester, array('route' => array('semesters.update', $semester->id), 'method' => 'PUT' , 'class' => 'form-horizontal')) }}
        <div class="box-body">
          <div class="form-group">
            {{ Form::label('number', 'N° de semester' , array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::number('number', null, array('class' => 'form-control' , 'min' => '1' , 'max' => '6')) }}
            </div>
          </div>

          <div class="form-group">
            {{ Form::label('year', 'Année acc' , array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::select('year', $years, null, ['id'=> 'year', 'class' => 'form-control']) }}
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
<script>
  $("#domain").change(function(){
    console.log("louading ...");
    $.post("{{ route('getfiliers') }}",
            {
              "_token": $('#create').find( 'input[name=_token]' ).val(),
              "domain" : $('#domain').val(),
            },
            function(data, status){
              console.log(data + status);
              if (data != '') {
                $("#filiers").html(data);
              }
            });
  });
</script>

@endsection
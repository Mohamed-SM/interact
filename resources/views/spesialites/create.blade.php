@extends('layouts.app')

@section('name', '| Ajoute Spesialite')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Ajoute Spesialite:
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
    {{ Form::open(array('url' => 'spesialites' ,'id' => 'create' , 'class' => 'form-horizontal')) }}

        <div class="box-body">
        <div class="form-group">
          {{ Form::label('name', 'Nom de spesialite' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::text('name', '', array('class' => 'form-control' , 'placeholder' => '...')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('domain', 'Domaine' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::select('domain', $domains, null, ['id'=> 'domain', 'placeholder' => 'Domains ...' , 'class' => 'form-control']) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('filier', 'Filier' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            <select name="filier" id="filiers" class="form-control">
              <option selected="selected" disabled="disabled" hidden="hidden" value="">Filier ...</option>
            </select>
          </div>
        </div>

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {{ Form::submit('Enrigistre', array('class' => 'btn col-sm-offset-2 btn-primary')) }}
        <a href="{{ config('app.url') }}/spesialites" class="btn btn-link">Cancel</a>
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
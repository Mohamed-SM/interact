@extends('layouts.app')

@section('name', '| Modifer Année Accadimique')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Modifer : @if($acc_year->year > 1)
                    {{ $acc_year->year }} eme
                @else
                    {{ $acc_year->year }} er
                @endif
                année
                @if($acc_year->grade == 'L')
                    Lisance
                @else
                    Master
                @endif

                ({{ $acc_year->study_year."/".($acc_year->study_year+1) }})
    </h1>
  </section>

    <!-- Main content -->
<section class="content">
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-name">information de l'année</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {{ Form::model($acc_year, array('route' => array('annee_acc.update', $acc_year->id), 'method' => 'PUT' ,'id' => 'create', 'class' => 'form-horizontal')) }}

        <div class="box-body">
        <div class="form-group">
          {{ Form::label('year', 'Année' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::number('year', null, array('class' => 'form-control' ,'min' => '1' , 'max' => '3')) }}
          </div>
        </div>

        <div class="form-group">
            {{ Form::label('grad', 'Grad' , array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                <select name="grade" class="form-control">
                    @if($acc_year->grade=='L')
                    <option value="L" selected="selected">lisanc</option>
                    <option value="M">Master</option>
                    @else
                    <option value="L">lisanc</option>
                    <option value="M" selected="selected">Master</option>
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group">
          {{ Form::label('domain_id', 'Domaine' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::select('domain_id', $domains, null, ['id'=> 'domain', 'placeholder' => 'Domains ...' , 'class' => 'form-control']) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('filier_id', 'Filier' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::select('filier_id', $filiers, null, ['id'=> 'filiers', 'placeholder' => 'Filiers ...' , 'class' => 'form-control']) }}
          </div>
        </div>

        <div class="form-group">
            {{ Form::label('spesialite_id', 'Spesialité' , array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::select('spesialite_id', $spesialites, null, ['id'=> 'spesialite', 'placeholder' => 'Spesialites ...' , 'class' => 'form-control']) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('departement_id', 'Departement' , array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::select('departement_id', $departements, null, ['placeholder' => 'Departements ...' , 'class' => 'form-control']) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('study_year', 'Année scholair' , array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                    {{ Form::number('study_year', null, array('class' => 'form-control' ,'min' => '2017' , 'max' => '2099')) }}
            </div>
        </div>

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {{ Form::submit('Enrigistre', array('class' => 'btn col-sm-offset-2 btn-primary')) }}
        <a href="{{ config('app.url') }}/annee_acc" class="btn btn-link">Cancel</a>
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
                  $.post("{{ route('getspesialite') }}",
                          {
                              "_token": $('#create').find( 'input[name=_token]' ).val(),
                              "filier" : $('#filiers').val(),
                          },
                          function(data, status){
                              console.log(data + status);
                              if (data != '') {
                                  $("#spesialite").html(data);
                              }
                          });
              }
            });
  });
  $("#filiers").change(function(){
      console.log("louading ...");
      $.post("{{ route('getspesialite') }}",
              {
                  "_token": $('#create').find( 'input[name=_token]' ).val(),
                  "filier" : $('#filiers').val(),
              },
              function(data, status){
                  console.log(data + status);
                  if (data != '') {
                      $("#spesialite").html(data);
                  }
              });
  });
</script>

@endsection
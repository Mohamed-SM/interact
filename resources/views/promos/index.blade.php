@extends('layouts.app')

@section('title', '| Promos')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Gestion des promos       
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box">
            <div class="box-header with-bordre">
              <a href="{{ URL::to('promos/create') }}" class="btn btn-success btn-flat pull-right">Ajoute promo</a>
              <h3 class="box-title">Tout les promos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordreed">
                <tbody><tr>
                  <th>promos</th>
                  <th>Sections</th>
                  <th>Groups</th>
                  <th>nombre d'etudient</th>
                  <th>Operation</th>
                </tr>
                
                @foreach ($promos as $promo)
                <tr>
                    <td>{{ $promo->accadimic_year->year.$promo->accadimic_year->grade.' '.$promo->accadimic_year->domain->code.' '.$promo->accadimic_year->filier->code.' '.$promo->accadimic_year->spesialite->code.' '.$promo->university_year->year.'/'.($promo->university_year->year+1) }}</td>
                    
                    @if(count($promo->sections))
                      <td>
                        {{ count($promo->sections) }}
                      </td>
                      <td>
                        <?php $g=0 ?>
                        @foreach($promo->sections as $section)
                        <?php $g+= count($section->groups); ?>
                        @endforeach
                        {{ $g }}
                      </td>
                    @else
                      <td colspan="2">
                        <button type="button" class="btn btn-info" data-toggle="modal"
                        data-target="#add-section-modal{{ $promo->id }}">
                          Ajouté des sections
                        </button>
                      </td>
                    @endif
                    
                    <td>{{ count($promo->students) }}</td>
                    <td>
                      <a href="{{ URL::to('promos/'.$promo->id) }}" class="btn btn-info">
                        <i class="fa fa-search"></i>
                      </a>
                      
                      <button type="button" class="btn btn-danger" data-toggle="modal"
                      data-target="#supp-modal{{ $promo->id }}">
                        <i class="fa fa-trash"></i>
                      </button>

                    </td>
                </tr>
                @endforeach

              </tbody></table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <div class="text-center">
                {{ $promos->links() }}
              </div>
            </div>
          </div>
    </section>
    <!-- /.content -->
</div>

@foreach ($promos as $promo)
  <div class="modal fade modal-danger" id="supp-modal{{ $promo->id }}" role="dialog">
    <div class="modal-dialog">
  
    <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirmier la supprission</h4>
        </div>
        <div class="modal-body">
          <p> <b>Id : </b> {{ $promo->id }}</p>
          
          <p> Othe Data to be add later ....</p>
          

          <p> <b>Ajoute le  : </b> {{ $promo->created_at->format('F d, Y h:ia') }}</p>
        </div>
        <div class="modal-footer">
        {!! Form::open(['method' => 'DELETE', 'route' => ['promos.destroy', $promo->id]]) !!}
        <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
        {!! Form::submit('Delete', ['class' => 'btn btn-outline']) !!}
        {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade modal-default" id="add-section-modal{{ $promo->id }}" role="dialog">
    <div class="modal-dialog">
  
    <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirmier la supprission</h4>
        </div>
        <div class="modal-body">
          <p>{{ $promo->accadimic_year->year.$promo->accadimic_year->grade.' '.$promo->accadimic_year->domain->name.' '.$promo->accadimic_year->filier->name.' '.$promo->accadimic_year->spesialite->name.' '.$promo->university_year->year.'/'.($promo->university_year->year+1) }}</p>
          <p> Othe Data to be add later ....</p>

          <p>le nombre des etudients dans cette section est : <b>{{ count($promo->students) }}</b></p>
          <hr>
          <div>
            {{ Form::open(array('url' => 'promos/addsection/'.$promo->id , 'class' => 'form-horizontal','id' =>'addsection-form-'.$promo->id)) }}

              <div class="form-group">
              {{ Form::label('sections', 'Nombre de sections' , array('class' => 'col-sm-6 control-label')) }}
                <div class="col-sm-6">
                  {{ Form::number('sections', null, ['min' => '0' , 'class' => 'form-control']) }}
                </div>
              </div>

              <div class="form-group">
              {{ Form::label('groups', 'Nombre de groups dans un section' , array('class' => 'col-sm-6 control-label')) }}
                <div class="col-sm-6">
                  {{ Form::number('groups', null, ['min' => '0' , 'class' => 'form-control']) }}
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-6 col-sm-6">
                  <div class="checkbox">
                    <label>
                      {{ Form::checkbox('auto_insert', '') }} ajouté les etudients automatiquement dans les groups
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                {{ Form::label('ordre', 'insiré les etudiant par ordre' , array('class' => 'col-sm-6 control-label')) }}
                <div class="col-sm-6">
                  {{ Form::select('ordre', ["A"=>"Alphabitique","L"=>"Aliatoir","D"=>"Date de naissance","N"=>"Nemero de la cart"], null, ['id'=> 'ordre-list', 'placeholder' => 'ordre par ...' , 'class' => 'form-control']) }}
                </div>
              </div>
            {!! Form::close() !!}
          </div>
          
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        {!! Form::submit('Ajoute', ['class' => 'btn btn-info','form' => 'addsection-form-'.$promo->id]) !!}
        
        </div>
      </div>
    </div>
  </div>    
@endforeach

@endsection
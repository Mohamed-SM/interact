@extends('layouts.app')

@section('title', '| Années Accadimique')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Gestion des Années Accadimique
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box">
            <div class="box-header with-border">
              <a href="{{ URL::to('annee_acc/create') }}" class="btn btn-success btn-flat pull-right">Ajoute Année acadimique</a>
              <h3 class="box-name">Années Accadimique</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                    <th>Annee Accadimique</th>
                    <th>Année scol</th>
                    <th>domain</th>
                    <th>filier</th>
                    <th>spesialité</th>
                    <th>departement</th>
                    <th>Operation</th>
                </tr>
                
                @foreach ($acc_years as $acc_year)
                <tr>
                    <td>
                        @if($acc_year->year > 1)
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
                        {{ $acc_year->study_year."/".($acc_year->study_year+1) }}
                    </td>
                    <td>{{ $acc_year->study_year."/".($acc_year->study_year+1) }}</td>
                    <td>{{ $acc_year->domain->name }}</td>
                    <td>{{ $acc_year->filier->name }}</td>
                    <td>
                    @if($acc_year->filier->id)
                    {{ $acc_year->spesialite->name }}
                    @endif
                    </td>
                    <td>{{ $acc_year->departement->title }}</td>
                    <td>
                      <a href="{{ URL::to('annee_acc/'.$acc_year->id.'/edit') }}" class="btn btn-info">
                        <i class="fa fa-pencil-square-o"></i>
                      </a>

                      <button type="button" class="btn btn-danger" data-toggle="modal"
                      data-target="#supp-modal{{ $acc_year->id }}">
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
                {{ $acc_years->links() }}
              </div>
            </div>
          </div>
    </section>
    <!-- /.content -->
</div>

@foreach ($acc_years as $acc_year)
  <div class="modal fade modal-danger" id="supp-modal{{ $acc_year->id }}" role="dialog">
    <div class="modal-dialog">
  
    <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-name">Confirmier la supprission</h4>
        </div>
        <div class="modal-body">
          <p> <b>Id : </b> {{ $acc_year->id }}</p>
          <p> <b>Année acadimique : </b> {{ $acc_year->year.$acc_year->grade }}</p>
          
          <p> Othe Data to be add later ....</p>
          

          <p> <b>Ajoute le  : </b> {{ $acc_year->created_at->format('F d, Y h:ia') }}</p>
        </div>
        <div class="modal-footer">
        {!! Form::open(['method' => 'DELETE', 'route' => ['annee_acc.destroy', $acc_year->id]]) !!}
        <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
        {!! Form::submit('Delete', ['class' => 'btn btn-outline']) !!}
        {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>    
@endforeach

@endsection
@extends('layouts.app')

@section('title', '| Departements')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Gestion des departements       
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box">
            <div class="box-header with-border">
              <a href="{{ URL::to('departements/create') }}" class="btn btn-success btn-flat pull-right">Ajoute departement</a>
              <h3 class="box-title">Tout les departements</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th>intitule</th>
                  <th>ABR</th>
                  <th>Faculté</th>
                  <th>Operation</th>
                </tr>
                
                @foreach ($departements as $departement)
                <tr>
                    <td>{{ $departement->title }}</td>
                    <td>{{ $departement->abreviation }}</td>
                    <td>{{ $departement->faculte->title }}</td>
                    <td>
                      <a href="{{ URL::to('departements/'.$departement->id.'/edit') }}" class="btn btn-info">
                        <i class="fa fa-pencil-square-o"></i>
                      </a>
                      
                      <button type="button" class="btn btn-danger" data-toggle="modal"
                      data-target="#supp-modal{{ $departement->id }}">
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
                {{ $departements->links() }}
              </div>
            </div>
          </div>
    </section>
    <!-- /.content -->
</div>

@foreach ($departements as $departement)
  <div class="modal fade modal-danger" id="supp-modal{{ $departement->id }}" role="dialog">
    <div class="modal-dialog">
  
    <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirmier la supprission</h4>
        </div>
        <div class="modal-body">
          <p> <b>Id : </b> {{ $departement->id }}</p>
          <p> <b>Nom de departement : </b> {{ $departement->title }}</p>
          <p> <b>Abriviation: </b> {{ $departement->abreviation }}</p>
          <p> <b>Faculté: </b> {{ $departement->faculte->title }}</p>
          
          <p> Othe Data to be add later ....</p>
          

          <p> <b>Ajoute le  : </b> {{ $departement->created_at->format('F d, Y h:ia') }}</p>
        </div>
        <div class="modal-footer">
        {!! Form::open(['method' => 'DELETE', 'route' => ['departements.destroy', $departement->id]]) !!}
        <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
        {!! Form::submit('Delete', ['class' => 'btn btn-outline']) !!}
        {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>    
@endforeach

@endsection
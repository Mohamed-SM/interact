@extends('layouts.app')

@section('title', '| Enseignant')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Gestion des Enseignants       
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box">
            <div class="box-header with-border">
              <a href="{{ URL::to('enseignants/create') }}" class="btn btn-success btn-flat pull-right">Ajoute Enseignant</a>
              <h3 class="box-title">Tout les enseignants</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th>nom et prenom</th>
                  <th>grade</th>
                  <th>date de recruitement</th>
                  <th>Operation</th>
                </tr>
                
                @foreach ($enseignants as $enseignant)
                <tr>
                    <td>{{ $enseignant->user->name.' '.$enseignant->user->last_name }}</td>
                    <td>{{ $enseignant->grade->title }}</td>
                    <td>{{ $enseignant->recruited_at }}</td>
                    <td>
                      <a href="{{ URL::to('enseignants/'.$enseignant->id.'/edit') }}" class="btn btn-info">
                        <i class="fa fa-pencil-square-o"></i>
                      </a>
                      
                      <button type="button" class="btn btn-danger" data-toggle="modal"
                      data-target="#supp-modal{{ $enseignant->id }}">
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
                {{ $enseignants->links() }}
              </div>
            </div>
          </div>
    </section>
    <!-- /.content -->
</div>

@foreach ($enseignants as $enseignant)
  <div class="modal fade modal-danger" id="supp-modal{{ $enseignant->id }}" role="dialog">
    <div class="modal-dialog">
  
    <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirmier la supprission</h4>
        </div>
        <div class="modal-body">
          <p> <b>Id : </b> {{ $enseignant->id }}</p>
          <p> <b>Nom de Enseignant : </b> {{ $enseignant->title }}</p>
          <p> <b>Abriviation: </b> {{ $enseignant->priority }}</p>
          
          <p> Othe Data to be add later ....</p>
          

          <p> <b>Ajoute le  : </b> {{ $enseignant->created_at->format('F d, Y h:ia') }}</p>
        </div>
        <div class="modal-footer">
        {!! Form::open(['method' => 'DELETE', 'route' => ['enseignants.destroy', $enseignant->id]]) !!}
        <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
        {!! Form::submit('Delete', ['class' => 'btn btn-outline']) !!}
        {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>    
@endforeach

@endsection
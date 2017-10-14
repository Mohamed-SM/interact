@extends('layouts.app')

@section('title', '| Spesialites')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Gestion des Spesialites
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box">
            <div class="box-header with-border">
              <a href="{{ URL::to('spesialites/create') }}" class="btn btn-success btn-flat pull-right">Ajoute Spesialite</a>
              <h3 class="box-name">Tout les Spesialites</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th>spesialite</th>
                  <th>filier</th>
                  <th>domain</th>
                  <th>Code</th>
                  <th>Operation</th>
                </tr>
                
                @foreach ($spesialites as $spesialite)
                @if($spesialite->id==0)
                <tr>
                    <td>{{ $spesialite->name }}</td>
                    <td>/</td>
                    <td>/</td>
                    <td>SC</td>
                    <td>
                      <button type="button" class="btn btn-info disabled">
                        <i class="fa fa-pencil-square-o"></i>
                      </button>
                      <button type="button" class="btn btn-danger disabled">
                        <i class="fa fa-trash"></i>
                      </button>
                    </td>
                </tr>
                @else
                <tr>
                    <td>{{ $spesialite->name }}</td>
                    <td>{{ $spesialite->filier->name }}</td>
                    <td>{{ $spesialite->filier->domain->name }}</td>
                    <td>{{ $spesialite->code }}</td>
                    <td>
                      <a href="{{ URL::to('spesialites/'.$spesialite->id.'/edit') }}" class="btn btn-info">
                        <i class="fa fa-pencil-square-o"></i>
                      </a>
                      
                      <button type="button" class="btn btn-danger" data-toggle="modal"
                      data-target="#supp-modal{{ $spesialite->id }}">
                        <i class="fa fa-trash"></i>
                      </button>

                    </td>
                </tr>
                @endif
                @endforeach

              </tbody></table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <div class="text-center">
                {{ $spesialites->links() }}
              </div>
            </div>
          </div>
    </section>
    <!-- /.content -->
</div>

@foreach ($spesialites as $spesialite)
  <div class="modal fade modal-danger" id="supp-modal{{ $spesialite->id }}" role="dialog">
    <div class="modal-dialog">
  
    <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-name">Confirmier la supprission</h4>
        </div>
        <div class="modal-body">
          <p> <b>Id : </b> {{ $spesialite->id }}</p>
          <p> <b>Nom de filier : </b> {{ $spesialite->name }}</p>
          
          <p> Othe Data to be add later ....</p>
          

          <p> <b>Ajoute le  : </b> {{ $spesialite->created_at->format('F d, Y h:ia') }}</p>
        </div>
        <div class="modal-footer">
        {!! Form::open(['method' => 'DELETE', 'route' => ['spesialites.destroy', $spesialite->id]]) !!}
        <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
        {!! Form::submit('Delete', ['class' => 'btn btn-outline']) !!}
        {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>    
@endforeach

@endsection
@extends('layouts.app')

@section('title', '| Canvas')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Gestion des canvaés       
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box">
            <div class="box-header with-border">
              <a href="{{ URL::to('canvas/create') }}" class="btn btn-success btn-flat pull-right">Ajoute canva</a>
              <h3 class="box-title">Tout les canvaés</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th>semestre</th>
                  <th>started at</th>
                  <th>Operation</th>
                </tr>
                
                @foreach ($canvas as $canva)
                <tr>
                    <td>{{ $canva->semester->code }}</td>
                    <td>{{ $canva->started_at }}</td>
                    <td>
                      <a href="{{ URL::to('canvas/'.$canva->id) }}" class="btn btn-info">
                        <i class="fa  fa-search-plus"></i>
                      </a>
                      <a href="{{ URL::to('canvas/'.$canva->id.'/edit') }}" class="btn btn-info">
                        <i class="fa fa-pencil-square-o"></i>
                      </a>

                      
                      <button type="button" class="btn btn-danger" data-toggle="modal"
                      data-target="#supp-modal{{ $canva->id }}">
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
                {{ $canvas->links() }}
              </div>
            </div>
          </div>
    </section>
    <!-- /.content -->
</div>

@foreach ($canvas as $canva)
  <div class="modal fade modal-danger" id="supp-modal{{ $canva->id }}" role="dialog">
    <div class="modal-dialog">
  
    <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirmier la supprission</h4>
        </div>
        <div class="modal-body">
          <p> <b>Id : </b> {{ $canva->id }}</p>
          
          <p> Othe Data to be add later ....</p>
          

          <p> <b>Ajoute le  : </b> {{ $canva->created_at->format('F d, Y h:ia') }}</p>
        </div>
        <div class="modal-footer">
        {!! Form::open(['method' => 'DELETE', 'route' => ['canvas.destroy', $canva->id]]) !!}
        <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
        {!! Form::submit('Delete', ['class' => 'btn btn-outline']) !!}
        {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>    
@endforeach

@endsection
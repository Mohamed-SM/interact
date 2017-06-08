@extends('layouts.app')

@section('title', '| Permissions')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Gestion des Permissions        
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box">
            <div class="box-header with-border">
              <a href="{{ URL::to('permissions/create') }}" class="btn btn-success btn-flat pull-right">Ajoute Permission</a>
              <h3 class="box-title">Tout les permissions</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th>Permissions</th>
                  <th>Description</th>
                  <th>Operation</th>
                </tr>
                
                @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->display_name }}</td>
                    <td>{{ $permission->description }}</td> 
                    <td>
                      <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}" class="btn btn-info">
                        <i class="fa fa-pencil-square-o"></i>
                      </a>
                      
                      <button type="button" class="btn btn-danger" data-toggle="modal"
                      data-target="#supp-modal{{ $permission->id }}">
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
                {{ $permissions->links() }}
              </div>
            </div>
          </div>
    </section>
    <!-- /.content -->
</div>

@foreach ($permissions as $permission)
  <div class="modal fade modal-danger" id="supp-modal{{ $permission->id }}" role="dialog">
    <div class="modal-dialog">
  
    <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirmier la supprission</h4>
        </div>
        <div class="modal-body">
          <p> <b>Id : </b> {{ $permission->id }}</p>
          <p> <b>Nom de permission : </b> {{ $permission->name }}</p>
          <p> <b>titre de permission : </b> {{ $permission->display_name }}</p>
          <p> <b>permissions : </b> 
            <ul>
              @foreach($permission->roles()->pluck('display_name') as $role)
              <li>{{ $role }}</li>
              @endforeach
            </ul>
          </p>

          <p> <b>Ajoute le  : </b> {{ $permission->created_at->format('F d, Y h:ia') }}</p>
        </div>
        <div class="modal-footer">
        {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id]]) !!}
        <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
        {!! Form::submit('Delete', ['class' => 'btn btn-outline']) !!}
        {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>    
@endforeach

@endsection
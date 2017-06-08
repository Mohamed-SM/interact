@extends('layouts.app')

@section('title', '| Roles')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Gestion des Roles       
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box">
            <div class="box-header with-border">
              <a href="{{ URL::to('roles/create') }}" class="btn btn-success btn-flat pull-right">Ajoute Role</a>
              <h3 class="box-title">Tout les Roles</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th>Role</th>
                  <th>Permissions</th>
                  <th>Operation</th>
                </tr>
                
                @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->display_name }}</td>
                    <td>
                        <ul>
                            @foreach($role->permissions()->pluck('display_name') as $permissions)
                            <li>{{ $permissions }}</li>
                            @endforeach
                        </ul>
                    </td>{{-- Retrieve array of permissions associated to a role and convert to string --}} 
                    <td>
                      <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" class="btn btn-info">
                        <i class="fa fa-pencil-square-o"></i>
                      </a>
                      
                      <button type="button" class="btn btn-danger" data-toggle="modal"
                      data-target="#supp-modal{{ $role->id }}">
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
                {{ $roles->links() }}
              </div>
            </div>
          </div>
    </section>
    <!-- /.content -->
</div>

@foreach ($roles as $role)
  <div class="modal fade modal-danger" id="supp-modal{{ $role->id }}" role="dialog">
    <div class="modal-dialog">
  
    <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirmier la supprission</h4>
        </div>
        <div class="modal-body">
          <p> <b>Id : </b> {{ $role->id }}</p>
          <p> <b>Nom de role : </b> {{ $role->name }}</p>
          <p> <b>titre de role : </b> {{ $role->display_name }}</p>
          <p> <b>permissions : </b> 
            <ul>
              @foreach($role->permissions()->pluck('display_name') as $permissions)
              <li>{{ $permissions }}</li>
              @endforeach
            </ul>
          </p>

          <p> <b>users : </b> 
            <ul>
              @foreach($role->users()->get() as $user)
              <li>{{ $user->name .' '. $user->last_name }}</li>
              @endforeach
            </ul>
          </p>

          <p> <b>Ajoute le  : </b> {{ $role->created_at->format('F d, Y h:ia') }}</p>
        </div>
        <div class="modal-footer">
        {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id]]) !!}
        <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
        {!! Form::submit('Delete', ['class' => 'btn btn-outline']) !!}
        {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>    
@endforeach

@endsection
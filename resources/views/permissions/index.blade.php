@extends('layouts.app')

@section('title', '| Permissions')

@section('content')
<div>
    <h1><i class="fa fa-key"></i>Available Permissions

    <a href="{{ route('users.index') }}" class="btn btn-default pull-right">Users</a>
    <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a></h1>
    <hr>

    <div class="panel panel-default panel-table">
      <div class="panel-heading">
        <div class="row">
          <div class="col col-xs-6">
            <h3 class="panel-title">Panel Heading</h3>
          </div>
          <div class="col col-xs-6 text-right">
            <a href="{{ URL::to('permissions/create') }}" class="btn btn-sm btn-success btn-create"">Add Permission</a>
          </div>
        </div>
      </div>
      <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
                <th>Permissions</th>
                <th>Description</th>
                <th><em class="fa fa-cog"></em> Operation</th>
            </tr> 
          </thead>
          <tbody>
              @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->display_name }}</td>
                    <td>{{ $permission->description }}</td> 
                    <td>
                    <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
              @endforeach
           </tbody>
        </table>
      </div>
      </div>
      <div class="panel-footer">
        <div class="row">
          <div class="text-center">
            {{ $permissions->links() }}
          </div>
        </div>
      </div>
    </div>

</div>
@endsection
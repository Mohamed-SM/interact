@extends('layouts.app')

@section('title', '| Roles')

@section('content')
<div>
    <h1><i class="fa fa-key"></i> Roles

    <a href="{{ route('users.index') }}" class="btn btn-default pull-right">Users</a>
    <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a></h1>
    <hr>

    <div class="panel panel-default panel-table">
      <div class="panel-heading">
        <div class="row">
          <div class="col col-xs-6">
            <h3 class="panel-title">Panel Heading</h3>
          </div>
          <div class="col col-xs-6 text-right">
            <a href="{{ URL::to('roles/create') }}" class="btn btn-sm btn-success btn-create"">Ajouté role</a>
          </div>
        </div>
      </div>
      <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
                <th>Role</th>
                <th>Permissions</th>
                <th><em class="fa fa-cog"></em> Operation</th>
            </tr> 
          </thead>
          <tbody>
              @foreach ($roles as $role)
                <tr>

                    <td>{{ $role->name }}</td>

                    <td>
                        <ul>
                            @foreach($role->permissions()->pluck('display_name') as $permissions)
                            <li>{{ $permissions }}</li>
                            @endforeach
                        </ul>
                    </td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                    <td>
                    <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
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
            {{ $roles->links() }}
          </div>
        </div>
      </div>
    </div>

</div>

@endsection
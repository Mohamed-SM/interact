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
                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
                    <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" class="btn btn-sm btn-info">Edit</a>
                    {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) !!}
                    {!! Form::close() !!}
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


@endsection
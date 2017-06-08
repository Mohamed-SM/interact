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
                    {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
                    <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}" class="btn btn-sm btn-info">Edit</a>
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
                {{ $permissions->links() }}
              </div>
            </div>
          </div>
    </section>
    <!-- /.content -->
</div>

@endsection
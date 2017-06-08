@extends('layouts.app')

@section('title', '| Users')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Administration
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box">
            <div class="box-header with-border">
              <a href="{{ route('users.create') }}" class="btn btn-success btn-flat pull-right">Ajoute Utilisateur</a>
              <h3 class="box-title">Tout les utilisateur </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <tbody><tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date/Time Added</th>
                    <th>User Roles</th>
                    <th>Operations</th>
                </tr>
                 @foreach ($users as $user)
                <tr>

                    <td>{{ $user->name .' '.$user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                    <td>{{ $user->roles()->pluck('display_name')->implode(' ,') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
                    <td>
                    
                      <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">
                        <i class="fa fa-pencil-square-o"></i>
                      </a>
                      
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#supp-modal{{ $user->id }}">
                        <i class="fa fa-trash"></i>
                      </button>
                    
                    </td>
                </tr>
                @endforeach

                </tbody>
              </table>
            </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <div class="text-center">
                {{ $users->links() }}
              </div>
            </div>
          </div>
    </section>
    <!-- /.content -->
</div>
<!-- Modal -->
@foreach ($users as $user)
<div class="modal fade modal-danger" id="supp-modal{{ $user->id }}" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirmier la supprission</h4>
      </div>
      <div class="modal-body">
        <p> <b>Id : </b> {{ $user->id }}</p>
        <p> <b>Nom : </b> {{ $user->name .' '.$user->last_name }}</p>
        <p> <b>Email : </b> {{ $user->email }}</p>
        <p> <b>Roles : </b> {{ $user->roles()->pluck('display_name')->implode(' ,') }}</p>
        <p> <b>Ajoute le  : </b> {{ $user->created_at->format('F d, Y h:ia') }}</p>
      </div>
      <div class="modal-footer">
      {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
      <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
      {!! Form::submit('Delete', ['class' => 'btn btn-outline']) !!}
      {!! Form::close() !!}
      </div>
    </div>
    
  </div>
</div>    
@endforeach

@endsection
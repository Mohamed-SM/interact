@extends('layouts.app')

@section('title', '| Edit User')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Modifer Utilisateur : {{$user->name .' '. $user->last_name}}
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">information d'utilisateur</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT' , 'class' => 'form-horizontal')) }}

        <div class="box-body">
        <div class="form-group">
          {{ Form::label('name', 'nom' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::text('name', null, array('class' => 'form-control')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('last_name', 'prenom' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::text('last_name', null, array('class' => 'form-control')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('email', 'Email' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::email('email', null, array('class' => 'form-control')) }}
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Attacher Rôles</label>
          <div class="col-sm-10">
            <ul style="list-style-type: none;">
              @foreach ($roles as $role)
                <li>
                {{ Form::checkbox('roles[]',  $role->id ) }}
                {{ $role->name }}
                </li>
              @endforeach
            </ul>
          </div>
        </div>
        
        <p class="col-sm-offset-2 text-light-blue"><em class="fa fa-info-circle"></em> Vous pouvez lessez les champs de mot de pass vide pour ne pas modifier</p>
        <div class="form-group">
          {{ Form::label('password', 'Mot de pass' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::password('password', array('class' => 'form-control')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('password', 'Confirmier' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
          </div>
        </div>

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {{ Form::submit('Enrigistre', array('class' => 'btn col-sm-offset-2 btn-primary')) }}
        <a href="{{ config('app.url') }}/users" class="btn btn-link">Cancel</a>
      </div>
      <!-- /.box-footer -->
    {{ Form::close() }}
    </div>

  </section>
  <!-- /.content -->
</div>

@endsection
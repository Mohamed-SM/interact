@extends('layouts.app')

@section('title', '| Add Role')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Ajoute Role:
    </h1>
  </section>

    <!-- Main content -->
  <section class="content">
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">information de permission</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {{ Form::open(array('url' => 'roles' , 'class' => 'form-horizontal')) }}

        <div class="box-body">
        <div class="form-group">
          {{ Form::label('name', 'Role Name' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::text('name', '', array('class' => 'form-control')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('display_name', 'Role title' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::text('display_name', '', array('class' => 'form-control')) }}
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">
            Attacher permissins          
          </label>
          <div class="col-sm-10">
            <ul style="list-style-type: none;">
            @foreach ($permissions as $permission)
            <li>
              {{ Form::checkbox('permissions[]',  $permission->id ) }}
              {{ Form::label($permission->name, ucfirst($permission->name)) }}
            </li>
            @endforeach  
          </ul>
          </div>
        </div>


      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {{ Form::submit('Enrigistre', array('class' => 'btn col-sm-offset-2 btn-primary')) }}
        <a href="{{ config('app.url') }}/roles" class="btn btn-link">Cancel</a>
      </div>
        
      <!-- /.box-footer -->
      {{ Form::close() }}
      </div>

  </section>
  <!-- /.content -->
</div>

@endsection
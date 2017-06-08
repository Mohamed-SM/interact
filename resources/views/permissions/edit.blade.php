@extends('layouts.app')

@section('title', '| Edit Permission')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Modifer permission : {{$permission->display_name}}
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
    {{ Form::model($permission, array('route' => array('permissions.update', $permission->id ), 'method' => 'PUT' , 'class' => 'form-horizontal')) }}

        <div class="box-body">
        <div class="form-group">
          {{ Form::label('name', 'Permission' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::text('name', null, array('class' => 'form-control')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('display_name', 'titre Permission' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::text('display_name', null, array('class' => 'form-control')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('description', 'Description' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::textarea('description', null, array('class' => 'form-control')) }}
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
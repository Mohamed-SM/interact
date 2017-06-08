@extends('layouts.app')

@section('title', '| Edit Permission')

@section('content')

<div class='col-lg-12'>

    <h1><i class='fa fa-key'></i> Edit {{$permission->display_name}}</h1>
    <hr>

    {{ Form::model($permission, array('route' => array('permissions.update', $permission->id ), 'method' => 'PUT' , 'class' => 'form-horizontal')) }}{{-- Form model binding to automatically populate our fields with permission data --}}

    <div class="form-group">
        {{ Form::label('name', 'Permission Name' , array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('display_name', 'Nom a aficher' , array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
            {{ Form::text('display_name', null, array('class' => 'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('description', 'description' , array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
            {{ Form::textarea('description', null, array('class' => 'form-control')) }}
        </div>
    </div>
    <br>
    <div class="col-sm-offset-2 col-sm-10">
        {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}
    </div>
    {{ Form::close() }}

</div>

@endsection
@extends('layouts.app')

@section('title', '| Create Permission')

@section('content')

<div class='col-lg-12'>

    <h1><i class='fa fa-key'></i> Add Permission</h1>
    <hr>

    {{ Form::open(array('url' => 'permissions' , 'class' => 'form-horizontal')) }}


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
    @if(!$roles->isEmpty())
    <div class="form-group">
        <div class="control-label col-sm-2"><label>Assign to Roles</label> </div>
        <div class="col-sm-10">
        @foreach ($roles as $role) 
            {{ Form::checkbox('roles[]',  $role->id ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>
        @endforeach
        </div>
    </div>
    @endif
    <br>
    <div class="col-sm-offset-2 col-sm-10">
        {{ Form::submit('Ajouté', array('class' => 'btn btn-primary')) }}
    </div>
    {{ Form::close() }}

</div>

@endsection
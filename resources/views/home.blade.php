@extends('layouts.app')

@section('title', '| Home')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
        <small>welcom</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!<br>
                    your name is {{ auth()->user()->name .' '. auth()->user()->last_name }}.<br>
                    your roles are : 
                    @if(count(auth()->user()->roles))
                      <ul>
                      @foreach(auth()->user()->roles as $role)
                      <li>
                        {{ $role->name }}
                      </li>
                      @endforeach
                      </ul>
                    @else none.
                    @endif
                    <br>
                </div>
            </div>

    </section>
    <!-- /.content -->
  </div>
@endsection


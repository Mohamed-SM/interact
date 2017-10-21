@extends('layouts.app')

@section('title', '| Ajoute Student')

@section('plugin')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('vendor/datatables/css/dataTables.bootstrap.css') }}">
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/js/dataTables.bootstrap.min.js') }}"></script>



@endsection

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Ajoute Student:
    </h1>
  </section>

    <!-- Main content -->
  <section class="content">
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">information des etudinats</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {{ Form::open(array('url' => 'students' , 'class' => 'form-horizontal')) }}

        <div class="box-body">

        <div class="form-group">
          {{ Form::label('promo_id', 'Promo' , array('class' => 'col-sm-2 control-label')) }}
          <div class="col-sm-10">
            {{ Form::select('promo_id', $promos, null, ['id'=> 'promo', 'placeholder' => 'Promos ...' , 'class' => 'form-control']) }}
          </div>
        </div>
        
        <div class="col-sm-offset-2">
          <table id="users" class="table table-bordered table-striped ">
            <thead>
              <tr>
                <th>check</th>
                <th>Nom prenom</th>
                <th>Email</th>
                <th>Code</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr>
                <td>{{ Form::checkbox('users[]', $user->id, null) }}</td>
                <td>{{ $user->last_name.' '.$user->name }}</td>
                <td>{{ $user->email }}</td>
                <td></td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>check</th>
                <th>Nom prenom</th>
                <th>Email</th>
                <th>Code</th>
              </tr>
            </tfoot>
          </table>
        </div>
            
            

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {{ Form::submit('Enrigistre', array('class' => 'btn col-sm-offset-2 btn-primary')) }}
        <a href="{{ config('app.url') }}/students" class="btn btn-link">Cancel</a>
      </div>
        
      <!-- /.box-footer -->
      {{ Form::close() }}
      </div>

  </section>
  <!-- /.content -->
</div>
<script>
  $(function () {
    $("#users").DataTable();
  });
</script>
@endsection
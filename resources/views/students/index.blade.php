@extends('layouts.app')

@section('title', '| Student')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Gestion des Students       
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box">
            <div class="box-header with-border">
              <a href="{{ URL::to('students/create') }}" class="btn btn-success btn-flat pull-right">Ajoute Student</a>
              <h3 class="box-title">Tout les students</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th>nom et prenom</th>
                  <th>code</th>
                  <th>promo</th>
                  <th>Operation</th>
                </tr>
                
                @foreach ($students as $student)
                <tr>
                    <td>{{ $student->user->name.' '.$student->user->last_name }}</td>
                    <td></td>
                    <td>{{ $student->promo->accadimic_year->grade.$student->promo->accadimic_year->year.' '.$student->promo->accadimic_year->domain->name.' '.$student->promo->accadimic_year->filier->name.' '.$student->promo->accadimic_year->spesialite->name.' ('.$student->promo->university_year->year.'/'.($student->promo->university_year->year+1).')' }}</td>
                    <td>
                      <a href="{{ URL::to('students/'.$student->id.'/edit') }}" class="btn btn-info">
                        <i class="fa fa-pencil-square-o"></i>
                      </a>
                      
                      <button type="button" class="btn btn-danger" data-toggle="modal"
                      data-target="#supp-modal{{ $student->id }}">
                        <i class="fa fa-trash"></i>
                      </button>

                    </td>
                </tr>
                @endforeach

              </tbody></table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <div class="text-center">
                {{ $students->links() }}
              </div>
            </div>
          </div>
    </section>
    <!-- /.content -->
</div>

@foreach ($students as $student)
  <div class="modal fade modal-danger" id="supp-modal{{ $student->id }}" role="dialog">
    <div class="modal-dialog">
  
    <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirmier la supprission</h4>
        </div>
        <div class="modal-body">
          <p> <b>Id : </b> {{ $student->id }}</p>
          <p> <b>Nom de Student : </b> {{ $student->title }}</p>
          <p> <b>Abriviation: </b> {{ $student->priority }}</p>
          
          <p> Othe Data to be add later ....</p>
          

          <p> <b>Ajoute le  : </b> {{ $student->created_at->format('F d, Y h:ia') }}</p>
        </div>
        <div class="modal-footer">
        {!! Form::open(['method' => 'DELETE', 'route' => ['students.destroy', $student->id]]) !!}
        <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
        {!! Form::submit('Delete', ['class' => 'btn btn-outline']) !!}
        {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>    
@endforeach

@endsection
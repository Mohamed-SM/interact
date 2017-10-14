@extends('layouts.app')

@section('title', '| Semesters')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Gestion des Semesters
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header with-border">
              <a href="{{ URL::to('semesters/create') }}" class="btn btn-success btn-flat pull-right">Ajoute Semester</a>
              <h3 class="box-name">Tout les Semesters</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th>semester</th>
                  <th>année accadimic</th>
                  <th>Operation</th>
                </tr>
                
                @foreach ($semesters as $semester)
                <tr>
                    <td>S{{ $semester->number }}</td>
                    <td>{{ $semester->year->grade.$semester->year->year.' '.$semester->year->domain->code }} 
                      {{ $semester->year->filier->code }}
                      @if($semester->year->filier->id != 0)
                      {{ $semester->year->spesialite->code }}
                      @endif
                      ({{ $semester->year->study_year.'/'.($semester->year->study_year+1) }})</td>
                    <td>
                      <a href="{{ URL::to('semesters/'.$semester->id.'/edit') }}" class="btn btn-info">
                        <i class="fa fa-pencil-square-o"></i>
                      </a>
                      
                      <button type="button" class="btn btn-danger" data-toggle="modal"
                      data-target="#supp-modal{{ $semester->id }}">
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
                {{ $semesters->links() }}
              </div>
            </div>
          </div>
    </section>
    <!-- /.content -->
</div>

@foreach ($semesters as $semester)
  <div class="modal fade modal-danger" id="supp-modal{{ $semester->id }}" role="dialog">
    <div class="modal-dialog">
  
    <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-name">Confirmier la supprission</h4>
        </div>
        <div class="modal-body">
          <p> <b>Id : </b> {{ $semester->id }}</p>
          <p> <b>Nom de filier : </b> {{ $semester->number }}</p>
          
          <p> Othe Data to be add later ....</p>
          

          <p> <b>Ajoute le  : </b> {{ $semester->created_at->format('F d, Y h:ia') }}</p>
        </div>
        <div class="modal-footer">
        {!! Form::open(['method' => 'DELETE', 'route' => ['semesters.destroy', $semester->id]]) !!}
        <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
        {!! Form::submit('Delete', ['class' => 'btn btn-outline']) !!}
        {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>    
@endforeach

@endsection
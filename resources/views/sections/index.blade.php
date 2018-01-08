@extends('layouts.app')

@section('title', '| sections')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Gestion des sections       
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box">
            <div class="box-header with-border">
              <a href="{{ URL::to('sections/create') }}" class="btn btn-success btn-flat pull-right">Ajoute section</a>
              <h3 class="box-name">Tout les sections</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th>Section</th>
                  <th>promo</th>
                  <th>groups</th>
                  <th>Operation</th>
                </tr>
                
                @foreach ($sections as $section)
                <tr>
                    <td>{{ $section->code }}</td>
                    <td>{{ $section->promo->accadimic_year->year.$section->promo->accadimic_year->grade.' '.$section->promo->accadimic_year->domain->code.' '.$section->promo->accadimic_year->filier->code.' '.$section->promo->accadimic_year->spesialite->code.' '.$section->promo->university_year->year.'/'.($section->promo->university_year->year+1) }}</td>
                    <td>{{ count($section->groups) }} </td>
                    <td>
                      <a href="{{ URL::to('sections/'.$section->id) }}" class="btn btn-info">
                        <i class="fa fa-search"></i>
                      </a>
                      
                      <button type="button" class="btn btn-danger" data-toggle="modal"
                      data-target="#supp-modal{{ $section->id }}">
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
                {{ $sections->links() }}
              </div>
            </div>
          </div>
    </section>
    <!-- /.content -->
</div>

@foreach ($sections as $section)
  <div class="modal fade modal-danger" id="supp-modal{{ $section->id }}" role="dialog">
    <div class="modal-dialog">
  
    <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-name">Confirmier la supprission</h4>
        </div>
        <div class="modal-body">
          <p> <b>Id : </b> {{ $section->id }}</p>
          <p> <b>Nom de section : </b> {{ $section->name }}</p>
          
          <p> Othe Data to be add later ....</p>
          

          <p> <b>Ajoute le  : </b> {{ $section->created_at->format('F d, Y h:ia') }}</p>
        </div>
        <div class="modal-footer">
        {!! Form::open(['method' => 'DELETE', 'route' => ['sections.destroy', $section->id]]) !!}
        <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
        {!! Form::submit('Delete', ['class' => 'btn btn-outline']) !!}
        {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>    
@endforeach

@endsection
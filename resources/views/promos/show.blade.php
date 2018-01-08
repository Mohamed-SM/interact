@extends('layouts.app')

@section('title', '| promo')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Promo {{ $promo->accadimic_year->year.$promo->accadimic_year->grade.' '.$promo->accadimic_year->domain->code.' '.$promo->accadimic_year->filier->code.' '.$promo->accadimic_year->spesialite->code.' '.$promo->university_year->year.'/'.($promo->university_year->year+1) }}       
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box">
            <div class="box-header with-border">
              <a href="{{ URL::to('sections/create/'.$promo->id) }}" class="btn btn-success btn-flat pull-right">Ajoute section</a>
              <h3 class="box-name">Tout les sections</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th>sections</th>
                  <th>groups</th>
                  <th>nombre des etudiants</th>
                  <th>Operation</th>
                </tr>
                
                @foreach ($promo->sections as $section)
                <tr>
                    <td>{{ $section->code }}</td>
                    <td>{{ count($section->groups) }} </td>
                    <td>
                      <?php $g=0 ?>
                      @foreach($section->groups as $group)
                      <?php $g+= count($group->students); ?>
                      @endforeach
                      {{ count($promo->students).' ('.$g.' dans les groups)' }}
                    </td>
                    <td>
                      

                    </td>
                </tr>
                @endforeach

              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
    </section>
    <!-- /.content -->
</div>

@foreach ($section->groups as $group)
  <div class="modal fade modal-danger" id="supp-modal{{ $group->id }}" role="dialog">
    <div class="modal-dialog">
  
    <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-name">Confirmier la supprission</h4>
        </div>
        <div class="modal-body">
          <p> <b>Id : </b> {{ $group->id }}</p>
          <p> <b>Nom de section : </b> {{ $group->code }}</p>
          @if(count($group->students))
          <strong>il exist des etudiants dans ce group</strong>
          @endif
          <p> Othe Data to be add later ....</p>

          

          <p> <b>Ajoute le  : </b> {{ $group->created_at->format('F d, Y h:ia') }}</p>
        </div>
        <div class="modal-footer">
        {!! Form::open(['method' => 'DELETE', 'route' => ['sections.destroy', $group->id]]) !!}
        <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
        {!! Form::submit('Delete', ['class' => 'btn btn-outline']) !!}
        {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>    
@endforeach

@endsection
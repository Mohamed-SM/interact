@extends('layouts.app')

@section('title', '| groups')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Gestion des groups       
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box">
            <div class="box-header with-border">
              <a href="#" class="btn btn-success btn-flat pull-right">------------</a>
              <h3 class="box-name">Tout les groups</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th>Group</th>
                  <th>SEction</th>
                  <th>Promo</th>
                  <th>Operation</th>
                </tr>
                
                @foreach ($groups as $group)
                <tr>
                    <td>{{ $group->code }}</td>
                    <td>{{ $group->section->code }}</td>
                    <?php $promo = $group->section->promo; ?>
                    <td>{{ $promo->accadimic_year->year.$promo->accadimic_year->grade.' '.$promo->accadimic_year->domain->code.' '.$promo->accadimic_year->filier->code.' '.$promo->accadimic_year->spesialite->code.' '.$promo->university_year->year.'/'.($promo->university_year->year+1) }} </td>
                    <td>
                      <a href="{{ URL::to('groups/'.$group->id.'/edit') }}" class="btn btn-info">
                        <i class="fa fa-pencil-square-o"></i>
                      </a>
                      
                      <button type="button" class="btn btn-danger" data-toggle="modal"
                      data-target="#supp-modal{{ $group->id }}">
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
                {{ $groups->links() }}
              </div>
            </div>
          </div>
    </section>
    <!-- /.content -->
</div>

@foreach ($groups as $group)
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
          <p> <b>Nom de group : </b> {{ $group->name }}</p>
          
          <p> Othe Data to be add later ....</p>
          

          <p> <b>Ajoute le  : </b> {{ $group->created_at->format('F d, Y h:ia') }}</p>
        </div>
        <div class="modal-footer">
        {!! Form::open(['method' => 'DELETE', 'route' => ['groups.destroy', $group->id]]) !!}
        <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
        {!! Form::submit('Delete', ['class' => 'btn btn-outline']) !!}
        {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>    
@endforeach

@endsection
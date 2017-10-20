<?php

function convertToHoursMins($time, $format = '%02d:%02d') {
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}

$time_course = 0;
$time_td = 0;
$time_tp = 0;
$credits = 0;
$coefficient = 0;
$vhs = 0;
$autre = 0;

?>

@extends('layouts.app')

@section('title', '| Canva')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Canva{{ $canva->semester->code }}:
    </h1>
  </section>

    <!-- Main content -->
  <section class="content">
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">information de canva</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
      <div class="box-body">
        <table class="table table-bordered">
          <tr>
            <th rowspan="2">Unités d'enseignement<br></th>
            <th colspan="2">Matières</th>
            <th rowspan="2">crédits</th>
            <th rowspan="2">coefficient</th>
            <th colspan="3">Volume horaire<br>hebdomadaire<br></th>
            <th rowspan="2">VHS<br>(15 semaines)<br></th>
            <th rowspan="2">Autre*</th>
            <th colspan="2">Mode d'évaluation<br></th>
          </tr>
          <tr>
            <td>code</td>
            <td>intitulé</td>
            <td>cours</td>
            <td>TD</td>
            <td>TP</td>
            <td>Controle<br>Continu<br></td>
            <td>Examen</td>
          </tr>
          @foreach( $canva->units as $unit )
            <tr>
              <td rowspan="{{ count($unit->modules) }}">{{ $unit->code.' '.$unit->unit_type->title }}</td>
              @foreach( $unit->modules as $module )
                <td>{{ $module->code }}</td> 
                <td>{{ $module->title }}</td>
                <td>{{ $module->credits }}</td> <?php $credits += $module->credits; ?>
                <td>{{ $module->coefficient }}</td> <?php $coefficient += $module->coefficient; ?>
                <td>{{ convertToHoursMins($module->time_course , '%02dh%02d') }}</td>
                <?php $time_course += $module->time_course; ?>
                <td>{{ convertToHoursMins($module->time_td , '%02dh%02d') }}</td>
                <?php $time_td += $module->time_td; ?>
                <td>{{ convertToHoursMins($module->time_tp , '%02dh%02d') }}</td>
                <?php $time_tp += $module->time_tp; ?>
                <td>{{ convertToHoursMins(($module->time_course + $module->time_td + $module->time_tp )*15 , '%02dh%02d') }}</td>
                <?php $vhs += ($module->time_course + $module->time_td + $module->time_tp )*15; ?>
                <td>{{ convertToHoursMins(2700, '%02dh%02d') }}</td>
                <?php $autre += 2700; ?>
                <td>{{ $module->controle }}</td>
                <td>{{ $module->exame }}</td>
              </tr>
                @if ($module != end($unit->modules))
              <tr>  
                @endif
              @endforeach
            @endforeach
            <tr>
              <td colspan="3">Total semester {{ $canva->semester->number }} </td>
              <td>{{ $credits }}</td>
              <td>{{ $coefficient }}</td>
              <td>{{ convertToHoursMins($time_course, '%02dh%02d') }}</td>
              <td>{{ convertToHoursMins($time_td, '%02dh%02d') }}</td>
              <td>{{ convertToHoursMins($time_tp, '%02dh%02d') }}</td>
              <td>{{ convertToHoursMins($vhs, '%02dh%02d') }}</td>
              <td>{{ convertToHoursMins($autre, '%02dh%02d') }}</td>
              <td></td>
              <td></td>
            </tr>
        </table>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <a href="{{ config('app.url') }}/canvas" class="btn btn-link">retur</a>
      </div>
        
      <!-- /.box-footer -->
      {{ Form::close() }}
      </div>

  </section>
  <!-- /.content -->
</div>

@endsection
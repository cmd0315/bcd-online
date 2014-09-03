@extends('layout.inner.master')

@section('breadcrumb')
  {{ Breadcrumbs::render('system-records') }}
@stop

@section('heading')
  <h3>Which set of records do you want to update?</h3>
@stop

@section('content')
<div class="row mt centered">
  <div class="col-lg-4 dashboard-options">
      {{ HTML::image("img/add-record.png", "Employee", array('class' => 'thumb')) }}
      <h4>Employee</h4>
      <a href="{{ URL::route('employees.create')}}">Add</a> | <a href="{{ URL::route('employees.index') }}">Manage</a>
  </div>
  <div class="col-lg-4 dashboard-options">
    {{ HTML::image("img/departments.png", "Department", array('class' => 'thumb')) }}
    <h4>Department</h4>
    <a href="{{ URL::route('departments.create') }}">Add</a> | <a href="{{ URL::route('departments.index') }}">Manage</a>
  </div>
  <div class="col-lg-4 dashboard-options">
    {{ HTML::image("img/clients.png", "Client", array('class' => 'thumb')) }}
    <h4>Client</h4>
    <a href="#">Add</a> | <a href="#">Manage</a>
  </div>
</div><!-- /row -->
@stop

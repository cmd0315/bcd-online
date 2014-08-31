@extends('layout.inner.master')

@section('heading')
  <h3>Hi, {{ e(Auth::user()->employee->first_name) }} ! <br/> What Do You Want to Do?</h3>
    <div class="alert alert-info">
      <p class="text-info emphasize"> You have 2 unread notifications. View <a href="#">here.</a> </p>
    </div>
@stop

@section('content')
    <div class="row mt centered">
      <div class="col-lg-4 dashboard-options">
        <a href="#">
          {{ HTML::image("img/create-form.png", "Create Request", array('class' => 'thumb')) }}
          <h4>Create Request</h4>
          <p>Create request from selected forms</p>
        </a>
      </div><!--/col-lg-4 -->
      <div class="col-lg-4 dashboard-options">
        <a href="#">
          {{ HTML::image("img/search-records.png", "Search Submitted Forms", array('class' => 'thumb')) }}
          <h4>Search Submitted Forms</h4>
          <p>Search and view submitted forms</p>
        </a>
      </div><!--/col-lg-4 -->

      <!-- Add special function for System Admin -->
      @if(Employee::where('username', e(Auth::user()->username))->pluck('position') === 2)
        <div class="col-lg-4 dashboard-options">
          <a href="#">
            {{ HTML::image("img/add-record.png", "Manage System Records", array('class' => 'thumb')) }}
            <h4>Manage System Records</h4>
            <p>Add, edit, or delete records</p>
          </a>
        </div><!--/col-lg-4 -->
      @endif
    </div><!-- /row -->
@stop
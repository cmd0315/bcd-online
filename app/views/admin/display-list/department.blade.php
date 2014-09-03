@extends('layout.inner.master')

@section('breadcrumb')
  {{ Breadcrumbs::render('manage-departments') }}
@stop

@section('content')
<div class="row">
  <div class="col-lg-10 col-lg-offset-2">
    <h4>List of Departments ({{$departments->count()}})</h4>
    <div class="row">
        <div class="col-lg-1 col-lg-offset-6">
            <div class="btn-group">
              <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
              Sort By <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ URL::route('departments.index', array('sortBy' => 'name')) }}">Name</a></li>
                <li><a href="{{ URL::route('departments.index', array('sortBy' => 'created_at')) }}">Created At</a></li>
              </ul>
            </div><!-- .btn-group -->
          </div>
          <div class="col-lg-3">
            <form name="search" id="search" method="GET" action="{{ URL::route('departments.index') }}">
              <div class="input-group input-group-sm">
                <input type="text" class="form-control" name="search-data" id="search-data">
                <span class="input-group-btn">
                  <button class="btn btn-warning" type="submit" id="search-form-btn">Search</button>
                </span>
              </div><!-- /input-group -->
            </form>
            <div id="search-msg" style="displa:none;"></div>
        </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-8 col-lg-offset-2">
    <table class="table table-condensed table-hover">
      <thead>
        <tr>
          <td>#</td>
          <td>Department ID</td>
          <td>Name</td>
          <td>Last Updated At</td>
          <td>Created At</td>
          <td></td>
        </tr>
      </thead>
      <tbody>
      <?php $counter=0; ?>
      @foreach($departments as $department)
        @if($department->status === 1)
          <tr class="danger">
        @else
          <tr>
        @endif
          
            <td>{{ ++$counter }}</td>
            <td> <a href="{{ URL::route('departments.edit', $departmentID = e($department->department_id)) }}"> {{ $departmentID }} </td>
            <td> {{ $departmentName = e($department->department) }} </td>
            <td> {{ e(date("Y-m-d H:i a",strtotime($department->updated_at))) }} </td>
            <td> {{ e(date("Y-m-d H:i a",strtotime($department->created_at))) }} </td>
            @if(($status = e($department->status)) == 0)
              {{ Form::open(array('route' => array('departments.destroy', $id=e($department->department_id)), 'method' => 'DELETE')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                <td>{{ Form::submit('x', array('class' => 'btn btn-delete', 'style' => 'display:none;')) }}</td>
              {{ Form::close() }}
            @endif
          </tr>
      @endforeach
      </tbody>
    </table>
    {{ $departments->appends(Request::except('page'))->links(); }}
  </div>
</div><!-- .row -->

<div class="row">
  <div class="col-lg-12 text-center">
    <a href="{{ URL::route('departments.create') }}"><button type="button" class="btn btn-warning btn-lg">Add Department</button></a>
    <button type="button" class="btn btn-danger btn-lg" id="delete-btn" name="delete-btn">Deactivate Account</button>
    <button type="button" class="btn btn-lg" id="cancel-btn" name="cancel-btn" style="display:none">Cancel</button>
  </div>
</div>
@stop

@section('scripts')
<script>
  $('document').ready(function() {
    $('#delete-btn').on('click', function() {
      $('.btn-delete').css('display', 'inline-block');
      $('#delete-btn').css('display', 'none');
      $('#cancel-btn').css('display', 'inline-block');
    });

    $('#cancel-btn').on('click', function() {
      $('.btn-delete').css('display', 'none');
      $('#delete-btn').css('display', 'inline-block');
      $('#cancel-btn').css('display', 'none');
    });
  });
</script>
@stop
@extends('layout.inner.master')

@section('breadcrumb')
@stop

@section('content')
<div class="row mt">
  <div class="col-lg-12">
    <h4>List of Employees ({{$employees->count()}}) </h4>
    <table class="table table-condensed table-hover" id="employee-table">
      <thead>
        <tr>
          <td>#</td>
          <td>Name</td>
          <td>Username</td>
          <td>Status</td>
          <td>Department</td>
          <td>Position</td>
          <td>Email</td>
          <td>Mobile</td>
          <td>Last Updated At</td>
          <td>Date Joined</td>
          <td></td>
        </tr>
      </thead>
      <tbody>
      <?php $counter=0; ?>
      @foreach($employees as $employee)
        @if(($status = e($employee->account->status)) > 0)
          <tr class="danger">
        @else
          <tr>
        @endif
            <td>{{ ++$counter }}</td>
            <?php $username = e($employee->username); ?>
            <td> <a href="{{ URL::route('employees.edit', array('username' => $username)) }}">{{ e($employee->first_name) . " " . e($employee->middle_name) . " " . e($employee->last_name) }} </a></td>
            <td> {{ $username }} </td>
            <td> {{e($employee->account->status)}} </td>
            <td> {{ e($employee->department->department) }} </td>

            @if(($employee_position = e($employee->position)) == 2) 
              <td>System Admin</td>
            @elseif($employee_position == 1)
              <td>Head</td>
            @else
              <td>Member</td>
            @endif

            <td> {{ e($employee->email) }} </td>
            <td> {{ e($employee->mobile) }} </td>
            <td> {{ e($employee->account->updated_at) }} </td>
            <td> {{ e($employee->account->created_at) }} </td>
            @if(($status = e($employee->account->status)) == 0)
              {{ Form::open(array('route' => array('employees.destroy', $username=e($employee->username)), 'method' => 'DELETE')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                <td>{{ Form::submit('x', array('class' => 'btn btn-danger', 'style' => 'display:none;')) }}</td>
              {{ Form::close() }}
            @else

            @endif
          </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div><!-- .row -->
<div class="row mt">
  <div class="col-lg-12 text-center">
    <a href="{{ URL::route('employees.create') }}"><button type="button" class="btn btn-lg btn-warning">Add Employee</button></a>
    <button type="button" class="btn btn-danger btn-lg" id="delete-btn" name="delete-btn">Deactivate Account</button>
    <button type="button" class="btn btn-lg" id="cancel-btn" name="cancel-btn" style="display:none">Cancel</button>
  </div>
</div>
@stop

@section('scripts')
<script>
  $('document').ready(function() {
    $('#delete-btn').on('click', function() {
      $('.btn-danger').css('display', 'inline-block');
      $('#delete-btn').css('display', 'none');
      $('#cancel-btn').css('display', 'inline-block');
    });

    $('#cancel-btn').on('click', function() {
      $('.btn-danger').css('display', 'none');
      $('#delete-btn').css('display', 'inline-block');
      $('#cancel-btn').css('display', 'none');
    });
  });
</script>
@stop
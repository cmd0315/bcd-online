@extends('layout.inner.master')

@section('breadcrumb')
  {{ Breadcrumbs::render('manage-employees') }}
@stop

@section('content')
<div class="row mt">
  <div class="col-lg-8">
    <h4>List of Employees ({{$totalEmployees}}) </h4>
  </div>
  <div class="col-lg-4">
    <div class="input-group input-group-sm">
      <input type="text" class="form-control">
      <span class="input-group-btn">
        <button class="btn btn-warning" type="button">Search</button>
      </span>
    </div><!-- /input-group -->
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
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
            <td> <a href="{{ URL::route('employees.show', ['username' => $username]) }}">{{ e($employee->first_name) . " " . e($employee->middle_name) . " " . e($employee->last_name) }} </a></td>
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
              {{ Form::open( array('route' => 'modals.getDeactivateEmployee', 'method' => 'get','id' => 'form-modal-request') ) }}
                <input type="hidden" id="employee-username" name="employee-username" value="{{ $username }}" />
                <td>{{ Form::submit( 'X', array('class' => 'btn btn-delete', 'style' => 'display:none;') ) }}
              {{ Form::close() }}
            @endif
          </tr>
      @endforeach
      </tbody>
    </table>
    {{ $employees->appends(Request::except('page'))->links(); }}
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

@section('modal-content')
    <div class="modal-content">
      {{ Form::open(array('id' => 'modal-form', 'route' => array('employees.destroy', $username=e($employee->username)), 'method' => 'DELETE')) }}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Deactivate Employee Account</h4>
        </div>
        <div class="modal-body">
          Are you sure you want to deactivate <span id="employee-full-name">employee</span>'s account?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          {{ Form::submit('OK', array('class' => 'btn btn-warning')) }}
        </div>
      {{ Form::close() }}
    </div>
@stop

@section('scripts')
<script>
  jQuery(document).ready(function($){
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

    $('#form-modal-request').on('submit', function(){ 
                 
       // ajax get method to pass emplyee's username and name to the form data
        $.get(
            $(this).prop('action'),        {
                "employee-username": $( '#employee-username' ).val()
            },
            function(data){
              $("#modal-form").attr("action", data['action_link']);
              $('#employee-full-name').html(data['full_name']);
              $('#myModal').modal('show');
            },
            'json' 
        ); 
       
        return false;
    }); 
  });


</script>
@stop
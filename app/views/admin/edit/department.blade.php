@extends('layout.inner.master')

@section('breadcrumb')
  {{ Breadcrumbs::render('edit-department') }}
@stop

@section('content')
<div class="row mt">
  <div class="col-lg-6 col-lg-offset-1">
     {{ Form::open(array('class' => 'form-horizontal', 'route' => array('departments.update', $department_id=e($department->department_id)), 'method' => 'PUT')) }}
      <div class="row">
        <h4>Department Details</h4>
        <div class="col-lg-12">
          <div class="form-group">
            <label for="department_id" class="col-sm-4 control-label">ID</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="department_id" name="department_id" value="{{ $department_id }}" readonly>
              @if($errors->has('department_id'))
                <p class="bg-danger">{{ $errors->first('department_id') }}</p>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label for="department" class="col-sm-4 control-label">Name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="department" name="department" value="{{ e($department->department) }}">
              @if($errors->has('department'))
                <p class="bg-danger">{{ $errors->first('department') }}</p>
              @endif
            </div>
          </div>
          <div class="form-group">
              <label for="department_head" class="col-sm-4 control-label {{$departmentHeadUsername ? '' : 'text-info'}}">{{$departmentHeadUsername ? 'Current Head Employee' : 'Select New Head Employee'}}</label>
            <div class="col-sm-8">
              <select class="form-control" name="department_head" id="department_head">
                <?php $count = 0; ?>
                @foreach($employees as $employee)
                  <?php $count += 1; ?>
                  @if($departmentHeadUsername == (e($employee->username)))
                    <option value="{{ e($employee->username) }}" selected="selected"> {{ $employee_full_name = e($employee->first_name) . " " . e($employee->middle_name) . " " . e($employee->last_name) }} </option>
                  @else
                    @if($count === 1)
                      <option></option>
                    @endif
                    <option value="{{ e($employee->username) }}"> {{ $employee_full_name = e($employee->first_name) . " " . e($employee->middle_name) . " " . e($employee->last_name) }} </option>
                  @endif
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="date_added" class="col-sm-4 control-label">Date Added</label>
            <div class="col-sm-8">
              <input type="date" class="form-control" id="date_added" name="date_added" value="{{ e(date('Y-m-d',strtotime($department->created_at))) }}" readonly>
            </div>
          </div>
        </div>
      </div><!-- /row -->
      <div class="row">
        <div class="col-lg-4 col-lg-offset-8">
          <button type="submit" class="btn btn-lg btn-warning" id="submit_form" name="submit_form">Save Changes</button>
        </div>
      </div><!-- /row -->
      {{ Form::token() }}
    {{ Form::close() }}
  </div><!-- /col-lg-6 -->
  <div class="col-lg-5">
    <h5>Members</h5>
    <table class="table table-condensed table-hover">
      <thead>
        <tr>
          <td>Username</td>
          <td>Name</td>
          <td>Date Joined</td>
        </tr>
      </thead>
      <tbody>
        @if( $dept_members->count() > 0)
          @foreach($dept_members as $dept_member)
            <tr>
              <td><a href="{{ URL::route('employees.edit', $member_username = $dept_member->username) }}">{{$member_username}}</a></td>
              <td>{{ e($dept_member->first_name) . " " . e($dept_member->middle_name) . " " . e($dept_member->last_name) }}</td>
              <td>{{ e($dept_member->account->created_at) }}</td>
            </tr>
          @endforeach
        @endif
      </tbody>
    </table>
  </div><!-- .col-lg-5 -->
</div><!-- .row -->
@stop
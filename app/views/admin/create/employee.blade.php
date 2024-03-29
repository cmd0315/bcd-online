@extends('layout.inner.master')

@section('breadcrumb')
  {{ Breadcrumbs::render('create-employee') }}
@stop

@section('content')
<div class="row mt">
  <div class="col-lg-12">
    <form class="form-horizontal" role="form" method="POST" action="{{ URL::route('employees.store') }}">
      <div class="row">
        <h4>Account Details</h4>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="username" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="username" name="username"{{ (Input::old('username')) ? ' value ="' . Input::old('username') . '"' : '' }}>
              @if($errors->has('username'))
              	<p class="bg-danger">{{ $errors->first('username') }}</p>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label for="date_created" class="col-sm-2 control-label">Date</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="date_created" name="date_created" value="{{ date('Y-m-d') }}" readonly>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="password" name="password">
              @if($errors->has('password'))
              	<p class="bg-danger">{{ $errors->first('password') }}</p>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label for="password_again" class="col-sm-2 control-label">Retype Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="password_again" name="password_again">
              @if($errors->has('password_again'))
              	<p class="bg-danger">{{ $errors->first('password_again') }}</p>
              @endif
            </div>
          </div>
        </div>
      </div><!-- /row -->
      <div class="row">
        <h4>Employee Information</h4>
        <div class="col-lg-4">
          <div class="form-group">
            <label for="first_name" class="col-sm-4 control-label">First Name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="first_name" name="first_name"{{ (Input::old('first_name')) ? ' value ="' . Input::old('first_name') . '"' : '' }}>
              @if($errors->has('first_name'))
                <p class="bg-danger">{{ $errors->first('first_name') }}</p>
              @endif
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group">
            <label for="middle_name" class="col-sm-4 control-label">Middle Name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="middle_name" name="middle_name"{{ (Input::old('middle_name')) ? ' value ="' . Input::old('middle_name') . '"' : '' }}>
              @if($errors->has('middle_name'))
                <p class="bg-danger">{{ $errors->first('middle_name') }}</p>
              @endif
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group">
            <label for="last_name" class="col-sm-4 control-label">Last Name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="last_name" name="last_name"{{ (Input::old('last_name')) ? ' value ="' . Input::old('last_name') . '"' : '' }}>
              @if($errors->has('last_name'))
                <p class="bg-danger">{{ $errors->first('last_name') }}</p>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="row">
         <div class="col-lg-6">
          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="email" name="email"{{ (Input::old('email')) ? ' value ="' . Input::old('email') . '"' : '' }}>
              @if($errors->has('email'))
                <p class="bg-danger">{{ $errors->first('email') }}</p>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label for="mobile" class="col-sm-2 control-label">Mobile Number</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="mobile" name="mobile"{{ (Input::old('mobile')) ? ' value ="' . Input::old('mobile') . '"' : '' }}>
              @if($errors->has('mobile'))
                <p class="bg-danger">{{ $errors->first('mobile') }}</p>
              @endif
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="department" class="col-sm-2 control-label">Department</label>
            <div class="col-sm-10">
              	{{ Form::select('department', $departments, Input::old('department'), array('class' => 'form-control')) }}
              @if($errors->has('department'))
              	<p class="bg-danger">{{ $errors->first('department') }}</p>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label for="position" class="col-sm-2 control-label">Position</label>
            <div class="col-sm-10">
              {{ Form::select('position', array('0' => 'Member', '1' => 'Head'), Input::old('position'), array('class' => 'form-control')) }}

              @if($errors->has('position'))
              	<p class="bg-danger">{{ $errors->first('position') }}</p>
              @endif
            </div>
          </div>
        </div>
      </div><!-- /row -->
      <div class="row mt">
        <div class="col-lg-1 col-lg-offset-11">
          <button type="submit" class="btn btn-lg btn-warning" id="submit_form" name="submit_form">Submit</button>
        </div>
      </div><!-- /row -->
    </div>
    <?php
      if(Session::has('recreate'))
        $recreate = Session::get('recreate');
      else
        $recreate = 0;
    ?>
    <input type="hidden" id="recreate" name="recreate" value="{{ $recreate }}"/>
    {{ Form::token() }}
    </form><!-- /form -->
  </div>
</div><!-- /row -->
@stop
@extends('layout.inner.master')

@section('breadcrumb')
  {{ Breadcrumbs::render('add-department') }}
@stop

@section('content')
<div class="row mt">
  <div class="col-lg-6 col-lg-offset-3">
    <form class="form-horizontal" role="form" method="POST" action="{{ URL::route('departments.store') }}">
      <div class="row">
        <h4>Department Details</h4>
        <div class="col-lg-12">
          <div class="form-group">
            <label for="department_id" class="col-sm-4 control-label">ID</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="department_id" name="department_id" value="{{ $generatedID }}" readonly>
              @if($errors->has('department_id'))
                <p class="bg-danger">{{ $errors->first('department_id') }}</p>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label for="department" class="col-sm-4 control-label">Name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="department" name="department">
              @if($errors->has('department'))
                <p class="bg-danger">{{ $errors->first('department') }}</p>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label for="date_added" class="col-sm-4 control-label">Date Added</label>
            <div class="col-sm-8">
              <input type="date" class="form-control" id="date_added" name="date_added" value="{{ date('Y-m-d') }}" readonly>
            </div>
          </div>
        </div>
      </div><!-- /row -->
      <div class="row mt">
        <div class="col-lg-12 text-center">
          <button type="submit" class="btn btn-lg btn-warning" id="submit_form" name="submit_form">Submit</button>
        </div>
      </div><!-- /row -->
      {{ Form::token() }}
    </form><!-- /form -->
  </div>
</div><!-- .row -->
@stop
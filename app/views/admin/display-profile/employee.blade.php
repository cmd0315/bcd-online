@extends('layout.inner.profile.master')

@section('header-content')
<div class="row">
  <div class="col-lg-8">
    <h2 id="username">{{ $username = e($employee->username) }} <small><a href="{{ URL::route('employees.edit', $username) }}">(Edit)</a></small></h2>
    <h4 id="full-name">{{ e($employee->full_name) }}</h4>
    <p id="position-department">{{ e($employee->position_title) }}, {{ e($employee->department->department) }} Department</p>
  </div>
  <div class="col-lg-4">
    <p>Email: {{ e($employee->email) }}</p>
    @if(e($employee->mobile) !== '')
      <p>Mobile: {{ e($employee->mobile) }}</p>
    @endif
    <p>Date Joined: {{ e($employee->account->created_at) }}</p>
    <p>Last Profile Update: {{ e($employee->account->last_profile_update) }}</p>
    <br/>
    <p>Last Active: </p>
  </div>
</div>
@stop
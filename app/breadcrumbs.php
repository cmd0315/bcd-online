<?php

Breadcrumbs::register('dashboard', function($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('dashboard'));
});

Breadcrumbs::register('system-records', function($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('System Records', route('system-records'));
});

Breadcrumbs::register('create-employee', function($breadcrumbs) {
    $breadcrumbs->parent('system-records');
    $breadcrumbs->push('Create Employee Account', route('employees.create'));
});

Breadcrumbs::register('manage-employees', function($breadcrumbs) {
    $breadcrumbs->parent('system-records');
    $breadcrumbs->push('Manage Employees', route('employees.index'));
});

Breadcrumbs::register('admin-edit-employee', function($breadcrumbs) {
    $breadcrumbs->parent('manage-employees');
    $breadcrumbs->push('Edit Employee Information', route('employees.edit'));
});

Breadcrumbs::register('add-department', function($breadcrumbs) {
    $breadcrumbs->parent('system-records');
    $breadcrumbs->push('Add Department', route('departments.create'));
});

Breadcrumbs::register('manage-departments', function($breadcrumbs) {
    $breadcrumbs->parent('system-records');
    $breadcrumbs->push('Manage Departments', route('departments.index'));
});

Breadcrumbs::register('edit-department', function($breadcrumbs) {
    $breadcrumbs->parent('manage-departments');
    $breadcrumbs->push('Edit Department Information', route('departments.edit'));
});
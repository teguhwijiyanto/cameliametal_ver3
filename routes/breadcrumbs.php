<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Daily Report
Breadcrumbs::for('dailyReport.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Daily Report', route('dailyReport.index'));
});

// Workorder
Breadcrumbs::for('workorder.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Workorder', route('workorder.index'));
});

// OEE Details
Breadcrumbs::for('workorder.details', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Workorder', route('workorder.index'));
    $trail->push('Workorder Detail', route('workorder.details'));
});

// User Index
Breadcrumbs::for('admin.user.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('User', route('admin.user.index'));
});

// User Create
Breadcrumbs::for('admin.user.create', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('User', route('admin.user.index'));
    $trail->push('Create User', route('admin.user.create'));
});

// User Edit
Breadcrumbs::for('admin.user.edit', function ($trail, $user) {
    $trail->push('Home', route('home'));
    $trail->push('User', route('admin.user.index'));
    $trail->push('Edit User', route('admin.user.edit', $user));
});

// Product Index
Breadcrumbs::for('admin.product.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Product', route('admin.product.index'));
});

// Workorder Index
Breadcrumbs::for('admin.workorder.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Workorder', route('admin.workorder.index'));
});

// Workorder Create
Breadcrumbs::for('admin.workorder.create', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Workorder', route('admin.workorder.index'));
    $trail->push('Create Workorder', route('admin.workorder.create'));
});

// Workorder Edit
Breadcrumbs::for('admin.workorder.edit', function ($trail, $workorder) {
    $trail->push('Home', route('home'));
    $trail->push('Workorder', route('admin.workorder.index'));
    $trail->push('Edit Workorder', route('admin.workorder.edit', $workorder));
});

// Workorder Closed
Breadcrumbs::for('admin.workorder.closed', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Closed Workorder', route('admin.workorder.closed'));
});

// Production Index
Breadcrumbs::for('admin.production.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Production', route('admin.production.index'));
});


// Smelting Create
Breadcrumbs::for('admin.smelting.create', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Workorder', route('admin.workorder.index'));
    $trail->push('Create Smelting', route('admin.smelting.create'));
});

// OEE Index
Breadcrumbs::for('admin.oee.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('OEE', route('admin.oee.index'));
});

// Supplier Index
Breadcrumbs::for('admin.supplier.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Supplier', route('admin.supplier.index'));
});

// Supplier Create
Breadcrumbs::for('admin.supplier.create', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Supplier', route('admin.supplier.index'));
    $trail->push('Create Supplier', route('admin.supplier.create'));
});

// Supplier Edit
Breadcrumbs::for('admin.supplier.edit', function ($trail, $supplier) {
    $trail->push('Home', route('home'));
    $trail->push('Supplier', route('admin.supplier.index'));
    $trail->push('Edit Supplier', route('admin.supplier.edit', $supplier));
});

// Line Index
Breadcrumbs::for('admin.line.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Line', route('admin.line.index'));
});

// Line Create
Breadcrumbs::for('admin.line.create', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Line', route('admin.line.index'));
    $trail->push('Create Line', route('admin.line.create'));
});

// Line Edit
Breadcrumbs::for('admin.line.edit', function ($trail, $line ) {
    $trail->push('Home', route('home'));
    $trail->push('Supplier', route('admin.line.index'));
    $trail->push('Edit Line', route('admin.line.edit', $line));
});

// Machine Index
Breadcrumbs::for('admin.machine.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Machine', route('admin.machine.index'));
});

// Machine Create
Breadcrumbs::for('admin.machine.create', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Machine', route('admin.machine.index'));
    $trail->push('Create Machine', route('admin.machine.create'));
});

// Machine Edit
Breadcrumbs::for('admin.machine.edit', function ($trail, $machine ) {
    $trail->push('Home', route('home'));
    $trail->push('Machine', route('admin.machine.index'));
    $trail->push('Edit Machine', route('admin.machine.edit', $machine));
});

// Customer Index
Breadcrumbs::for('admin.customer.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Customer', route('admin.customer.index'));
});

// Customer Create
Breadcrumbs::for('admin.customer.create', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Customer', route('admin.customer.index'));
    $trail->push('Create Customer', route('admin.customer.create'));
});

// Customer Edit
Breadcrumbs::for('admin.customer.edit', function ($trail, $customer) {
    $trail->push('Home', route('home'));
    $trail->push('Customer', route('admin.customer.index'));
    $trail->push('Edit Customer', route('admin.customer.edit', $customer));
});

// Operator Schedule
Breadcrumbs::for('schedule.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Schedule', route('schedule.index'));
});

// Operator Production
Breadcrumbs::for('production.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Production', route('production.index'));
});

//Help Index
Breadcrumbs::for('help.index', function ($trail) {
    $trail->push('Home', route('help.index'));
});

// Admin Schedule
Breadcrumbs::for('admin.schedule.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Schedule', route('admin.production.index'));
});

Breadcrumbs::for('spvproduction.index', function ($trail) {
    $trail->push('Home', route('spvproduction.index'));
});




// Dayoff Index
Breadcrumbs::for('admin.dayoff.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Dayoff', route('admin.dayoff.index'));
});

// Dayoff Create
Breadcrumbs::for('admin.dayoff.create', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Dayoff', route('admin.dayoff.index'));
    $trail->push('Create Dayoff', route('admin.dayoff.create'));
});

// Dayoff Edit
Breadcrumbs::for('admin.dayoff.edit', function ($trail, $dayoff ) {
    $trail->push('Home', route('home'));
    $trail->push('Supplier', route('admin.dayoff.index'));
    $trail->push('Edit Dayoff', route('admin.dayoff.edit', $dayoff));
});

// Holiday Index
Breadcrumbs::for('admin.holiday.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Holiday', route('admin.holiday.index'));
});

// Holiday Create
Breadcrumbs::for('admin.holiday.create', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Holiday', route('admin.holiday.index'));
    $trail->push('Create Holiday', route('admin.holiday.create'));
});

// Holiday Edit
Breadcrumbs::for('admin.holiday.edit', function ($trail, $holiday ) {
    $trail->push('Home', route('home'));
    $trail->push('Supplier', route('admin.holiday.index'));
    $trail->push('Edit Holiday', route('admin.holiday.edit', $holiday));
});

// Breaktime Index
Breadcrumbs::for('admin.breaktime.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Breaktime', route('admin.breaktime.index'));
});

// Breaktime Create
Breadcrumbs::for('admin.breaktime.create', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Breaktime', route('admin.breaktime.index'));
    $trail->push('Create Breaktime', route('admin.breaktime.create'));
});

// Breaktime Edit
Breadcrumbs::for('admin.breaktime.edit', function ($trail, $breaktime ) {
    $trail->push('Home', route('home'));
    $trail->push('Supplier', route('admin.breaktime.index'));
    $trail->push('Edit Breaktime', route('admin.breaktime.edit', $breaktime));
});

// Color Index
Breadcrumbs::for('admin.color.index', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Color', route('admin.color.index'));
});

// Color Create
Breadcrumbs::for('admin.color.create', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Color', route('admin.color.index'));
    $trail->push('Create Color', route('admin.color.create'));
});

// Color Edit
Breadcrumbs::for('admin.color.edit', function ($trail, $color ) {
    $trail->push('Home', route('home'));
    $trail->push('Supplier', route('admin.color.index'));
    $trail->push('Edit Color', route('admin.color.edit', $color));
});

Breadcrumbs::for('spvshow.show', function ($trail) {
    $trail->push('Home', route('spvshow.show'));
    $trail->push('Workorder', route('admin.color.index'));
    $trail->push('Create Color', route('admin.color.create'));
});

Breadcrumbs::for('supervisor.production.show_details', function ($trail) {
    $trail->push('Home', route('supervisor.production.show_details'));
});
 
Breadcrumbs::for('operator.production.show_details', function ($trail) {
    $trail->push('Home', route('operator.production.show_details'));
});
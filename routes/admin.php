<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DataController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\SmeltingController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WorkorderController;

Route::middleware(['verified'])->group(function(){
    Route::get('user/data',[DataController::class,'users'])->name('user.data');
    Route::get('workorder/datadraft',[DataController::class,'workordersDraft'])->name('workorder.datadraft');
    Route::get('workorder/datawaiting',[DataController::class,'workordersWaiting'])->name('workorder.datawaiting');
    Route::get('workorder/dataonprocess',[DataController::class,'workordersOnProcess'])->name('workorder.dataonprocess');
    Route::get('workorder/dataclosed',[DataController::class,'workordersClosed'])->name('workorder.dataclosed');
    Route::get('production/data',[DataController::class,'productions'])->name('production.data');
    Route::get('oee/data',[DataController::class,'oees'])->name('oee.data');
    Route::get('smelting/data_wo',[DataController::class,'wo_smeltings'])->name('smelting.data_wo');
    Route::get('smelting/data',[DataController::class,'smeltings'])->name('smelting.data');
    Route::get('supplier/data',[DataController::class,'suppliers'])->name('supplier.data');
    Route::get('holiday/data',[DataController::class,'holidays'])->name('holiday.data');
    Route::get('breaktime/data',[DataController::class,'breaktimes'])->name('breaktime.data');
    Route::get('color/data',[DataController::class,'colors'])->name('color.data');
    Route::get('line/data',[DataController::class,'lines'])->name('line.data');
    Route::get('machine/data',[DataController::class,'machines'])->name('machine.data');
    Route::get('customer/data',[DataController::class,'customers'])->name('customer.data');
});

Route::middleware(['verified'])->group(function(){
    Route::post('user/reset-password',[UserController::class,'resetPassword'])->name('user.reset.password');
    Route::resource('user','UserController');
});

Route::middleware(['verified'])->group(function(){
    Route::post('smelting/getDataWo',[SmeltingController::class,'getDataWo'])->name('smelting.getDataWo');
    Route::post('smelting/addSmelting',[SmeltingController::class,'addSmelting'])->name('smelting.addSmelting');
    Route::resource('smelting','SmeltingController');
});

Route::middleware(['verified'])->group(function(){
    Route::get('workorder/closed',[WorkorderController::class,'closedWorkorder'])->name('workorder.closed');
    Route::post('workorder/updateOrder',[WorkorderController::class,'updateOrder'])->name('workorder.updateorder');
    Route::post('workorder/setWoStatus',[WorkorderController::class,'setWoStatus'])->name('workorder.setWoStatus');
    Route::post('workorder/calculatePcsPerBundle',[WorkorderController::class,'calculatePcsPerBundle'])->name('workorder.calculatePcsPerBundle');
    Route::resource('workorder','WorkorderController');
});

Route::middleware(['verified'])->resource('holiday',HolidayController::class);

Route::middleware(['verified'])->resource('production',ProductionController::class);

Route::middleware(['verified'])->resource('breaktime',BreaktimeController::class);

Route::middleware(['verified'])->resource('color',ColorController::class);

Route::middleware(['verified'])->resource('line',LineController::class);

Route::middleware(['verified'])->resource('machine',MachineController::class);

Route::middleware(['verified'])->resource('oee',OeeController::class);

Route::middleware(['verified'])->resource('shift',ShiftController::class);

Route::middleware(['verified'])->group(function(){
    Route::get('schedule/data',[ScheduleController::class,'data'])->name('schedule.data');
    Route::resource('schedule','ScheduleController');
});

Route::middleware(['verified'])->group(function(){
    Route::post('suppllier/getSupplierData',[SupplierController::class,'getSupplierData'])->name('supplier.getSupplierData');
    Route::resource('supplier','SupplierController');
});

Route::middleware(['verified'])->group(function(){
    Route::post('customer/getCustomerData',[CustomerController::class,'getCustomerData'])->name('customer.getCustomerData');
    Route::resource('customer','CustomerController');
});

Route::middleware(['verified'])->group(function(){
    Route::post('color/getColorData',[ColorController::class,'getColorData'])->name('color.getColorData');
    Route::resource('color','ColorController');
});




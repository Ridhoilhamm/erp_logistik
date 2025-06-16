<?php

use App\Exports\StockProductExport;
use App\Exports\WarehousesExport;
use App\Livewire\Auth\Login;
use App\Livewire\Home;
use App\Livewire\Menu\Dashboard\DashboardIndex;
use App\Livewire\Menu\Product\ProductCreate;
use App\Livewire\Menu\Product\ProductCreateCategory;
use App\Livewire\Menu\Product\ProductCreateUnit;
use App\Livewire\Menu\Stoks\StokBarang;
use App\Livewire\Product\Product;
use App\Livewire\Warehouse\Warehouse;
use App\Livewire\Warehouse\WarehouseCreate;
use App\Livewire\Warehouse\WarehouseEdit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Excel;

use App\Exports\WarehousesTemplateExport;
use App\Imports\WarehousesImport;
use App\Livewire\Menu\Product\ProductEdit;
use App\Livewire\Menu\Stoks\StockCreate;
use App\Livewire\Menu\Stoks\StockEdit;
use App\Livewire\Menu\Stoks\StockHistory;
use App\Livewire\Menu\Stoks\StokHistory;
use App\Livewire\Menu\Stoks\StokOut;
use App\Livewire\Menu\Tranferstoks\Stocktransferform;
use App\Livewire\Menu\Tranferstoks\Stocktransferhistory;
use Illuminate\Http\Request;

Route::get('/login', Login::class)->name('login');

Route::middleware('auth')->group(function () {

    Route::get('/logout', function () {
        Auth::logout();
        Session::regenerateToken();

        return redirect()->route('login');
    })->name('logout');

    Route::get('/menu/dashboard', DashboardIndex::class)->name('dashboard');
    Route::get('/product', Product::class)->name('product');
    Route::get('/warehouse', Warehouse::class)->name('warehouse');
    Route::get('/product/create', ProductCreate::class)->name('product-create');
    Route::get('/product/unit', ProductCreateUnit::class)->name('product-create-unit');
    Route::get('/product/create/category', ProductCreateCategory::class)->name('product-create-category');
    Route::get('/product/edit/{id}', ProductEdit::class)->name('product.edit');


    // fuction export data ke excell
    Route::get('/product/export', Product::class,  'export')->name('product-excel');
    // Route::get('/warehouse/export', Warehouse::class,  'export')->name('warehouse-excel');
    Route::get('/warehouse/export', Warehouse::class,  'export')->name('warehouse-excel');
    // Route::get('/warehouse/template/export', WarehousesTemplateExport::class,  'export')->name('warehouse-template-excel');

    //halaman create warehouse
    Route::get('/warehouse-create', WarehouseCreate::class)->name('warehouse-create');
    Route::get('/warehouse/edit/{id}', WarehouseEdit::class)->name('warehouse.edit');

    // halaman stock crud
    Route::get('/stock', StokBarang::class)->name('stock');
    Route::get('/stock/create', StockCreate::class)->name('stock.create');
    Route::get('/stock/out', StokOut::class)->name('stock.out');
    Route::get('/stock/history', StokHistory::class)->name('stock.history');
    Route::get('/stock/edit/{id}', StockEdit::class)->name('stock.edit');
    Route::get('/stock/export', StokBarang::class, 'export')->name('stock-excel');

    // halaman stockTranfers
    Route::get('/stock-transfers/create', Stocktransferform::class)->name('stock-transfers.create');
    Route::get('/stock-transfers/history', Stocktransferhistory::class)->name('stock-transfers.histori');

});

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Ruta publica al ususario final 
 *
 * @return View Login
 */

Route::get('/preview_mail', 'MailController@preview');
Route::get('/mailable', 'MailController@test');



Route::get('/','AuthController@showLogin')->name('login');

Route::post('/postLogin', 'AuthController@postLogin')->name("postLogin");

Route::get('/logout', 'AuthController@logOut')->name('logout');

/**
 * Rutas para la parte de Dashboard
 * 
 * @return View
 */


Route::get('/getCP/{id}', 'CPController@show');
//PDF
/*
Route::get('/PDFtest', 'PDFController@test');
Route::group(['prefix' => 'pdf', 'middleware' => 'auth'], function () {
    Route::get('/AlianzaQuotation', 'PDFController@alianzaQuotation');

});*/


Route::get('/getCurrency', 'NavigationController@getCurrency')->name('Currency');

Route::group(['prefix' => 'dashboard', 'middleware' => ['rol']], function () {


    Route::group(['prefix' => 'api/sap' ], function(){

        Route::get('token', 'CotizacionSAPController@AuthToken')->name('AuthToken');

    });


    /*Buscador*/
    Route::get('/buscar', 'SearcherController@search')->name('search');
    
    Route::get('/monitor', 'MonitorController@index')->name('monitor-avance');
    Route::get('/monitor/getSLP', 'MonitorController@searchSalesPersons')->name('getSLP');
    Route::get('/monitor/getAllSLP', 'MonitorController@getSalesPersons')->name('getAllSLP');
    Route::get('/monitor/getProgress', 'MonitorController@getProgress')->name('getProgress');
    Route::post('monitor/getOrdersInfo', 'MonitorController@getOrdersInfo')->name('getOrdersInfo');

    Route::group(['prefix' => 'kpi'], function(){
        Route::get('getSLPInfo', 'KPIController@getSLPInfo')->name('getSLPInfo');
        Route::get('getGralInfo', 'KPIController@getGeneralInfo')->name('getGralInfo');
        Route::get('getPartners', 'KPIController@getPartners')->name('getPartners');
        Route::get('getQuotationsFrequency', 'KPIController@getQuotationsFrequency')->name('getQuotationsFrequency');
    });


    Route::get('/', function(){

        return view('index');
    
    })->name('dashboard');



    Route::group(['prefix' => 'cuenta'], function () {
        Route::get('verPerfil', 'AccountController@index')->name('profile');
        Route::get('getInfo', 'AccountController@getInfo')->name('getInfo');
    });
    Route::group(['prefix' => 'reportes'], function () {
        Route::get('estado-cuenta/getStatement', 'StatementController@getStatement')->name('getStatement');
        Route::get('comisiones', 'CommissionsController@index')->name('commissions');
        Route::get('comisiones/getEstimateReport', 'CommissionsController@getEstimateReport')->name('getEstimateReport');
        Route::get('comisiones/getResumeReport', 'CommissionsController@getResumeReport')->name('getResumeReport');
    });
    
    Route::group(['prefix' => 'cotizaciones'], function () {

        Route::post('sap/validate', 'CotizacionSAPController@validateQuotation')->name('validateQuotation');


        /*
         * Nueva cotizacion y los resources
         */

        Route::get('nueva-cotizacion', 'CotizacionController@index')->name('nueva-cotizacion');
        Route::get('nueva-cotizacion/getCliente', 'CotizacionController@getClienteAll')->name('getCliente');
        Route::get('nueva-cotizacion/getClienteData', 'CotizacionController@getClienteData')->name('getClienteData');
        Route::get('nueva-cotizacion/getArticuloAll', 'CotizacionController@getArticuloAll' )->name('getArticuloAll');
        Route::get('nueva-cotizacion/getArticuloData', 'CotizacionController@getArticuloData')->name('getArticuloData');
        Route::get('nueva-cotizacion/getStock', 'CotizacionController@getStock')->name('getStock');
        Route::get('nueva-cotizacion/getNotasData', 'CotizacionController@getNotasData')->name('getNotasData');
        Route::post('nueva-cotizacion/sendCotizacion', 'CotizacionController@sendCotizacion')->name('sendCotizacion');
        Route::post('nueva-cotizacion/getCotizacionesAll', 'CotizacionController@getAllCotizaciones')->name('getAllCotizaciones');
        Route::post('nueva-cotizacion/getDataCotizacionReview', 'CotizacionController@getDataCotizacionReview')->name('getDataCotizacionReview');
        Route::post('nueva-cotizacion/getDataCotizacionReviewAll', 'CotizacionController@getDataCotizacionReviewAll')->name('getDataCotizacionReviewAll');
        Route::get('nueva-cotizacion/show/{id}', 'CotizacionController@show')->name('show-cotizacion');
        Route::post('nueva-cotizacion/show/payment', 'CotizacionController@setPayment')->name('setPayment');
        Route::post('nueva-cotizacion/deleteProduct', "CotizacionController@deleteProduct")->name('deleteProduct');
        Route::post('nueva-cotizacion/updateCotizacion', "CotizacionController@updateCotizacion")->name('updateCotizacion');

        Route::get('/pdf/{numCotizacion}', 'PDFController@pdfQuotation')->name('pdfQuotation');

        Route::get('alta-cliente', function () {
            return view('theme.cotizaciones.alta-cliente');
        })->name('alta-cliente');


        Route::resource('cliente_nosap', 'ClienteNoSAPController', [
            'names' => [
                'index' => 'cliente_nosap'
            ]
        ]);

        Route::get('buscar-cotizacion', 'CotizacionController@searchCoti')->name('buscar-cotizacion');
        
        Route::get('nuevo-articulo','ArticulosController@newArticulo')->name('nuevo-articulo');


        /*Clientes*/
        Route::get('clientes', function(){
            return View('theme.cotizaciones.ver-cliente');
        });
        Route::get('getClientInfo', 'CotizacionController@getClientInfo')->name('getClientInfo');
        
    });

    Route::group(['prefix' => 'transferencia'], function(){

        Route::get('/','TransferenciaController@Index');
        Route::post('/getDocument','TransferenciaController@searchDocument')->name('TransferSearchDocument');

        Route::get('/SolicitudTransferenia', 'TransferenciaController@SolicitudTransferenia')
            ->name('SolicitudTransferenia');

        Route::get('/FindAllByCardCode','TransferenciaController@FindAllByCardCode')->name('FindAllByCardCode');
        Route::get('/FindAllByCardName','TransferenciaController@FindAllByCardName')->name('FindAllByCardName');

        Route::get('/FindAllInfo', 'TransferenciaController@FindAllInfo')->name('FindAllInfo');
        Route::get('/FindAllProduct', 'TransferenciaController@FindAllProduct')->name('FindAllProduct');
        Route::get('/FindAllProductName', 'TransferenciaController@FindAllProductName')->name('FindAllProductName');
        Route::get('/FindAllProductById', 'TransferenciaController@FindAllProductById')->name('FindAllProductById');   

    });

    /*Articulos*/
    Route::get('articulos', function(){
        return View('theme.articulos.ver');
    });


    Route::group(['prefix' => 'pedidos'], function () {

        Route::group(['prefix' => 'buscar'], function () {
            Route::get('pedidos', function () {
                return view('theme.pedidos.reporte-pedidos');
            })->name('pedidos');
        });
        Route::get('buscar', function () {
            return view('theme.pedidos.buscar-pedido');
        })->name('buscar-pedido');

    });

    Route::group(['prefix' => 'entregas'], function () {
        Route::get('buscar-entregas', 'DeliverController@index')->name('buscar-entrega');
        Route::get('buscar-entregas/getAllDelivers', 'DeliverController@getAllDelivers')->name('getAllDelivers');
        Route::get('buscar-entregas/getDeliver', 'DeliverController@getDeliver')->name('getDeliver');
        Route::get('buscar-entregas/getReport', 'DeliverController@getReport')->name('getReport');
    });

    Route::group(['prefix' => 'facturas'], function () {
        Route::get('buscar-facturas', 'InvoiceController@index')->name('buscar-facturas');
        Route::get('buscar-facturas/getInvoice', 'InvoiceController@getInvoice')->name('getInvoice');
        Route::get('buscar-facturas/getAllInvoices', 'InvoiceController@getAllInvoices')->name('getAllInvoices');
        Route::get('buscar-facturas/getNewEDoc', 'InvoiceController@getNewEDoc')->name('getNewEDoc');
    });
    Route::group(['prefix' => 'solicitudes'], function () {
        
        Route::get('credito', function () {
            return view('theme.solicitudes.credito');
        })->name("scredito");

        Route::resource('alta-cliente-sap', 'ClienteSAPController', [
            'names' => [
                'index' => 'scliente'
            ]
        ]);

    });

    Route::group(['prefix' => 'administracion'], function () {

        Route::resource('notes', 'NotesController');
        
        Route::get('general', function () {
            return view('theme.administracion.general');
        })->name('general');

        Route::get('usuarios', 'AuthController@ShowUsers')->name('usuarios');
        Route::post('setRol', 'AuthController@setRol')->name('setRol');
    
        Route::resource('herramientas', 'ToolsController');

        Route::resource('slider', 'SliderController', [
            'names' => [
                'index' => 'slider'
            ]
        ]);
        Route::resource('policy', 'PolicyController', [
            'names' => [
                'index' => 'policy'
            ]
        ]);
        Route::resource('specs', 'SpecsController', [
            'names' => [
                'index' => 'specs'
            ]
        ]);

        Route::resource('capacitacion', 'CapacitacionController', [
            'names' => [
                'index' => 'capacitacion'
            ]
        ]);
        Route::resource('articulos', 'ArticulosController', [
            'names' => [
                'index' => 'articulos'
            ]
        ]);

        Route::get('personalizacion', 'MiscController@getCustomisationIndex')->name('customisation');


        /*Heplers*/
        Route::post('saveColors', 'MiscController@saveColors')->name('saveColors');
        Route::get('loadColors', 'MiscController@loadColors')->name('loadColors');
        Route::get('getArticles', 'ArticulosController@getArticles')->name('getArticles');
        Route::get('getArticleInfo', 'ArticulosController@getArticleInfo')->name('getArticleInfo');

        Route::get('biblioteca', function () {
            return view('theme.biblioteca.biblioteca');
        })->name('biblioteca');

    });    

});


Route::group(['prefix' => 'superadmin'], function () {

    Route::get('/', function(){

        return view('clean-theme.index');
    
    })->name('sDashboard'); 

    Route::get('agregar', 'SuperadminController@indexCreate')->name('create');
    Route::get('ver', 'SuperadminController@indexRead')->name('read');
    Route::get('actualizar', 'SuperadminController@indexUpdate')->name('update');
    Route::get('actualizar-f', 'SuperadminController@getUpdatePopup')->name('update-f');
    Route::get('eliminar', 'SuperadminController@indexDelete')->name('delete');
    Route::get('testSAP', 'SuperadminController@testSAP')->name('testSAP');
    Route::get('testMySQL', 'SuperadminController@testMySQL')->name('testMySQL');
    Route::get('getSQLFile', 'SuperadminController@getSQLFile')->name('getSQLFile');
    Route::post('createCompany', 'SuperadminController@createCompany')->name('createCompany');
    Route::resource('companies' ,'SuperadminController' );
});


/********
    Rutas momentaneas
*******/


Route::get('/refrencias-cruzadas', function(){
    return 'Construccion';
})->name('refrencias-cruzadas');

Route::get('/antiguedad-saldo', function(){
    return 'Construccion';
})->name('antiguedad-saldo');

Route::get('/estados-cuenta', function(){
    return 'Construccion';
})->name('estados-cuenta');


Route::get('/pruebaMBR','CPController@prueba')->name('pruebaMBR');

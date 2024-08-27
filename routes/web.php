<?php

use App\Lib\Router;
use Illuminate\Support\Facades\Route;

// User Support Ticket
Route::controller('TicketController')->prefix('ticket')->group(function () {
    Route::get('/', 'supportTicket')->name('ticket');
    Route::get('/new', 'openSupportTicket')->name('ticket.open');
    Route::post('/create', 'storeSupportTicket')->name('ticket.store');
    Route::get('/view/{ticket}', 'viewTicket')->name('ticket.view');
    Route::post('/reply/{ticket}', 'replyTicket')->name('ticket.reply');
    Route::post('/close/{ticket}', 'closeTicket')->name('ticket.close');
    Route::get('/download/{ticket}', 'ticketDownload')->name('ticket.download');
});

Route::get('app/deposit/confirm/{hash}', 'Gateway\PaymentController@appDepositConfirm')->name('deposit.app.confirm');

Route::controller('SiteController')->group(function () {

    Route::get('/contact', 'contact')->name('contact');

    Route::post('/contact', 'contactSubmit');

    Route::get('/change/{lang?}', 'changeLanguage')->name('lang');

    Route::get('cookie-policy', 'cookiePolicy')->name('cookie.policy');

    Route::get('/cookie/accept', 'cookieAccept')->name('cookie.accept');

    Route::get('blog/{slug}/{id}', 'blogDetails')->name('blog.details');

    Route::get('policy/{slug}/{id}', 'policyPages')->name('policy.pages');

    Route::get('placeholder-image/{size}', 'placeholderImage')->name('placeholder.image');

    Route::get('/community', 'community')->name('community');
    Route::post('/community-search', 'communitySearch')->name('community.search');
    Route::get('/community-details/{id}', 'communityDetails')->name('community.details');

    Route::get('/browse', 'hostel_list')->name('hostel_list');
    Route::get('/hostels-details/{slug}/{id}', 'hostel_list_details')->name('hostel_list_details');

    Route::get('/blog', 'blog_post')->name('blog_post');
    Route::get('/blog_details/{id}', 'blog_details')->name('blog_details');

    Route::post('/location-search', 'location_search')->name('location.search');

    Route::get('/{slug}', 'pages')->name('pages');

    Route::get('/', 'index')->name('home');

});




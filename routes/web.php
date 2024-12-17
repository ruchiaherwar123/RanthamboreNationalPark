<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\ContactController;
use App\Http\Controllers\backend\OnlineSafariController;
use App\Http\Controllers\backend\TourPackageController;
use App\Http\Controllers\backend\HotelController;
use App\Http\Controllers\backend\EnquiryController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\NewsController;
use App\Http\Controllers\backend\SafariResortController;
use App\Http\Controllers\IndexController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/admin/login',[App\Http\Controllers\backend\UserController::class, 'Loginadmin']);
Route::post('login',[App\Http\Controllers\backend\UserController::class, 'accptlogin']);
Route::get('logout',[App\Http\Controllers\backend\UserController::class, 'logout']);

Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');
Route::get('about-us', [App\Http\Controllers\IndexController::class, 'about'])->name('about');
Route::get('gallery', [App\Http\Controllers\IndexController::class, 'gallary'])->name('gallary');
Route::get('contact-us', [App\Http\Controllers\IndexController::class, 'contact'])->name('contact');
Route::post('/submitcontact', [App\Http\Controllers\backend\ContactController::class, 'submitcontact'])->name('submit_contact');
Route::post('submitenquiry', [App\Http\Controllers\backend\EnquiryController::class, 'submitenquiry'])->name('submit_enquiry');
Route::get('enquiry', [App\Http\Controllers\IndexController::class, 'enquiry'])->name('enquiry');
Route::get('tourist-attraction', [App\Http\Controllers\IndexController::class, 'tourist'])->name('tourist');
Route::get('geographical-details', [App\Http\Controllers\IndexController::class, 'geographical'])->name('geographical');
Route::get('frequently-asked-questions', [App\Http\Controllers\IndexController::class, 'faq'])->name('faq');
Route::get('terms-&-conditions', [App\Http\Controllers\IndexController::class, 'tandc'])->name('tandc');
Route::get('jungle-safari-in-ranthambore', [App\Http\Controllers\IndexController::class, 'jungle_safari'])->name('jungle_safari');
Route::get('flora-fauna-ranthambore', [App\Http\Controllers\IndexController::class, 'floraandfauna'])->name('floraandfauna');
Route::get('best-time-visit-ranthambore', [App\Http\Controllers\IndexController::class, 'best_time'])->name('best_time');
Route::get('plan-ranthambore-tour', [App\Http\Controllers\IndexController::class, 'how_to_plan'])->name('how_to_plan');
Route::get('fort-ranthambore-national-park', [App\Http\Controllers\IndexController::class, 'ranthambore_fort'])->name('ranthambore_fort');
Route::get('reach-ranthambore-national-park', [App\Http\Controllers\IndexController::class, 'how_to_reach'])->name('how_to_reach');
Route::get('why-ranthambore-national-park-is-famous', [App\Http\Controllers\IndexController::class, 'places_to_visit'])->name('places_to_visit');
Route::get('history-of-ranthambore-national-park', [App\Http\Controllers\IndexController::class, 'history'])->name('history');
Route::get('animals-in-ranthambore-tiger-reserve', [App\Http\Controllers\IndexController::class, 'animals'])->name('animals');
Route::get('safari-tips-ranthambore', [App\Http\Controllers\IndexController::class, 'safari_tips'])->name('safari_tips');
Route::get('birds-ranthambore', [App\Http\Controllers\IndexController::class, 'birds'])->name('birds');
Route::get('best-safari-zones-in-ranthambore', [App\Http\Controllers\IndexController::class, 'best_tiger_zone'])->name('best_tiger_zone');
Route::get('online-safari-booking', [App\Http\Controllers\IndexController::class, 'onlinesafari'])->name('onlinesafari');
Route::get('/resort-booking', [App\Http\Controllers\IndexController::class, 'hotel'])->name('hotel');
Route::get('/hotels/{name}',[App\Http\Controllers\IndexController::class, 'hotel_view'])->name('Home.hotel_view');
Route::get('/blogs',[App\Http\Controllers\IndexController::class, 'news'])->name('blogs');
Route::get('/blog/{name}',[App\Http\Controllers\IndexController::class, 'news_detail'])->name('blog');
Route::post('/online_safari_booking_submit', [App\Http\Controllers\IndexController::class, 'submit_safari'])->name('submit_online_safari_booking');
Route::get('/safari_payment',[App\Http\Controllers\IndexController::class,'safari_payment'])->name('safari_payment');
Route::post('/get-price', [App\Http\Controllers\IndexController::class, 'getPrice']);
Route::post('/book_room',[App\Http\Controllers\IndexController::class,'book_room'])->name('book_room');
Route::get('/submithotelbooking',[App\Http\Controllers\IndexController::class,'submithotelbooking'])->name('submithotelbooking');
Route::post('/submit_modal_form', [App\Http\Controllers\IndexController::class, 'submit_modal_form'])->name('submit_modal_form');
Route::get('territory-tigers', [App\Http\Controllers\IndexController::class, 'tiger_territory'])->name('tiger_territory');
Route::get('/tiger-story/{name}', [App\Http\Controllers\IndexController::class, 'tiger_story_view'])->name('tiger_story_view');
Route::get('/invoice/{id}',[App\Http\Controllers\IndexController::class,'invoice'])->name('invoice');
Route::get('/hotel_invoice/{id}',[App\Http\Controllers\backend\HotelController::class,'hotel_invoice'])->name('hotel_invoice');

Route::put('/add_follow_up_remark/{contact}', [App\Http\Controllers\IndexController::class, 'add_follow_up_remark'])->name('add_follow_up_remark');
Route::get('/ranthambore-tour-packages',[App\Http\Controllers\IndexController::class,'tourpackages'])->name('tourpackages');
Route::get('/tour-packages/{name}', [App\Http\Controllers\IndexController::class, 'tour_view'])->name('Home.tour_view');
Route::get('/payment',[App\Http\Controllers\IndexController::class, 'payment'])->name('Home.paynow');
Route::post('/payment_success',[App\Http\Controllers\backend\PaymentController::class,'payment_success'])->name('payment_success');

Route::group(['middleware'=> 'logincheck'], function(){
    #backend controller
    Route::get('/admin/dashboard', [App\Http\Controllers\backend\ContactController::class, 'index'])->name('admin_dashboard');
    Route::get('/showdetails', [App\Http\Controllers\backend\ContactController::class, 'showdetails'])->name('show_details');
    Route::delete('/delete/contact/{contact}', [App\Http\Controllers\backend\ContactController::class, 'delete_contact'])->name('destroy_contact');
    Route::get('/quick_safari_booking_details', [App\Http\Controllers\backend\ContactController::class, 'quick_safari_booking_details'])->name('quick_safari_booking_details');
    Route::delete('/delete/quick_safari_booking_details/{modal}', [App\Http\Controllers\backend\ContactController::class, 'delete_quick_safari_booking_details'])->name('destroy_quick_safari_booking_details');
    Route::get('/online_safari_booking_details', [App\Http\Controllers\backend\OnlineSafariController::class, 'showsafari_details'])->name('show_safari_details');
    Route::get('/online_safari_booking_enquiry', [App\Http\Controllers\backend\OnlineSafariController::class, 'showsafari_enquiry'])->name('show_safari_enquiry');

    Route::delete('/delete/online_safari/{onlinesafari}', [App\Http\Controllers\backend\OnlineSafariController::class, 'delete_onlinesafari'])->name('destroy_onlinesafari');
    Route::get('/view/online_safari/{id}', [App\Http\Controllers\backend\OnlineSafariController::class, 'view_onlinesafari'])->name('view_onlinesafari');
    Route::get('/hotel_booking_details', [App\Http\Controllers\backend\HotelController::class, 'show_hotel_booking_details'])->name('show_hotel_booking_details');
    Route::delete('/delete/hotel_booking/{hotelbooking}', [App\Http\Controllers\backend\HotelController::class, 'delete_hotel_booking'])->name('delete_hotel_booking');
    Route::get('/package_booking_details', [App\Http\Controllers\backend\SafariResortController::class, 'show_package_booking_details'])->name('show_package_booking_details');
    Route::delete('/delete/package_booking/{package}', [App\Http\Controllers\backend\SafariResortController::class, 'delete_package_booking'])->name('delete_package_booking');
    Route::get('/add_tour_package', [App\Http\Controllers\backend\TourPackageController::class, 'add_tour_package_form'])->name('show_add_tour_package');
    Route::post('/submit_tour_package', [App\Http\Controllers\backend\TourPackageController::class, 'submit_tour_package_form'])->name('submit_add_tour_package');
    Route::get('/tour_package_details', [App\Http\Controllers\backend\TourPackageController::class, 'show_tour_package_details'])->name('show_tour_package_details');
    Route::get('/tour_view_details/{tour}', [App\Http\Controllers\backend\TourPackageController::class, 'tour_view_details'])->name('tour_view_details');
    Route::post('/tour-package/update/{id}', [TourPackageController::class, 'update_tour_package_form'])->name('submit_update_tour_package');
    Route::get('/tour_edit_details/{id}', [App\Http\Controllers\backend\TourPackageController::class, 'tour_edit_details'])->name('tour_edit_details');
    Route::delete('/delete/tour_package/{TourPackage}', [App\Http\Controllers\backend\TourPackageController::class, 'delete_tour'])->name('destroy_tour');
    Route::get('/add_hotel', [App\Http\Controllers\backend\HotelController::class, 'add_hotel'])->name('show_hotel_form');
    Route::post('/submit_hotel', [App\Http\Controllers\backend\HotelController::class, 'submit_hotel'])->name('submit_hotel_form');
    Route::get('/hotel_details', [App\Http\Controllers\backend\HotelController::class, 'show_hotel_details'])->name('show_hotel_details');
    Route::get('/hotel_edit_details/{id}', [App\Http\Controllers\backend\HotelController::class, 'hotel_edit_detail'])->name('hotel_edit_details');
    Route::delete('/delete/hotel/{hotel}', [App\Http\Controllers\backend\HotelController::class, 'delete_hotel'])->name('destroy_hotel');
    Route::get('/enquiry_details', [App\Http\Controllers\backend\EnquiryController::class, 'show_enquiry_details'])->name('show_enquiry_details');
    Route::delete('/delete/enquiry/{enquiry}', [App\Http\Controllers\backend\EnquiryController::class, 'delete_enquiry'])->name('destroy_enquiry');
    Route::get('/latest-news',[App\Http\Controllers\backend\NewsController::class,'news'])->name('news');
    Route::post('/submit_news',[App\Http\Controllers\backend\NewsController::class,'submit_news']);
    Route::post('/upload_image', [App\Http\Controllers\backend\NewsController::class, 'uploadImage'])->name('upload_image');
    Route::get('/update_news/{id}',[App\Http\Controllers\backend\NewsController::class,'update_news'])->name('update_news');
    Route::post('/submit_update_news/{id}',[App\Http\Controllers\backend\NewsController::class,'submit_update_news']);
    Route::get('/show_news_details',[App\Http\Controllers\backend\NewsController::class,'show_news_details'])->name('show_news_details');
    Route::delete('/delete/news/{news}', [App\Http\Controllers\backend\NewsController::class, 'delete_news'])->name('destroy_news');
    Route::get('/add_tiger_story', [App\Http\Controllers\backend\ContactController::class, 'add_tiger_story'])->name('add_tiger_story');
    Route::post('/submit_tiger_story', [App\Http\Controllers\backend\ContactController::class, 'submit_tiger_story'])->name('submit_tiger_story');
    Route::post('/download_voucher',[App\Http\Controllers\IndexController::class,'download_voucher'])->name('download_voucher');
     Route::post('/download_hotel_voucher',[App\Http\Controllers\backend\HotelController::class,'download_hotel_voucher'])->name('download_hotel_voucher');

    Route::put('/updatename/{user}', [App\Http\Controllers\backend\OnlineSafariController::class, 'submit_update_name_form'])->name('submiteditname');
    Route::put('/editname/{user}', [App\Http\Controllers\backend\HotelController::class, 'submit_edit_name_form'])->name('submitusereditname');
    Route::put('/edit_username/{user}', [App\Http\Controllers\backend\SafariResortController::class, 'submit_edit_package_name_form'])->name('submiteditusername');
    Route::put('/add_remark/{contact}', [App\Http\Controllers\backend\ContactController::class, 'add_remark'])->name('add_remark');
    Route::put('/add_enquiry_remark/{enquiry}', [App\Http\Controllers\backend\EnquiryController::class, 'add_enquiry_remark'])->name('add_enquiry_remark');
    Route::put('/add_safari_remark/{user}', [App\Http\Controllers\backend\OnlineSafariController::class, 'add_safari_remark'])->name('add_safari_remark');
    Route::put('/add_hotel_remark/{user}', [App\Http\Controllers\backend\HotelController::class, 'add_hotel_remark'])->name('add_hotel_remark');
    Route::put('/add_package_remark/{user}', [App\Http\Controllers\backend\SafariResortController::class, 'add_package_remark'])->name('add_package_remark');
    Route::get('/edit_hotel_detail/{id}', [App\Http\Controllers\backend\HotelController::class, 'edit_hotel_detail'])->name('edit_hotel_detail');
    Route::post('store_edit_hotel_detail', [App\Http\Controllers\backend\HotelController::class, 'store_edit_hotel_detail'])->name('store_edit_hotel_detail');
    Route::post('submit_edit_hotel_form', [App\Http\Controllers\backend\HotelController::class, 'submit_edit_hotel_form'])->name('submit_edit_hotel_form');


    Route::get('/payment_details', [App\Http\Controllers\backend\PaymentController::class, 'show_payment_details'])->name('show_payment_details');
    Route::get('/update_payment/{id}',[App\Http\Controllers\backend\PaymentController::class,'update_payment'])->name('update_payment');
    Route::post('/submit_update_payment/{id}',[App\Http\Controllers\backend\PaymentController::class,'submit_update_payment'])->name('submit_update_payment');
    Route::delete('/delete/payment/{payment}', [App\Http\Controllers\backend\PaymentController::class, 'delete_payment'])->name('destroy_payment');
    
    Route::get('/add_blog_gallery',[App\Http\Controllers\BlogGalleryController::class,'add_blog_gallery'])->name('add_blog_gallery');
    Route::post('/submit_blog_gallery',[App\Http\Controllers\BlogGalleryController::class,'submitBlogGallery']);
	Route::get('/blog_gallery_details',[App\Http\Controllers\BlogGalleryController::class,'blog_gallery_details'])->name('blog_gallery_details');
	Route::put('/editimage/{id}', [App\Http\Controllers\BlogGalleryController::class, 'submitimageupdate'])->name('submitimageupdate');
    Route::delete('/delete/blog_gallery/{id}', [App\Http\Controllers\BlogGalleryController::class, 'delete_blog_gallery'])->name('destroy_blog_gallery');
    
    Route::get('/user_lists',[App\Http\Controllers\backend\UserController::class,'userList'])->name('user_lists');
   Route::get('change-password/{id}',[App\Http\Controllers\backend\UserController::class,'changePassword'])->name('change.password');
   Route::post('password/update',[App\Http\Controllers\backend\UserController::class,'passwordUpdate'])->name('password/update');
    });
    
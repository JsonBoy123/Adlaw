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

// Route::get('/', function(){
// 	abort(404);
// })->name('/');

// Route::get('/state_city_count/{id}',function($id){
// 	// return $id;
	
// });


Route::get('/','HomeController@index')->name('/');
Route::get('/get_city_count/{id}','HomeController@getCityCount');

// Route::get('/home','HomeController@home')->name('home');
Auth::routes();


Route::get('/verify', 'VerifyController@getVerify')->name('getverify');
Route::get('/resendVerifyCode', 'VerifyController@resendVerifyCode')->name('resendVerifyCode');
Route::post('/verify', 'VerifyController@postVerfiy')->name('verify');
Route::get('/verify/{token}', 'VerifyController@verifyUser')->name('verifyUser');



Route::get('/testphone','HomeController@testphone');
Route::get('/verified_account','HomeController@verified_account')->name('verified_account');
Route::get('cause_list_reminder','HomeController@cause_list_reminder')->name('cause_list_reminder');


// Route::view('/connect', 'connect')->name('connect');
Route::get('/connect', 'Admin\AdminController@connectLogin')->name('connect');

Route::get('/message_sent', 'HomeController@message_sent')->name('message_sent');
Route::post('/message_sent_store', 'HomeController@message_sent_store')->name('message_sent_store');

Route::get('/connectcj', 'HomeController@connectcj')->name('connectcj');


Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');
Route::get('/state','HomeController@getStateList')->name('state');
Route::get('/city_fetch', 'HomeController@getCityList')->name('city');
Route::get('/cityDropDown', 'HomeController@getCityListDropDown')->name('cityDropDown');
Route::get('/cityDropDownClient', 'HomeController@getCityListClientDropDown')->name('cityDropDownClient');
Route::post('/courtTypeFilter','HomeController@courtTypeFilter')->name('courtTypeFilter');
Route::get('/court_category/{id}','HomeController@court_category');
Route::get('/state_city_court','HomeController@state_city_court');

Route::get('/case_subcategory', 'HomeController@case_subcategory');
Route::get('/get_all_users', 'HomeController@get_all_users')->name('get_all_users');

Route::get('/service_mast_fetch/{id}', 'HomeController@service_mast_fetch')->name('service_mast_fetch');

Route::get('/service_client_mast_fetch/{id}', 'HomeController@service_client_mast_fetch')->name('service_client_mast_fetch');

Route::post('/book_an_appointment','BookingController@book_an_appointment')->name('book_an_appointment');

Route::resource('/contact','ContactController');
Route::post('/buy_crm_dashboard','ContactController@buy_crm_dashboard')->name('buy_crm_dashboard');


Route::get('/refreshCaptcha','ContactController@refreshCaptcha')->name('contact.refreshCaptcha');
Route::get('/display_blogs/{id}', 'BlogController@show_blogs')->name('display_blogs');
Route::get('/more_articles','BlogController@more_articles')->name('more_articles');
Route::get('/notifications','HomeController@all_notifications')->name('all_notifications');

Route::get('/notification_read/{id}/{id1?}','HomeController@notification_read')->name('notification_read');

Route::get('refresh_captcha', 'HomeController@refreshCaptcha')->name('refresh_captcha');
/*Start Pages View */

// Route::view('/law_data_mining','pages.law_data_mining');
// Route::view('/law_data_warehousing','pages.law_data_warehousing');
// Route::view('/law_data_analytics','pages.law_data_analytics');
// Route::view('/online_appointment','pages.online_appointment');
// Route::view('/advance_dms','pages.advance_dms');
// Route::view('/law_crm','pages.law_crm');
// Route::view('/case_law_analysis','pages.case_law_analysis');
// Route::view('/integrated_law_research','pages.integrated_law_research');
// Route::view('/legal_article_written','pages.legal_article_written');\
// Route::view('/court','pages.court');
// Route::view('/faq','pages.faq');



// Route::view('/tos','pages.subpages.tos');
// Route::view('/about-us','pages.subpages.about_us')->name('about_us');
// Route::view('/disclaimer','pages.subpages.disclaimer');
// Route::view('/privacy-policy','pages.subpages.privacy_policy')->name('privacy_policy');
// Route::view('/why-adlaw','pages.subpages.why_adlaw')->name('why_adlaw');
// Route::view('/faqs','pages.subpages.faqs')->name('faqs');
// Route::view('/contact_support', 'package.contact_support')->name('contact_support');


Route::get('/tos',function(){
	return view('pages.subpages.tos');
})->name('tos');
Route::get('/about-us',function(){
	return view('pages.subpages.about_us');
})->name('about_us');

Route::get('/disclaimer',function(){
	return view('pages.subpages.disclaimer');
})->name('disclaimer');

Route::get('/privacy-policy',function(){
	return view('pages.subpages.privacy_policy');
})->name('privacy_policy');

Route::get('/why-adlaw',function(){
	return view('pages.subpages.why_adlaw');
})->name('why_adlaw');

Route::get('/why-adlaw',function(){
	return view('pages.subpages.why_adlaw');
})->name('why_adlaw');

Route::get('/faqs',function(){
	return view('pages.subpages.faqs');
})->name('faqs');

Route::get('/contact_support',function(){
	return view('pages.subpages.contact_support');
})->name('contact_support');

Route::get('/features/law-firms',function(){
	return view('pages.subpages.lawfirms_features');
})->name('lawfirms');




Route::view('/features/law-firms','pages.subpages.lawfirms_features')->name('lawfirms');
Route::group(['prefix' => 'features/lawfirms'] ,function(){
	Route::get('/case-management',function(){
		return view('pages.features.subpages.lawfirms.case_management');
	})->name('features.case_management');

	Route::get('/client-management',function(){
		return view('pages.features.subpages.lawfirms.client_management');
	})->name('features.client_management');

	Route::get('/calendar-management',function(){
		return view('pages.features.subpages.lawfirms.calendar_management');
	})->name('features.calendar_management');

	Route::get('/document-management',function(){
		return view('pages.features.subpages.lawfirms.document_management');
	})->name('features.document_management');

	Route::get('/appointment-management',function(){
		return view('pages.features.subpages.lawfirms.appointment_schedule');
	})->name('features.appointment_schedule');

	Route::get('/schedule-management',function(){
		return view('pages.features.subpages.lawfirms.schedule_management');
	})->name('features.schedule_management');

	Route::get('/agenda-management',function(){
		return view('pages.features.subpages.lawfirms.agenda_management');
	})->name('features.agenda_management');

	Route::get('/chat-or-messanger',function(){
		return view('pages.features.subpages.lawfirms.chat_or_messanger');
	})->name('features.chat_or_messanger');

	Route::get('/team-management',function(){
		return view('pages.features.subpages.lawfirms.team_management');
	})->name('features.team_management');

	Route::get('/profile-management',function(){
		return view('pages.features.subpages.lawfirms.profile_management');
	})->name('features.profile_management');

	Route::get('/todo-management',function(){
		return view('pages.features.subpages.lawfirms.todo_management');
	})->name('features.todo_management');

	Route::get('/hearing-management',function(){
		return view('pages.features.subpages.lawfirms.hearing_management');
	})->name('features.hearing_management');

	// Route::view('/case-management','pages.features.subpages.lawfirms.case_management')->name('features.case_management');
	// Route::view('/client-management','pages.features.subpages.lawfirms.client_management')->name('features.client_management');
	// Route::view('/calendar-management','pages.features.subpages.lawfirms.calendar_management')->name('features.calendar_management');
	// Route::view('/document-management','pages.features.subpages.lawfirms.document_management')->name('features.document_management');
	// Route::view('/appointment-schedule','pages.features.subpages.lawfirms.appointment_schedule')->name('features.appointment_schedule');
	// Route::view('/schedule-management','pages.features.subpages.lawfirms.schedule_management')->name('features.schedule_management');
	// Route::view('/agenda-management','pages.features.subpages.lawfirms.agenda_management')->name('features.agenda_management');
	// Route::view('/chat-or-messanger','pages.features.subpages.lawfirms.chat_or_messanger')->name('features.chat_or_messanger');
	// Route::view('/team-management','pages.features.subpages.lawfirms.team_management')->name('features.team_management');
	// Route::view('/profile-management','pages.features.subpages.lawfirms.profile_management')->name('features.profile_management');

	// Route::view('/todo-management','pages.features.subpages.lawfirms.todo_management')->name('features.todo_management');
	// Route::view('/hearing-management','pages.features.subpages.lawfirms.hearing_management')->name('features.hearing_management');
});	


Route::get('/features/law-schools','Search\SearchController@lawSchools')->name('lawschools');
Route::group(['prefix' => 'features/lawschools'] ,function(){	

	Route::get('/search','Search\SearchController@lawschoolsSearch')->name('lawschools.search');
	Route::get('/profile/{id}', 'Search\SearchController@lawschoolsprofileShow')->name('lawschoolsprofile.show');

	Route::get('/course-management',function(){
		return view('pages.features.subpages.lawschools.course_management');
	})->name('lawschools.course_management');

	Route::get('/profile-management',function(){
		return view('pages.features.subpages.lawschools.profile_management');
	})->name('lawschools.profile_management');
	
	Route::get('/student-management',function(){
		return view('pages.features.subpages.lawschools.student_management');
	})->name('lawschools.student_management');
	
	Route::get('/document-management',function(){
		return view('pages.features.subpages.lawschools.document_management');
	})->name('lawschools.document_management');
	
	Route::get('/team-management',function(){
		return view('pages.features.subpages.lawschools.team_management');
	})->name('lawschools.team_management');

	Route::get('/agenda-management',function(){
		return view('pages.features.subpages.lawschools.agenda_management');
	})->name('lawschools.agenda_management');


	// Route::view('/course-management','pages.features.subpages.lawschools.course_management')->name('lawschools.course_management');
	// Route::view('/profile-management','pages.features.subpages.lawschools.profile_management')->name('lawschools.profile_management');
	// Route::view('/student-management','pages.features.subpages.lawschools.student_management')->name('lawschools.student_management');
	// Route::view('/document-management','pages.features.subpages.lawschools.document_management')->name('lawschools.document_management');
	// Route::view('/team-management','pages.features.subpages.lawschools.team_management')->name('lawschools.team_management');
	// Route::view('/agenda-management','pages.features.subpages.lawschools.agenda_management')->name('lawschools.agenda_management');
	// Route::view('/todo_management','pages.features.subpages.lawschools.todos_management')->name('features.todo_management');
});


Route::group(['prefix' => 'features/guest'] ,function(){	
	Route::get('/','Search\SearchController@lawfirms')->name('guest');
	

	Route::get('/search','Search\SearchController@lawfirmsSearch')->name('lawfirms.search');
	Route::post('/review','Search\SearchController@writeReview')->name('lawfirms.writeReview');

	Route::get('/profile-management',function(){
		return view('pages.features.subpages.guest.profile_management');
	})->name('guest.profile_management');
	
	Route::get('/profile-management',function(){
		return view('pages.features.subpages.guest.profile_management');
	})->name('guest.profile_management');

	Route::get('/search-management',function(){
		return view('pages.features.subpages.guest.search_lawyer');
	})->name('guest.search_lawyer');
	
	Route::get('/calendar',function(){
		return view('pages.features.subpages.guest.calendar');
	})->name('guest.calendar');

	// Route::view('/profile-management','pages.features.subpages.guest.profile_management')->name('guest.profile_management');
	// Route::view('/search-lawyer','pages.features.subpages.guest.search_lawyer')->name('guest.search_lawyer');
	// Route::view('/calendar','pages.features.subpages.guest.calendar')->name('guest.calendar');
});


// Route::resource('/admin/users', 'Admin\UsersController');
// Route::get('/admin/send-credentials/{id}','UsersController@sendCredentials');
	Route::get('search/profile/{id}', 'Search\SearchController@lawfirmsprofileShow')->name('lawfirmsprofile.show');	
	Route::get('/search/{id?}/{id1?}','Search\SearchController@search')->name('search');

/*End Pages View */

/* ---------------------Admin--------------------------------- */
Route::group(['middleware' => ['role:admin']], function() {
	Route::get('/registration','Admin\AdminController@registration')->name('registration');
	Route::get('/registration/create','Admin\AdminController@registration_create')->name('registration.create');
	Route::post('/registration','Admin\AdminController@registration_store')->name('registration.store');


	Route::get('/reports/users', 'Admin\AdminController@reports')->name('reports.index');
	Route::post('/reports/filter', 'Admin\AdminController@users_reports_filter')->name('reports.filter');


	Route::get('/admin','Admin\AdminController@index')->name('admin.index');
	Route::get('/user_data_fetch','Admin\AdminController@user_data_fetch')->name('admin.user_data_fetch');
	Route::get('/user_appointment','Admin\AdminController@user_appointment')->name('admin.user_appointment');

	Route::get('/reviews','Admin\AdminController@pending_reviews')->name('admin.pending_reviews');
	Route::get('/admin/{review_id}/active_pending_reviews','Admin\AdminController@active_pending_reviews')->name('admin.active_pending_reviews');
	Route::get('/admin/decline_pending_reviews/{review_id}','Admin\AdminController@decline_pending_reviews')->name('admin.decline_pending_reviews');
	Route::post('/admin/active_all_reviews','Admin\AdminController@active_all_reviews')->name('admin.active_all_reviews');
	Route::post('/admin/decline_all_reviews','Admin\AdminController@decline_all_reviews')->name('admin.decline_all_reviews');
	Route::resource('/blog','BlogController');
	Route::get('/blogger','Admin\AdminController@bloguser')->name('admin.bloguser');
	Route::post('/blogpremission','Admin\AdminController@blogpremission')->name('admin.blogpremission');

	Route::get('/contact_details','Admin\AdminController@contact_details')->name('admin.contact_details');
	Route::get('/show_subscription','Admin\AdminController@show_subscription')->name('admin.show_subscription');
	Route::get('/find_subscriptions','Admin\AdminController@find_subscriptions')->name('admin.find_subscriptions');
	
	Route::post('/subscription_package_active','Admin\AdminController@subscription_package_active')->name('admin.subscription_package_active');
	Route::get('/package_fetch','Admin\AdminController@package_fetch')->name('admin.package_fetch');

	Route::get('/upload','Admin\AdminController@uploadData')->name('admin.upload');

	Route::post('/importData','Admin\AdminController@importData')->name('admin.importData');

	Route::get('/import-cause-list','Admin\AdminController@cause_list')->name('admin.cause-list.index');
	Route::post('/import-cause-list/filter','Admin\AdminController@cause_list_filter')->name('admin.cause-list_filter');
	Route::post('/import-cause-list/upload','Admin\AdminController@importCauseList')->name('admin.cause-list.import');



	Route::resource('/referral','Admin\ReferralController');
	Route::get('/referral/delete/{id}','Admin\ReferralController@delete')->name('referral.delete');


// Start Master module

Route::group(['prefix' => 'master', 'namespace' => 'Admin\Master'], function ()  {

	Route::group(['prefix' => 'location'], function ()  {
		Route::resource('/country','CountryController');
		Route::resource('/city','CityController');
		Route::resource('/state','StateController');
		Route::post('/state/countryFilter','StateController@countryFilter')->name('master.countryFilter');
		Route::post('/city/cityfilter','CityController@cityfilter')->name('master.cityfilter');
	});

	Route::resource('/slots','SlotsController');	
	Route::resource('/payment_mode','PaymentModeController');	
	Route::resource('/religion','ReligionController');	
	Route::resource('/relation','RelationController');	
	Route::resource('/profession','ProfessionMastController');	
	Route::resource('/reservation','ReservationClassController');	
	Route::resource('/designation','DesignationMastController');	

	Route::group(['prefix' => 'specialization'], function ()  {
		Route::resource('/spec_category','SpecCategoryController');
		Route::resource('/spec_subcategory','SpecSubCategoryController');
		Route::post('/subCategoryFilter','SpecSubCategoryController@subCategoryFilter')->name('spec_subCategoryFilter');
	});

	Route::group(['prefix' => 'qualification'], function ()  {
		Route::resource('/qual_category','QualCategoryController');
		Route::resource('/qual_subcategory','QualSubCategoryController');
		Route::resource('/qual_doc_type','QualDocTypeController');
		Route::resource('/qual_doc_mast','QualDocMastController');
		Route::post('/qual_subCategoryFilter','QualSubCategoryController@subCategoryFilter')->name('qual_subCategoryFilter');	
	});

	Route::resource('/court/court_category','CourtCategoryController');
	Route::resource('/court/court_subcategory','CourtSubCategoryController');	
	Route::resource('/case_type','CaseTypeController');
	Route::post('/case_type/courtFilter','CaseTypeController@courtFilter')->name('courtFilter');
	// Route::resource('/master/user','Admin\Master\UserController');
// End Master

	});
	
	Route::group(['prefix' => 'acl', 'namespace' => 'Admin\ACL'], function ()  {
		Route::resource('/acl_package','PackageController');
		Route::resource('/acl_module','ModuleController');
		Route::resource('role','RoleController');
		Route::resource('permission','PermissionController');
	});

});
/* --------------------Admin---------------------------------- */

/* ------------------Lawyer-------------------Lawcompany------------- */


Route::group(['middleware' => ['role:lawyer|lawcompany|admin']], function() {
	Route::resource('/lawfirm', 'LawFirm\LawFirmController');
	Route::get('/profile', 'LawFirm\LawFirmController@showProfile')->name('lawfirms.profile');

	Route::get('/upcoming_hearings','LawFirm\LawFirmController@upcoming_hearings')->name('upcomingHearings');
	Route::get('/practicing_court', 'LawFirm\LawFirmController@practicing_court')->name('practicing_court.index');
	Route::post('/practicing_court/store', 'LawFirm\LawFirmController@store_practicing_court')->name('practicing_court.store');
	Route::get('/user_court_list','LawFirm\LawFirmController@user_court_list');

	Route::get('/landmarkcase', 'LawFirm\LawFirmController@landmarkcase')->name('landmarkcase.index');
	Route::post('/landmarkcase/store', 'LawFirm\LawFirmController@landmarkcase_store')->name('landmarkcase.store');
	Route::resource('/appointment', 'AppointmentController');	


	Route::group(['middleware' => ['permission:subscription_package']], function () {
		Route::resource('/clients', 'ClientsController');
		Route::get('/client_filter/{id}', 'ClientsController@client_filter')->name('client_filter');

		Route::get('/client_fetch/{id}', 'ClientsController@client_fetch')->name('client_fetch');
	
		Route::resource('/case_mast', 'CaseManagement\CaseMastController');
		Route::get('case_details/{id}','CaseManagement\CaseMastController@case_details')->name('case_details');

		Route::get('/cases_table','CaseManagement\CaseMastController@cases_table');
		Route::post('/case_filter','CaseManagement\CaseMastController@case_filter')->name('case_filter');
		
		Route::resource('/case_hearing', 'CaseManagement\CaseHearingController');
		Route::resource('/case_doc', 'CaseManagement\CaseDocController');
		Route::resource('/case_notes', 'CaseManagement\CaseNotesController');
		Route::resource('/case_diary', 'CaseManagement\CaseDiaryController');
		Route::post('/case_diary/filter','CaseManagement\CaseDiaryController@filter')->name('case_diary.filter');

		Route::get('cause-list','CaseManagement\CauseListController@index')->name('cause-list.index');
		Route::get('cause-list/show','CaseManagement\CauseListController@show')->name('cause-list.show');
		Route::post('cause-list/filter','CaseManagement\CauseListController@filter')->name('cause-list.filter');

		
		Route::resource('invoice','Invoice\InvoiceController');

		Route::get('invoice_test/{no}','Invoice\InvoiceController@invoice_test')->name('invoice_test');
		Route::get('invoice_create','Invoice\InvoiceController@invoice_create');
		Route::post('invoice_store','Invoice\InvoiceController@invoice_store')->name('invoice_store');

		Route::get('/case/invoice','Invoice\InvoiceController@case_related_index')->name('invoice.case_related');

		Route::post('invoice_service_add','Invoice\InvoiceController@invoice_service_add')->name('invoice.service_add');
		Route::post('invoice_service_update','Invoice\InvoiceController@invoice_service_update')->name('invoice.service_update');

		Route::get('invoice_service_delete/{id}','Invoice\InvoiceController@invoice_service_delete')->name('invoice.service_delete');

		Route::get('invoice_download/{id}','Invoice\InvoiceController@download')->name('invoice.download');
		Route::get('payment_receipt_download/{id}/{id1}','Invoice\InvoiceController@invoice_payment_receipt_download');

		Route::post('payment_receive','Invoice\InvoiceController@payment_receive')->name('payment_receive');
		Route::post('payment_history','Invoice\InvoiceController@payment_history')->name('payment_history');
		Route::get('invoice/receipt/{invc_numb}/{reciept_no}','Invoice\InvoiceController@payment_receipt')->name('invoice.receipt');


		Route::resource('invoice_service','Invoice\ServiceController');
	});

	Route::get('/fileDownload', 'CaseManagement\CaseDocController@fileDownload')->name('fileDownload');
	Route::resource('/booking','BookingController');
	Route::get('/bookingUpdate/{id}','BookingController@bookingUpdate')->name('bookingUpdate');
	Route::post('/bookingCancelled','BookingController@bookingCancelled')->name('bookingCancelled');

	
});
/* ------------------Lawyer-------------------Lawcompany------------- */

/* ------------------------Lawyer------------------------------ */
Route::group(['middleware' => ['role:lawyer']],function(){
	Route::get('/specialization','LawFirm\LawFirmController@specialization')->name('specialization.index');
	Route::post('/specialization/store','LawFirm\LawFirmController@storeSpecialization')->name('specialization.store');
	Route::get('/company_profile','LawFirm\LawFirmController@company_profile')->name('lawfirm.company_profile');
});
/* ----------------------Lawyer-------------------------------- */


/* --------------Lawyer--------Lawcompany-----------Guest---------- */
Route::group(['middleware' => ['role:lawyer|lawcompany|guest|client']], function(){
	Route::resource('/message', 'MessageController');
	Route::post('/message/reply', 'MessageController@reply')->name('message.reply');
	Route::get('/sent_messages', 'MessageController@show_send')->name('message.sent');
	Route::get('/delete/mess','MessageController@delete')->name('message.delete');
	// Route::get('/trash_message','MessageController@trash')->name('message.trash');
});
/* --------------Lawyer--------Lawcompany-----------Guest---------- */

/* --------------Lawcollege--------Teacher-----------Student---------- */
Route::group(['middleware' => ['role:lawcollege|teacher|student']], function() {

	Route::resource('/lawschools', 'LawSchools\LawSchoolsController');
	

// Route::group(['prefix' => 'features'] ,function(){	});
	Route::resource('/student', 'Student\StudentDashboardController');
	Route::resource('/student_detail', 'Student\StudentDetailController');
	Route::resource('/student_manage', 'Student\StudentManageController');
	Route::post('/forward_student', 'Student\StudentManageController@forward_tranfer_student')->name('forward_student');

	Route::post('/passout_student', 'Student\StudentManageController@passout_student')->name('passout_student');
	Route::post('/dropout_student', 'Student\StudentManageController@dropout_student')->name('dropout_student');
	Route::get('/student_record', 'Student\StudentManageController@student_record')->name('student_record');	
	// Route::post('/temporary_save', 'Student\StudentDetailController@temp_data');

	Route::post('/student_filter', 'Student\StudentDetailController@student_filter')->name('student_filter');
	Route::get('/upload_student', 'Student\StudentDashboardController@upload_student')->name('upload_student');
	Route::post('/import_student', 'Student\StudentDashboardController@importStudent')->name('import_student');
	Route::get('/student_sample', 'Student\StudentDashboardController@student_sample')->name('student_sample');
	Route::get('/all_students_export', 'Student\StudentDashboardController@all_students_export')->name('all_students_export');

	Route::get('/s_batch_wise', 'Student\StudentDashboardController@export_batch_wise')->name('s_batch_wise');
	Route::post('/batch_wise_export', 'Student\StudentDashboardController@batch_wise_export')->name('batch_wise_export');

	Route::resource('manage/batches', 'LawSchools\BatchMastController');
	
	Route::group(['prefix' => 'attendance', 'namespace' => 'LawSchools'], function ()  {

		Route::get('/dashboard', 'AttendanceController@index')->name('attendance.index');
		Route::get('/student', 'AttendanceController@student_attendance')->name('attendance.student');
		Route::post('/student_fetch', 'AttendanceController@student_fetch')->name('attendance.student_fetch');
		Route::post('/attendance_submit', 'AttendanceController@attendance_submit')->name('attendance.submit');
		Route::get('/staff', 'AttendanceController@staff_attendance')->name('attendance.staff');

		Route::get('/manage/student', 'AttendanceController@manage_student_attendance')->name('attendance.manage_student');
		Route::post('/student_filter', 'AttendanceController@student_filter')->name('attendance.student_filter');


		Route::get('/manage/staff', 'AttendanceController@manage_staff_attendance')->name('attendance.manage_staff');
		Route::post('/staff_filter', 'AttendanceController@staff_filter')->name('attendance.staff_filter');
		Route::post('/attendance_staff_update', 'AttendanceController@attendance_staff_update')->name('attendance.staff_update');

		Route::get('/manage/show_attendance/{id}', 'AttendanceController@show_attendance')->name('attendance.show_attendance');
		Route::post('/attendance_list', 'AttendanceController@attendance_list')->name('attendance.list');
		Route::post('/attendance_update', 'AttendanceController@attendance_update')->name('attendance.update');
		Route::get('/upload','AttendanceController@attendance_upload')->name('attendance.upload');
		
		Route::get('/report/student','AttendanceController@attendance_student_report')->name('attendance.student_report');

		Route::get('/report/staff','AttendanceController@attendance_staff_report')->name('attendance.staff_report');

		Route::post('/report_generate','AttendanceController@report_generate')->name('attendance.report_generate');

		Route::post('/staff_report_generate','AttendanceController@staff_report_generate')->name('attendance.staff_report_generate');

		Route::post('/attendance-staff-submit','AttendanceController@attendanceStaffSubmit')->name('attendance-staff.submit');

		Route::post('/import','AttendanceController@importAttendence')->name('attendance.import');
	});

	Route::group(['prefix' => 'fees', 'namespace' => 'LawSchools'], function ()  {
		Route::get('/dashboard','FeesController@index')->name('fees.index');

	});

	Route::group(['prefix' => 'manage/academic','namespace' => 'LawSchools'],function(){
		Route::get('/index', 'LawSchoolsController@academicCalendarIndex')->name('academic.index');
		Route::get('/create', 'LawSchoolsController@academicCalendarCreate')->name('academic.create');
		Route::post('/store', 'LawSchoolsController@academicCalendarStore')->name('academic.store');	
		Route::get('show/{id}', 'LawSchoolsController@academicCalendarShow')->name('academic.show');	
		Route::get('edit/{id}', 'LawSchoolsController@academicCalendarEdit')->name('academic.edit');	
		Route::patch('update/{id}', 'LawSchoolsController@academicCalendarUpdate')->name('academic.update');
			
		Route::get('destroy/{id}', 'LawSchoolsController@academicCalendarDestroy')->name('academic.destroy');	
	});

});
/* --------------Lawcollege--------Teacher-----------Student---------- */

/* -----------------------Lawcollege------------------------------- */
Route::group(['middleware' => ['role:lawcollege']], function() {
	Route::resource('/course',"LawSchools\CourseController");
});
/* -----------------------Lawcollege------------------------------- */


/* -----------------------Teacher------------------------------- */
Route::group(['middleware' => ['role:teacher']], function() {
	Route::get('college/profile','LawSchools\LawSchoolsController@college_profile')->name('lawschools.college_profile');
	Route::get('/college/courses','LawSchools\LawSchoolsController@college_courses')->name('lawschools.college_courses');

	Route::get('/college/courses/{id}','LawSchools\LawSchoolsController@show_course_details')->name('lawschools.show_course_details');
});
/* -------------------------Teacher----------------------------- */

/* ----------------Lawyer---------------Teacher--------------- */
Route::group(['middleware' => ['role:lawyer|teacher|lawcollege']], function() {   
	Route::resource('/qualification','QualificationController');
	Route::get('/qual_category','QualificationController@qualCategory')->name('qual.category');
	Route::get('/qual_docs','QualificationController@qual_docs');

});

/* ----------------Lawyer---------------Teacher--------------- */

Route::group(['middleware' => ['role:guest|client']], function() {
	Route::get('/customer', 'CustomerController@index')->name('customer');
	
	Route::patch('/updateProfile/{id}', 'CustomerController@updateProfile')->name('customer.update');
	Route::get('/appointmentShow', 'BookingController@appointment_show')->name('customer.appointment');
});
Route::group(['middleware' => ['role:lawyer|lawcompany|lawcollege|admin|guest|teacher|student|client']], function() {
	
	Route::get('/password_change', 'HomeController@password_change')->name('password_change');
	Route::post('/user/change-password', 'HomeController@changePassword')->name('change-password');

});
/* -------------------------------all--------------- */

Route::group(['middleware' => ['role:lawyer|lawcompany|lawcollege|admin|guest|teacher|student']], function() {

	Route::resource('/crm_dashboard','CRM\CRMController');
	Route::get('/old_subscription_package','CRM\CRMController@old_subscription_package')->name('old_subscription_package');
	Route::get('/expired_subscription','CRM\CRMController@expired_subscription')->name('expired_subscription');
	// Route::get('/expired_package','CRM\CRMController@expired_package')->name('expired_package');
	
	Route::group(['middleware' => ['permission:subscription_package']], function () {

		Route::resource('/teams','Teams\TeamController');

		Route::get('/team_users','Teams\TeamController@team_users');

		Route::resource('/users','Teams\UsersController');
		
		Route::get('/users/old_package/{id}','Teams\UsersController@old_package')->name('users.old_package');


		Route::post('/login_history', 'Teams\UsersController@login_history')->name('login_history');
		Route::post('/member_cases', 'Teams\UsersController@member_cases')->name('member_cases');

		Route::get('/assign_role/{id}', 'Teams\UsersController@assign_role')->name('assign_role');
		Route::post('/user_role_assign', 'Teams\UsersController@user_role_assign')->name('user_role_assign');

		Route::get('/assign_permission/{id}', 'Teams\UsersController@assign_permission')->name('assign_permission');

		Route::post('/filterUser', 'Teams\UsersController@filterUser')->name('filterUser');

		Route::post('/user_permission_assign', 'Teams\UsersController@user_permission_assign')->name('user_permission_assign');

		Route::resource('/todos', 'TodosController');
		Route::post('/todos/category_table_change', 'TodosController@category_table_change')->name('todo.category_table_change');
		Route::post('/status_table_change', 'TodosController@status_table_change')->name('todo.status_table_change');
		Route::post('/todo_status_update', 'TodosController@todo_status_update')->name('todos.todoUpdate');
		Route::get('/todos/form/create', 'TodosController@create_form')->name('todos.create_form');
		Route::get('/update_todo_missed', 'TodosController@update_todo_missed')->name('todos.update_todo_missed');
		Route::get('/todo_closed_reason', 'TodosController@todo_closed_reason')->name('todos.todo_closed_reason');
		Route::get('/awaiting_todo_update', 'TodosController@awaiting_todo_update')->name('todos.awaiting_todo_update');

		Route::get('/mark_as_read', 'TodosController@mark_as_read')->name('mark_as_read');
		
		Route::post('/todos_comments', 'TodosController@comments')->name('todos_comments');


		Route::resource('/calendar', 'CalendarController');
		Route::get('/case_member', 'CalendarController@case_member')->name('case_member');

		Route::get('/filestack-mgmt', 'Admin\FilestackMgmtController@index')->name('admin.filestack-mgmt');
		Route::resource('/filestacks', 'Admin\FilestackMgmtController');
		Route::post('/filestacks/get_users', 'Admin\FilestackMgmtController@get_users');
		Route::post('/filestacks/paginate', 'Admin\FilestackMgmtController@search');
		Route::post('/filestacks/updateIndex', 'Admin\FilestackMgmtController@updateIndex');
		Route::post('/filestack-mgmt/update_permissions', 'Admin\FilestackMgmtController@update_permissions');
		Route::post('/filestack-mgmt/users', 'Admin\FilestackMgmtController@get_all_users');
		Route::post('/filestack-mgmt/tags', 'Admin\FilestackMgmtController@get_filestack_type');


	Route::group(['prefix' => 'docs', 'namespace' => 'Docs'], function ()  {
		// resources
		Route::resource('/stacks', 'FilestacksController');
		Route::resource('/documents', 'DocsController');
		Route::resource('/folders', 'FoldersController');
		Route::resource('/media', 'MediaController');

		// gets
		Route::get('/', 'MainController@index')->name('docs.home');
		Route::get('/files/download/{ids}', 'DocsController@download');
		Route::get('/stacks/search/{keyword}', 'FilestacksController@search');
		Route::get('/back_to_home/{stack_id}', 'FilestacksController@backToHome');
		
		// posts
		Route::post('/move_folder', 'FoldersController@move_folder');
		Route::post('/stacks/get_count', 'FilestacksController@get_count');
		Route::post('/documents/multi_delete', 'DocsController@multi_delete');
		Route::post('/files/download', 'DocsController@download');
		Route::post('/documents/move_file', 'DocsController@move_file');
		Route::post('/documents/multi_cut_paste', 'DocsController@multi_cut_paste');
		Route::post('/documents/upload_folder', 'DocsController@uploadFolder');
	});

	Route::group(['prefix' => 'pms', 'namespace' => 'PMS'], function ()  {
		Route::resource('agenda', 'Agenda\AgendaMastController');
		Route::resource('agenda/response', 'Agenda\AgendaResponseController');
		Route::post('agenda/checks/is_strict', 'Agenda\AgendaMastController@check_is_strict');
		Route::post('/get_users','Agenda\AgendaMastController@get_users');
		// Schedule Routes
		Route::resource('/schedule', 'Schedule\ScheduleController');
		Route::post('/getschedule', 'Schedule\ScheduleController@getSchdule');
		Route::post('/updateSchedule/{id}', 'Schedule\ScheduleController@updateSchedule');
		Route::patch('/schedule/{display_id}/take_action', 'Schedule\ScheduleController@takeAction');
		Route::get('/display_reminder', 'Schedule\ScheduleController@display_reminder');
		Route::get('/allSchdule', 'Schedule\ScheduleController@allSchedule');
		Route::get('/deleteSchedule/{id}', 'Schedule\ScheduleController@destroy');
	});
});

	Route::group(['namespace' => 'Package'], function() {
		Route::resource('package','PackageController');
		Route::post('payment_success','PackageController@payment_success')->name('payment_success');
		Route::post('payment_cancel','PackageController@payment_cancel')->name('payment_cancel');

		
	});
});


Route::get('/services_approval','Admin\ServiceController@services_approval')->name('admin.service_approve');
Route::get('/services_approved/{id}/{status}','Admin\ServiceController@services_approved')->name('admin.services_approved');















// Route::get('notifyAgendaAdded/{id}/{team_id?}','PMS\Agenda\AgendaMastController@active_agenda');

// Route::get('agendaAddReminder/{id}/{team_id?}','PMS\Agenda\AgendaMastController@active_add_response');









//new route for agenda

	// Route::resource('agenda', 'Agenda\AgendaMastController');
	// Route::resource('agenda/response', 'Agenda\AgendaResponseController');
	// Route::post('agenda/checks/is_strict', 'Agenda\AgendaMastController@check_is_strict');

	// Route::get('/', 'MainController@pmsIndex')->name('pms');
	// Route::get('/team/{id}', 'MainController@teamIndex')->name('team.index'); //shows list of tools
	// Route::get('/get-media-url/{post}', 'MediaController@getMediaUrl');
	// Route::post('/fetch-comments', 'CommentsController@getComments');

	// Route::resource('/topics', 'TopicsController');
	// Route::resource('/documents', 'DocumentsController');
	// Route::resource('/media', 'MediaController');
	// Route::resource('/comments', 'CommentsController');
	// Route::resource('/posts', 'PostsController');
	
	// Route::get('/agenda_pass','Agenda\AgendaResponseController@agendaPass')->name('agenda_pass');
	// ROute::post('/agenda_submit','Agenda\AgendaResponseController@submitAgenda')->name('submit_agneda');
	
	// Route::post('/documents/search', 'DocumentsController@paginatedDocs');

	// Route::resource('/media', 'MediaController');
	// Route::get('/get-media-url/{post}', 'MediaController@getMediaUrl');




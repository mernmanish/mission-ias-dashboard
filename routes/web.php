<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\Location_master;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TestSeriesController;
use App\Http\Controllers\Admin\TestSeriesQuestionController;
use App\Http\Controllers\Admin\AssignCourseController;
use App\Http\Controllers\Admin\LiveClassController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\WebHomeController;
use App\Http\Controllers\WebAboutController;
use App\Http\Controllers\WebBookController;
use App\Http\Controllers\WebContactController;
use App\Http\Controllers\WebCourseController;
use App\Http\Controllers\WebEventController;
use App\Http\Controllers\WebNewsController;
use App\Http\Controllers\WebTestSeriesController;
use App\Models\Course;
use App\Models\Event;
use App\Models\News;
use App\Http\Middleware;


Route::get('/', function () {
    // return view('admin.login');
    // $course = Course::where('status','1')->orderBy('id','desc')->limit(6)->get();
    // $event = Event::where('status','1')->orderBy('id','desc')->limit(4)->get();
    // $news = News::where('status','1')->orderBy('id','desc')->limit(3)->get();
    return view('frontend.index');
});
Route::get('/admin', function () {
    return view('admin.login');
    // return view('frontend.index');
});


Route::get('/home',[WebHomeController::class,'index'])->name('home');
Route::get('/pay-now',[WebHomeController::class,'payNow'])->name('pay-now');
Route::post('/send-payment',[WebHomeController::class,'sendPayment'])->name('send-payment');
Route::post('/make-payment',[WebHomeController::class,'store'])->name('make-payment');

Route::get('/about-us',[WebAboutController::class,'index'])->name('about-us');
Route::get('/all-book',[WebBookController::class,'index'])->name('all-book');
Route::get('/book-order-request/{id}',[WebBookController::class,'bookOrderRequest'])->name('book-order-request');
Route::get('/contact-us',[WebContactController::class,'index'])->name('contact-us');
Route::get('/our-course',[WebCourseController::class,'index'])->name('our-course');
Route::get('/course-enquiry/{id}',[WebCourseController::class,'courseEnquiry']);
Route::get('/our-event',[WebEventController::class,'index'])->name('our-event');
Route::get('/book-event/{id}',[WebEventController::class,'bookEvent'])->name('book-event');
Route::get('/news-update',[WebNewsController::class,'index'])->name('news-update');
Route::get('/test-series',[WebTestSeriesController::class,'index'])->name('test-series');
Route::get('/test-series-request/{id}',[WebTestSeriesController::class,'testSeriesRequest'])->name('test-series-request');


// Route::get('/admin', [Auth::class, 'index']);
Route::post('/manageadminlogin', [Auth::class, 'manageadminlogin']);
Route::group(['middleware' => 'sessionadmin'], function () {
Route::get('/dashboard', [Dashboard::class, 'index']);
Route::get('/logout', [Auth::class, 'logout'])->name('logout');
Route::get('/state', [Location_master::class, 'state']);
Route::get('/admin-list', [Auth::class, 'admin_registration']);
Route::get('/Add-Admin', [Auth::class, 'create']);
Route::post('/manageadmin', [Auth::class, 'store']);
Route::get('/admindelete/{id}', [Auth::class, 'destroy']);
Route::get('/edit-admin/{id}', [Auth::class, 'edit']);
Route::post('/changeadmindata', [Auth::class,'changeadmindata']);
Route::post('/managestate', [Location_master::class, 'store']);
Route::get('/statedelete/{id}', [Location_master::class, 'destroy']);
Route::post('/changestate', [Location_master::class, 'changestatus']);
Route::get('/district', [Location_master::class, 'district']);
Route::post('/managedistrict', [Location_master::class, 'managedistrict']);
Route::get('/editdistrict/{id}',[Location_master::class,'editdistrict']);
Route::post('/changedistrict', [Location_master::class, 'changedistrict']);
Route::get('/deletedistrict/{id}', [Location_master::class, 'deletedistrict']);
Route::post('/changestates', [Location_master::class, 'changestates']);
Route::get('/editstate/{id}',[Location_master::class, 'editstate']);
Route::get('/city',[Location_master::class, 'city']);
Route::post('/managecity', [Location_master::class, 'managecity']);
Route::post('/changecitydata',[Location_master::class,'changecitydata']);
Route::get('/editcity/{id}',[Location_master::class,'editcity']);
Route::get('/deletecity/{id}',[Location_master::class,'deletecity']);
Route::post('/changesdistricts',[Location_master::class,'changesdistricts']);

Route::get('/category',[CourseController::class,'index']);

Route::post('/managecategory',[CourseController::class,'create'])->name('managecategory');
Route::get('/editcategory/{id}',[CourseController::class,'edit']);
Route::get('/deletecategory/{id}',[CourseController::class,'deletecategory']);
Route::post('/changecategories',[CourseController::class,'changecategories']);
Route::get('/addCourses',[CourseController::class,'addCourses'])->name('addCourses');
Route::get('/course-list',[CourseController::class,'courseList'])->name('course-list');
Route::post('/manage-course',[CourseController::class,'manageCourse'])->name('manage-course');
Route::get('/deletecourse/{id}',[CourseController::class,'deletecourse']);
Route::get('/edit-course/{id}',[CourseController::class,'edit_course']);
Route::post('/changecoursestatus',[CourseController::class,'changecoursestatus'])->name('changecoursestatus');
Route::post('/changeSubCategory',[CourseController::class,'changeSubCategory'])->name('changeSubCategory');

Route::get('/sub-category',[CourseController::class,'subCategory'])->name('sub-category');
Route::post('/store-subCategory',[CourseController::class,'storeSubCategory'])->name('store-subCategory');
Route::post('/changeSubCategories',[CourseController::class,'changeSubCategories'])->name('changeSubCategories');
Route::get('/editSubcategory/{id}',[CourseController::class,'editSubcategory'])->name('editSubcategory');
Route::get('/deleteSubCategory/{id}',[CourseController::class,'deleteSubCategory'])->name('deleteSubCategory');
Route::post('/changeCategory',[CourseController::class,'changeCategory'])->name('changeCategory');
Route::post('/changeSubCategoryData',[CourseController::class,'changeSubCategoryData'])->name('changeSubCategoryData');


Route::get('/course-type',[CourseController::class,'courseType'])->name('course-type');
Route::post('/store-course-type',[CourseController::class,'storeCourseType'])->name('store-course-type');
Route::post('/changesCourseType',[CourseController::class,'changesCourseType'])->name('changesCourseType');
Route::get('/editCourseType/{id}',[CourseController::class,'editCourseType'])->name('editCourseType');
Route::get('/deleteCourseType/{id}',[CourseController::class,'deleteCourseType'])->name('deleteCourseType');



Route::get('/add-video',[VideoController::class,'addVideo'])->name('add-video');
Route::get('/all-videos',[VideoController::class,'index'])->name('all-videos');
Route::post('/addVideo',[VideoController::class,'store'])->name('addVideo');
Route::post('/changeVideos',[VideoController::class,'change'])->name('changeVideos');
Route::get('/delete-video/{id}',[VideoController::class,'destroy']);
Route::get('/edit-video/{id}',[VideoController::class,'edit']);
// Route::get('/chat-list',[VideoController::class,'chatList'])->name('chat-list');
Route::post('/reply-chat-list',[VideoController::class,'replyChatList'])->name('reply-chat-list');
// Route::post('/add-reply-chat',[VideoController::class,'addReplyChat'])->name('add-reply-chat');


Route::get('/add-live-class',[LiveClassController::class,'addVideo'])->name('add-live-class');
Route::get('/all-live-class',[LiveClassController::class,'index'])->name('all-live-class');
Route::post('/addLiveClass',[LiveClassController::class,'store'])->name('addLiveClass');
Route::post('/changeLiveClass',[LiveClassController::class,'change'])->name('changeLiveClass');
Route::get('/delete-live-class/{id}',[LiveClassController::class,'destroy']);
Route::get('/edit-live-class/{id}',[LiveClassController::class,'edit']);
Route::get('/chat-list/{id}',[LiveClassController::class,'chatList']);
Route::post('/add-reply-chat',[VideoController::class,'addReplyChat'])->name('add-reply-chat');


Route::get('/all-books',[BookController::class,'index'])->name('all-books');
Route::get('/add-book',[BookController::class,'addBook'])->name('add-book');
Route::post('/store-book',[BookController::class,'store'])->name('store-book');
Route::post('/changeBooks',[BookController::class,'change'])->name('changeBooks');
Route::get('/delete-book/{id}',[BookController::class,'destroy']);
Route::get('/edit-book/{id}',[BookController::class,'edit']);


Route::get('/all-study-material',[MaterialController::class,'index'])->name('all-study-material');
Route::get('/add-study-material',[MaterialController::class,'addStudyMaterial'])->name('add-study-material');
Route::post('/create-study-material',[MaterialController::class,'store'])->name('create-study-material');
Route::get('/edit-study-material/{id}',[MaterialController::class,'edit'])->name('edit-study-material');
Route::get('/delete-study-material/{id}',[MaterialController::class,'delete'])->name('delete-study-material');
Route::post('/changeMaterials',[MaterialController::class,'changeMaterials'])->name('changeMaterials');

Route::get('/all-event',[EventController::class,'index'])->name('all-event');
Route::get('/add-event',[EventController::class,'add'])->name('add-event');
Route::post('/addEvent',[EventController::class,'store'])->name('addEvent');
Route::get('/edit-event/{id}',[EventController::class,'edit'])->name('edit-event');
Route::get('/delete-event/{id}',[EventController::class,'delete'])->name('delete-event');
Route::post('/changeEvents',[EventController::class,'change'])->name('changeEvents');


Route::get('/all-banner',[BannerController::class,'index'])->name('all-banner');
Route::get('/add-banner',[BannerController::class,'add'])->name('add-banner');
Route::post('/addBanner',[BannerController::class,'store'])->name('addBanner');
Route::get('/edit-banner/{id}',[BannerController::class,'edit'])->name('edit-banner');
Route::get('/delete-banner/{id}',[BannerController::class,'delete'])->name('delete-banner');
Route::post('/changeBanner',[BannerController::class,'change'])->name('changeBanner');


Route::get('/all-news',[NewsController::class,'index'])->name('all-news');
Route::get('/add-news',[NewsController::class,'add'])->name('add-news');
Route::post('/addNews',[NewsController::class,'store'])->name('addNews');
Route::get('/edit-news/{id}',[NewsController::class,'edit'])->name('edit-news');
Route::get('/delete-news/{id}',[NewsController::class,'delete'])->name('delete-news');
Route::post('/changeNews',[NewsController::class,'change'])->name('changeNews');


Route::get('/all-users',[UserController::class,'index'])->name('all-users');
Route::get('/user_list',[UserController::class,'userList'])->name('user_list');
Route::get('/delete-user-data/{id}',[UserController::class,'delete']);
Route::get('/login-users',[UserController::class,'loginUser'])->name('login-users');
Route::get('/user-bulk-upload',[UserController::class,'userBulkUpload'])->name('user-bulk-upload');
Route::post('/import-user-excel',[UserController::class,'importUserExcel'])->name('import-user-excel');


Route::get('/notification',[NotificationController::class,'index'])->name('notification');
Route::post('/send-notification',[NotificationController::class,'sendNotification'])->name('send-notification');


Route::get('/all-test-series',[TestSeriesController::class,'index'])->name('all-test-series');
Route::get('/add-test-series',[TestSeriesController::class,'create'])->name('add-test-series');
Route::post('/addTestSeries',[TestSeriesController::class,'store'])->name('addTestSeries');
Route::get('/edit-test-series/{id}',[TestSeriesController::class,'edit'])->name('edit-test-series');
Route::get('/delete-test-series/{id}',[TestSeriesController::class,'delete'])->name('delete-test-series');
Route::post('/ChangeTestSeries',[TestSeriesController::class,'change'])->name('ChangeTestSeries');
Route::get('/test-score/{id}',[TestSeriesController::class,'testScore'])->name('test-score');


Route::get('/add-test-series-question/{id}',[TestSeriesQuestionController::class,'add'])->name('add-test-series-question');
Route::get('/view-test-series-question/{id}',[TestSeriesQuestionController::class,'index'])->name('view-test-series-question');
Route::post('/addTestSeriesQuestion',[TestSeriesQuestionController::class,'store'])->name('addTestSeriesQuestion');
Route::get('/view-question-details/{id}',[TestSeriesQuestionController::class,'viewQuestionDetails'])->name('view-question-details');
Route::get('/delete-test-question/{id}',[TestSeriesQuestionController::class,'destroy'])->name('delete-test-question');
Route::get('/edit-test-question/{id}',[TestSeriesQuestionController::class,'edit'])->name('edit-test-question');
Route::post('/importTestSeriesQuestion',[TestSeriesQuestionController::class,'importTestSeriesQuestion'])->name('importTestSeriesQuestion');



Route::get('/all-assign-course',[AssignCourseController::class,'index'])->name('all-assign-course');
Route::get('/add-assign-course',[AssignCourseController::class,'addAssignCourse'])->name('add-assign-course');
Route::get('/assign-bulk-upload',[AssignCourseController::class,'assignBulkUpload'])->name('assign-bulk-upload');
Route::get('/delete-assign-course/{id}',[AssignCourseController::class,'delete'])->name('delete-assign-course');
Route::post('/searchUser',[AssignCourseController::class,'searchUser'])->name('searchUser');
Route::post('/getAssignCourse',[AssignCourseController::class,'getAssignCourse'])->name('getAssignCourse');
Route::post('/store-assign-course',[AssignCourseController::class,'store'])->name('store-assign-course');
Route::post('/changeAssign',[AssignCourseController::class,'change'])->name('changeAssign');
Route::post('/import-assign-excel',[AssignCourseController::class,'import'])->name('import-assign-excel');
Route::get('/online-payment',[AssignCourseController::class,'onlinePayment'])->name('online-payment');
Route::post('/searchAssignedCourse',[AssignCourseController::class,'searchAssignedCourse'])->name('searchAssignedCourse');



// Frontend Route View


// Route::get('/all-assign-course',[TestSeriesQuestionController::class,'index'])->name('all-assign-course');


});


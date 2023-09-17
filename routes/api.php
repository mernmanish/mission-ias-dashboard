<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\VideoController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\StudyMaterialController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\TestSeriesController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\LiveClassController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});
Route::post('/user-registration', [AuthController::class,'registration']);
Route::post('/user-login', [AuthController::class,'login']);
Route::get('/login', [AuthController::class,'login'])->name('login');
Route::post('/send-otp', [AuthController::class,'sendOTP'])->name('send-otp');
Route::post('/change-password', [AuthController::class,'changePassword'])->name('change-password');
Route::middleware('auth:api')->get('/course-list',[CourseController::class,'courseList']);
Route::middleware('auth:api')->get('/assign-course-list',[CourseController::class,'assignCourseList']);
Route::middleware('auth:api')->post('/course-details',[CourseController::class,'courseDetails']);
Route::middleware('auth:api')->get('/category-list',[CourseController::class,'categoryList']);
Route::middleware('auth:api')->get('/course-type-list/{id}',[CourseController::class,'courseTypeList']);
Route::middleware('auth:api')->get('/sub-category-list',[CourseController::class,'subCategoryList']);
Route::middleware('auth:api')->post('/course-purchase',[CourseController::class,'coursePurchase']);
Route::middleware('auth:api')->post('/verify_payment',[CourseController::class,'verifyPayment']);

Route::middleware('auth:api')->get('/video-list',[VideoController::class,'videoList']);
Route::middleware('auth:api')->post('/course-video-list',[VideoController::class,'courseVideoList']);

Route::middleware('auth:api')->get('/live-class-list',[LiveClassController::class,'liveClassList']);
Route::middleware('auth:api')->post('/course-live-class-list',[LiveClassController::class,'courseLiveClassList']);

Route::middleware('auth:api')->get('/banner-list',[BannerController::class,'bannerList']);

Route::middleware('auth:api')->get('/news-list/{id}',[NewsController::class,'newsList']);

Route::middleware('auth:api')->get('/material-list/{id}',[StudyMaterialController::class,'materialList']);
Route::middleware('auth:api')->post('/download-material',[StudyMaterialController::class,'downloadMaterial']);
Route::middleware('auth:api')->get('/delete-material/{id}',[StudyMaterialController::class,'deleteMaterial']);
Route::middleware('auth:api')->get('/material-download-history',[StudyMaterialController::class,'materialDownloadHistory']);

Route::middleware('auth:api')->get('/event-list/{id}',[EventController::class,'eventList']);


Route::middleware('auth:api')->get('/book-list/{id}',[BookController::class,'bookList']);
Route::middleware('auth:api')->post('/book-order',[BookController::class,'bookOrder']);
Route::middleware('auth:api')->get('/book-order-history/{id}',[BookController::class,'bookOrderHistory']);


Route::middleware('auth:api')->get('/all-test-series/{id}',[TestSeriesController::class,'testSeriesList']);
Route::middleware('auth:api')->get('/test-series-question/{id}',[TestSeriesController::class,'testSeriesQuestion']);
Route::middleware('auth:api')->post('/test-submit',[TestSeriesController::class,'testSubmit']);
Route::middleware('auth:api')->post('/test-submit-list',[TestSeriesController::class,'testSubmitList']);
Route::middleware('auth:api')->post('/test-stats',[TestSeriesController::class,'testStats']);

Route::middleware('auth:api')->post('/create-chat',[ChatController::class,'createChat']);
Route::middleware('auth:api')->post('/chat-list',[ChatController::class,'chatList']);
Route::middleware('auth:api')->post('/chat-reply-list',[ChatController::class,'chatReplyList']);
Route::middleware('auth:api')->post('/live-user-count',[ChatController::class,'liveUser']);





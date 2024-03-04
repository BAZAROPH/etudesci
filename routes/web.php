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

Route::get('/generate', 'App\Http\Controllers\PaymentController@generate');

// Authentification
Route::get('/login', 'App\Http\Controllers\AuthController@loginView')->name('login.view');
Route::post('/make-login', 'App\Http\Controllers\AuthController@login')->name('login');
Route::post('/make-register', 'App\Http\Controllers\AuthController@register')->name('register');
Route::get('/confirm-email/{token}', 'App\Http\Controllers\AuthController@confirmEmail')->name('confirm-email');
Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
Route::get('/reset-password', 'App\Http\Controllers\AuthController@resetPasswordView')->name('reset-password');
Route::post('/send-reset-password', 'App\Http\Controllers\AuthController@sendResetPassword')->name('send-reset-password');
Route::get('/reset-password-preprocess/{token}', 'App\Http\Controllers\AuthController@resetPasswordPreProcess')->name('reset-password-preprocess');
Route::post('/save-new-password', 'App\Http\Controllers\AuthController@resetPassword')->name('save-new-password');

//Dashboard page

Route::middleware(['admin'])->group(function(){
    Route::get('/web/admin', 'App\Http\Controllers\HomeController@adminIndex')->name('admin.dashboard');

    //Question
    Route::get('/online-class/questions/{slug}', 'App\Http\Controllers\QuizController@index')->name('admin.onlineClass.quiz.index');
    Route::post('/online-class/questions/store', 'App\Http\Controllers\QuizController@store')->name('admin.onlineClass.quiz.store');
    Route::post('/online-class/questions/update', 'App\Http\Controllers\QuizController@update')->name('admin.onlineClass.quiz.update');
    Route::post('/online-class/questions/delete', 'App\Http\Controllers\QuizController@delete')->name('admin.onlineClass.quiz.delete');

    //author type
    Route::get('/web/admin/authors-type', 'App\Http\Controllers\AuthorController@adminAuthorTypeIndex')->name('admin.author.type.index');
    Route::post('/web/admin/authors-type/store', 'App\Http\Controllers\AuthorController@adminAuthorTypeStore')->name('admin.author.type.store');
    Route::post('/web/admin/authors-type/update', 'App\Http\Controllers\AuthorController@adminAuthorTypeUpdate')->name('admin.author.type.update');
    Route::post('/web/admin/authors-type/delete', 'App\Http\Controllers\AuthorController@adminAuthorTypeDelete')->name('admin.author.type.delete');

    //author
    Route::get('/web/admin/authors', 'App\Http\Controllers\AuthorController@adminIndex')->name('admin.author.index');
    Route::get('/web/admin/authors/create', 'App\Http\Controllers\AuthorController@adminCreate')->name('admin.author.create');
    Route::post('/web/admin/authors/store', 'App\Http\Controllers\AuthorController@adminStore')->name('admin.author.store');
    Route::get('/web/admin/authors/edit/{slug}', 'App\Http\Controllers\AuthorController@adminEdit')->name('admin.author.edit');
    Route::post('/web/admin/authors/update', 'App\Http\Controllers\AuthorController@adminUpdate')->name('admin.author.update');
    Route::post('/web/admin/authors/delete', 'App\Http\Controllers\AuthorController@adminDelete')->name('admin.author.delete');
    Route::get('/web/admin/authors/trash', 'App\Http\Controllers\AuthorController@adminTrash')->name('admin.author.trash');
    Route::get('/web/admin/authors/restore/{slug}', 'App\Http\Controllers\AuthorController@adminRestore')->name('admin.author.restore');
    Route::post('/web/admin/authors/force-delete', 'App\Http\Controllers\AuthorController@adminForceDelete')->name('admin.author.forceDelete');


    //offices
    Route::get('/web/admin/offices', 'App\Http\Controllers\OfficeController@adminIndex')->name('admin.office.index');
    Route::get('/web/admin/offices/create', 'App\Http\Controllers\OfficeController@adminCreate')->name('admin.office.create');
    Route::post('/web/admin/offices/store', 'App\Http\Controllers\OfficeController@adminStore')->name('admin.office.store');
    Route::get('/web/admin/offices/edit/{slug}', 'App\Http\Controllers\OfficeController@adminEdit')->name('admin.office.edit');
    Route::post('/web/admin/offices/update', 'App\Http\Controllers\OfficeController@adminUpdate')->name('admin.office.update');
    Route::post('/web/admin/offices/delete', 'App\Http\Controllers\OfficeController@adminDelete')->name('admin.office.delete');
    Route::get('/web/admin/offices/trash', 'App\Http\Controllers\OfficeController@adminTrash')->name('admin.office.trash');
    Route::get('/web/admin/offices/restore/{slug}', 'App\Http\Controllers\OfficeController@adminRestore')->name('admin.office.restore');
    Route::post('/web/admin/offices/force-delete', 'App\Http\Controllers\OfficeController@adminForceDelete')->name('admin.office.forceDelete');


    //tainers
    Route::get('/web/admin/trainers', 'App\Http\Controllers\TrainerController@adminIndex')->name('admin.trainer.index');
    Route::get('/web/admin/trainers/create', 'App\Http\Controllers\TrainerController@adminCreate')->name('admin.trainer.create');
    Route::post('/web/admin/trainers/store', 'App\Http\Controllers\TrainerController@adminStore')->name('admin.trainer.store');
    Route::get('/web/admin/trainers/edit/{slug}', 'App\Http\Controllers\TrainerController@adminEdit')->name('admin.trainer.edit');
    Route::post('/web/admin/trainers/update', 'App\Http\Controllers\TrainerController@adminUpdate')->name('admin.trainer.update');
    Route::post('/web/admin/trainers/delete', 'App\Http\Controllers\TrainerController@adminDelete')->name('admin.trainer.delete');
    Route::get('/web/admin/trainers/trash', 'App\Http\Controllers\TrainerController@adminTrash')->name('admin.trainer.trash');
    Route::get('/web/admin/trainers/restore/{slug}', 'App\Http\Controllers\TrainerController@adminRestore')->name('admin.trainer.restore');
    Route::post('/web/admin/trainers/force-delete', 'App\Http\Controllers\TrainerController@adminForceDelete')->name('admin.trainer.forceDelete');


    //organizers
    Route::get('/web/admin/organizers', 'App\Http\Controllers\OrganizerController@adminIndex')->name('admin.organizer.index');
    Route::get('/web/admin/organizers/create', 'App\Http\Controllers\OrganizerController@adminCreate')->name('admin.organizer.create');
    Route::post('/web/admin/organizers/store', 'App\Http\Controllers\OrganizerController@adminStore')->name('admin.organizer.store');
    Route::get('/web/admin/organizers/edit/{slug}', 'App\Http\Controllers\OrganizerController@adminEdit')->name('admin.organizer.edit');
    Route::post('/web/admin/organizers/update', 'App\Http\Controllers\OrganizerController@adminUpdate')->name('admin.organizer.update');
    Route::post('/web/admin/organizers/delete', 'App\Http\Controllers\OrganizerController@adminDelete')->name('admin.organizer.delete');
    Route::get('/web/admin/organizers/trash', 'App\Http\Controllers\OrganizerController@adminTrash')->name('admin.organizer.trash');
    Route::get('/web/admin/organizers/restore/{slug}', 'App\Http\Controllers\OrganizerController@adminRestore')->name('admin.organizer.restore');
    Route::post('/web/admin/organizers/force-delete', 'App\Http\Controllers\OrganizerController@adminForceDelete')->name('admin.organizer.forceDelete');


    //domaine type
    Route::get('/web/admin/domaines-type', 'App\Http\Controllers\DomaineController@adminDomaineTypeIndex')->name('admin.domaine.type.index');
    Route::post('/web/admin/domaines-type/store', 'App\Http\Controllers\DomaineController@adminDomaineTypeStore')->name('admin.domaine.type.store');
    Route::post('/web/admin/domaines-type/update', 'App\Http\Controllers\DomaineController@adminDomaineTypeUpdate')->name('admin.domaine.type.update');
    Route::post('/web/admin/domaines-type/delete', 'App\Http\Controllers\DomaineController@adminDomaineTypeDelete')->name('admin.domaine.type.delete');


    //domaine
    Route::get('/web/admin/domaines', 'App\Http\Controllers\DomaineController@adminIndex')->name('admin.domaine.index');
    Route::post('/web/admin/domaines/store', 'App\Http\Controllers\DomaineController@adminStore')->name('admin.domaine.store');
    Route::post('/web/admin/domaines/update', 'App\Http\Controllers\DomaineController@adminUpdate')->name('admin.domaine.update');
    Route::post('/web/admin/domaines/delete', 'App\Http\Controllers\DomaineController@adminDelete')->name('admin.domaine.delete');
    Route::get('/web/admin/domaines/trash', 'App\Http\Controllers\DomaineController@adminTrash')->name('admin.domaine.trash');
    Route::get('/web/admin/domaines/restore/{id}', 'App\Http\Controllers\DomaineController@adminRestore')->name('admin.domaine.restore');
    Route::post('/web/admin/domaines/forceDelete', 'App\Http\Controllers\DomaineController@adminForceDelete')->name('admin.domaine.forceDelete');

    //domaine article
    Route::get('/web/admin/articles-type', 'App\Http\Controllers\ArticleController@adminArticleTypeIndex')->name('admin.article.type.index');
    Route::post('/web/admin/articles-type/store', 'App\Http\Controllers\ArticleController@adminArticleTypeStore')->name('admin.article.type.store');
    Route::post('/web/admin/articles-type/update', 'App\Http\Controllers\ArticleController@adminArticleTypeUpdate')->name('admin.article.type.update');
    Route::post('/web/admin/articles-type/delete', 'App\Http\Controllers\ArticleController@adminArticleTypeDelete')->name('admin.article.type.delete');

    //article
    Route::get('/web/admin/articles', 'App\Http\Controllers\ArticleController@adminIndex')->name('admin.article.index');
    Route::get('/web/admin/articles/create', 'App\Http\Controllers\ArticleController@adminCreate')->name('admin.article.create');
    Route::post('/web/admin/articles/store', 'App\Http\Controllers\ArticleController@adminStore')->name('admin.article.store');
    Route::get('/web/admin/articles/edit/{slug}', 'App\Http\Controllers\ArticleController@adminEdit')->name('admin.article.edit');
    Route::post('/web/admin/articles/update', 'App\Http\Controllers\ArticleController@adminUpdate')->name('admin.article.update');
    Route::post('/web/admin/articles/delete', 'App\Http\Controllers\ArticleController@adminDelete')->name('admin.article.delete');
    Route::get('/web/admin/articles/trash', 'App\Http\Controllers\ArticleController@adminTrash')->name('admin.article.trash');
    Route::get('/web/admin/articles/restore/{id}', 'App\Http\Controllers\ArticleController@adminRestore')->name('admin.article.restore');
    Route::post('/web/admin/articles/forceDelete', 'App\Http\Controllers\ArticleController@adminForceDelete')->name('admin.article.forceDelete');
    Route::get('/web/admin/articles/published/{slug}', 'App\Http\Controllers\ArticleController@adminPublished')->name('admin.article.published');
    Route::get('/web/admin/articles/left-slide/{slug}', 'App\Http\Controllers\ArticleController@adminLeftSlide')->name('admin.article.leftSlide');
    Route::get('/web/admin/articles/right-slide/{slug}', 'App\Http\Controllers\ArticleController@adminRightSlide')->name('admin.article.rightSlide');


    //certifications
    Route::get('/web/admin/certifications', 'App\Http\Controllers\CertificationController@adminIndex')->name('admin.certification.index');
    Route::get('/web/admin/certifications/create', 'App\Http\Controllers\CertificationController@adminCreate')->name('admin.certification.create');
    Route::post('/web/admin/certifications/store', 'App\Http\Controllers\CertificationController@adminStore')->name('admin.certification.store');
    Route::get('/web/admin/certifications/edit/{slug}', 'App\Http\Controllers\CertificationController@adminEdit')->name('admin.certification.edit');
    Route::post('/web/admin/certifications/update', 'App\Http\Controllers\CertificationController@adminUpdate')->name('admin.certification.update');
    Route::post('/web/admin/certifications/delete', 'App\Http\Controllers\CertificationController@adminDelete')->name('admin.certification.delete');
    Route::get('/web/admin/certifications/trash', 'App\Http\Controllers\CertificationController@adminTrash')->name('admin.certification.trash');
    Route::get('/web/admin/certifications/restore/{slug}', 'App\Http\Controllers\CertificationController@adminRestore')->name('admin.certification.restore');
    Route::post('/web/admin/certifications/forceDelete', 'App\Http\Controllers\CertificationController@adminForceDelete')->name('admin.certification.forceDelete');

    //books and ebooks
    Route::get('/web/admin/books-and-ebooks', 'App\Http\Controllers\BookController@adminIndex')->name('admin.book.index');
    Route::get('/web/admin/books-and-ebooks/create', 'App\Http\Controllers\BookController@adminCreate')->name('admin.book.create');
    Route::post('/web/admin/books-and-ebooks/store', 'App\Http\Controllers\BookController@adminStore')->name('admin.book.store');
    Route::get('/web/admin/books-and-ebooks/edit/{slug}', 'App\Http\Controllers\BookController@adminEdit')->name('admin.book.edit');
    Route::post('/web/admin/books-and-ebooks/update', 'App\Http\Controllers\BookController@adminUpdate')->name('admin.book.update');
    Route::post('/web/admin/books-and-ebooks/delete', 'App\Http\Controllers\BookController@adminDelete')->name('admin.book.delete');
    Route::get('/web/admin/books-and-ebooks/trash', 'App\Http\Controllers\BookController@adminTrash')->name('admin.book.trash');
    Route::get('/web/admin/books-and-ebooks/restore/{slug}', 'App\Http\Controllers\BookController@adminRestore')->name('admin.book.restore');
    Route::post('/web/admin/books-and-ebooks/forceDelete', 'App\Http\Controllers\BookController@adminForceDelete')->name('admin.book.forceDelete');
    Route::get('/web/admin/books-and-ebooks/published/{slug}', 'App\Http\Controllers\BookController@adminPublished')->name('admin.book.published');

    //event type
    Route::get('/web/admin/events-type', 'App\Http\Controllers\EventController@adminEventTypeIndex')->name('admin.event.type.index');
    Route::post('/web/admin/events-type/store', 'App\Http\Controllers\EventController@adminEventTypeStore')->name('admin.event.type.store');
    Route::post('/web/admin/events-type/update', 'App\Http\Controllers\EventController@adminEventTypeUpdate')->name('admin.event.type.update');
    Route::post('/web/admin/events-type/delete', 'App\Http\Controllers\EventController@adminEventTypeDelete')->name('admin.event.type.delete');

    //events
    Route::get('/web/admin/events', 'App\Http\Controllers\EventController@adminIndex')->name('admin.event.index');
    Route::get('/web/admin/events/create', 'App\Http\Controllers\EventController@adminCreate')->name('admin.event.create');
    Route::post('/web/admin/events/store', 'App\Http\Controllers\EventController@adminStore')->name('admin.event.store');
    Route::get('/web/admin/events/edit/{slug}', 'App\Http\Controllers\EventController@adminEdit')->name('admin.event.edit');
    Route::post('/web/admin/events/update', 'App\Http\Controllers\EventController@adminUpdate')->name('admin.event.update');
    Route::post('/web/admin/events/delete', 'App\Http\Controllers\EventController@adminDelete')->name('admin.event.delete');
    Route::get('/web/admin/events/trash', 'App\Http\Controllers\EventController@adminTrash')->name('admin.event.trash');
    Route::get('/web/admin/events/restore/{slug}', 'App\Http\Controllers\EventController@adminRestore')->name('admin.event.restore');
    Route::post('/web/admin/events/forceDelete', 'App\Http\Controllers\EventController@adminForceDelete')->name('admin.event.forceDelete');
    Route::get('/web/admin/events/published/{slug}', 'App\Http\Controllers\EventController@adminPublished')->name('admin.event.published');


    // Courses
    Route::get('/web/admin/courses', 'App\Http\Controllers\CourseController@adminIndex')->name('admin.course.index');
    Route::get('/web/admin/courses/create', 'App\Http\Controllers\CourseController@adminCreate')->name('admin.course.create');
    Route::post('/web/admin/courses/store', 'App\Http\Controllers\CourseController@adminStore')->name('admin.course.store');
    Route::get('/web/admin/courses/edit/{slug}', 'App\Http\Controllers\CourseController@adminEdit')->name('admin.course.edit');
    Route::post('/web/admin/courses/update', 'App\Http\Controllers\CourseController@adminUpdate')->name('admin.course.update');
    Route::post('/web/admin/courses/delete', 'App\Http\Controllers\CourseController@adminDelete')->name('admin.course.delete');
    Route::get('/web/admin/courses/trash', 'App\Http\Controllers\CourseController@adminTrash')->name('admin.course.trash');
    Route::get('/web/admin/courses/restore/{slug}', 'App\Http\Controllers\CourseController@adminRestore')->name('admin.course.restore');
    Route::post('/web/admin/courses/forceDelete', 'App\Http\Controllers\CourseController@adminForceDelete')->name('admin.course.forceDelete');
    Route::get('/web/admin/courses/published/{slug}', 'App\Http\Controllers\CourseController@adminPublished')->name('admin.course.published');

    //Modules
    Route::get('/web/admin/modules/{course_slug}/', 'App\Http\Controllers\ModuleController@adminIndex')->name('admin.module.index');
    Route::post('/web/admin/modules/store', 'App\Http\Controllers\ModuleController@adminStore')->name('admin.module.store');
    Route::post('/web/admin/modules/update', 'App\Http\Controllers\ModuleController@adminUpdate')->name('admin.module.update');
    Route::post('/web/admin/modules/force-delete', 'App\Http\Controllers\ModuleController@adminForceDelete')->name('admin.module.forceDelete');


    //accreditassion
    Route::get('/web/admin/accreditassions', 'App\Http\Controllers\AccreditassionController@adminIndex')->name('admin.accreditassion.index');
    Route::get('/web/admin/accreditassions/create', 'App\Http\Controllers\AccreditassionController@adminCreate')->name('admin.accreditassion.create');
    Route::post('/web/admin/accreditassions/store', 'App\Http\Controllers\AccreditassionController@adminStore')->name('admin.accreditassion.store');
    Route::get('/web/admin/accreditassions/edit/{id}', 'App\Http\Controllers\AccreditassionController@adminEdit')->name('admin.accreditassion.edit');
    Route::post('/web/admin/accreditassions/update', 'App\Http\Controllers\AccreditassionController@adminUpdate')->name('admin.accreditassion.update');
    Route::post('/web/admin/accreditassions/delete', 'App\Http\Controllers\AccreditassionController@adminDelete')->name('admin.accreditassion.delete');
    Route::get('/web/admin/accreditassions/trash', 'App\Http\Controllers\AccreditassionController@adminTrash')->name('admin.accreditassion.trash');
    Route::get('/web/admin/accreditassions/restore/{id}', 'App\Http\Controllers\AccreditassionController@adminRestore')->name('admin.accreditassion.restore');
    Route::post('/web/admin/accreditassions/force-delete', 'App\Http\Controllers\AccreditassionController@adminForceDelete')->name('admin.accreditassion.forceDelete');

    //utilisateur type
    Route::get('/web/admin/users', 'App\Http\Controllers\UserController@adminIndex')->name('admin.user.index');
    Route::post('/web/admin/users/store', 'App\Http\Controllers\UserController@adminStore')->name('admin.user.store');
    Route::post('/web/admin/users/update', 'App\Http\Controllers\UserController@adminUpdate')->name('admin.user.update');
    Route::post('/web/admin/users/delete', 'App\Http\Controllers\UserController@adminDelete')->name('admin.user.delete');
    Route::get('/web/admin/users/trash', 'App\Http\Controllers\UserController@adminTrash')->name('admin.user.trash');
    Route::post('/web/admin/users/force-delete', 'App\Http\Controllers\UserController@adminForceDelete')->name('admin.user.forceDelete');
    Route::get('/web/admin/users/restore/{id}', 'App\Http\Controllers\UserController@adminRestore')->name('admin.user.restore');

    //Admin Payments
    Route::get('/web/admin/payments', 'App\Http\Controllers\PaymentController@adminIndex')->name('admin.payment.index');

    //Subscribers Admin
    Route::get('/web/admin/subscribers', 'App\Http\Controllers\UserController@subscribers')->name('admin.subscriber.index');
    Route::get('/web/admin/potential-subscribers', 'App\Http\Controllers\UserController@potentialSubscribers')->name('admin.potentialSubscribers.index');

    //Subscription Admin
    Route::get('/web/admin/subscriptions', 'App\Http\Controllers\SubscriptionController@adminIndex')->name('admin.subscription.index');

    //Online Class
    Route::get('web/admin/online-class', 'App\Http\Controllers\OnlineClassController@adminIndex')->name('admin.onlineClass.index');
    Route::get('web/admin/online-class/create', 'App\Http\Controllers\OnlineClassController@adminCreate')->name('admin.onlineClass.create');
    Route::post('web/admin/online-class/store', 'App\Http\Controllers\OnlineClassController@adminStore')->name('admin.onlineClass.store');
    Route::get('web/admin/online-class/edit/{slug}', 'App\Http\Controllers\OnlineClassController@adminEdit')->name('admin.onlineClass.edit');
    Route::post('web/admin/online-class/update', 'App\Http\Controllers\OnlineClassController@adminUpdate')->name('admin.onlineClass.update');
    Route::get('web/admin/online-class/trash', 'App\Http\Controllers\OnlineClassController@adminTrash')->name('admin.onlineClass.trash');
    Route::post('web/admin/online-class/delete', 'App\Http\Controllers\OnlineClassController@adminDelete')->name('admin.onlineClass.delete');
    Route::get('web/admin/online-class/restore/{slug}', 'App\Http\Controllers\OnlineClassController@adminRestore')->name('admin.onlineClass.restore');
    Route::post('web/admin/online-class/force-delete', 'App\Http\Controllers\OnlineClassController@adminForceDelete')->name('admin.onlineClass.forceDelete');

    //Subscriber in admin
    Route::post('web/admin/add-subscriber', 'App\Http\Controllers\UserController@addSubscriberInAmin')->name('admin.addSubscriber');

    //Format Contact
    Route::post('web/admin/format-contact', 'App\Http\Controllers\HomeController@formatContact')->name('admin.format-contact');
    //Users emails
    Route::get('web/admin/users-email', 'App\Http\Controllers\UserController@getUsersEmail')->name('admin.users-emails');
    //Potentials Subscribers emails
    Route::get('web/admin/potentials-users-email', 'App\Http\Controllers\UserController@getPotentialSubscribers')->name('admin.potentials-users-emails');
    //Subscribers
    Route::get('web/admin/get-subscribers', 'App\Http\Controllers\UserController@getSubscribers')->name('admin.get-subscribers');

    //Partners
    Route::get('web/admin/partners', 'App\Http\Controllers\PartnerController@adminIndex')->name('admin.partner.index');

    //Banners
    Route::get('/web/admin/medias/banners', 'App\Http\Controllers\BannerController@bannerIndex')->name('admin.banners.index');
    Route::post('/web/admin/medias/banners/store', 'App\Http\Controllers\BannerController@storeBanner')->name('admin.banners.store');

    //Applications
    Route::post('/web/admin/applications/send-customs-emails', 'App\Http\Controllers\ApplicationController@send_customs_emails_to_users_list')->name('admin.application.send_customs_emails_to_users_list');

});



Route::get('/certificate/{slug}/{test_id}', 'App\Http\Controllers\QuizController@downloadCertificate')->name('certificate');
Route::middleware(['auth'])->group(function(){
    // Courses
    Route::get('/courses/taken/{slug}/{module_slug}', 'App\Http\Controllers\CourseController@taken')->name('course.taken');
    Route::get('/courses/{slug}/test', 'App\Http\Controllers\QuizController@test')->name('course.test');
    Route::post('/courses/{slug}/test/save', 'App\Http\Controllers\QuizController@save')->name('course.test.save');

    //Resume
    Route::get('/moncv', 'App\Http\Controllers\ResumeController@index')->name('resume.list');
    Route::get('/moncv/{model}', 'App\Http\Controllers\ResumeController@workSpace');

    //My Purchases
    Route::get('/purchases', 'App\Http\Controllers\UserController@purchases')->name('user.purchase');
    Route::get('/purchases/download-invoice/{payment_id}', 'App\Http\Controllers\UserController@downloadInvoice')->name('user.downloadInvoice');
});

// share resume
Route::get('/mon-cv-en-ligne/{email}', 'App\Http\Controllers\ResumeController@share')->name('resume.share');



// Subscriptions
Route::get('bsp', 'App\Http\Controllers\SubscriptionController@description')->name('subscritption.description');
Route::get('bois-sacre-des-pros/payment', 'App\Http\Controllers\SubscriptionController@payment')->name('subcription.pay');
Route::post('bois-sacre-des-pros/login', 'App\Http\Controllers\SubscriptionController@login')->name('subcription.login');
Route::post('bois-sacre-des-pros/register', 'App\Http\Controllers\SubscriptionController@register')->name('subcription.register');
Route::get('bois-sacre-des-pros/validate-payment', 'App\Http\Controllers\SubscriptionController@validatePayment')->name('subcription.validate.payment');

//payment page
Route::get('/payment/{type}/{slug}', 'App\Http\Controllers\PaymentController@index')->name('payment');
Route::get('/payment/validate-payment', 'App\Http\Controllers\PaymentController@validatePayment')->name('payment.validate');

// User space
Route::middleware(['subscriber'])->group(function(){
    Route::get('bois-sacre-des-pros/mon-espace', 'App\Http\Controllers\UserController@space')->name('subscritption.space');
});

// Route('/invoice', function(){
//     return view('site.invoices.payment');
// });

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

// Courses
Route::get('/courses/{subject?}', 'App\Http\Controllers\CourseController@list')->name('course.list');
Route::get('/courses/details/{slug}', 'App\Http\Controllers\CourseController@details')->name('course.details');


//Certifications
Route::get('/certifications/{subject?}', 'App\Http\Controllers\CertificationController@list')->name('certification.list');
Route::get('/certifications/details/{slug}', 'App\Http\Controllers\CertificationController@details')->name('certification.details');


// Articles
Route::get('/articles/{subject?}', 'App\Http\Controllers\ArticleController@list')->name('article.list');
Route::get('/articles/details/{slug}', 'App\Http\Controllers\ArticleController@details')->name('article.details');


// Offices
Route::get('/offices/{subject?}', 'App\Http\Controllers\OfficeController@list')->name('office.list');
Route::get('/offices/details/{slug}', 'App\Http\Controllers\OfficeController@details')->name('office.details');



// Events
Route::get('/events/{subject?}', 'App\Http\Controllers\EventController@list')->name('event.list');
Route::get('/events/details/{slug}', 'App\Http\Controllers\EventController@details')->name('event.details');


// Books
Route::get('/books/{subject?}', 'App\Http\Controllers\BookController@list')->name('book.list');
Route::get('/books/details/{slug}', 'App\Http\Controllers\BookController@details')->name('book.details');

//Contact
Route::get('/contact', 'App\Http\Controllers\ContactController@index')->name('contact.index');
Route::post('/contact/partners', 'App\Http\Controllers\PartnerController@store')->name('contact.partner');

Route::middleware(['subscription'])->group( function(){
    //Onlineclass
    Route::get('/online-classrooms/meet/open/{slug}', 'App\Http\Controllers\OnlineClassController@open')->name('onlineClass.open');
});







Route::get('/test', 'App\Http\Controllers\SubscriptionController@test')->name('redirection');
Route::get('/partenariat', 'App\Http\Controllers\HomeController@partners')->name('partners');

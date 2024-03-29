<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ScreenController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Include all routes that should log out a logged user when they are blocked
Route::middleware('block')->group(
    function () {

        /**
         * Root page
         */
        Route::get('/', [FilmController::class, 'index']);

        /**
         * User routes
         */
        Route::get('profile', [RegisteredUserController::class, 'index'])
            ->middleware(['auth', 'verified', 'admin.customer'])
            ->name('profile.index');

        /**
         * Film routes
         */
        Route::controller(FilmController::class)->group(function () {
            Route::get('films', 'index')
                ->name('films.index');

            Route::get('films/{film}', 'show')
                ->name('films.show');
        });

        /**
         * Screening routes
         */
        Route::controller(ScreeningController::class)->group(function () {
            Route::get('screening/{screening}', 'show')
                ->name('screenings.show')
                ->middleware('client');
        });

        /**
         * Receipt routes
         */
        Route::controller(ReceiptController::class)->middleware(['auth', 'verified'])->group(function () {
            Route::get('receipts', 'index')
                ->name('receipts.index')
                ->middleware('can:viewAny,App\Models\Receipt');

            Route::get('receipts/{receipt}', 'show')
                ->name('receipts.show')
                ->middleware('can:view,receipt');

            Route::get('receipts/{receipt}/pdf', 'get_pdf')
                ->name('receipts.get_pdf')
                ->middleware('can:view,receipt');
        });

        /**
         * Ticket routes
         */
        Route::controller(TicketController::class)->group(function () {
            Route::get('tickets', 'index')
                ->name('tickets.index')
                ->middleware('can:viewAny,App\Models\Ticket');

            Route::get('tickets/{ticket}', 'show')
                ->name('tickets.show')
                ->middleware('can:view,ticket');

            Route::get('tickets/{ticket}/pdf', 'get_pdf')
                ->name('tickets.get_pdf')
                ->middleware('can:view,ticket');

            Route::post('cart', 'store')
                ->name('tickets.store')
                ->middleware('can:finalizePurchase,App\Models\Screening');
        });

        /**
         * Shopping Cart routes
         */
        Route::controller(CartController::class)->middleware('client')->group(function () {
            Route::get('cart', 'index')
                ->name('cart.index');

            Route::post('screening/{screening}/{seat}', 'store')
                ->name('cart.store');

            Route::delete('cart/{key}', 'destroy')
                ->name('cart.destroy');
        });

        /**
         * Employee routes
         */
        Route::middleware('auth')->prefix('employee')->name('employee.')->group(function () {

            /**
             * Screening employee routes
             */
            Route::controller(ScreeningController::class)->group(function () {

                Route::get('screenings', 'employee_index')
                    ->name('screenings.index')
                    ->middleware('can:viewAnyEmployee,App\Models\Screening');

                Route::get('screenings/{screening}', 'backend_show')
                    ->name('screenings.show')
                    ->middleware('can:view,screening');

                Route::get('screenings/{screening}/validate', 'validate_tickets')
                    ->name('screenings.validate')
                    ->middleware('can:validate,screening');

                Route::put('screenings/{screening}/validate/{ticket}', 'validate_ticket')
                    ->name('screenings.validate.ticket')
                    ->middleware('can:validate,screening');
            });

            /**
             * User employee routes
             */
            Route::controller(UserController::class)->group(function () {
                Route::get('users', 'employee_index')
                    ->name('users.index')
                    ->middleware('can:viewAnyEmployee,App\Models\User');
            });
        });

        /**
         * Admin routes
         */
        Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

            /**
             * User admin routes
             */
            Route::controller(UserController::class)->group(function () {
                Route::get('users', 'index')
                    ->name('users.index')
                    ->middleware('can:viewAnyAdmin,App\Models\User');

                Route::get('users/{user}/view', 'show')
                    ->name('users.show')
                    ->middleware('can:view,user');

                Route::get('users/{user}/edit', 'edit')
                    ->name('users.edit')
                    ->middleware('can:update,user');

                Route::put('users/{user}', 'update')
                    ->name('users.update')
                    ->middleware('can:update,user');

                Route::delete('users/{user}', 'destroy')
                    ->name('users.destroy')
                    ->middleware('can:delete,user');

                Route::put('users/{user}/toggleblock', 'toggleblock')
                    ->name('users.toggleblock')
                    ->middleware('can:block,user');

                Route::get('users/create', 'create')
                    ->name('users.create')
                    ->middleware('can:create,App\Models\User');

                Route::post('users/create', 'store')
                    ->name('users.store')
                    ->middleware('can:create,App\Models\User');
            });

            /**
             * Film admin routes
             */
            Route::controller(FilmController::class)->group(function () {
                Route::get('films', 'admin_index')
                    ->name('films.index')
                    ->middleware('can:viewAny,App\Models\Film');

                Route::get('films/create', 'create')
                    ->name('films.create')
                    ->middleware('can:create,App\Models\Film');

                Route::post('films/create', 'store')
                    ->name('films.store')
                    ->middleware('can:create,App\Models\Film');

                Route::get('films/{film}/edit', 'edit')
                    ->name('films.edit')
                    ->middleware('can:update,film');

                Route::put('films/{film}', 'update')
                    ->name('films.update')
                    ->middleware('can:update,film');

                Route::delete('films/{film}', 'destroy')
                    ->name('films.destroy')
                    ->middleware('can:delete,film');
            });


            /**
             * Screening admin routes
             */
            Route::controller(ScreeningController::class)->group(function () {
                Route::get('screenings',  'index')
                    ->name('screenings.index')
                    ->middleware('can:viewAnyAdmin,App\Models\Screening');

                Route::get('screenings/create/{film}', 'create')
                    ->name('screenings.create')
                    ->middleware('can:create,App\Models\Screening');

                Route::post('screenings/create', 'store')
                    ->name('screenings.store')
                    ->middleware('can:create,App\Models\Screening');

                Route::get('screenings/{screening}', 'backend_show')
                    ->name('screenings.show')
                    ->middleware('can:view,screening');

                Route::get('screenings/{screening}/edit', 'edit')
                    ->name('screenings.edit')
                    ->middleware('can:update,screening');

                Route::put('screenings/{screening}', 'update')
                    ->name('screenings.update')
                    ->middleware('can:update,screening');

                Route::delete('screenings/{screening}', 'destroy')
                    ->name('screenings.destroy')
                    ->middleware('can:delete,screening');
            });

            /**
             * Screen admin routes
             */
            Route::controller(ScreenController::class)->group(function () {
                Route::get('screens',  'index')
                    ->name('screens.index')
                    ->middleware('can:viewAny,App\Models\Screen');

                Route::get('screens/create', 'create')
                    ->name('screens.create')
                    ->middleware('can:create,App\Models\Screen');

                Route::post('screens/create', 'store')
                    ->name('screens.store')
                    ->middleware('can:create,App\Models\Screen');

                Route::get('screens/{screen}/edit', 'edit')
                    ->name('screens.edit')
                    ->middleware('can:update,screen');

                Route::put('screens/{screen}', 'update')
                    ->name('screens.update')
                    ->middleware('can:update,screen');

                Route::delete('screens/{screen}', 'destroy')
                    ->name('screens.destroy')
                    ->middleware('can:delete,screen');
            });

            //Não achamos necessário criar policy para as rotas abaixo pois a única verificação é se o utilizador é admin, e não há uma entidade em si.
            Route::middleware('admin')->group(function () {
                Route::get('config', [ConfigurationController::class, 'index'])
                    ->name('config.index');

                Route::put('config', [ConfigurationController::class, 'update'])
                    ->name('config.update');

                Route::get('statistics', [StatisticsController::class, 'index'])
                    ->name('statistics.index');
            });
        });
    }
);

require __DIR__ . '/auth.php';

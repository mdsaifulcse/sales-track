<?php

namespace App\Providers;

use App\Models\EmpExpenditure;
use Illuminate\Support\ServiceProvider;
use View,MyHelper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer( // Main menu supply to menu bar
            [
                'backend.app'
            ],function ($view){
            $borrowRepayRequestNotification=0;
            $authRole=\MyHelper::userRole()->role;
            if ($authRole=='super-admin' || $authRole=='developer') {

                $borrowRepayRequestNotification = EmpExpenditure::join('emp_money_transactions', 'emp_expenditures.id', 'emp_money_transactions.emp_expenditure_id')
                    ->where(['emp_money_transactions.status' => 0])
                    ->count('emp_money_transactions.id');
            }

            $view->with('borrowRepayRequestNotification',$borrowRepayRequestNotification);
        });
    }
}

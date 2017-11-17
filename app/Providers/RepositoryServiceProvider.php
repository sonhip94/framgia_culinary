<?php

namespace App\Providers;

use App;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Contracts\IngredientRepositoryInterface;
use App\Repositories\Eloquent\IngredientRepository;
use App\Repositories\Contracts\FoodyRepositoryInterface;
use App\Repositories\Eloquent\FoodyRepository;
use App\Repositories\Contracts\ReceiptStepRepositoryInterface;
use App\Repositories\Eloquent\ReceiptStepRepository;
use App\Repositories\Contracts\ReceiptRepositoryInterface;
use App\Repositories\Eloquent\ReceiptRepository;
use App\Repositories\Contracts\UnitRepositoryInterface;
use App\Repositories\Eloquent\UnitRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Contracts\ReceiptFoodyRepositoryInterface;
use App\Repositories\Eloquent\ReceiptFoodyRepository;
use App\Repositories\Contracts\ReceiptIngredientRepositoryInterface;
use App\Repositories\Eloquent\ReceiptIngredientRepository;
use App\Repositories\Contracts\LikeRepositoryInterface;
use App\Repositories\Eloquent\LikeRepository;
use App\Repositories\Contracts\FollowRepositoryInterface;
use App\Repositories\Eloquent\FollowRepository;
use App\Repositories\Contracts\RateRepositoryInterface;
use App\Repositories\Eloquent\RateRepository;
use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Repositories\Eloquent\CommentRepository;
use App\Repositories\Contracts\UserReceiptRepositoryInterface;
use App\Repositories\Eloquent\UserReceiptRepository;
use App\Repositories\Contracts\UserReceiptIngredientRepositoryInterface;
use App\Repositories\Eloquent\UserReceiptIngredientRepository;
use App\Repositories\Contracts\UserReceiptFoodyRepositoryInterface;
use App\Repositories\Eloquent\UserReceiptFoodyRepository;
use App\Repositories\Contracts\UserReceiptStepRepositoryInterface;
use App\Repositories\Eloquent\UserReceiptStepRepository;
use App\Repositories\Contracts\RequestReceiptRepositoryInterface;
use App\Repositories\Eloquent\RequestReceiptRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        $models = [
            'Category',
            'Ingredient',
            'Foody',
            'ReceiptStep',
            'Receipt',
            'Unit',
            'User',
            'ReceiptFoody',
            'ReceiptIngredient',
            'Like',
            'Follow',
            'Rate',
            'Comment',
            'UserReceipt',
            'UserReceiptIngredient',
            'UserReceiptStep',
            'UserReceiptFoody',
            'RequestReceipt'
        ];
        
        foreach ($models as $model) {
            App::bind('App\Repositories\Contracts\\' . $model . 'RepositoryInterface', 'App\Repositories\Eloquent\\' . $model . 'Repository');
        }
    }
}

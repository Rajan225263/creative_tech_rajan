<?php

namespace App\Providers;

use App\Repositories\BaseRepositoryContract;
use App\Repositories\BaseRepository;
use App\Repositories\BookshelfRepository\BookshelfRepositoryContact;
use App\Repositories\BookshelfRepository\BookshelfRepository;

use App\Repositories\BookRepository\BookRepositoryContact;
use App\Repositories\BookRepository\BookRepository;

use App\Repositories\ChapterRepository\ChapterRepositoryContact;
use App\Repositories\ChapterRepository\ChapterRepository;

use App\Repositories\PageRepository\PageRepositoryContact;
use App\Repositories\PageRepository\PageRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BaseRepositoryContract::class, BaseRepository::class);
        $this->app->bind(BookshelfRepositoryContact::class, BookshelfRepository::class);
        $this->app->bind(BookRepositoryContact::class, BookRepository::class);
        $this->app->bind(ChapterRepositoryContact::class, ChapterRepository::class);
        $this->app->bind(PageRepositoryContact::class, PageRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

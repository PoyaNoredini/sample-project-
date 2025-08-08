<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// Repository interfaces and implementations
use App\Contracts\Repositories\Interface\IAuthRepository;
use App\Contracts\Repositories\Auth\AuthRepository;
use App\Contracts\Repositories\Interface\IOTPRepository;
use App\Contracts\Repositories\OTPCode\OTPRepository;
use App\Contracts\Repositories\Category\CategoryRepository;
use App\Contracts\Repositories\Interface\ICategoryRepository;
use App\Contracts\Repositories\Interface\ICityStateRepository;
use App\Contracts\Repositories\CityState\CityStateRepository;
use App\Contracts\Services\Contracts\IAuthService;
use App\Contracts\Services\AuthService;
use App\Contracts\Services\Contracts\IOtpService;
use App\Contracts\Services\OtpService;
use App\Contracts\Services\CategoryService;
use App\Contracts\Services\Contracts\ICategoryService;
use App\Contracts\Services\Contracts\ICityStateService;
use App\Contracts\Services\CityStateService;
use App\Contracts\Services\Contracts\IUserService;
use App\Contracts\Services\UserService;
use App\Contracts\Repositories\Interface\IUserRepository;
use App\Contracts\Repositories\User\UserRepository;
use App\Contracts\Services\Contracts\IUuidConversionService;
use App\Contracts\Services\UuidConversionService;
use App\Contracts\Repositories\Interface\IProviderRepository;
use App\Contracts\Repositories\Provider\ProviderRepository;
use App\Contracts\Services\Contracts\IProviderService;
use App\Contracts\Services\ProviderService;
use App\Contracts\Repositories\Interface\IAdsRepository;
use App\Contracts\Repositories\Ads\AdsRepository;
use App\Contracts\Services\Contracts\IAdsService;
use App\Contracts\Services\AdsService;
use App\Contracts\Services\Contracts\IFileUploadService;
use App\Contracts\Services\FileUploadService;
use App\Contracts\Repositories\Interface\IPostRepository;
use App\Contracts\Repositories\Post\PostRepository;
use App\Contracts\Services\Contracts\IPostService;
use App\Contracts\Services\PostService;
use App\Contracts\Repositories\Interface\IStoryRepository;
use App\Contracts\Repositories\Story\StoryRepository;
use App\Contracts\Services\Contracts\IStoryService;
use App\Contracts\Services\StoryService;
use App\Contracts\Repositories\Interface\IInviteCodeRepository;
use App\Contracts\Repositories\InviteCode\InviteCodeRepository;
use App\Contracts\Services\Contracts\IInviteCodeService;
use App\Contracts\Services\InviteCodeService;
use App\Contracts\Repositories\Interface\IFollowingRepository;
use App\Contracts\Repositories\Following\FollowingRepository;
use App\Contracts\Services\Contracts\IFollowingService;
use App\Contracts\Services\FollowingService;
use App\Contracts\Repositories\Interface\ICloseFriendRepository;
use App\Contracts\Repositories\CloseFriends\CloseFriendsRepository;
use App\Contracts\Services\Contracts\ICloseFriendsService;
use App\Contracts\Services\CloseFriendsService;
use App\Contracts\Repositories\Interface\ICustomerClubRepository;
use App\Contracts\Repositories\CustomerClub\CustomerClubRepository;
use App\Contracts\Services\Contracts\ICustomerClubService;
use App\Contracts\Services\CustomerClubService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind Repository Interfaces to their implementations
        $this->app->bind(IAuthRepository::class, AuthRepository::class);
        $this->app->bind(IOTPRepository::class, OTPRepository::class);
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        $this->app->bind(ICityStateRepository::class, CityStateRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);



        // Bind Service Interfaces to their implementations
        $this->app->bind(IAuthService::class, AuthService::class);
        $this->app->bind(IOtpService::class, OtpService::class);
        $this->app->bind(ICategoryService::class, CategoryService::class);
        $this->app->bind(ICityStateService::class, CityStateService::class);
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IUuidConversionService::class, UuidConversionService::class);
        $this->app->bind(IProviderService::class, ProviderService::class);
        $this->app->bind(IAdsService::class, AdsService::class);
        $this->app->bind(IFileUploadService::class, FileUploadService::class);
        $this->app->bind(IPostService::class, PostService::class);
        $this->app->bind(IStoryService::class, StoryService::class);
        $this->app->bind(IInviteCodeService::class, InviteCodeService::class);
        $this->app->bind(IFollowingService::class, FollowingService::class);
        $this->app->bind(ICloseFriendsService::class, CloseFriendsService::class);
        $this->app->bind(ICustomerClubService::class, CustomerClubService::class);
     
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

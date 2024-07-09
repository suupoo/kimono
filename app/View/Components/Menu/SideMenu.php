<?php

namespace App\View\Components\Menu;

use App\Enums\AdministratorRole;
use App\Models\Administrator;
use App\Models\Customer;
use App\Models\Staff;
use App\Models\Store;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class SideMenu extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // 権限でメニューが変わる場合はここで判定する
        $menuList = match (auth()->user()->role) {
            AdministratorRole::ADMIN => $this->admin(),
            default => $this->default()
        };

        return view('components.menu.sideMenu', ['menuList' => $menuList]);
    }

    /**
     * デフォルトのメニュー
     *
     * @return array
     */
    public function default()
    {
        // ここにメニューを記載する
        return [
            [
                // ホーム
                'text' => __('menu.home'),
                'link' => route('home'),
                'icon' => 'home',
                'active' => Route::Is('home'),
            ],
        ];
    }

    /**
     * 管理者のメニュー
     *
     * @return array|array[]
     */
    private function admin(): array
    {
        try {
            $resourceCustomers = new Customer;
            $resourceUsers = new User;
            $resourceStores = new Store;
            $resourceStaffs = new Staff;
            $resourceAdministrators = new Administrator;

            // ここにメニューを記載する
            return [
                [
                    // ホーム
                    'text' => __('menu.home'),
                    'link' => route('home'),
                    'icon' => 'home',
                    'active' => Route::Is('home'),
                ],
                [
                    // 顧客
                    'text' => __('menu.'.$resourceCustomers->getTable()),
                    'link' => route($resourceCustomers->getTable().'.index'),
                    'icon' => 'list',
                    'active' => Route::Is($resourceCustomers->getTable().'.*'),
                ],
                [
                    // ユーザー
                    'text' => __('menu.'.$resourceUsers->getTable()),
                    'link' => route($resourceUsers->getTable().'.index'),
                    'icon' => 'list',
                    'active' => Route::Is($resourceUsers->getTable().'.*'),
                ],
                [
                    // 店舗
                    'text' => __('menu.'.$resourceStores->getTable()),
                    'link' => route($resourceStores->getTable().'.index'),
                    'icon' => 'list',
                    'active' => Route::Is($resourceStores->getTable().'.*'),
                ],
                [
                    // 店舗
                    'text' => __('menu.'.$resourceStaffs->getTable()),
                    'link' => route($resourceStaffs->getTable().'.index'),
                    'icon' => 'list',
                    'active' => Route::Is($resourceStaffs->getTable().'.*'),
                ],
                [
                    // 管理者
                    'text' => __('menu.'.$resourceAdministrators->getTable()),
                    'link' => route($resourceAdministrators->getTable().'.index'),
                    'icon' => 'peoples',
                    'active' => Route::Is($resourceAdministrators->getTable().'.*'),
                ],
            ];
        } catch (\Exception $e) {
            Log::error('メニューの取得に失敗しました。', ['message' => $e->getMessage(), 'line' => $e->getLine()]);

            return [];
        }
    }
}

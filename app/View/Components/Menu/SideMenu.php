<?php

namespace App\View\Components\Menu;

use App\Enums\AdministratorRole;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Notification;
use App\Models\Staff;
use App\Models\Stock;
use App\Models\Store;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;
use Laravel\Pennant\Feature;

class SideMenu extends Component
{
    protected array $features = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->features = Feature::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // 権限でメニューが変わる場合はここで判定する
        $menuList = match (auth()->user()->role) {
            AdministratorRole::ADMIN => $this->admin(),
            AdministratorRole::SYSTEM => $this->system(),
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
        $menu = $this->default();

        /**
         * リソース系のメニュー項目
         * 並び順番はm_system_featuresに合わせてキー名でアルファベット順
         */
        // 顧客
        if ($this->menuCustomers()) {
            $menu[] = $this->menuCustomers()[0];
        } // todo:グループ表示に対応時に変更
        // スタッフ
        if ($this->menuStaffs()) {
            $menu[] = $this->menuStaffs()[0];
        } // todo:グループ表示に対応時に変更
        // 店舗
        if ($this->menuStores()) {
            $menu[] = $this->menuStores()[0];
        } // todo:グループ表示に対応時に変更
        // 在庫
        if ($this->menuStock()) {
            $menu[] = $this->menuStock()[0];
        } // todo:グループ表示に対応時に変更
        // ユーザー
        if ($this->menuUsers()) {
            $menu[] = $this->menuUsers()[0];
        } // todo:グループ表示に対応時に変更
        // 通知
        if ($this->menuNotifications()) {
            $menu[] = $this->menuNotifications()[0];
        } // todo:グループ表示に対応時に変更
        // 企業
        if ($this->menuCompany()) {
            $menu[] = $this->menuCompany()[0];
        } // todo:グループ表示に対応時に変更

        return $menu;
    }

    /**
     * システムのメニュー
     *
     * @return array|array[]
     */
    private function system(): array
    {
        // 管理者のメニューを取得
        $menu = $this->admin();
        // システムのメニュー項目を追加
        $menu[] = [
            // 機能
            'group' => 'system',
            'text' => __('menu.system.*'),
            'link' => null,
            'icon' => 'empty',
            'active' => Route::Is('system.*'),
            'items' => [
                [
                    'text' => __('menu.system.features'),
                    'link' => route('system.listFeature'),
                    'icon' => 'config',
                    'active' => Route::Is('system.listFeature'),
                ],
                [
                    'text' => __('menu.system.companies'),
                    'link' => route('system.companies.index'),
                    'icon' => 'list',
                    'active' => Route::Is('system.companies.*'),
                ],
                [
                    'text' => __('menu.system.administrators'),
                    'link' => route('system.administrators.index'),
                    'icon' => 'list',
                    'active' => Route::Is('system.administrators.*'),
                ],
            ],
        ];

        return $menu;
    }

    /**
     * リソース系のメニュー
     */
    private function menuResources(string $modelClass): ?array
    {
        $menu = null;
        $resource = new $modelClass;
        $resourceTable = $resource->getTable();

        if (array_key_exists($resourceTable, $this->features)) {
            $menu = [];
            // 機能が有効の場合はメニューに表示
            $menu[] = [
                'group' => $resourceTable,
                'text' => __('menu.'.$resourceTable),
                'link' => route($resourceTable.'.index'),
                'icon' => 'list',
                'active' => Route::Is($resourceTable.'.*'),
            ];
        }

        return $menu;
    }

    /**
     * ユーザーのメニュー
     */
    private function menuUsers(): ?array
    {
        return $this->menuResources(User::class);
    }

    /**
     * 顧客のメニュー
     */
    private function menuCustomers(): ?array
    {
        return $this->menuResources(Customer::class);
    }

    /**
     * 店舗のメニュー
     */
    private function menuStores(): ?array
    {
        return $this->menuResources(Store::class);
    }

    /**
     * スタッフのメニュー
     */
    private function menuStaffs(): ?array
    {
        return $this->menuResources(Staff::class);
    }

    /**
     * 通知のメニュー
     */
    private function menuNotifications(): ?array
    {
        return $this->menuResources(Notification::class);
    }

    /**
     * 企業のメニュー
     */
    private function menuCompany(): ?array
    {
        return $this->menuResources(Company::class);
    }

    /**
     * 在庫のメニュー
     */
    private function menuStock(): ?array
    {
        return $this->menuResources(Stock::class);
    }
}

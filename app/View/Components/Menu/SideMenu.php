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
        $menu = [];

        /**
         * リソース系のメニュー項目
         * 並び順番はm_system_featuresに合わせてキー名でアルファベット順
         */
        // 管理者
        if($this->menuAdministrators())$menu[] = $this->menuAdministrators()[0]; // todo:グループ表示に対応時に変更
        // 顧客
        if($this->menuCustomers()) $menu[] = $this->menuCustomers()[0]; // todo:グループ表示に対応時に変更
        // スタッフ
        if($this->menuStaffs()) $menu[] = $this->menuStaffs()[0]; // todo:グループ表示に対応時に変更
        // 店舗
        if($this->menuStores()) $menu[] = $this->menuStores()[0]; // todo:グループ表示に対応時に変更
        // ユーザー
        if($this->menuUsers()) $menu[] = $this->menuUsers()[0]; // todo:グループ表示に対応時に変更

        // システムのメニュー項目
        $menu[] = [
            // 機能
            'text' => __('menu.system.features'),
            'link' => route('system.listFeature'),
            'icon' => 'config',
            'active' => Route::Is('system.*'),
        ];

        return $menu;
    }

    /**
     * リソース系のメニュー
     * @param string $modelClass
     * @return array|null
     */

    private function menuResources(string $modelClass) :?array
    {
        $menu = null;
        $resource = new $modelClass;
        $resourceTable = $resource->getTable();

        if(array_key_exists($resourceTable, $this->features)){
            $menu = [];
            // 機能が有効の場合はメニューに表示
            $menu[] = [
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
     * @return array|null
     */
    private function menuUsers() :?array
    {
        return $this->menuResources(User::class);
    }

    /**
     * 顧客のメニュー
     * @return array|null
     */
    private function menuCustomers() :?array
    {
        return $this->menuResources(Customer::class);
    }

    /**
     * 店舗のメニュー
     * @return array|null
     */
    private function menuStores() :?array
    {
        return $this->menuResources(Store::class);
    }

    /**
     * スタッフのメニュー
     * @return array|null
     */
    private function menuStaffs() :?array
    {
        return $this->menuResources(Staff::class);
    }

    /**
     * 管理者のメニュー
     * @return array|null
     */
    private function menuAdministrators() :?array
    {
        return $this->menuResources(Administrator::class);
    }
}

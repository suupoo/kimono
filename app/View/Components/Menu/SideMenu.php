<?php

namespace App\View\Components\Menu;

use App\Models\Customer;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class SideMenu extends Component
{
    const LINK = 0;
    const TEXT = 1;
    const ICON = 2;

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
        $menuList = $this->menuList();
        return view('components.menu.sideMenu', ['menuList' => $menuList]);
    }

    private function menuList(): array
    {
        try {
            $resourceCustomers = new Customer;
            // ここにメニューを記載する
            return [
                // 顧客
                [ self::LINK => route($resourceCustomers->getTable().".index"), self::TEXT => $resourceCustomers::NAME, self::ICON => 'list'],
                // todo:メニューグループ対応
            ];
        } catch (\Exception $e) {
            return [];
        }
    }
}

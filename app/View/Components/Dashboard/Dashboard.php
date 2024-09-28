<?php

namespace App\View\Components\Dashboard;

use App\Models\MSystemCompanyDashboard;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Dashboard extends Component
{
    protected ?MSystemCompanyDashboard $dashboard;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->dashboard = auth()->user()
            ->systemCompanies?->first()
            ?->dashboards?->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $dashboard = $this->dashboard;
        return view('components.dashboard.dashboard', compact('dashboard'));
    }
}

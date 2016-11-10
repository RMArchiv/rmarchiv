<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Models\Logo;

class LogoComposer {

    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $logo = Logo::inRandomOrder()->take(1)->get()->first();

        $view->with('logo', $logo);
    }

}
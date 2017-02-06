<?php

namespace App\Http\ViewComposers;

use App\Models\Logo;
use Illuminate\Contracts\View\View;

class LogoComposer
{
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        //$logo = Logo::inRandomOrder()->take(1)->get()->first();
        $logo = \DB::table('logos')
            ->leftJoin('users', 'logos.user_id', '=', 'users.id')
            ->leftJoin('logo_votes', 'logos.id', '=', 'logo_votes.logo_id')
            ->select(['logos.title', 'logos.filename', 'users.name', 'users.id'])
            ->whereRaw('(logo_votes.up - logo_votes.down) > 0')
            ->inRandomOrder()
            ->first();

        $view->with('logo', $logo);
    }
}

<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Models\User;

class UserComposer {

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
        $user = \DB::table('users')
            ->leftJoin('user_settings', 'users.id', '=', 'user_settings.user_id')
            ->where('users.id', '=', \Auth::id());

        $view->with('user', $user);
    }

}
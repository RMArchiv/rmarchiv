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
        //$user = Auth::check();

        $userid = \Auth::id();
        $user = User::where('id', $userid)->get()->first();

        $view->with('user', $user);
    }

}
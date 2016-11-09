<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Logo;
use App\User;

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
        $logo = Logo::inRandomOrder()->take(1)->get();

        //print_r($logo);
        //dump($logo);

        $res = array();
        $user = array();

        foreach($logo as $item){
            $user = User::find($item->user_id);
            $res = $item;
        }

        $logo = $res;

        $view->with('logo', $logo);
        $view->with('user', $user);
    }

}
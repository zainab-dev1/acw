<?php
 
namespace App\View;
 
use Illuminate\View\View;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
 
class ApplistComposer
{
    
 
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $applists = \DB::table('applist')->get();

        $user_role = \DB::table('user_roles')->where('user_id', Auth::user()->id)->first();

        $view->with('applists', $applists)
            ->with('user_role',$user_role);
    }
}
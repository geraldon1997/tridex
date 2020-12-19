<?php
namespace App\Core;

use App\Models\Auth;
use App\Models\Role;
use App\Models\User;

class Controller
{
    public $main = 'main';
    public $dashboard = 'dashboard';

    public $views = [
        'auth' => [
            'general' => [
                'dashboard',
                'profile',
                'login',
                'wallet',
                'referrals',
                'active_investments',
                'pending_investments',
                'completed_investments',
                'pending_withdrawals',
                'completed_withdrawals',
                'bonus',
                'payment_page'
            ],
            'admin' => [
                'active_members',
                'inactive_members',
                'moderators',
                'user',
                'users_referrals',
                'users_investments'
            ],
            'moderator' => [
                'users_investments',
                'user'
            ]
        ],
        'nonauth' => [
            'home',
            'about',
            'register',
            'signin',
            'forgotpassword',
            'resetpassword',
            'verifyuser',
        ]
    ];

    public function view($view, $params = null)
    {
        $this->views['nonauth'] = array_combine(range(1, count($this->views['nonauth'])), $this->views['nonauth']);
        $this->views['auth']['general'] = array_combine(range(1, count($this->views['auth']['general'])), $this->views['auth']['general']);
        $this->views['auth']['admin'] = array_combine(range(1, count($this->views['auth']['admin'])), $this->views['auth']['admin']);
        $this->views['auth']['moderator'] = array_combine(range(1, count($this->views['auth']['moderator'])), $this->views['auth']['moderator']);
        
        if (!isset($_SESSION['email'])) {
            $exist_in_nonauth = array_search($view, $this->views['nonauth']);
            if (!$exist_in_nonauth) {
                $exists_in_general = array_search($view, $this->views['auth']['general']);
                if (!$exists_in_general) {
                    Response::code(404);
                    return '<h1>page not found</h1>';
                }
                Response::code(403);
                return Response::redirect('/user/signin');
            }
            Response::code(200);
            return View::renderView($this->main, $view, $params);
        }

        $userid = User::findSingle(User::$table, 'email', $_SESSION['email'])[0]['id'];
        $is_logged_in = Auth::findSingle(Auth::$table, 'user_id', $userid)[0]['is_logged_in'];
        
        $exists_in_general = array_search($view, $this->views['auth']['general']);
        if (!$exists_in_general) {
            $roleid = User::findSingle(User::$table, 'email', $_SESSION['email'])[0]['role_id'];
            $role = Role::findSingle(Role::$table, 'id', $roleid)[0]['role'];

            $exists_in_secret = array_search($view, $this->views['auth'][$role]);
            if (!$exists_in_secret) {
                Response::code(404);
                unset($_SESSION['email']);
                return Response::redirect('/user/signin');
            }
            Response::code(200);
            if (!$is_logged_in) {
                return View::renderView($this->main, $view, $params);
            }
            return View::renderView($this->dashboard, $view, $params);
        }
        Response::code(200);
        if (!$is_logged_in) {
            return View::renderView($this->main, $view, $params);
        }
        return View::renderView($this->dashboard, $view, $params);
    }
}

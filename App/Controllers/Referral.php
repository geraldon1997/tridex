<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Profile;
use App\Models\Referral as ModelsReferral;
use App\Models\User;

class Referral extends Controller
{
    public function users($id)
    {
        $referred = [];
        $id = $id[0];
        $referrals = ModelsReferral::find(ModelsReferral::$table, 'referrer', $id);
        foreach ($referrals as $key) {
            $profile = User::find(User::$table, 'id', $key['referred'])[0];
            array_push($referred, $profile);
        }
        $referrer = User::find(User::$table, 'id', $id)[0]['email'];
        return $this->view('users_referrals', ['referrer' => $referrer, 'referred' => $referred]);
    }
}

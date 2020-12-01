<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Investment as ModelsInvestment;
use App\Models\Package;
use App\Models\User;
use App\Models\Wallet;
use App\Controllers\Mail;
use App\Models\Profile;

class Investment extends Controller
{
    public function active()
    {
        $investment = ModelsInvestment::findMultiple(ModelsInvestment::$table, "is_paid = 1 AND is_active = 1");
        return $this->view('active_investments', ['admin' => $investment]);
    }

    public function pending()
    {
        $investment = ModelsInvestment::findMultiple(ModelsInvestment::$table, "is_paid = 1 AND is_active = 0");
        return $this->view('pending_investments', ['admin' => $investment]);
    }

    public function completed()
    {
        $investment = ModelsInvestment::findMultiple(ModelsInvestment::$table, "is_paid = 1 AND is_active = 0 AND is_completed = 1");
        return $this->view('completed_investments', ['admin' => $investment]);
    }

    public function addInvestment()
    {
        $userid = User::userid($_SESSION['email']);
        $package = $_POST['package'];
        $amount = $_POST['amount'];

        $interest = Package::package($package)[0]['interest'];
        $period = Package::package($package)[0]['period'];

        $expected = $amount + ($amount * $interest * $period);

        $expire = time() + (60 * 60 * 24 * $period);

        $values = [
        'user_id' => $userid,
        'package_id' => $package,
        'amount' => $amount,
        'period' => $expire,
        'accumulated_amount' => 0,
        'expected_amount' => $expected,
        'is_active' => 0,
        'is_paid' => 0,
        'is_completed' => 0,
        'is_withdrawn_to_wallet' => 0,
        'date_updated' => date('Y-m-d')
        ];

        $name = Profile::find(Profile::$table, 'user_id', $userid)[0]['firstname'];
        $packagename = Package::package($package)[0]['package_name'];
        $mailamount = '$'.number_format($amount);

        $mail = new Mail;
        $mail->receiver = $_SESSION['email'];
        $mail->subject = "Pending Investment";
        $template = $mail->template();
        $mail->body = $mail->inject($template, APP_NAME, "You Requested An Investment", $name, "You requested an invesment of <b>$mailamount</b> under our $packagename plan <br>, Please Make the deposit to start earning");
        $mail->sendemail();

        return ModelsInvestment::insert(ModelsInvestment::$table, $values);
    }

    public function pay()
    {
        $id = $_POST['inv_id'];

        return ModelsInvestment::update(ModelsInvestment::$table, "is_paid = 1", 'id', $id);
    }

    public function paid()
    {
        //
    }

    public function activate()
    {
        $id = $_POST['inv_id'];
        

        $investment = ModelsInvestment::find(ModelsInvestment::$table, 'id', $id);
        $time = Package::package($investment[0]['package_id'])[0]['period'];
        $period = time() + (60 * 60 * 24 * $time);

        $email = User::find(User::$table, 'id', $investment[0]['user_id'])[0]['email'];
        $amount = '$'.number_format($investment[0]['amount']);
        $name = Profile::find(Profile::$table, 'user_id', $investment[0]['user_id'])[0]['firstname'];

        $mail = new Mail;
        $mail->receiver = $email;
        $mail->subject = "Payment Confirmed";
        $template = $mail->template();
        $mail->body = $mail->inject($template, APP_NAME, 'PAYMENT CONFIRMATION', $name, "your payment of <b>$amount</b> worth of coin has been confirmed");
        $mail->sendemail();
        
        return ModelsInvestment::update(ModelsInvestment::$table, "is_active = 1, period = '$period' ", 'id', $id);
    }

    public function currentIV()
    {
        $current = ModelsInvestment::current()[0];
        // return json_encode($current);
        return $current;
    }

    public function withdrawtowallet()
    {
        $invid = $_POST['inv_id'];
        ModelsInvestment::update(ModelsInvestment::$table, "is_withdrawn_to_wallet = 1", 'id', $invid);
        $investment = ModelsInvestment::findSingle(ModelsInvestment::$table, 'id', $invid);
        
        $userid = User::userid($_SESSION['email']);
        $wallet = Wallet::exists(Wallet::$table, 'user_id', $userid);
        
        if ($wallet) {
            $new_balance = $wallet[0]['balance'] + $investment[0]['expected_amount'];
            return Wallet::update(Wallet::$table, "balance = $new_balance", 'user_id', $userid);
        }

        return Wallet::insert(Wallet::$table, [
            'user_id' => $userid,
            'balance' => $investment[0]['expected_amount'],
            'withdrawable' => 0
        ]);
    }

    public function accu()
    {
        var_dump($_POST['accu']);
    }
}

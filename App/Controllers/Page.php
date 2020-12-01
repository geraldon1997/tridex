<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Migration;

class Page extends Controller
{
    public function default()
    {
        return $this->view('home');
    }

    public function about()
    {
        return $this->view('about');
    }

    public function how()
    {
        return $this->view('how');
    }

    public function dbseeder()
    {
        $mail = new Mail;
        $template = $mail->template('verify');
        return $mail->inject($template, 'BTC', 'welcome to [site_title]', 'mosco@email.com', '<a class="btn btn-primary" href="[link]">verify</a>', 'https://google.com');
    }
}

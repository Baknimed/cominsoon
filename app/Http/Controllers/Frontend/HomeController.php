<?php

namespace App\Http\Controllers\Frontend;


use App\Commons\Response;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Mail\ComingSoonMailable;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }


    public function index()
    {
        return view("frontend.page.landing_01");
    }

    public function write(Request $request)
    {
        $data = $this->validate($request, [
            'email' => 'required',
        ]);

        $subscriber = Subscriber::query()
            ->where('email', $request->email)
            ->exists();

        if (!$subscriber) {
            $user = new Subscriber();
            $user->fill($data)->save();
            return $this->response->formatResponse(200, [], "success");
        } else {
            return $this->response->formatResponse(208, [], "This email is already in your wishlist!");
        }
    }

    public function changeLanguage($locale)
    {
        Session::put('language_code', $locale);
        $language = Session::get('language_code');

        return redirect()->back();
    }
}

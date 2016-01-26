<?php

namespace App\Http\Controllers\Auth;

use App\Checkin;
use App\Equipment;
use App\User;
use Carbon\Carbon;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => 1,
            'bank' => $data['bank'],
            'address' => $data['address'],
            'subscription' => $data['subscription']
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        \Auth::logout();
        return redirect('/');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showprofile()
    {
        $user = \Auth::user();
        return view('auth.profile', compact('user'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_profile(Request $request)
    {
        $user = \Auth::user();
        $data = $request->except(['_token', '_method']);
        $user->update($data);
        return redirect()->back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function stats()
    {
        $user = \Auth::id();

        $now = new Carbon;
        $currentFirstDay = clone $now;
        $currentFirstDay = $currentFirstDay->firstOfMonth();
        $currentLastDay = clone $now;
        $currentLastDay = $currentLastDay->lastOfMonth();

        $thisMonth = Checkin::where('user_id', $user)
            ->whereBetween('checkin', [$currentFirstDay, $currentLastDay])
            ->whereBetween('checkout', [$currentFirstDay, $currentLastDay])
            ->orderBy('checkout')
            ->get();

        $stats['current']['total'] = $thisMonth->sum('burned');
        $stats['current']['min'] = $thisMonth->min('burned');
        $stats['current']['max'] = $thisMonth->max('burned');

        $previousLastDay = clone $currentFirstDay;
        $previousLastDay = $previousLastDay->modify('-1 day');
        $previousFirstDay = clone $previousLastDay;
        $previousFirstDay = $previousFirstDay->firstOfMonth();

        $previousMonth = Checkin::where('user_id', $user)
            ->whereBetween('checkin', [$previousFirstDay, $previousLastDay])
            ->whereBetween('checkout', [$previousFirstDay, $previousLastDay])
            ->orderBy('checkout')
            ->get();
        $stats['previous']['total'] = $previousMonth->sum('burned');
        $stats['previous']['min'] = $previousMonth->min('burned');
        $stats['previous']['max'] = $previousMonth->max('burned');

        if ($stats['current']['total'] < $stats['previous']['total']) {
            $stats['difference'] = $stats['previous']['total'] - $stats['current']['total'];
            $stats['suggestion'] = Equipment::orderBy('calories_pm', 'desc')->first();
        }

        return view('equipment.progress', $stats);
    }

    public function advice()
    {
        $equipment = Equipment::all();
        return view('auth.advice', compact('equipment'));
    }

    public function requestadvice(Request $request)
    {
        $data['user'] = \Auth::user()->name . ' (' . \Auth::user()->email . ')';
        $data['date'] = (new \DateTime())->format('Y-m-d H:i:s');
        $data += $request->except('_token');
        $emailcontent = "<h2>You've received a request for advice:</h2>\n";
        $emailcontent .= "<table>\n";
        foreach ($data as $key => $value) {
            $emailcontent .= <<<CONTENT
<tr>
    <th>$key</th>
    <td>$value</td>
</tr>

CONTENT;

        }
        $emailcontent .= "</table>";
        \Mail::raw($emailcontent, function ($message) {
            $message->subject('Request for advice')
                ->from('noreply@sportschool.nl', 'Sportschool noreply')
                ->replyto(\Auth::user()->email, \Auth::user()->name)
                ->to('sportschool@bcome.nl');
        });
        return 'Your request for advice has beent sent.';
    }
}

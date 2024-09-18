<?php



namespace App\Http\Controllers\Auth;

use DB;

use App\User;

use Auth;
use Carbon\Carbon;

use Socialite;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Arr;

class LoginController extends Controller

{

    /*

      |--------------------------------------------------------------------------

      | Login Controller

      |--------------------------------------------------------------------------

      |

      | This controller handles authenticating users for the application and

      | redirecting them to your home screen. The controller uses a trait

      | to conveniently provide its functionality to your applications.

      |

     */



    use AuthenticatesUsers;



    /**

     * Where to redirect users after login.

     *

     * @var string

     */

    protected $redirectTo = '/home';



    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

        $this->middleware('guest')->except('logout');
    }



    /**

     * Redirect the user to the OAuth Provider.

     *

     * @return Response

     */

    public function redirectToProvider($provider)

    {

        return Socialite::driver($provider)->redirect();
    }



    /**

     * Obtain the user information from provider.  Check if the user already exists in our

     * database by looking up their provider_id in the database.

     * If the user exists, log them in. Otherwise, create a new user then log them in. After that 

     * redirect them to the authenticated users homepage.

     *

     * @return Response

     */

    public function handleProviderCallback($provider)

    {

        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);

        Auth::login($authUser, true);

        return redirect($this->redirectTo);
    }



    /**

     * If a user has registered before using social auth, return the user

     * else, create a new user object.

     * @param  $user Socialite user object

     * @param $provider Social auth provider

     * @return  User

     */

    public function findOrCreateUser($user, $provider)

    {

        if ($user->getEmail() != '') {

            $authUser = User::where('email', 'like', $user->getEmail())->first();

            if ($authUser) {

                /* $authUser->provider = $provider;

                  $authUser->provider_id = $user->getId();

                  $authUser->update(); */

                return $authUser;
            }
        }

        $str = $user->getName() . $user->getId() . $user->getEmail();

        return User::create([

            'first_name' => $user->getName(),

            'middle_name' => $user->getName(),

            'last_name' => $user->getName(),

            'name' => $user->getName(),

            'email' => $user->getEmail(),

            //'provider' => $provider,

            //'provider_id' => $user->getId(),

            'password' => bcrypt($str),

            'is_active' => 1,

            'verified' => 1,

        ]);
    }

    public function verify_otp()
    {

        $email = isset($_GET['email']) ? base64_decode($_GET['email']) : '';
        $candidate_or_employer = isset($_GET['type']) ? base64_decode($_GET['type']) : '';
        $password_decode = isset($_GET['cre']) ? base64_decode($_GET['cre']) : '';

        if ($email == '' || $password_decode == '') {
            return redirect()->route('login');
        }
        $password = json_decode($password_decode);
        $user = array(
            'email' => $email,
            'candidate_or_employer' => $candidate_or_employer,
            'password' => $password
        );
        return view('auth.verify_otp')->with('user', $user);
    }

    public function check_otp(Request $request)
    {
        
        $otp = $request->otp;
        $email = $request->email;
        $candidate_or_employer = $request->candidate_or_employer;
        $get_otp = DB::table('user_otp')->where('otp', $otp)->where('otp_status', 1)->where('user_email', $email)->where('login_type',$candidate_or_employer)->first();

        if ($get_otp) {
            $created_at = Carbon::parse($get_otp->created_at);
            $minutes_diff = $created_at->diffInMinutes(Carbon::now());
            if ($minutes_diff < 5) {
                // OTP expired, update the status to 2 (expired)
                $update_otp_status = DB::table('user_otp')  
                    ->where('id', $get_otp->id)
                    ->where('login_type', $get_otp->login_type)
                    ->where('otp', $otp)
                    ->where('user_email', $email)
                    ->update(['otp_status' => 2]);
                if ($update_otp_status) {
                    echo 1;
                    die;
                }
            } else {
                echo 2;
                die;
            }
        } else {
            echo 2;
            die;
        }
    }
}

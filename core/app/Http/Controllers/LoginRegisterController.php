<?php

namespace App\Http\Controllers;
use App\Bonus;
use App\Refference;
use App\Setting;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class LoginRegisterController extends Controller
{
    public function registerPage()
    {
        $username = '';
        if(request('username') != null){
            if(count(User::where('username',request('username'))->pluck('username'))){

                $username = request('username');
                return view('frontend.registration',compact('username'));
            }else{
                return redirect()->route('register')->with('error','Invalid Refferal Link');
            }
        }

        return view('frontend.registration',compact('username'));
    }

    public function register(Request $request,Setting $setting,Transaction $trans)
    {
        $this->validate($request,[
            'username'=>'required|unique:users,username',
            'email'=>'required|unique:users,email',
            'password'=>'required|confirmed|min:4',
        ]);
            
          $transaction = time();
          $refferd = User::where('username',$request->reffer)->first();
          $bonus = Setting::first()->signup_bonus; 
          if(empty($refferd)){
            $user = User::create([
                'username'=>$request->username,
                'email'=>$request->email,
                'balance'=>$bonus,
                'password'=>bcrypt($request->password)
            ]);

            $trans->getAdminBonus($user->id,$user->balance,$user->username,$transaction,$user->balance);

            Auth::login($user);
            return redirect()->route('home');

          }else{ 

            //   Reffered user Commission
            $comission = Setting::pluck('comission');
            $all_setting =  Setting::first();
            $amount = $refferd->balance + ($refferd->balance * $comission[0] )/100;
            $refferedUserComission = ($refferd->balance * $comission[0] )/100;
            $refferd->balance = $amount;
            $refferd->save();
            $transaction = time();
            // End of reffered user Comission


            // Create User by refference
            $user = User::create([
                'username'=>$request->username,
                'email'=>$request->email,
                'balance'=>$bonus,
                'reffered_by'=>$refferd->id,
                'password'=>bcrypt($request->password)
            ]);

            $trans->getAdminBonus($user->id,$user->balance,$user->username,$transaction,$user->balance);
            $trans->getRefferedUserMoneyLog($refferd->id,$refferedUserComission,$refferd->id,$transaction,$refferd->balance);

            Auth::login($user);
            return redirect()->route('home');

          }    
        
    }

    public function loginPage()
    {
        return view('frontend.loginPage');
    }


    public function login(Request $request)
    {

        $this->validate($request,[
            'username'=>'required',
            'password'=>'required'
        ]);
            
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            return redirect()->route('home');
        }
        
        return redirect()->back()->with('error','Login Failed');
    }

    public function resetPage()
    {
        return view('frontend.reset');
    }

    public function resetPasswordSendMail(Request $request)
    {
        $user = User::where('email',$request->email)->get();
        if(count($user) == 0){
            return redirect()->back()->with('error','No User In this Email');
            
        }else{
            $encode_email = base64_encode($request->email);
            $message = route('reset_form',['token'=>$encode_email]);
            $headers = 'From: admin@example.com' . "\r\n" .
                        'Reply-To: webmaster@example.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();;
            mail($request->email,'Change Password',$message,$headers);
            return redirect()->back()->with('success','Send Mail Success');
        }
        
    }

    public function resetform(Request $request)
    {
        $decode_email = base64_decode($request->token);
        $user = User::where('email',$decode_email)->get();
        if(count($user) == 0){
            return redirect()->route('login')->with('invalidurl','Invalid Url');
        }
        return view('frontend.resetform');
    }

    public function resetformsubmit(Request $request)
    {
        $this->validate($request,[
            'password'=>'required|confirmed|min:4',
        ]);
        
        $decode_email = base64_decode($request->token);
        $user = User::where('email',$decode_email)->first();
        
        $user->password = bcrypt($request->password);

        $user->save();

        return redirect()->route('login')->with('success','Password Change Success');
        
    }
}

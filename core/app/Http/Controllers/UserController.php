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

class UserController extends Controller
{
    
    public function home()
    {
        $reffer_list = User::with('reffer')->where('reffered_by',auth()->user()->id)->get();
        $transfermoney = Transaction::with('user')->where('user_id',auth()->user()->id)->orderBy('id','desc')->latest()->paginate(5);
        // return $transfermoney;
        return view('frontend.home',compact('transfermoney','reffer_list'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function transaction(Request $request,Transaction $trans,Setting $setting,User $user)
    {
       $this->validate($request,[
            'money' => 'required|numeric|min:1',
            'username' => 'required',
       ]);
       

    if(Auth::user()->username == $request->username){
           return redirect()->back()->with('error','You cannot send you money');
       }

    if(count(User::where('username',$request->username)->pluck('username'))){
    
            $user_info = User::where('username',$request->username);
            $balance = $user_info->pluck('balance');

            // validation for short balance
            if(Auth::user()->balance < $request->money){
                return redirect()->back()->with('short','You have not Enough balance');
            }

        // transaction logic set by admin
        $transaction_id = time();
        $charge = ($setting->first()->charge*$request->money)/100;
        $reciver_new_balance = $balance[0]+$request->money;
        $update_user = Auth::user()->balance - $request->money - $charge;

            
        if($update_user < 0){
            return redirect()->back()->with('error','Not Enough Balance');
        }

        // If user Is not Reffered
       
        if(empty(auth()->user()->reffered_by)){
            $receiver_id = User::where('username',$request->username)->first();
            $user_info->update(['balance'=>$reciver_new_balance]);
            $info = Auth::user();   
            $info->balance = $update_user;
            $info->save();
            
            $trans->userTransactionLogInfo($request->money,$request->username,$transaction_id,$charge,$info->balance);
            $trans->sendUserMoneyTransferLog($receiver_id->id,$request->money,$request->username,$transaction_id,$charge=0,$reciver_new_balance);
            return redirect()->back(); 
       }else{
    
        // Reffered User Balance Add
                
        $reffered_user = User::find(auth()->user()->reffered_by);
        $receiver_id = User::where('username',$request->username)->first();

        $reffered_user->balance = $reffered_user->balance + $request->money;
                
        $reffered_user->save();

        $info = Auth::user();
                
        $info->balance = $update_user;
    
        $info->save();

        $transactionOfRefferedUser = time() + 10;
        $amount = ($setting->first()->trans_bonus*$request->money)/100;
        $reffered_user->balance = $reffered_user->balance + $amount;
                
        $reffered_user->save();

        $trans->userTransactionLogInfo($request->money,$request->username,$transaction_id,$charge,$info->balance);
        $trans->sendUserMoneyTransferLog($receiver_id->id,$request->money,$request->username,$transaction_id,$charge,$reciver_new_balance);
        $trans->getRefferedUserMoneyLog($reffered_user->id,$amount,$reffered_user->username,$transactionOfRefferedUser,$reffered_user->balance);
        return redirect()->back();
    }            
    }else{ 
           return redirect()->back()->with('error','This user is not associate in our system');
       }
    }



    public function refferedUser()
    {
        $reffer_list = User::with('reffer')->where('reffered_by',auth()->user()->id)->get();
        return view('frontend.reffered',compact('reffer_list'));
    }



    public function refferEmail(Request $request)
    {
       $this->validate($request,[
            'email'=>'required|email'
       ]);
       $user = User::where('email', $request->email)->first();
      
       if($user == NULL){

            $route = route('register',['username'=>auth()->user()->username]);
            $headers = 'From:'.auth()->user()->email. "\r\n" .
                        'Reply-To:'.$request->email . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
            mail($request->email,'Reffer For Sign Up',$route,$headers);

            return redirect()->back()->with('success','Send Mail Success');
       }

       return redirect()->back()->with('exists','Existing user Can not be Reffered');
       
    }


  



}

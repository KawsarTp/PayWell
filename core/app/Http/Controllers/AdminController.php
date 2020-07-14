<?php

namespace App\Http\Controllers;

use App\Bonus;
use App\Currency;
use App\Setting;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
       return view('admin.login');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        if(Auth::guard('admin')->attempt(['username' => $username, 'password' => $password])){
            return redirect()->route('admin.home');
        }
        

        return redirect()->back()->with('error','Login Error');
        
    }


    public function home()
    {
        $trans_all = Transaction::with('user')->latest()->paginate(5);
        $totalTransaction = Transaction::all();
        
        $totalUser = User::all();
        
        $nonRefferedUserCount = User::whereNull('reffered_by')->count();

        $refferedUserCount = User::count();
        $totalRefferedUser = $refferedUserCount-$nonRefferedUserCount;


        

        // if(count($trans_all) == 0 && count($totalUser) == 0 && $refferedUser == null){
        //     return view('admin.dashboard');
        // }
        return view('admin.dashboard',compact('trans_all','totalUser','totalRefferedUser','totalTransaction'));
    }


    public function logout()
    { 
        Auth::logout();
        return redirect()->route('admin.login');
    }

    
    public function currency()
    {
        $currency = Currency::where('status',0)->get();
        return view('admin.currency',compact('currency'));
    }


    public function addCurrency(Request $request)
    {
        $this->validate($request,[
            'currency'=>'required|unique:currencies',
        ]);

        Currency::create([
            'currency'=>$request->currency
        ]);

        return redirect()->back()->with('success','Added Successfully');
    }


    public function changeCurrency(Request $request)
    {
       
        Currency::where('status',1)->update(['status'=>0]);
        $currency = Currency::find($request->currency_change)->update(['status'=>1]);


        return redirect()->back();
    }


    public function signUpBonus(Request $request)
    {
        $this->validate($request,[
            'bonus'=>'required|integer'
        ]);

        if($request->bonus < 0){
            return redirect()->back()->with('error','Bonus must be greater than 0');
        }
        
       $a = Bonus::first();

       if($a == null){
        Bonus::create(['bonus'=>$request->bonus]);
        return redirect()->route('admin.home');
       }else{
        $a->delete();

        Bonus::create(['bonus'=>$request->bonus]);
        return redirect()->route('admin.home');
       }
        
    }


    public function settingView()
    {
        $all_setting = Setting::first();
        if($all_setting == null){
            return view('admin.setting',compact('all_setting'));
        }
        return view('admin.setting',compact('all_setting'));
    }


    public function setting(Request $request)
    {
        $this->validate($request,[

            'comission'=>'required|numeric|min:0',
            'transbonus'=>'required|numeric|min:0',
            'charge'=>'required|numeric|min:0',
            'bonusall'=>'required|numeric|min:0',
            'signUp' => 'required|numeric|min:200',
            'currency' => 'required|min:2'
        ]);

        $setting = Setting::first();

        $setting->comission = $request->comission;
        $setting->trans_bonus = $request->transbonus;
        $setting->charge = $request->charge;
        $setting->bonusall = $request->bonusall;
        $setting->signup_bonus = $request->signUp;
        

        $setting->currency =  $setting->currency;


        $setting->save();
        
        return redirect()->back()->with('success','Updated Suceesfully');
        
    }


    public function userListPage()
    {
        $user_list = User::latest()->paginate(5);
        if($user_list == null ){
            return view('admin.userlist');
        }
       return view('admin.userlist',compact('user_list'));
    }

    public function updateBalance(Request $request)
    {
        $this->validate($request,[
            'addBalance'=>'numeric',
            'subBalance'=>'numeric',
        ]);


        $user = User::find($request->userid);

        if($request->addBalance == 0 && $request->subBalance == 0){
            return redirect()->back()->with('error','No Balance Add / Subtruct');
        }

        if($request->addBalance > 0 && $request->subBalance > 0){
            return redirect()->back()->with('error','Add And Subtruct can Not do in One Operation');
        }


        if($request->addBalance > 0 && $request->subBalance == 0){
           
            $user->balance = $user->balance + $request->addBalance;

            $user->save();

            $transactionId =  time() + 10 ;

            $status = 'Add Money Form Admin'; 

            $this->adminUpdateBalanceLog($user->id,$transactionId, $request->addBalance,$charge=0, $user->username,$user->balance,$status);

            return redirect()->back()->with('success','Add Balance Successfully');
        }
        

        if($request->subBalance > 0 && $request->addBalance == 0){
            $user->balance = $user->balance - $request->subBalance;
            $charge = $request->subBalance;
            $user->save();

            $transactionId =  time() + 10 ;

            $status = 'Subtruct Money Form Admin'; 

            $this->adminUpdateBalanceLog($user->id,$transactionId, $request->subBalance,$charge, $user->username,$user->balance,$status);

            return redirect()->back()->with('success','Subtruct Balance Successfully');
        }
    }

    public function loginUsingId($id)
    {
        $userId = User::find($id);
        Auth::login($userId);

        return redirect()->route('home');
    }

    public function transaction()
    {
        $trans_all = Transaction::with('user')->latest()->paginate(10);
        return view('admin.viewAllTransaction',compact('trans_all'));

    }


    public function userInfo(User $id)
    {

        $reffredBonus = 0;
        $allMoneyWithoutReffer = 0;
        $totalSendMoney = 0;

        $reffer = $id->reffer->count();

        if($id->reffer->count() > 0){
            $reffredBonus = Transaction::where('user_id',$id->id)->where('comission_status',1)->sum('amount');
        };

        $allMoneyWithoutReffer = Transaction::where('user_id',$id->id)->where('charge',0)->where('comission_status',0)->sum('amount');

        $allamount = Transaction::where('user_id',$id->id)->where('charge','>',0)->sum('amount');
        $allCharge = Transaction::where('user_id',$id->id)->where('charge','>',0)->sum('charge');

        $totalSendMoney = $allamount + $allCharge ;

        $transactionLog = $transfermoney = Transaction::with('user')->where('user_id',$id->id)->orderBy('id','desc')->latest()->paginate(5);

        // return $transactionLog;


        return view('admin.user_info',compact('id','reffer','reffredBonus','allMoneyWithoutReffer','totalSendMoney','transactionLog'));
    }

    public function giveBalanceComission(Request $request)
    {
        $user = User::all();

        if($user == null || $request->bonusall == 0){
            return redirect()->back()->with('error','Can Not give Bonus');
        }

        $transactionId = time() + 10;

        $comission = Setting::first();

        foreach($user as $userUpdate){
            $amount = ($comission->bonusall*$userUpdate->balance)/100;
            $userUpdate->balance = $userUpdate->balance + ($comission->bonusall*$userUpdate->balance)/100;
            $userUpdate->save();
            $status = 'Comission Given By Admin';
            $this->adminUpdateBalanceLog($userUpdate->id,$transactionId, $amount, $userUpdate->username,$userUpdate->balance,$status);
            
        }

        return redirect()->back()->with('success','Give Comission Successfully');
    }

    public function adminUpdateBalanceLog($id,$transactionId, $amount, $charge = 0, $reciver,$balance,$status)
    {
        $transaction = new Transaction();
        $transaction->user_id = $id;
        $transaction->transaction_id= $transactionId;
        $transaction->amount= $amount;
        $transaction->receive_by= $reciver;
        $transaction->charge= $charge;
        $transaction->balance= $balance;
        $transaction->status= $status;

        $transaction->save();
        
    }


    public function search(Request $request)
    {
        $this->validate($request,[
            'trans'=>'required'
        ]);

        $transaction = Transaction::with('user')->where('transaction_id','like', '%'.$request->trans.'%')->get();
        


        return view('admin.user_trans',compact('transaction'));
        
        
    }

}

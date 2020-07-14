<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];
    
    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function userTransactionLogInfo($amount,$receiver,$transaction,$charge = 0,$balance)
    {
            $this->create([
                'user_id'=>auth()->user()->id,
                'transaction_id'=>$transaction,
                'amount'=>$amount,
                'receive_by'=>$receiver,
                'charge'=>$charge,
                'balance'=>$balance,
                'status'=>'Send Money to '.$receiver
            ]);
        
    }
    public function sendUserMoneyTransferLog($id,$amount,$receiver,$transaction,$charge,$balance)
    {

        $this->create([
            'user_id'=>$id,
            'transaction_id'=>$transaction,
            'amount'=>$amount,
            'receive_by'=>$receiver,
            'charge'=>0,
            'balance'=>$balance,
            'status'=>'Get Money From '.auth()->user()->username
        ]);
        
    }
    public function getRefferedUserMoneyLog($id,$amount,$reciver,$transaction,$balance)
    {

        $this->create([
            'user_id'=>$id,
            'transaction_id'=>$transaction,
            'amount'=>$amount,
            'receive_by'=>$reciver,
            'charge'=>0,
            'balance'=>$balance,
            'status' => 'Get Money by refferal transaction',
            'comission_status'=>1
        ]);
    }

    public function getAdminBonus($id,$amount,$reciver,$transaction,$balance)
    {
        $this->create([
            'user_id'=>$id,
            'transaction_id'=>$transaction,
            'amount'=>$amount,
            'receive_by'=>$reciver,
            'charge'=>0,
            'balance'=>$balance,
            'status' => 'Get money by Admin'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\drug;
use App\quotation;
use App\quotation_row;
use App\notification;
use App\User;
use App\prescription;

class QuotationController extends Controller
{
    public function __construct() {
        
        $this->upload = new UploadController;
        $this->DbManagement= new DbManagementController;
        
    }

    public function process(Request $request){
        // return 'success';
        $drug=drug::where('id',$request->drug_id)->first();

        $qu=quotation::where('user_id',$request->user_id)->where('status',0)->where('prescription_id',$request->prescription_id)->first();

        if($qu){

            $data2= quotation_row::create([
                'quotation_id'=>$qu->id,
                'drug'=>$drug->name, 
                'qtr'=>$drug->price.' x '.$request->qtr,
                'amount'=>$drug->price*$request->qtr,
                'status'=>0
            ]);

            $qu->amount=$qu->amount+ $data2->amount;
            $qu->save();

            $data_array=['row'=>$data2,'amount'=>$qu->amount];
 
            return  $data_array;

        }else{
            $data= quotation::create([
                'user_id'=>$request->user_id,
                'prescription_id'=>$request->prescription_id,
                'amount'=>0,
                'status'=>0
            ]);
    
            $data1= quotation_row::create([
                'quotation_id'=>$data->id,
                'drug'=>$drug->name, 
                'qtr'=>$drug->price.' x '.$request->qtr,
                'amount'=>$drug->price*$request->qtr,
                'status'=>0
            ]);

            $data->amount=$data->amount+ $data1->amount;
            $data->save();

            $data_array=['row'=>$data1,'amount'=>$data->amount];
 
            return  $data_array;

        }

     }

     public function send(Request $request){


        $qu=quotation::where('user_id',$request->user_id)->where('prescription_id',$request->prescription_id)->first();

        $qu->status =1;
        $qu->save();
        $pr=prescription::where('id',$request->prescription_id)->first();
        $pr->status=1;
        $pr->save();

        // $details = [
        //     'title' => 'Mail from ItSolutionStuff.com',
        //     'body' => 'This is for testing email using smtp'
        // ];

        $user =User::where('id',$request->user_id)->first();
       
        //\Mail::to($user->email)->send(new \App\Mail\MyTestMail($details));

        //return redirect()->route('prescriptions.index')->with('message', 'quotation send successfully');
        return 'success';
     }

     public function reject(Request $request){

        $qu=quotation::where('id',$request->id)->first();

        if($qu){
            $qu->status =$request->status;
            $qu->save();

            $pr=prescription::where('id',$request->pr_id)->first();
            $pr->status=$request->status;
            $pr->save();
        }

        if($request->status==2){
            //$this->DbManagement->notificationStatus($request->id,'user_accept');
            $this->DbManagement->addNotification($request->id,'user_accept');
        }else{
            $this->DbManagement->addNotification($request->id,'user_reject');
        }
    
        return 'success';
     }

     public function delivery(Request $request){

        $qu=quotation::where('id',$request->id)->first();

        if($qu){
            $qu->status =3;
            $qu->save();

            $pr=prescription::where('id',$request->pr_id)->first();
            $pr->status=$request->status;
            $pr->save();

            if($request->status==5){
                $this->DbManagement->notificationStatus($request->id,'user_reject');
            }else{
                $this->DbManagement->notificationStatus($request->id,'user_accept');
            }
            
        }
    
        return 'success';
     }


     public function notification(){
        // return 'success';
        $accept=count(notification::where('type','user_accept')->where('success',false)->get());
        $reject=count(notification::where('type','user_reject')->where('success',false)->get());
 
        $data=['accept'=>$accept,'reject'=>$reject];
 
         return  $data;
     }


}

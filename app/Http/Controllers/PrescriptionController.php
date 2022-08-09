<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;
use App\Http\Controllers\UploadController;
use App\prescription;
use App\prescription_image;
use Illuminate\Support\Facades\Auth;
use App\drug;
use Illuminate\Support\Facades\DB;

class PrescriptionController extends Controller
{
    public function __construct() {
        
        $this->upload = new UploadController;
        $this->DbManagement= new DbManagementController;
        
    }

    public function index()
    {

        $prescriptions=$this->DbManagement->getPrescriptions();

        return view('pages.prescriptions.index',compact('prescriptions'));
        
    }

    public function cusindex()
    {

        $prescriptions=$this->DbManagement->getPrescriptionsByUserId(Auth::user()->id);

        return view('pages.prescriptions.cusindex',compact('prescriptions'));
        
    }

    public function create()
    {
        return view('pages.prescriptions.create');
        
    }

    public function uploadImages(Request $request)
    {

        $data= prescription::create([
            'user_id'=>Auth::user()->id,
            'note'=>$request->note,
            'delivery_address'=>$request->address,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
            'status'=>0
        ]);

        foreach($request->image as $img){
            $individual_image =  $this->upload->setImageUpload($img);
            $image_single=prescription_image::create([
                'prescription_id'=>$data->id,
                'url'=>$individual_image['imagePath'],
                'status'=>0
            ]);
        }

        return redirect()->route('prescriptions.cus.index')->with('status', 'Image Uploaded Successfully');

    }

    public function uploadPrescriptionView($id)
    {
        $prescription=$this->DbManagement->getPrescriptionsById($id);
        $drugs = DB::table('drugs as p')->where('status',1)->get();

        $quotations=$this->DbManagement->getQuotationsById($id);
        //dd($drugs);
        return view('pages.prescriptions.view',compact('prescription','drugs','quotations'));

    }

    public function myPrescriptionView($id)
    {
        $prescription=$this->DbManagement->getPrescriptionsById($id);
        $drugs = DB::table('drugs as p')->where('status',1)->get();

        $quotations=$this->DbManagement->getQuotationsById($id);
        //dd($drugs);
        return view('pages.prescriptions.view',compact('prescription','drugs','quotations'));

    }



    public function uploadImagess(Request $request)
    {
       // dd($request->image);
       // $this->validate($request,[
       //     'image_name'=>'required|mimes:jpeg,bmp,jpg,png|between:1, 6000',
       // ]);

            $image_name = $request->file('image')->getRealPath();
            //dd($image_name );
            //the upload method handles the uploading of the file and can accept attributes to define what should happen to the image

            //Also note you could set a default height for all the images and Cloudinary does a good job of handling and rendering the image.
            Cloudder::upload($image_name, null, array(
                "folder" => "prescriptions",  "overwrite" => FALSE,
                "resource_type" => "image", "responsive" => TRUE, "transformation" => array("quality" => "70", "width" => "250", "height" => "250", "crop" => "scale")
            ));

            $image_url = Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height" => $height, "crop" => "scale", "quality" => 70, "secure" => "true"]);

            dd($image_url);

        return redirect()->back()->with('status', 'Image Uploaded Successfully');
    }

    public function media(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'avatar' => 'image|mimes:jpeg,png,jpg|max:1048|required',
            ]);


            $image_name = $request->file('avatar')->getRealPath();
            //the upload method handles the uploading of the file and can accept attributes to define what should happen to the image

            //Also note you could set a default height for all the images and Cloudinary does a good job of handling and rendering the image.
            Cloudder::upload($image_name, null, array(
                "folder" => "laravel_tutorial",  "overwrite" => FALSE,
                "resource_type" => "image", "responsive" => TRUE, "transformation" => array("quality" => "70", "width" => "250", "height" => "250", "crop" => "scale")
            ));

            //Cloudinary returns the publicId of the media uploaded which we'll store in our database for ease of access when displaying it.

           $public_id = Cloudder::getPublicId();

            $width = 250;
            $height = 250;

            //The show method returns the URL of the media file on Cloudinary
            $image_url = Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height" => $height, "crop" => "scale", "quality" => 70, "secure" => "true"]);

            //In a situation where the user has already uploaded a file we could use the delete method to remove the media and upload a new one.
            if ($public_id != null) {
                $image_public_id_exist = User::select('public_id')->where('id', Auth::user()->id)->get();
                Cloudder::delete($image_public_id_exist);
            }

            $user = User::find(Auth::user()->id);
            $user->public_id = $public_id;
            $user->avatar_url = $image_url;
            $user->update();
            return back()->with('success_msg', 'Media successfully updated!');
        } else {
            return view('media');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Video;
use App\Events\VideoViewer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use LaravelLocalization;
class CrudController extends Controller
{
    use OfferTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getOffers(){
        $offers=Offer::select('id',
            'price','photo','name_'.LaravelLocalization::getCurrentLocale().' as name',
            'details_'.LaravelLocalization::getCurrentLocale().' as details' )->get();
        return View('offers.all',compact('offers'));

    }

    public function store(OfferRequest $request){

        //add photo
        $file_name= $this->saveImage($request->photo,'images/offers');


//        $rules= $this->getRules();
//        $message=$this->getMessage();
//
//        //validate
//
//        $validator= Validator::make($request->all(), $rules, $message);
//
//        if ($validator->fails()){
//            return redirect()->back()->withErrors($validator)->withInput($request->all());
//        }
        //insert
        Offer::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'photo' => $file_name,
            'price' => $request->price,
            'details_en' => $request->details_en,
            'details_ar' => $request->details_ar,
        ]);
        return redirect()->back()->with(['success'=>'تم اضافة العرض بنجاح']);

    }

    public function creat(){
        return view('offers.creat'); //edetion waiting
    }

    public function editOffer($offer_id){
        $offer= Offer::find($offer_id);
        if(!$offer){
            return redirect()->back();
        }
        $offer=Offer::select('id','name_en','name_ar','price','details_en','details_ar')->find($offer_id);

        return View('offers.edit',compact('offer'));
    }

    public function updateOffer(OfferRequest $request,$offer_id){
        $offer= Offer::find($offer_id);
        if(!$offer){
            return redirect()->back();
        }
        $offer->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'price' => $request->price,
            'details_en' => $request->details_en,
            'details_ar' => $request->details_ar,
        ]);
        return redirect()->back()->with(['success'=>'تم التحديث بنجاح']);
    }

    public function delete($offer_id){
        $offer= Offer::find($offer_id);
        if(!$offer)
            return redirect()->back()->with(['error'=>__('messages.offer not exist')]);
        $offer->delete();
        return redirect()->route('offers.all',$offer_id)->with(['success'=>__('messages.offer deleted')]);

    }

    public function getVideo()
    {
        $video = Video::first();
        event(new VideoViewer($video)); //fire event
        return view('video')->with('video', $video);
    }





//
//    protected function getMessage(){
//        return $message= [
//            'name.required'=>__('messages.offer name required'),
//            'name.unique'=>__('messages.offer name must be unique'),
//            'price.numeric'=>__('messages.price must be a number'),
//            'price.required'=>__('messages.price required'),
//        ];
//    }
//
//    protected function getRules(){
//        return $rules=[
//            'name'=>'required|max:100|unique:offers,name',
//            'price'=>'required|numeric',
//            'details'=>'required',
//        ];
//    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class OfferController extends Controller
{
    use OfferTrait;

    public function create(){
        return view('ajaxoffers.creat');
    }

    public function store(Request $request){

        //add photo
        $file_name= $this->saveImage($request->photo,'images/offers');



        $offer=Offer::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'photo' => $file_name,
            'price' => $request->price,
            'details_en' => $request->details_en,
            'details_ar' => $request->details_ar,
        ]);

        if($offer){
            return response()->json([
                'status'=>true,
                'msg'=>'تم الحفظ بنجاح',
            ]);
        }

        else{
            return response()->json([
                'status'=>false,
                'msg'=>'لم يتم الحفظ',
            ]);
        }

//        return redirect()->back()->with(['success'=>'تم اضافة العرض بنجاح']);

    }

    public function all(){
        $offers=Offer::select('id',
            'price','photo','name_'.LaravelLocalization::getCurrentLocale().' as name',
            'details_'.LaravelLocalization::getCurrentLocale().' as details' )->get();
        return View('ajaxoffers.all',compact('offers'));

    }

    public function delete(Request $request){

        $offer= Offer::find($request->id);

        if(!$offer)
            return redirect()->back()->with(['error'=>__('messages.offer not exist')]);
        $offer->delete();
        return response()->json([
            'status'=>true,
            'msg'=>'تم الحذف بنجاح',
            'data_id'=>$request->id,
        ]);
//        return redirect()->route('offers.all',$offer_id)->with(['success'=>__('messages.offer deleted')]);

    }

    public function edit(Request $request){
        $offer= Offer::find($request->offer_id);
        if(!$offer){
            return response()->json([
                'status'=>false,
                'msg'=>'هذا العرض عير موجود',
            ]);
        }
        $offer=Offer::select('id','name_en','name_ar','price','details_en','details_ar')->find($request->offer_id);

        return View('ajaxoffers.edit',compact('offer'));
    }




    public  function update(Request $request){
        $offer = Offer::find($request-> offer_id);
        if (!$offer)
            return response()->json([
                'status' => false,
                'msg' => 'هذ العرض غير موجود',
            ]);

        //update data
        $offer->update($request->all());

        return response()->json([
            'status' => true,
            'msg' => 'تم  التحديث بنجاح',
        ]);
    }

}

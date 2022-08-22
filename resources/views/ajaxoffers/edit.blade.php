@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="flex-center position-ref full-height">

            <div class="content">


                <div class="alert alert-success" id="success-msg" style="display: none;" role="alert">تم التحديث بنجاح</div>


                <form id="offerFormUpdate" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.select photo')}}</label>
                        <input type="file" class="form-control" name="photo" >
                        @error('photo')
                        <small  class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <input type="text" name="offer_id" style="display: none;"  value="{{$offer -> id}}" >

                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.offer name English')}}</label>
                        <input type="text" class="form-control" name="name_en" value="{{$offer->name_en}}" aria-describedby="emailHelp">
                        @error('name_en')
                        <small  class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>



                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.offer name Arabic')}}</label>
                        <input type="text" class="form-control" name="name_ar" value="{{$offer->name_ar}}" aria-describedby="emailHelp">
                        @error('name_ar')
                        <small  class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>



                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.offer price')}}</label>
                        <input type="text" class="form-control" name="price" value="{{$offer->price}}">
                        @error('price')
                        <small  class="form-text text-danger">{{$message}}</small>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.offer details English')}}</label>
                        <input type="text" class="form-control" name="details_en" value="{{$offer->details_en}}">
                        @error('details_en')
                        <small  class="form-text text-danger">{{$message}}</small>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.offer details Arabic')}}</label>
                        <input type="text" class="form-control" name="details_ar" value="{{$offer->details_ar}}">
                        @error('details_ar')
                        <small  class="form-text text-danger">{{$message}}</small>
                        @enderror

                    </div>

                    <button id="Update" class="btn btn-primary">Update</button>
                </form>


            </div>
        </div>

    </div>

@stop


@section('scripts')
    <script>
        $(document).on('click','#Update',function (e){
            e.preventDefault();
            var formData= new FormData($('#offerFormUpdate')[0]);
            $.ajax({
                type:'post',
                enctype:'multipart/form-data',
                url:"{{route('ajax.offers.update')}}",
                data: formData,
                processData:false,
                contentType:false,
                cache:false,
                success:function (data){

                    if(data.status == true){
                        $('#success-msg').css('display','block');
                    }
                },
                error:function (reject){

                }
            });

        });
    </script>
@stop

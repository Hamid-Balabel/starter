@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="alert alert-success" id="success_msg" style="display: none"> تم الحذف بنجاح</div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('messages.offer name')}}</th>
                <th scope="col">{{__('messages.offer price')}}</th>
                <th scope="col">{{__('messages.offer photo')}}</th>
                <th scope="col">{{__('messages.offer details')}}</th>
                <th scope="col">{{__('messages.operations')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($offers as $offer)
                <tr class="offerRow{{$offer-> id}}">
                    <th scope="row">{{$offer-> id}}</th>
                    <td>{{$offer-> name}}</td>
                    <td>{{$offer-> price}}</td>
                    <td><img style="width: 50px;height:50px;" src="{{asset('images/offers/'.$offer->photo)}}" alt=""> </td>
                    <td>{{$offer-> details}}</td>
                    <td>
                        <a href="{{url('offers/edit/'.$offer-> id)}}" class="btn btn-success">{{__('messages.update')}}</a>
                        <a href="{{route('offers.delete',$offer-> id)}}" class="btn btn-danger">{{__('messages.delete')}}</a>
                        <a href="" offer_id="{{$offer-> id}}" id="" class="btn btn-danger delete_btn">حذف اجاكس</a>
                        <a href="{{route('ajax.offers.edit',$offer-> id)}}" class="btn btn-success">{{__('messages.update')}} ajax</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

@stop

@section('scripts')
    <script>
        $(document).on('click','.delete_btn',function (e){
            e.preventDefault();
            var offer_id=$(this).attr("offer_id");
            $.ajax({
                type:'post',
                url:"{{route('ajax.offers.delete')}}",
                data:{
                    '_token': "{{csrf_token()}}",
                    'id':offer_id
                },
                success:function (data){

                    if(data.status == true){
                        $('#success-msg').css('display','block');
                        $('.offerRow'+data.data_id).remove();
                    }
                },
                error:function (reject){

                }
            });

        });
    </script>
@stop

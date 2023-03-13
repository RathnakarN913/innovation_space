@extends('header')
@section('content')


<div class="container mt-5">

    <form action="{{url('/updatesurveyor')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="userid" id="" value="{{$data->id}}">
        <h5>Surveyor creation</h5>
        <div class="row">
            <div class="col-md-4">


                <label for="">Name</label>
                <input type="text" name="name" id="" class="form-control" value="{{$data->name}}">
                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label for="">Mobile Number</label>
                <input type="text" name="mobilenumber" id="" class="form-control" value="{{$data->mobilenumber}}">
                @error('mobilenumber') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label for="">Email id</label>
                <input type="email" name="emailid" id="" class="form-control" value="{{$data->emailid}}">
                @error('emailid') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
        </div>


        <h5>address</h5>
        <div class="row">
            <div class="col-md-4">
                <label for="">Country</label>
                <select name="country" id="country" class="form-control  select2" value=" {{$data->country}}"
                    onchange="changestate()">
                    <option value="">--select--</option>
                    @foreach($country as $count)
                    <option value="{{$count->id}}">{{$count->country_name}}</option>
                    @endforeach
                </select>
                @error('country') <div class="text-danger">{{ $message }}</div> @enderror
            </div>



            <div class="col-md-4">
                <label for="">State</label>
                <select name="state" id="state" class="form-control select2" value="{{$data->state}}">
                    <option value="">--select--</option>
                    @foreach($state as $serve)
                    <option value="{{$serve->id}}">{{$serve->state_name}}</option>
                    @endforeach

                </select>
                @error('state') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
       <div class="col-md-4">
                <label for="">Pincode</label>
                <input type="pincode" name="pincode" id="" class="form-control" value=" {{$data->pincode}}">
                @error('pincode') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

        </div>

        <div class="row">
            <div class="col-md-4">
                <label for="">Age</label>
                <input type="number" name="age" id="" class="form-control" value="{{$data->age}}">
                @error('age') <div class="text-danger">{{ $message }}</div> @enderror
            </div>


            <div class="col-md-4">
                <label for="">Gender</label>
                <input type="text" name="gender" id="" class="form-control" value=" {{$data->gender}}">
                @error('gender') <div class="text-danger">{{ $message }}</div> @enderror
            </div>



            <div class="col-md-4">
                <label for="">Upload addhar document or any proof</label>
                <input type="file" name="file" id="" class="form-control" value=" {{$data->file}}" required>
                @error('file') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

        </div>


        <div class="mb-3">
            <label for="">Remarks</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"
                name="remarks"> {{$data->remarks}}</textarea>
            @error('remarks') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

   <div class="text-end">
            <button class="btn btn-success" type="submit">update</button>
        </div>
     </form>

</div>


<script>
function changestate() {
    var country_id = $('#country').val();
   

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: "{{ url('/surveyor') }}",
        data: {
            'countryid': country_id
        },
        DataType: 'json',

        success: function(data) {
            console.log(data);
            $('#state').html(data);
        }
    });
}
</script>

<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>

















@endsection
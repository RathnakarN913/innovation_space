@extends('header')
@section('content')

<form action="{{url('/client_update')}}" method="post">
  @csrf
    <div style="font-size: 14px;">
        <div class="row">
            <input type="hidden" name="userid" value="{{$data->id}}">
            <div class="col-md-3">
                <label for="">Company Name</label><span class="text-danger">*</span>
                <input type="text" class="form-control" name="companyname"  value="{{$data->company_name}}">
                 
                
            </div>
            <div class="col-md-3">
                <label for="">Consult person name</label><span class="text-danger">*</span>
                <input type="text" class="form-control" name="personname" value="{{$data->consult_person_name}}">
             
            </div>
            <div class="col-md-3">
                <label for="">Email Id</label><span class="text-danger">*</span>
                <input type="text" class="form-control" name="email" value="{{$data->email}}">
  

            </div>
            <div class="col-md-3">
                <label for="">Mobile Number</label><span class="text-danger">*</span>
                <input type="text" class="form-control" name="mobile" value="{{$data->mobile_number}}">
             
            </div>
        </div>

        <br>
 
        <div class="row">
            <div class="col-md-3">
                <label for="">Company PAN Number</label><span class="text-danger">*</span>
                <input type="text" class="form-control" name="pannumber" value="{{$data->pan_number}}">
              
            </div>
            <div class="col-md-3">
                <label for="">Company GST Number</label><span class="text-danger">*</span>
                <input type="text" class="form-control" name="gstnumber" value="{{$data->gst_number}}">
 
            </div>

           
            <div class="col-md-3">
                <label for="">Country</label><span class="text-danger">*</span>
                <select name="country" id="country" class="form-control  select2" value="{{old('country')}}"
                    onchange="get_state()">
                    <option value="">--select--</option>
                    @foreach($country as $count)

                    <option value="{{$count->id}}">{{$count->country_name}}</option>

                    @endforeach

                </select>
               
              
            </div>
            <div class="col-md-3">
                <label for="">State</label><span class="text-danger">*</span>
                <select name="state" id="state" class="form-control  select2" value="{{old('state')}}">
                    <option value="">--select--</option>
                    @foreach($state as $count)
                    <option value="{{$count->id}}">{{$count->state_name}}</option>
                    @endforeach
                </select>
                 
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
<label for="">Address</label><span class="text-danger">*</span>
            <textarea name="address" id="" class="form-control" cols="8" rows="4">{{$data->address}}</textarea>
           
            </div>
            
        </div>



    </div>
    <br>
<div class="d-flex justify-content-end">
  <button type="submit" class="btn text-white" style="background-color: #36e591">Update</button>
        </div>

</form>
<script>

$(document).ready(function() {
            $('.select2').select2();
        });
    
    function get_state() {
        var countrys = $('#country').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('/country_ajax') }}",
            data: {
                'countries': countrys
            },
            type: 'post',
            dataType: 'json',
            success: function(response) {

                console.log(response.store);
                $('#state').empty();
                $('#state').append('<option value="">select state</option>');

                $.each(response.store, function(key, value) {
                    $('#state').append('<option value="' + value.id + '">' + value.state_name +
                        '</option>');

                });

            }
        });



    }
    </script>
@endsection
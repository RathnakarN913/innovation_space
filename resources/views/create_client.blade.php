@extends('header')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
   .breadcrumb {
     font-size:13px;  
   }
     
 
</style>

<!--<nav class="navbar navbar-expand-lg navbar-light ">-->
<!--    <div class="container-fluid">-->
<!--        <a class="navbar-brand" href="/dashboard">Home</a>-->

<!--        <div class="collapse navbar-collapse">-->
<!--            <ul class="navbar-nav">-->
<!--                <li class="nav-item">-->
<!--                    <a class="nav-link " aria-current="page" href="#">Client creation</a>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </div>-->
<!--</nav>-->
<h1>sana afreen</h1>
<nav style=" " aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
    <li class="breadcrumb-item  " aria-current="page">Client Creation</li>
  </ol>
</nav>

<hr>
 
    <h5><strong>Client Creation</strong></h5>
<br>
<br>

    
<form action="{{url('/store_client')}}" method="post">
    @csrf
    <div style="font-size: 14px;">
            <div class="row">
            <div class="col-md-3">
               <label for="">Company Name</label>
                <input type="text" class="form-control" name="companyname" value="{{ old('companyname') }}">

                @error('companyname')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="">Consult Person Name</label>
                <input type="text" class="form-control" name="personname" value="{{ old('personname') }}">
                @error('personname')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="">Email ID</label>
                <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                @error('email')
                <div class="text-danger">{{$message}}</div>
                @enderror

            </div>
            <div class="col-md-3">
                <label for="">Mobile Number</label>
                <input type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" maxlength="10"
                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                    onkeydown="if(event.key==='.'){event.preventDefault();}">
                @error('mobile')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-3">
                <label for="">Company PAN Number</label>
                <input type="text" class="form-control" name="pannumber" value="{{ old('pannumber') }}">
                @error('pannumber')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="">Company GST Number</label>
                <input type="text" class="form-control" name="gstnumber" value="{{ old('gstnumber') }}">
                @error('gstnumber')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>


            <div class="col-md-3">
                <label for="">Country</label>
                <select name="country" id="country" class="form-select  select2" value="{{old('country')}}"
                    onchange="get_state()">
                    <option value="">-Select-</option>
                    @foreach($country as $count)

                    <option value="{{$count->id}}">{{$count->country_name}}</option>

                    @endforeach

                </select>
                @error('country')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="">State</label>
                <select name="state" id="state" class="form-control  select2" value="{{old('state')}}">
                    <option value="">-Select-</option>
                    @foreach($state as $count)
                    <option value="{{$count->id}}">{{$count->state_name}}</option>
                    @endforeach
                </select>
                @error('state')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <label for="">Address</label>
                <textarea name="address" id="" class="form-control" cols="8" rows="4">{{ old('address')}}</textarea>
                @error('address')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

        </div>



    </div>
    <br>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn text-white" style="background-color: #36e591">Create</button>
    </div>

</form>
<br>
<div class='row mb-3'>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div>
                    <div>
                        <h5 class="mb-3"><b>Client Data</b></h5>
                    </div>

                </div>

            <div class="table-responsive">
                <table class="table table-borderless " width="100%"  >
                    <tr class="table-info">
                        <th>Sl. No.</th>
                        <th>Company Name</th>
                        <th>Consult Person Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Company PAN Number</th>
                        <th>Company GST Number</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    <tbody>
                        @php $i=1;
                        @endphp
                        @foreach($data as $store)
                        <tr>

                            <td>{{$i++}}</td>
                            <td>{{$store->company_name}}</td>
                            <td>{{$store->consult_person_name}}</td>
                            <td>{{$store->email}}</td>
                            <td>{{$store->mobile_number}}</td>
                            <td>{{$store->pan_number}}</td>
                            <td>{{$store->gst_number}} </td>
                            <td>{{$store->country_name}}</td>
                            <td>{{$store->state_name}} </td>
                            <td>{{$store->address}}</td>
                            <td>
                              <div class="d-flex justify-content-between">  
                                <a href="{{url('/client__view')}}/{{$store->id}}" class=""><i class="fa-solid fa-eye"></i></a>
                                <a href="{{url('/client_delete')}}/{{$store->id}}" class="text-danger"><i class="fa-solid fa-trash"></i></a>
                              </div>  
                            </td>

                        </tr>

                        @endforeach

                    </tbody>
                </table>
                
            </div>    
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('#status').on('change', function() {
            var status = $(this).val();
            if (status == 2 || status == 3) {
                $('.resign_div').show();
            } else {
                $('.resign_div').hide();
            }
        })

        $(document).ready(function() {
            $('.select2').select2();
        });
    })
    </script>
    <script>
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
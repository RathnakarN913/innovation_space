@extends('header')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
    .select2-container .select2-selection--single{
    height: 35px !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered{
    line-height: 35px!important;
}
.dashboard-nav{
    overflow:hidden;
}
.table.dataTable tbody td{
    border: 1px #ccc solid;
}

.table.dataTable tbody th{
    border: 1px #ccc solid;
}

</style>

<nav style=" " aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
    <li class="breadcrumb-item  " aria-current="page">Surveyor Creation</li>
  </ol>
</nav>

<hr>

 <div class="">

 <form action="{{url('insert_serveyor')}}" method="post" enctype="multipart/form-data">
        @csrf
        
        <h5><strong>Surveyor Creation</strong></h5>
        <h1>sushmitha</h1>
        
        <div class="row mt-4 m-0">
            
            <div class="col-md-4">
                <label for="">Name</label>
                <input type="text" name="name" id="" class="form-control" value="{{old('name')}}">
                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>


            <div class="col-md-4">
                <label for="">Mobile Number</label>
                <input type="text" name="mobilenumber" id="" class="form-control" value="{{old('mobilenumber')}}"  maxlength="10"
                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                    onkeydown="if(event.key==='.'){event.preventDefault();}">
                @error('mobilenumber') <div class="text-danger">{{ $message }}</div> @enderror
            </div>



            <div class="col-md-4">
                <label for="">Email id</label>
                <input type="email" name="emailid" id="" class="form-control" value="{{old('emailid')}}">
                @error('emailid') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
        </div>

        <!--<h5>address</h5>-->
       
        <div class="row mt-3 m-0">
            <div class="col-md-4">
                <label for="">Country</label>
                <select name="country" id="country" class="form-control  select2" value="{{old('country')}}"
                    onchange="changestate()">
                    <option value="">-Select-</option>
                    @foreach($country as $count)
                    <option value="{{$count->id}}">{{$count->country_name}}</option>
                    @endforeach
                </select>
                @error('country') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

        <div class="col-md-4">
                <label for="">State</label>
                <select name="state" id="state" class="form-control select2" value="{{old('state')}}">
                    <option value="">-Select-</option>
                    @foreach($state as $serve)
                    <option value="{{$serve->id}}">{{$serve->state_name}}</option>
                    @endforeach

                </select>
                @error('state') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

     <div class="col-md-4">
                <label for="">Pincode</label>
                <input type="pincode" name="pincode" id="" class="form-control" value="{{old('pincode')}}"  maxlength="6"
                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                    onkeydown="if(event.key==='.'){event.preventDefault();}">
                @error('pincode') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

        </div>

        <div class="row mt-3 m-0">
            <div class="col-md-4">
                <label for="">Age</label>
                <input type="text" name="age" id="" class="form-control" value="{{old('age')}}" maxlength="2"
                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                    onkeydown="if(event.key==='.'){event.preventDefault();}">
                @error('age') <div class="text-danger">{{ $message }}</div> @enderror
            </div>


            <div class="col-md-4">
                <label for="">Gender</label>
                <input type="text" name="gender" id="" class="form-control" value="{{old('gender')}}">
                @error('gender') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

           <div class="col-md-4">
                <label for="">Upload addhar document or any proof</label>
                <input type="file" name="file" id="" class="form-control" value="{{old('file')}}">
                @error('file') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

        </div>

 <div class="row mb-3 mt-3 m-0">
     <div class="col-md-12">
            <label for="">Remarks</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="remarks"></textarea>
            @error('remarks') <div class="text-danger">{{ $message }}</div> @enderror
       </div>     
 </div>

    <div class="text-end mb-4 mt-4">
            <button class="btn btn-success" type="submit">Create</button>
    </div>
        
        
     </form>

 </div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
      <table class="table table-borderless " width="100%">
    
                <thead>
                    <tr class="table-info">
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Mobile Number</th>
                        <th>Email Id</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>Pincode</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>File</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>
    
                </thead>
                <tbody>
                    @php
                    $s=1;
                    @endphp
                    <tr>
                        @foreach($data as $serve)
                        <td>{{$s++}}</td>
                        <td>{{$serve->name}}</td>
                        <td>{{$serve->mobilenumber}}</td>
                        <td>{{$serve->emailid}}</td>
                        <td>{{$serve->country_name}}</td>
                        <td>{{$serve->state_name}}</td>
                        <td>{{$serve->pincode}}</td>
                        <td>{{$serve->age}}</td>
                        <td>{{$serve->gender_id}}</td>
                        <td>{{$serve->file}}</td>
                        <td>{{$serve->remarks}}</td>
                        <td>
                            
                          <div class="d-flex justify-content-between">  
                            <a href="{{url('/surveyoredit')}}/{{$serve->id}}" class=" "><i class="fa-solid fa-eye"></i></a>
                            <a href="{{url('/surveyordelete')}}/{{$serve->id}}" class="text-danger"><i class="fa-solid fa-trash"></i></a>
                          </div>
                          
                        </td>
                    </tr>
    
                    @endforeach
                </tbody>
    
    
    
    
    
    
    
    
            </table>
 

    </div>
    </div>
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
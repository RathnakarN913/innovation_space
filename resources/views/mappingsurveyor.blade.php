@extends('header')
@section('content')

<div class="container mb-5">
    <nav style=" " aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
    <li class="breadcrumb-item  " aria-current="page">Mapping the surveyor to the project</li>
  </ol>
</nav>

<hr>
 
  <h5><strong>Mapping the surveyor to the project</strong></h5>
     

<form action="{{url('/mappingsurveyor_insert')}}" method="post">
        @csrf
        <div class="row mt-5">
            <div class="col-md-4">
                <label for="">Country</label>
                <select name="country" id="country" class="form-select" onchange="changestate()" value="{{old('country')}}">
                    <option value="">-Select-</option>
                    @foreach($country as $count)
                        <option value="{{ $count->id }}">{{ $count->country_name }}</option>
                    @endforeach
                </select>
                @error('country') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label for="">State</label>
                <select name="state" id="state" class="form-select" value="{{old('state')}}">
                    <option value="">-Select-</option>
                    @foreach($state as $serve)
                        <option value="{{$serve->id}}">{{$serve->state_name}}</option>
                    @endforeach
                </select>
                @error('state') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4 mb-4">
                <label for="">Select the Project</label>
                <select name="project_id" id="project" class="form-select" value="{{old('project_id')}}" onchange="changeproject()">
                
                    <option value="">-Select-</option>
                    @foreach($users as $project)
                    <option value="{{$project->id}}">{{$project->project_name}}</option>
                    @endforeach
                </select>
                @error('project_id') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
        </div>
<div class="serveyors"></div>
     
 
<div class="text-end mt-3">
    <span><button class="btn btn-success" type="submit">Submit</button></span>
</div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr class="table-info">
                    <th width="5%">S.No</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>Project Name</th>
                    <th>Surveyors</th>
                    <th>Action</th>
                    
                </tr>
            </thead>

            <tbody>
                @php
                    $s=1;
                @endphp
                <tr>
                    @foreach($main_data as $store)
                    <td>{{ $s++ }}</td>
                    <td>{{$store->country_name}}</td>
                    <td>{{$store->state_name}}</td>
                    <td>{{$store->project_name}}</td>
                    <td>{!!$store->name!!}</td>
                    <td width="5%">
                        <a href="#" class="text-danger"><i class="fa-solid fa-trash"></i></a>
                    </td>
                  </tr>
                @endforeach


            </tbody>

              </table>
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

            success: function (data) {
                console.log(data);
                $('#state').html(data);
            }
        });
    }

</script>



<script>

$(document).ready(function(){
     $("#project").change(function(){

      
        var pro = $(this).val();
         $.ajax({ 
            headers: { 
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }  , 


             url: "{{ url('/mapping_surveyor') }}",
             data: { id: pro },
            type: 'POST',
            DataType:'json',
            success:function(success) {
              if(success){
                $(".serveyors").html(success);
              }
              $('.error_project_id').text(success);
            // console.log(success);
                  },
           error:function() {
             console.log('this information was aleready exist');
        },
      });
     });
 });



</script>












@endsection

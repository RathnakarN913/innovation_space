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

 <form action="{{url('/surveyor/reports/filter')}}" method="post" enctype="multipart/form-data">
        @csrf
        
        <h5><strong>Surveyor Creation</strong></h5>

        <!--<h5>address</h5>-->
        <div class="row mt-3 m-0">
            <div class="col-md-4">
                <label for="">Serveyer Name</label>
                <select name="serveyer_id" class="form-control  select2" value="{{old('country')}}">
                    <option value="">-Select-</option>
                    @foreach($surveyor as $svyr)
                        <option value="{{$svyr->id}}">{{$svyr->name}}</option>
                    @endforeach 
                </select>
                @error('serveyer_name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- <div class="col-md-4">
                    <label for="">From Date</label>
                    <input type="date" name="from_date" class="form-control">
                    @error('from_date') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                    <label for="">To Date</label>
                    <input type="date" name="to_date" class="form-control">
                    @error('to_date') <div class="text-danger">{{ $message }}</div> @enderror
            </div> -->
        </div>

    <div class="text-end mb-4 mt-4">
            <button class="btn btn-success" type="submit">Search</button>
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
                        <th>Surveyor Name</th>
                        <th>Project Mapped</th>
                        <th>Serveyed Records</th>
                        <th>Last Updated</th>
                    </tr>
    
                </thead>
                <tbody>
   
                @foreach($surveyor as $sur)
                    <tr>
                       <td>{{$loop->iteration}}</td> 
                       <td><a href="{{route('surveyed_records_details',[$sur->id])}}">{{$sur->name}}</a></td> 
                       <?php
                        $project_mapped = DB::table('mappingserveyor')
                              ->where('surveyor_id', $sur->id)
                              ->get();
                       ?>
                       <td>{{count($project_mapped)}}</td> 
                       <?php
                        $surveyed_records = DB::table('survey_mst')
                              ->where('surveyor_id', $sur->id)
                              ->get();
                       ?>
                       <td>{{count($surveyed_records)}}</td> 
                       <td>{{$sur->updated_at}}</td> 

                    </tr>
                    @endforeach

                </tbody>
    
    
    
    
    
    
    
    
            </table>
 

    </div>
    </div>
</div> 
<script>
function changestate() {
    var serveyer_id = $('#serveyer_name').val();
    // console.log(serveyer_id);

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: "{{ url('/project/details') }}",
        data: {
            'serveyer_id': serveyer_id
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
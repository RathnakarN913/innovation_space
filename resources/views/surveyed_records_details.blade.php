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


<div class="card">
    <div class="card-body p-3">
        <div class="table-responsive">
        <table class="table table-borderless " width="100%">
        @foreach($projects as $pj)

             @php $key =1; $projectinfo=$servyedRecords->where('project_id',$pj->id); @endphp
             <tr>
                <td colspan="3">
               <h5> Project Name: {{$pj->project_name}}</h5>
            </td>
            @if($projectinfo->count()>0)
         
            @foreach($projectinfo as $pr_record)
            @if($key==1)
            <tr>
            <td>
            Sl. No.
            </td>
            <td>
            View File
          </td>
          <td>
             Updated date
          </td>
            <tr>
            @endif
            <tr>
            <td>{{$key}}</td>
            <td>
            <p> <img style="height:50px; width:50px;" src="{{ asset($pr_record->file_path) }}" alt="job image" title="job image"></p>
          </td>
          <td>
            <p>{{date('d-m-Y', strtotime($pr_record->created_at))}}</p>
          </td>
            <tr>
            @php  $key++;  @endphp     
            @endforeach
            @else
            <tr>
            <td colspan="2">
             N/A
             </td>
            <tr>
            @endif
        
        @endforeach
        </table>
  {{--    <table class="table table-borderless " width="100%">
    
                <thead>
                    <tr class="table-info">
                        <th>S.No</th>
                        <th>Surveyor Name</th>
                        <th>Project Name</th>
                        <th>Serveyed Records</th>
                        <th>Last Updated</th>
                    </tr>
    
                </thead>
                <tbody>
                @foreach($servyedRecords as $Records)
                
               <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{@$Records->GetProject->project_name}}</td>
                <td></td>
                <td></td>
                <td></td>
               </tr>
                @endforeach
                </tbody>
    
            </table>
            --}}
 

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
@extends('header')
@section('content')

<style>
    .table.dataTable tr th{
    border: 1px #ccc solid;
}

</style>


 <nav style=" " aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
    <li class="breadcrumb-item  " aria-current="page">Project Creation</li>
  </ol>
</nav>

<hr>

 <h5><strong>Project Creation</strong></h5>
 <h1>Venkataramana</h1>
 
<br><br>
<form action="{{url('/project_insert')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-3">
            <label for="select_client">Select The Client</label>
            <select name="select_client" class="form-select select2" id="select_client">
                <option value="">-Select client-</option>
                @foreach($store as $data)
                <option value="{{$data->id}}" @if($data->id==old('select_client')) selected
                    @endif>{{$data->company_name}}</option>
                @endforeach
            </select>
            @if ($errors->has('select_client'))
            <span class="mb-0 ml-2 text-danger" role="alert">
                <p>{{ $errors->first('select_client') }}.</p>
            </span>
            @endif

        </div>
        <div class="col-md-3">
            <label for='project_name'>Project Name</label>
            <input type="text" name="project_name" class="form-control" id="project_name"
                value="{{old('project_name')}}">
            @if ($errors->has('project_name'))
            <span class="mb-0 ml-2 text-danger" role="alert">
                <p>{{ $errors->first('project_name') }}.</p>
            </span>
            @endif
        </div>
        <div class="col-md-3">
            <label for="project_code">Project Code</label>
            <input type="text" name="project_code" class="form-control" id="project_code"
                value="{{old('project_code')}}">
            @if ($errors->has('project_code'))
            <span class="mb-0 ml-2 text-danger" role="alert">
                <p>{{ $errors->first('project_code') }}.</p>
            </span>
            @endif
        </div>
    </div>
    
    <div class="col-md-12 mt-3">
        <label for="project_code">Description</label>
        <textarea name="description" id="description" class="form-control" cols="30"
            rows="5">{{old('description')}}</textarea>
        @if ($errors->has('description'))
        <span class="mb-0 ml-2 text-danger" role="alert">
            <p>{{ $errors->first('description') }}.</p>
        </span>
        @endif
    </div>
    <br>
    <div class="col-md-2 mb-5 ms-auto">
        <button type="submit" class="btn btn-model btn-sm">Create</button>
    </div>

</form>
 
<table class="table table-hover ">

    <thead>
        <tr class="table-info">
            <th width="5%" >S.No</th>
            <th>Select the Client</th>
            <th>Project Name</th>
            <th>Project Code</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>


    <tbody>
        @php $i=1;
        @endphp
        @foreach($main_data as $name)
       
        <tr>
            <td>{{$i++}}</td>
            <td>{{$name->company_name}}</td>
            <td>{{$name->project_name}}</td>
            <td>{{$name->project_code}}</td>
            <td>{{$name->description}}</td>
            <td width="5%">
             <div class="d-flex justify-content-between">
                 <a href="{{url('/project_edit')}}/{{$name->id}}" class=""> <i class="fa-solid fa-eye"></i> </a>
                 <a href="{{url('/project_delete')}}/{{$name->id}}" class="text-danger"> <i class="fa-solid fa-trash"></i> </a>
             </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
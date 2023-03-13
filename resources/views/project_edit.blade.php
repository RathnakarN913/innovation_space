@extends('header')
@section('content')
<h1>Project Creation</h1>
<br><br>
<form action="{{url('/project_update')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-3">
            <input type="hidden"  class="form-control" id="" name="userid" value="{{$data->id}}">

            <label for="select_client">Select The Client</label>
 <select name="select_client" id="" class="form-select">
<option value="">--select client--</option>

@foreach($datas as $store)

<option value="{{$store->id}}"  @if($store->id==$data->select_client) selected @endif>{{$store->company_name}}</option>
@endforeach
 </select>
        </div>
        <div class="col-md-3">
            <label for='project_name'>projectname</label>
            <input type="text" name="project_name" class="form-control" value="{{$data->project_name}}">

        </div>
        <div class="col-md-3">
            <label for="project_code">Project Code</label>
            <input type="text" name="project_code" class="form-control" value="{{$data->project_code}}">

        </div>
    </div>
    <br><br>
    <h5>discription</h5>
    <textarea name="discription" id="discription" class="form-control" cols="30"
        rows="5">{{$data->discription}}</textarea>

    <br>
    <div class="col-md-2 mb-2 ms-auto">
        <button type="submit" class="btn btn-model btn-sm">Update</button>
    </div>

</form>

@endsection
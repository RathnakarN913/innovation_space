<h6>surveyor</h6>





<div class="card">
    <div class="card-body">
        <div class="row">
            @foreach($surveyor as $names)
            
          
            @php $mapid=$map->where('surveyor_id',$names->id)->first(); @endphp
           
                <div class="col-md-3">
                    <div class="form-check">
                 <input class="form-check-input" type="checkbox" value="{{$names->id}}" id="flexCheckDefault"
                            name="surveyors[]"
                            @if($names->id==@$mapid->surveyor_id)
                            {{'checked'}}
                            @endif
                            
                            >
                        <p>{{ $names->name }}</p>
                    </div>
                </div>
            @endforeach
        </div>



    </div>




</div>
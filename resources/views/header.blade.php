<!DOCTYPE html>
<html lang="en">

<head>
    <title>Innovation Space </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="csrf-token" content="{{ csrf_token() }}" />
   
    <!-- css&fonts -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fonts/fontawesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/MMF_icon.png') }}">
    <!-- scripts -->
    <script src="{{ asset('js/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="{{ asset('js/bs5-toast.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
.notification {
  /*background-color: #555;*/
  color: white;
  text-decoration: none;
  padding: 15px 26px;
  position: relative;
  display: inline-block;
  border-radius: 2px;
}

.notification .badge {
  position: absolute;
  top: 9px;
  right: 23px;
  padding: 4px 5px;
  border-radius: 29%;
  background-color: red;
  color: white;
}
.hidemenu{
    margin-left:55px;
}
.hidemenu .dashboard-toolbar {
    left: 55px;
}
.ringing{
  display:block;
  width: 30px;
  /*height: 40px;*/
  font-size: 30px;
  /*margin:50px auto 0;*/
  color: #5ebdd1;
  -webkit-animation: ring 4s .7s ease-in-out infinite;
  -webkit-transform-origin: 50% 4px;
  -moz-animation: ring 4s .7s ease-in-out infinite;
  -moz-transform-origin: 50% 4px;
  animation: ring 4s .7s ease-in-out infinite;
  transform-origin: 50% 4px;
}

@-webkit-keyframes ring {
  0% { -webkit-transform: rotateZ(0); }
  1% { -webkit-transform: rotateZ(30deg); }
  3% { -webkit-transform: rotateZ(-28deg); }
  5% { -webkit-transform: rotateZ(34deg); }
  7% { -webkit-transform: rotateZ(-32deg); }
  9% { -webkit-transform: rotateZ(30deg); }
  11% { -webkit-transform: rotateZ(-28deg); }
  13% { -webkit-transform: rotateZ(26deg); }
  15% { -webkit-transform: rotateZ(-24deg); }
  17% { -webkit-transform: rotateZ(22deg); }
  19% { -webkit-transform: rotateZ(-20deg); }
  21% { -webkit-transform: rotateZ(18deg); }
  23% { -webkit-transform: rotateZ(-16deg); }
  25% { -webkit-transform: rotateZ(14deg); }
  27% { -webkit-transform: rotateZ(-12deg); }
  29% { -webkit-transform: rotateZ(10deg); }
  31% { -webkit-transform: rotateZ(-8deg); }
  33% { -webkit-transform: rotateZ(6deg); }
  35% { -webkit-transform: rotateZ(-4deg); }
  37% { -webkit-transform: rotateZ(2deg); }
  39% { -webkit-transform: rotateZ(-1deg); }
  41% { -webkit-transform: rotateZ(1deg); }

  43% { -webkit-transform: rotateZ(0); }
  100% { -webkit-transform: rotateZ(0); }
}

@-moz-keyframes ring {
  0% { -moz-transform: rotate(0); }
  1% { -moz-transform: rotate(30deg); }
  3% { -moz-transform: rotate(-28deg); }
  5% { -moz-transform: rotate(34deg); }
  7% { -moz-transform: rotate(-32deg); }
  9% { -moz-transform: rotate(30deg); }
  11% { -moz-transform: rotate(-28deg); }
  13% { -moz-transform: rotate(26deg); }
  15% { -moz-transform: rotate(-24deg); }
  17% { -moz-transform: rotate(22deg); }
  19% { -moz-transform: rotate(-20deg); }
  21% { -moz-transform: rotate(18deg); }
  23% { -moz-transform: rotate(-16deg); }
  25% { -moz-transform: rotate(14deg); }
  27% { -moz-transform: rotate(-12deg); }
  29% { -moz-transform: rotate(10deg); }
  31% { -moz-transform: rotate(-8deg); }
  33% { -moz-transform: rotate(6deg); }
  35% { -moz-transform: rotate(-4deg); }
  37% { -moz-transform: rotate(2deg); }
  39% { -moz-transform: rotate(-1deg); }
  41% { -moz-transform: rotate(1deg); }

  43% { -moz-transform: rotate(0); }
  100% { -moz-transform: rotate(0); }
}

@keyframes ring {
  0% { transform: rotate(0); }
  1% { transform: rotate(30deg); }
  3% { transform: rotate(-28deg); }
  5% { transform: rotate(34deg); }
  7% { transform: rotate(-32deg); }
  9% { transform: rotate(30deg); }
  11% { transform: rotate(-28deg); }
  13% { transform: rotate(26deg); }
  15% { transform: rotate(-24deg); }
  17% { transform: rotate(22deg); }
  19% { transform: rotate(-20deg); }
  21% { transform: rotate(18deg); }
  23% { transform: rotate(-16deg); }
  25% { transform: rotate(14deg); }
  27% { transform: rotate(-12deg); }
  29% { transform: rotate(10deg); }
  31% { transform: rotate(-8deg); }
  33% { transform: rotate(6deg); }
  35% { transform: rotate(-4deg); }
  37% { transform: rotate(2deg); }
  39% { transform: rotate(-1deg); }
  41% { transform: rotate(1deg); }

  43% { transform: rotate(0); }
  100% { transform: rotate(0); }
}
.preview-list .preview-item .preview-thumbnail .preview-icon {
    padding: 0px;
    text-align: center;
    display: -webkit-flex;
    display: flex;
    -webkit-align-items: center;
    align-items: center;
    -webkit-justify-content: center;
    justify-content: center;
}
.preview-list .preview-item .preview-thumbnail img, .preview-list .preview-item .preview-thumbnail .preview-icon {
    width: 20px;
    height: 20px;
    border-radius: 100%;
}
.navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .navbar-dropdown .dropdown-item i {
    font-size: 12px;
}
.navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .count-indicator i {
    font-size: 2rem;
    vertical-align: middle;
}
.navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .count-indicator .count {
    position: absolute;
    left: 47%;
    width: 12px;
    height: 12px;
    border-radius: 100%;
    background: #ff0000;
    top: -2px;
    border: 1px solid #ffffff;
}
.table.dataTable tbody td{
    border: 1px #ccc solid;
}
.table.dataTable tbody th{
    border: 1px #ccc solid;
}
.table tr th{
    line-height:25px;
}




</style>

</head>

<body>
  <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>

    <div class='dashboard'>
      <div class="dashboard-nav clearfix">

         <div class="brand">
            
               
                    <p class="text-white"style="font-size:20px;margin-left:10px">   </p>
                    <small  class="text-white" style="font-size:10px">  </small>
                    <div class="col-md-1">
                        <a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a>
                    </div>
          </div>

            <nav class="dashboard-nav-list">
                <a href="{{url('/dashboard')}}" class="dashboard-nav-item active "><i class="fa-solid fa-gauge"></i> Dashboard</a>
                <a href="{{url('/create_client')}}" class="dashboard-nav-item active "><i class="fa-solid fa-user"></i>Client Creation</a>
                             
                <a href="{{url('/project_creation')}}" class="dashboard-nav-item active "><i class="fa-solid fa-gear"></i>Project Creation</a>
                <a href="{{url('/surveyor')}}" class="dashboard-nav-item active "><i class="fas fa-user-plus"></i>Surveyor Creation</a>
                <a href="{{url('/mappingsurveyor')}}" class="dashboard-nav-item active "><i class="fas fa-user-plus"></i>Mapping the surveyor <br> to the project</a>
                <a href="{{url('/surveyor/reports')}}" class="dashboard-nav-item active "><i class="fas fa-user-plus"></i>Surveyor Reports</a>    

                <form method="POST" action="{{url('logout')}}">
                            @csrf  
                       <a class="dashboard-nav-item" href="{{url('/logout')}}" onclick="event.preventDefault();this.closest('form').submit();"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </form>

            </nav>
        </div>
        
        <div class='dashboard-app'>
            <header class='dashboard-toolbar'>
                <div class="row">
                  
                    <div class="col-md-3">
                         <img src="{{url('public/images/logo.PNG')}}" style="margin-left: 10px;"alt="">
                    </div>
                </div>
                <div class="col-md-5 ms-auto">
                    <ul class="menu-items align-items-center">
                       

                        {{-- notification bell --}}
                        
                    <!--    <li class="nav-item dropdown">-->

                    <!--        <a href="" class="dropdown-toggle nav-link count-indicator notification" type="button"-->
                    <!--            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">-->
                                
                    <!--            <div class="d-flex align-items-center">-->
                    <!--                <i class="fa fa-bell ringing mx-0"></i>-->
                    <!--                <span id="badge" class="badge" >5</span>-->
                    <!--            </div>-->
                    <!--        </a>-->
                    <!--</li>-->

                                        
                    <div class="div" style="display:flex;align-items: center;">

                    <i class="fa-sharp fa-solid fa-circle-user" style="color:white"></i> 
                    <p class="text-white"> Admin </p>
                    </div>
                    </ul>

                </div>

            </header>

            <div class='dashboard-content clearfix'>
                <div class="mt-3">
                    @if(session()->has('success'))
                        <div class="alert alert-success">{{session()->get('success')}}</div>
                    @endif
                </div>
                @yield('content')

               
            </div>
        </div>
    </div>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css"/>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready( function () {
    $('.table').DataTable({
         dom: 'Bfrtip',
          buttons: [
              {
                extend: 'excelHtml5',
                title:'innovationspace',
              },
              {
                extend: 'csvHtml5',
                title:'innovationspace',
              },
              {
                extend: 'pdfHtml5',
                title:'innovationspace',
              },
              {
                extend: 'print',
                title:'',
              },
        ]
    });
} );
</script>

<script>
    $(document).ready(function() {
    $('.selectmy').select2();
});

$(document).ready(function(){
  $(".menu-toggle").click(function(){
     
    $(".dashboard-app").toggleClass("hidemenu");

     
  });
});
 
</script>


</body>

</html>

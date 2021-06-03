@extends('layouts.main')
@section('head_style')  
   @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap');
    
   #message-container{
        background: #EEEEEE;
        font-family: 'Roboto', sans-serif
    }

    .card {
        width: 300px;
        border: none;
        border-radius: 15px
    }
    
    .adiv {
        background: #04CB28;
        border-radius: 15px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        font-size: 12px;
        height: 46px
    }
    
    .chat {
        border: none;
        background: #E2FFE8;
        font-size: 10px;
        border-radius: 20px
    }
    
    .bg-white {
        border: 1px solid #E7E7E9;
        font-size: 10px;
        border-radius: 20px
    }
    
    .myvideo img {
        border-radius: 20px
    }
    
    .dot {
        font-weight: bold
    }
    
    .form-control {
        border-radius: 12px;
        border: 1px solid #F0F0F0;
        font-size: 8px
    }
@endsection
@section('content')
  <div class="row" id="message-container">
      <div class="col-3">
        <div class="card">
            <div class="card-header">Users</div>
              <div class="card-body">
                  <ul class="list-group list-group-flush">
                    @forelse($users as $user)
                      <a href="{{ route('chat',['id'=>$user->id])}}" class="list-group-item list-group-item-action">{{ $user->name }}</a>
                    @empty
                        <p>No User Available</p>
                    @endforelse
                  </ul>
            </div>
          </div>
      </div>
      <div class="col-9">
          <div id="message"></div>
        <div class="container d-flex justify-content-center">
            <div class="card mt-5">
                <div class="d-flex flex-row justify-content-between p-3 adiv text-white"> <i class="fas fa-chevron-left"></i> <span class="pb-3">Live chat</span> <i class="fas fa-times"></i> </div>
                <div class="d-flex flex-row p-3"> <img src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-7.png" width="30" height="30">
                    <div class="chat ml-2 p-3">Hello and thankyou for visiting birdlymind. Please click the video above</div>
                </div>
                <div class="d-flex flex-row p-3">
                    <div class="bg-white mr-2 p-3"><span class="text-muted">Hello and thankyou for visiting birdlynind.</span></div> <img src="https://img.icons8.com/color/48/000000/circled-user-male-skin-type-7.png" width="30" height="30">
                </div>
                <div class="d-flex flex-row p-3"> <img src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-7.png" width="30" height="30">
                    <div class="myvideo ml-2"><img src="https://imgur.com/GOxU1jx.png" width="200"></div>
                </div>
                <div class="d-flex flex-row p-3"> <img src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-7.png" width="30" height="30">
                    <div class="chat ml-2 p-3"><span class="text-muted dot">. . .</span></div>
                </div>
                <div class="form-group px-3"> <textarea class="form-control" rows="5" placeholder="Type your message"></textarea> </div>
            </div>
        </div>
      </div>
  </div>
    
@endsection
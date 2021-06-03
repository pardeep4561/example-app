@extends('layouts.main')

@section('content')
 <div id="register-step">
    <h3></h3>
    <section>
         <div class="row">
             <div class="col-5">
                 <select name="mobile_code" id="mobile_code" class="form-control">
                     <option value="">--Select One Mobile Code--</option>
                     @foreach ($countries as $country)
                      <option value="+{{ $country->mobile_code }}">
                         {{ $country->name }}
                      </option>
                     @endforeach
                 </select>
                 <p class="error text-danger"></p>
             </div>
             <div class="col-7">
                   <input type="text" class="form-control" placeholder="Enter mobile number" name="number" id="number">
                   <p class="error text-danger"></p>
             </div>
         </div>
         <button class="btn btn-primary my-2 float-right" id="sent-otp">Next</button>
    </section>
    <h3></h3>
    <section id="verify-otp-section">
     </section>
    <h3></h3>
    <section>
        <p>The next and previous buttons help you to navigate through your content.</p>
    </section>
</div>
@endsection

{{-- <h1>{{ $country->name }}</h1>
            <img src="{{ asset("images/flags/".$country->country_code.".png") }}" alt=""> --}}
<div class="row">
    <div class="col-12">
        <p>We've sent opt for verify your mobile number</p>
        <a href="{{ route('api-sentotp',['number'=> $number]) }}">Resend</a>
        <input type="text" name="otp" id="otp" placeholder="enter your opt">
        <button class="btn btn-primary my-2 float-right" id="verify-otp-btn">Next</button>
    </div>
</div>
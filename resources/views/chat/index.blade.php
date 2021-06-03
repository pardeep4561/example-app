@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-4">
            <form action="{{ route('test') }}" class="dropzone" id="imageUpload" >
                @csrf
                <div class="fallback">
                  <input name="file" type="file" multiple />
                </div>
              </form>
        </div>
        <div class="col-8">
            <div id="app"></div>
        </div>
    </div>    
@endsection

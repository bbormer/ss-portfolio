{{-- @php
  use Illuminate\Support\MessageBag;
  $locale = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2) : 'en';
  App::setLocale($locale);
@endphp --}}

<x-layout>
  <x-slot name="title">contact</x-slot>
  {{-- <x-slot name="title">contact<br><span style="font-size:40%">(inquiries, order quotations)</span></x-slot> --}}
  {{-- <x-slot name="title">contact<br><span style="font-size:40%">{{ $locale == 'ja' ? '（問い合わせ・見積り依頼）' : '(inquiries, order quotations)'}}</span></x-slot> --}}
  
  <div class="max-w-screen-lg mx-auto mt-12">
    <div class="flex flex-col justify-center w-auto lg:w-[60%] max-w-5xl m-auto">
      
      <form method="POST" action="/contact/validate" class=" w-auto lg:w-[100%] max-w-5xl">
        {{-- <form method="POST" action="{{ route('contact.validate') }}" class=" w-auto lg:w-[100%] max-w-5xl"> --}}
          @csrf
          <div>
            
            @if(session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
            @endif
            
            <div x-show="" class="form-group mb-6 {{ $errors->has('name') ? 'has-error' : '' }}">
              {{-- <label for="name">Name</label> --}}
              <input name="name" type="text" class="form-control w-[95%] lg:w-[400px] rounded border-green-300 border-2 p-2 mx-auto lg:mx-0" id="name" aria-describedby="name" placeholder="{{ __('name (required)')}}" value="{{ old('name') }}">
              @error('name')
              <p class="text-red-500 text-sm mt-1">{{ __('name is required') }}</p>
              @enderror
            </div>
            <div class="form-group mb-6 {{ $errors->has('name') ? 'has-error' : '' }}">
              {{-- <label for="email">Email address</label> --}}
              <input name="email" type="text" class="form-control w-[95%] lg:w-[400px] rounded border-green-300 border-2 p-2 mx-auto lg:mx-0" id="email" aria-describedby="emailHelp"
              placeholder=" {{ __('email (required)') }}" value="{{ old('email') }}"> 
              @error('email')
              {{ $errors }}
              <p class="text-red-500 text-sm mt-1">{{ __('email is required/invalid') }}</p>
              @enderror
            </div>
            <div class="form-group mb-6 {{ $errors->has('name') ? 'has-error' : '' }}">
              {{-- <label for="exampleInputPassword1">Comment</label> --}}
              <textarea name="content" placeholder=" {{ __('inquiries, quotation request, etc (required)') }}" class="form-control w-[95%] lg:w-[600px] rounded border-green-300 border-2 p-2 mx-auto lg:mx-0" rows="5">{{ old('content') }}</textarea>
              @error('content')
              <p class="text-red-500 text-sm mt-1">{{ __('message is required') }}</p>
              @enderror
            </div>
            
            <div class="flex content-center justify-start gap-4">
              <button type="submit" class="btn btn-primary rounded-lg  px-2 py-1 lowercase ml-2 lg:ml-0">
                <i class="fa-regular fa-envelope text-2xl hover:animate-pulse"></i>
              </button>
              @if(session()->has('status'))
              <p  x-data="{show: true}" x-show="show" x-transition.duration.1000ms x-init="setTimeout(() => show = false, 5000)" class="text-lg text-center animate-pulse font-[200] pt-[6px]">
                @if(session('status') == 0)
                <span class="text-red-400">{{ __(' mail sent failed') }}</span>
                @else
                <span class="text-green-400">{{ __(' mail sent') }}</span>
                @endif
              </p>
              @endif
            </div>
            {{-- </form> --}}
            {{-- <p class="text-center text-lg">
              {!! $locale == 'ja' ? 'オーダー承ります。ご相談ください。' : 'Please feel free to inquire for overseas order' !!}
            </p> --}}
          </div>
          
          {{-- <p class="py-4">Press ESC key or click the button below to close</p> --}}
          {{-- <div class="modal-action">
            <!-- if there is a button in form, it will close the modal -->
            <button class="btn">Close</button> --}}
            
            {{-- @if(session()->has('status'))
            <p  x-data="{show: true}" x-show="show" x-transition.duration.1000ms x-init="setTimeout(() => show = false, 5000)" class="text-green-400 text-2xl h-20 text-center animate-pulse font-[200]">{{ session('status') }}</p>
            @else
            <p class="text-2xl h-20"> </p>
            @endif --}}
          </form>
        </div>
        {{-- <p class="text-center opacity-75 mb-5 lg:w-[60%] max-w-5xl m-auto">{!! $locale == 'ja' ? '（問い合わせ、見積り依頼）' : '(inquiries, order quotations)' !!}</p> --}}
      </div>
    </x-layout>
    
    <style>
  .double-line {
    display: none;
  }
  .single-line {
    display: block;
  }
  @media(width < 640px) {
    .single-line {
      display: none;
    }
    .double-line {
      display: block;
    }
  }
</style>
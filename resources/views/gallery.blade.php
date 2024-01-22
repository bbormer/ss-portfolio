@php
  // $locale = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2) : 'en';
  $locale = App::getLocale();
  session()->forget(['validateStatus','name','email','address1','address2','city','state','zip','phone']);
  session(['validateStatus' => 0]);
@endphp

<x-layout>
  <x-slot name="title">works</x-slot>
  {{-- <h1 class="mb-8 text-center text-5xl md:text-7xl font-['Montserrat'] font-[200]">works</h1> --}}

  <div x-data class="flex flex-row flex-wrap justify-around items-start max-w-screen-lg  mx-auto mt-12">
    <figure class="mx-auto"><img src="{{ 'https://setup.satomisuzuki.info/storage/'.$gallery['image'] }}" class="mb-30" /></figure>
    <div class="hero-content text-center text-neutral-content">
      <div class="max-w-xl font-[300] text-xl {{ $locale == 'ja' ? 'font-ja' : 'font-en'}}">
        <h1 class="my-5 leading-[3.75rem] text-4xl font-xl text-gray-500 dark:text-gray-400">{!! $locale == 'ja' ? $gallery['title-ja'] : $gallery['title-en'] !!}</h1>
        <div class="mb-10 text-xl !text-gray-700 dark:!text-gray-400">{!! $locale == 'ja' ? $gallery['details-ja'] : $gallery['details-en']!!}</div>
        <div class="text-left text-xl text-gray-700 dark:text-gray-400">{!! $locale == 'ja' ? $gallery['desc-ja'] : $gallery['desc-en']!!}</div>

        @if($gallery['availability'] == 0)
          <p class="text-xl font-bold mt-10 text-red-600 ">SOLD</p>
        @elseif($gallery['availability'] == 1 && config('custom.shop_enabled'))
          <a href="/square/{{ $gallery['id'] }}">
          {{-- <a x-bind:href="`/square/{{ $gallery['id'] }}`"> --}}
            <button  class="btn btn-primary mt-10 lowercase hover:animate-pulse">{{ __('buy') }}</button>
          </a>
        @endif
      </div>


    </div>
    </div>
</x-layout>
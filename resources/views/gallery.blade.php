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
        {{-- @if($gallery['sold'] == 1)
          <p class="text-3xl font-bold mt-10 text-red-600 ">SOLD</p>
        @elseif ($gallery['not-for-sale'] != 1)
          <a x-bind:href="`/square/{{ $gallery['id'] }}`">
            <button  class="btn btn-primary mt-10 lowercase hover:animate-pulse">
              {{ __('buy') }}
            </button>
          </a>
        @endif --}}
        @if($gallery['availability'] == 0)
          <p class="text-xl font-bold mt-10 text-red-600 ">SOLD</p>
        @elseif(strlen($gallery['url']) > 0)
        {{-- <button @click="window.open('{{ $gallery['url'] }}' )" class="btn btn-primary mt-10 lowercase hover:animate-pulse">{{ $locale == 'ja' ? '購入' : 'purchase'}}</button> --}}
          <a x-bind:href="`/square/{{ $gallery['id'] }}`">
          <button  class="btn btn-primary mt-10 lowercase hover:animate-pulse">{{ __('buy') }}</button>
        </a>
        @endif
      </div>



      {{-- <div x-data class="">
        <div x-show="$store.locale == 'ja'"">
          <div class="max-w-md font-['Zen_Maru_Gothic']">
            <h1 class="my-5 text-5xl font-xl text-gray-500 dark:text-gray-400">{{ $gallery['title-ja'] }}</h1>
            <p class="text-xl text-gray-500 dark:text-gray-400">{!! $gallery['desc-ja'] !!}</p>
            <button @click="window.open('{{ $gallery['url'] }}' )" class="btn btn-primary mt-10">購入</button>
          </div>
        </div>
        <div x-show="$store.locale != 'ja'">
          <div class="max-w-md font-['Montserrat'] font-[300]">
            <h1 class="my-5 text-5xl font-xl text-gray-500 dark:text-gray-400">{{ $gallery['title-en'] }}</h1>
            <p class="text-xl text-gray-500 dark:text-gray-400">{!! $gallery['desc-en'] !!}</p>
            {{-- <div x-data="{ likes: 0}" class="flex items-center justify-center">
              <div x-data>
                <i x-on:click="likes++" x-show="likes" class="fa-solid fa-heart-circle-check text-green-300 mt-2 text-2xl"></i>
                <i x-on:click="likes++" x-show="!likes" class="fa-solid fa-heart-circle-check text-green-800 mt-2 text-2xl"></i>
                <span x-text="likes" x-show="likes" class="pl-2"></span>
              </div>
            </div> --}}
            
            {{-- <button @click="window.open('{{ $gallery['url'] }}' )" class="mt-10 btn btn-primary lowercase hover:animate-pulse">purchase</button>
          </div>
        </div>
      </div> --}}
      {{-- <div class="max-w-md font-['{{ $font_family }}']">
        <h1 class="mb-5 text-5xl  font-xl">{{ $gallery['title-'.$locale] }}</h1>
        <p class="mb-5 text-xl">{!! $gallery['desc-'.$locale] !!}</p>
        <button @click="window.open('{{ $gallery['url'] }}' )" class="btn btn-primary">purchase</button>
      </div> --}}
    </div>
    </div>
</x-layout>
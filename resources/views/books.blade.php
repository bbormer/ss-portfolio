@php
  // $locale = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2) : 'en';
  $locale = App::getLocale();
@endphp

<x-layout>
  <x-slot name="title">books</x-slot>
  {{-- <h1 class="mb-8 text-center text-5xl md:text-7xl font-['Montserrat'] font-[200]">books</h1> --}}

  <div class="lg:w-[90%] max-w-screen-lg mt-12 mx-auto">
    <div class="card lg:card-side bg-base-100 shadow-xl">
      <div class="lg:w-[100%] max-w-screen-lg my-0 mx-auto">
        @if($locale == 'ja')
          <div class="carousel w-full">
            <div id="slide1" class="carousel-item relative w-full">
              <img src="/images/cover.jpg" class="w-full" />
              <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                <a href="#slide4" class="btn btn-circle">❮</a> 
                <a href="#slide2" class="btn btn-circle">❯</a>
              </div>
            </div> 
            @if($locale == 'ja')
            <div id="slide2" class="carousel-item relative w-full">
              <img src="/images/p3.jpg" class="w-full" />
              <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                <a href="#slide1" class="btn btn-circle">❮</a> 
                <a href="#slide3" class="btn btn-circle">❯</a>
              </div>
            </div> 
            <div id="slide3" class="carousel-item relative w-full">
              <img src="/images/p10.jpg" class="w-full" />
              <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                <a href="#slide2" class="btn btn-circle">❮</a> 
                <a href="#slide4" class="btn btn-circle">❯</a>
              </div>
            </div> 
            <div id="slide4" class="carousel-item relative w-full">
              <img src="/images/p26.jpg" class="w-full" />
              <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                <a href="#slide3" class="btn btn-circle">❮</a> 
                <a href="#slide1" class="btn btn-circle">❯</a>
              </div>
            </div>
            @endif
          </div>
        @else
          <div class="inline-flex w-full">
            <img src="/images/cover-en.png" class="w-full sm:w-[85%]" />
          </div>
        @endif
      </div>
      <div class="card-body {{ $locale == 'ja' ? 'font-ja' : 'font-en'}} font-bold">
        <h2 class="mb-5 card-title text-2xl">{{ __('I am an APPLE')}}</h2>
        <div class="mb-10 font-[300] {{ $locale == 'ja' ? 'font-ja' : 'font-en'}}">
          <p class="text-xl">{{ $locale == 'ja' ? '「ぼくはいったい誰で、何のために生まれてきたんだろう？」自分を探すりんごが自分を創った人と、その思いに出会った時に見つける本当のアイデンティティと愛のおはなし。' : 'An illustrated story for all ages of an apple discovering his identity in God’s love.'}}</p>
        </div>
        
        <div class="card-actions justify-end">
          <a href="{{ $locale == 'ja' ? 'https://www.amazon.co.jp/%E3%81%BC%E3%81%8F%E3%81%AF%E3%82%8A%E3%82%93%E3%81%94-%E3%81%99%E3%81%9A%E3%81%8D%E3%81%95%E3%81%A8%E3%81%BF-ebook/dp/B08QCZ7TJ9/ref=sr_1_4?crid=VYILC68SZUBH&keywords=%E3%81%BC%E3%81%8F%E3%81%AF%E3%82%8A%E3%82%93%E3%81%94&qid=1692584542&sprefix=%2Caps%2C194&sr=8-4' : 'https://www.amazon.co.jp/I-am-APPLE-Satomi-Suzuki/dp/B08PLK5HBV'}}" target="_blank">
            <div x-data>
              <button class="btn btn-primary hover:animate-pulse lowercase">{{ __('buy') }}</button>
              {{-- <button x-show="$store.locale != 'ja'" class="btn btn-primary lowercase hover:animate-spin">buy</button> --}}
            </div>
            </a>
        </div>
      </div>
    </div>
  </div>
</x-layout>
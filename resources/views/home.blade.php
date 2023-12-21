@php
  // $locale = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2) : 'en';
  // App::setLocale($locale);
  $locale = App::getLocale();

  $showmessage = 0;
  $notification_url = App\Models\Notification::checkForNotifications();
  if(strlen($notification_url) > 0) {
    $showmessage = 1;
  }
@endphp



<x-layout>
  <x-slot name="title">satomi suzuki</x-slot>
  {{-- <h1 class="text-center text-5xl md:text-7xl font-['Montserrat'] font-[200]">suzuki satomi</h1> --}}

  <div x-data>
    <h2 class="text-center text-2xl mb-[30px] md:mb-[50px] {{ $locale == 'ja' ? 'font-ja' : 'font-en' }}">{{ __('sceneries never seen before')}}</h2>
    {{-- <h2 x-show="$store.locale == 'ja'" class="text-center text-2xl mb-[30px] md:mb-[50px] font-['Zen_Maru_Gothic']">まだ見たことのない景色</h2> 

    <h2 x-show="$store.locale != 'ja'" class="text-center text-2xl mb-12 md:mb-20 font-['Montserrat'] font-[200] transition-opacity duration-[1000ms]">{{ __('unencountered sceneries') }}</h2> --}}
  </div>
  {{-- @auth
  auth()->login(User:create[
    'name' => 'bobby',
    'email' => 'borromeo@momo.so-net.ne.jp',
    'password' => 'dummy'
  ])
    echo "is authenticated"
  @endauth --}}

  <section class="{{ $showmessage ? 'visible' : 'hidden'}}">
    <div x-data class="block mb-20 flex justify-center" >
      <a id="notification-link" href="{{ $notification_url }}" target="_blank">
        <button id="notification" class="text-center my-3 text-red-700 text-xl border rounded p-2 border-red-700">
          <span x-show="$store.locale == 'ja'" class="text-center mb-6 font-ja text-lg">お知らせ</span>
          <span x-show="$store.locale != 'ja'" class="text-center mb-6 font-en text-lg font-[300]">what's new</span>
          <span class="animate-pulse text-red-600"><i class="fa-solid fa-up-right-from-square pl-[10px]"></i></span>
        </button>
      </a>
    </div>
    {{-- x-cloak x-show="info" x-transition.duration.1000ms x-init="setTimeout(() => info = false, 15000)" --}}
    {{-- <div x-data="{info: {{ $showmessage }}}" class="block mb-20 flex justify-center" >
      <a href="{{ $notification_url }}" target="_blank">
        <button x-cloak x-show="info" x-transition.duration.1000ms x-init="setTimeout(() => info = false, 15000)" class="text-center my-3 text-red-400 text-xl border rounded p-2 border-red-400">
          <span x-show="$store.locale == 'ja'" class="text-center mb-6 font-['Zen_Maru_Gothic'] text-lg">お知らせ</span>
          <span x-show="$store.locale != 'ja'" class="text-center mb-6 font-['Montserrat'] text-lg font-[300]">what's new</span>
          <span class="animate-pulse text-red-600"><i class="fa-solid fa-up-right-from-square pl-[10px]"></i></span>
        </button>
        <div x-show="!info" class="mx-10"></div>
      </a>
    </div> --}}
  </section>
 @php
   
 @endphp
    <p class="text-center opacity-75"><span class="single-line">{!! $locale == 'ja' ? '作品のお問い合わせやオーダーについてはお気軽に<a class="underline" href="https://satomisuzuki.info/contact">ご連絡</a>ください。' : '<em>My works are available for international shipment. Please feel free to <a class="underline" href="https://satomisuzuki.info/contact">request</a> a quotation.</em>' !!}</span><span class="double-line">{!! $locale == 'ja' ? '作品のお問い合わせやオーダーについては<br>お気軽に<a class="underline" href="https://satomisuzuki.info/contact">ご連絡</a>ください。' : '<em>My works are available for international shipment.<br>Please feel free to <a class="underline" href="https://satomisuzuki.info/contact">request</a> a quotation.</em>' !!}</span>
      {{-- {!! $locale == 'ja' ? '作品のお問い合わせやオーダーについてはお気軽に<a class="underline" href="https://satomisuzuki.info/contact">ご連絡</a>ください。' : '<em>My works are available for international shipment. Please feel free to <a class="underline" href="https://satomisuzuki.info/contact">request</a> a quotation.</em>' !!} --}}
      {{-- {!! $locale == 'ja' ? 'オーダー承ります。<br><a class="underline" href="https://satomisuzuki.info/contact">コンタクトフォーム</a> でご相談ください。' : '<em>My works are available for international shipment.<br>Please feel free to <a class="underline" href="https://satomisuzuki.info/contact">request</a> a quotation.</em>' !!} --}}
    </p>

   <div x-data class="flex flex-row flex-wrap justify-around items-start max-w-screen-lg mt-8 mx-auto">
    {{-- @foreach(array_reverse($galleries) as $image) --}}
    @foreach($galleries as $image)
    {{-- @php
    dd($image);
    @endphp --}}
      {{-- <div class="tooltip tooltip-top" data-tip="more..."> --}}
        <div class="card card-compact w-80 bg-base-100 shadow-xl rounded-none mb-10">
          <div class="relative w-full max-w-['400px'] "
            <figure>
              <img src="{{ 'https://setup.satomisuzuki.info/storage/'.$image['image'] }}" class="block w-full h-auto" loading="lazy" />
              {{-- <img src="{{ asset('storage/'.$image['file']) }}" class="block w-full h-auto" /> --}}
            </figure>
            <div class="absolute top-0 bottom-0 left-0 right-0 h-full w-full opacity-0 bg-blue-400 ease-in duration-300 hover:opacity-[0.6]">
              <a x-bind:href="`/gallery/{{ $image['id'] }}`" class="text-white text-5xl absolute top-[45%] left-[43%] text-center translate-[-50%_-50%] animate-bounce"><i class="fa-solid fa-magnifying-glass"></i>
            </a>
          </div>
          </div>
          <div class="card-body">
            <div x-data>
              @if($locale == 'ja')
                <p class="text-center mb-6 font-ja text-lg">{!!$image['title-ja'] !!}</p>
              @else
              <p class="text-center mb-6 font-en text-lg">{!!$image['title-en'] !!}</p>
              @endif
              {{-- <p x-show="$store.locale == 'ja'" class="text-center mb-6 font-['Zen_Maru_Gothic'] text-lg">{!!$image['title-ja'] !!}</p> --}}
              {{-- <p x-show="$store.locale == 'ja'" x-text="`{!! mb_substr($image['title-ja'],0,80) !!}`" class="text-center mb-6 font-['Zen_Maru_Gothic'] text-lg"></p> --}}
              {{-- <p x-show="$store.locale != 'ja'" x-text="`{{ mb_substr($image['title-en'],0,80) }}`" class="text-center mb-6 font-['Montserrat'] text-lg font-[400]"></p> --}}
            </div>
          </div>
        </div>
      {{-- </div> --}}
    @endforeach
  </div>
</x-layout>


{{-- <div class="card card-compact w-80 bg-base-100 shadow-xl rounded-none">
  <div class="relative w-full max-w-['400px'] "
  <a x-bind:href="`/gallery/{{ $image['id'] }}`" class=" inline-block">
    <figure>
      <img :src="`/images/{{ $image['file'] }}`" class="hover:opacity-[0.5] transition duration-500" />
    </figure>
  </a>
  <div class="absolute top-0 bottom-0 left-0 right-0 h-full w-full opacity-0 bg-blue-400 ease-in duration-300 hover:opacity-[0.5]">
    <a x-bind:href="`/gallery/{{ $image['id'] }}`" class=" inline-block">
      <figure>
        <img :src="`/images/{{ $image['file'] }}`" class="block w-full h-auto" />
      </figure>
    </a>
  </div>
  </div>
  <div class="card-body">
    <div x-data>
      <p x-show="$store.locale == 'ja'" x-text="`{!! mb_substr($image['desc-ja'],0,20) !!}⋯⋯`" class="text-center mb-6 font-['Zen_Maru_Gothic'] text-lg"></p>
      <p x-show="$store.locale != 'ja'" x-text="`{{ mb_substr($image['desc-en'],0,20) }}⋯⋯`" class="text-center mb-6 font-['Montserrat'] text-lg font-[400]"></p>
    </div>
  </div>
</div> --}}

<script>
  window.addEventListener('load', function() {
    const elem = document.getElementById('notification');
    const link = document.getElementById('notification-link');
    setTimeout(() => {
      elem.style.opacity = '0';
      elem.style.visibility = 'hidden';
      elem.style.transition = '2s';
      link.style.pointerEvents = 'none';
    }, 10000);
  })
</script>
<style>
  .double-line {
    display: none;
  }
  .single-line {
    display: block;
  }
  /* @media(min-width: 375px) { */
    @media only screen and (max-width: 375px) {
    .single-line {
      display: none;
    }
    .double-line {
      display: block;
    }
  }
</style>
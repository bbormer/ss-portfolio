@php
  // $locale = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2) : 'en';
  $locale = App::getLocale();

  $about_text = App\Models\About::getText($locale);
@endphp

<x-layout>
  <div class="max-w-screen-md mx-auto">
    <x-slot name="title">about<br><span class="text-5xl">satomi suzuki</span></x-slot>
    {{-- <h1 class="mb-8 text-center text-5xl md:text-7xl font-['Montserrat'] font-[200]">about</h1> --}}
     
    
      <img src="/images/IMG_5737-45.jpg" class="px-5 pb-5 mx-auto mt-12 mb-10 transition-opacity"/>
    
    

    <div class="mb-10 px-3 font-[400] text-xl {{ $locale == 'ja' ? 'font-ja' : 'font-en'}}">{!! $about_text !!}
    </div>
    
    
    <div class="divider mb-10 {{ $locale == 'ja' ? 'font-ja' : 'font-en'}}"><i class="fa-regular fa-comments fa-lg px-2"></i></div>

    <div class="italic text-lg">
    <div class="chat chat-start mb-5">
      <div class="chat-bubble bg-gray-200 dark:bg-[#2A323C] text-black dark:text-[#A6ADBA]">{!! $locale == 'ja' ? '無邪気でフレッシュな感性とロマンチックな遊び心が作品に滲み出ている。<br><small>– 60代男性、博士号学者 –</small>' : 'Her innocent, fresh sensibility and romantic sense of playfulness are exuded in her works.<br><small>– 60’s male, PhD, Social Psychology –</small>' !!}</div>
      </div>
    <div class="chat chat-start mb-5">
      <div class="chat-bubble bg-gray-200 dark:bg-[#2A323C] text-black dark:text-[#A6ADBA]">{!! $locale == 'ja' ? '見る人を励ますような力強さと温もりと癒しを感じる。<br><small>– 20代女性、学生 –</small>' : 'Feel strength, warmth, and healing that encourage the viewer.<br><small>– 20’s female, College Student –</small>' !!}</div>
      </div>
    <div class="chat chat-end mb-5">
      <div class="chat-bubble bg-gray-200 dark:bg-[#2A323C] text-black dark:text-[#A6ADBA]">{!! $locale == 'ja' ? '純真で思いやりある人柄と深い思想が絵を見るとわかる。<br><small>– 30代男性、美容師 –</small>' : 'Her pure and thoughtful personality and deep thoughts are evident in her paintings.<br><small>– 30’s male, Hairdresser –</small>' !!}</div>
      </div>
    <div class="chat chat-end mb-5">
      <div class="chat-bubble bg-gray-200 dark:bg-[#2A323C] text-black dark:text-[#A6ADBA]">{!! $locale == 'ja' ? '「人間の美しさはその人が内面にもつグラデーションカラーの幅」と、彼女が話す美的センスや人生に対する希望、人と関わることで喜びを見出す情熱が作品からも感じられる。<br><small>– 40代女性、会社員 –</small>' : 'As she says “The beauty of a person is the range of gradation of colors that a person has inside.” her works convey her aesthetic sense, her hope for life, and her passion for finding joy in interacting with people.<br><small>– 40’s female, IT professional –</small>' !!}</div>
      </div>
    <div class="chat chat-start mb-5">
      <div class="chat-bubble bg-gray-200 dark:bg-[#2A323C] text-black dark:text-[#A6ADBA]">{!! $locale == 'ja' ? '彼女の絵を見ていると童心の大切さを思い出す。<br><small>– 70代男性、会社経営者 –</small>' : 'Looking at her pictures reminds me of the importance of heart of a child.<br><small>– 70’s male, Company Owner –</small>' !!}</div>
      </div>
    </div>
  </div>
</x-layout>
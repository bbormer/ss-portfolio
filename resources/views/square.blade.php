@php
  $locale = App::getLocale();
  session(['validateStatus' => false]);
  $statusValid = session()->get('validateStatus');
@endphp

    <x-layout>
      <x-slot name="title">purchase</x-slot>

      <figure x-data class="mx-auto w-[30%]"><img src="{{ 'https://setup.satomisuzuki.info/storage/'.$gallery['image'] }}" class="mb-30 mt-12 mb-6" /></figure>
      <div class="text-xl  text-center"> <!-- text-green-500 -->
        <p>{{ $locale == 'ja' ? $gallery['title-ja'] : $gallery['title-en']}}</p>
        <p>{{ number_format($gallery['amount'] * config('custom.tax_rate')) }}円 {{ __('(incl. tax)') }}  
        @if($locale != 'ja')
          <span class="tooltip tooltip-right" data-tip="{{ __('convert currency') }}" ><i id="infobox" class="fa-solid fa-circle-info px-3"></i></span>
        @endif
        </p>
        {{-- <p>{{ number_format($gallery['amount'] * config('custom.tax_rate')) }}円 {{ __('(incl. tax)') }}  <span class="tooltip tooltip-right" data-tip="{{ __('convert currency') }}" ><i class="fa-solid fa-circle-info px-3"></i></span>
        </p> --}}
        <p class="text-base">{{ __('shipping')}}: {{ number_format($gallery['shipping']) }}円</p>
      </div>
      
      <div class="dark-mode">
        @livewire('order', [
          'amount' => $gallery['amount'],
          'shipping' => $gallery['shipping'],
          'title_ja' => $gallery['title-ja']
        ])
      </div>
  </x-layout>

  <script>
    document.getElementById('infobox').addEventListener('click', () => {
      const fxtable = [
        { 'locale': 'en-US', 'currency': 'USD', 'sgd': '2'},  
        { 'locale': 'en-SG', 'currency': 'SGD', 'sgd': '2'},
        { 'locale': 'zh-SG', 'currency': 'SGD', 'sgd': '2'},
        { 'locale': 'ko-KR', 'currency': 'KRW', 'sgd': '0'},
        { 'locale': 'es-ES', 'currency': 'EUR', 'sgd': '2'},
        { 'locale': 'fr-FR', 'currency': 'EUR', 'sgd': '2'},
        { 'locale': 'de-DE', 'currency': 'EUR', 'sgd': '2'},
        { 'locale': 'en-GB', 'currency': 'GBP', 'sgd': '2'},
        { 'locale': 'en-CA', 'currency': 'CAD', 'sgd': '2'},
        { 'locale': 'zh-HK', 'currency': 'HKD', 'sgd': '2'},
        { 'locale': 'en-AU', 'currency': 'AUD', 'sgd': '2'}
      ] 

      // Fetching JSON
      const req_url = 'https://v6.exchangerate-api.com/v6/dcbded95122c007c479da974/latest/JPY';

      fetch(req_url, 
        {
          timeout: 10000, //タイムアウト時間
        })
        .then((response)=>
          {
            return response.json();  
          })
          .then((data)=>
            {
              if(data.results === null){
                  alert('cannot access exchange rates');
              } else {
                let fx = fxtable.find((el) => el.locale == navigator.language)
                if(fx === undefined || fx === null) {
                  fx = fxtable.find((el) => el.locale == 'en-US')
                }
                const base_amount = {{ $gallery['amount'] * config('custom.tax_rate') }}; 
                const converted_amount = (base_amount * data.conversion_rates[fx.currency]).toFixed(fx.sgd);
                alert(`estimated price in ${fx.currency} at current rate: ${Intl.NumberFormat(fx.locale, { style: 'currency', currency: fx.currency }).format(converted_amount)}`)
              }
            })
              .catch((ex)=>{ //例外処理
                  console.log(ex);
              });
          })
  </script>
  

  /*
    en_SG SGD 2
    en_US USD 2
    ko_KR KRW 0
    es_ES EUR 2
    fr_FR EUR 2
    de_DE EUR 2
    en_GB GBP 2
    en_CA CAD 2
    zh_HK HKD 2
    en_AU AUD 2

    

  */
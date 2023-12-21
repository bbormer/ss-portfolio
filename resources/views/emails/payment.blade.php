@php
  $locale = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2) : 'en';
  App::setLocale($locale);
@endphp

<h1>{{ __('Thank you for ordering') }}</h1>

<h2>{{ __('Payment ID') }} : {{ $id }}</h2>
<h2>{{ __('order details') }}</h2>
<p>{{ $note }}</p>
@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Welcome!!!
        @endcomponent
    @endslot{{-- Body --}}
              Hello {{ $name }}{{-- Subcopy --}} super excited to have you .
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset{{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
             Glad to add you to the team
        @endcomponent
    @endslot
@endcomponent
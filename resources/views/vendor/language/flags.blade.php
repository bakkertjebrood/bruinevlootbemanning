@foreach (language()->allowed() as $code => $name)
        <a href="{{ language()->back($code) }}">
            <img class="img flags" src="{{ asset('images/flags/'.$code.'.png') }}" alt="{{ $name }}" width="{{ config('language.flags.width') }}" />
        </a>
@endforeach

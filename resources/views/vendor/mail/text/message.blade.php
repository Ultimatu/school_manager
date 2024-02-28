<x-mail::layout>
    {{-- Header --}}
    <x-slot:header>
        @if (config('app.env') === 'production')
            @lang('Vous recevez ce courriel car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.')
        @else

        @endif
        <x-mail::header :url="config('app.url')">
            {{ config('app.name') }}
        </x-mail::header>
    </x-slot:header>

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        <x-slot:subcopy>
            <x-mail::subcopy>
                {{ $subcopy }}
            </x-mail::subcopy>
        </x-slot:subcopy>
    @endisset

    {{-- Footer --}}
    <x-slot:footer>
        <x-mail::footer>
            © {{ date('Y') }} {{ config('app.name') }}. @lang('Tous droits réservés.')
        </x-mail::footer>
    </x-slot:footer>
</x-mail::layout>

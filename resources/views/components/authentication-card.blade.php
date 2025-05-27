@php
    $bg = asset('storage/bgiloco.jpg');
@endphp
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100" style="background-image: url('{{ $bg }}');">
    <div>
        {{ $logo }}
    </div>
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-2xl overflow-hidden sm:rounded-lg mb-5">
        {{ $slot }}
    </div>
</div>

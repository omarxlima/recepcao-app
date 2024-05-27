{{-- <x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">

        <!-- Interact with the `state` property in Alpine.js -->

        <video x-ref="video" width="640" height="480" autoplay></video>


    </div>



    <script type="text/javascript">
        console.log('executing js here..')
       
    </script>


</x-dynamic-component> --}}



<div
x-data="{}"
x-load-js="[@js(\Filament\Support\Facades\FilamentAsset::getScriptSrc('webcam-script'))]"
>
<video id="video" autoplay></video>
<img src="" id="img" alt="">
<button id="capture">Capturar</button>
<canvas id="canvas" style="display: none;"></canvas>
<input type="hidden" id="image" name="{{ $getStatePath() }}">
<!-- ... -->
</div>
<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">

        <!-- Interact with the `state` property in Alpine.js -->
    
            <video x-ref="video" width="640" height="480" autoplay></video>
          
   
    </div>

  

    <script type="text/javascript">
        console.log('executing js here..')
       
    </script>

   
</x-dynamic-component>


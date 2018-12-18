@php
      $ref = $ref??'/'.request()->path();
      $no_js = $no_js ?? false;
@endphp

<div class="scene partial" reference="{{ $ref }}" parent="#scenes" @isset($family)family="{{$family}}"
     @endisset @isset($autoexpired)autoexpired="{{$autoexpired}}"@endisset>
    @yield('content_scene')


    @if($no_js!=true)
        <script>
            //if (location.href.indexOf('{{ $ref }}') == -1)
                location.href = '#!{{ $ref }}';
        </script>
    @endif
</div>


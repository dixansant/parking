{{--
    relative:

    autoremove:
--}}

@php


$show=isset($show)?$show:false;
$footer=isset($footer)?$footer:false;
$forward=isset($forward)?' forward="'.$forward.'"':''

@endphp
<div reference="{{ $reference }}" class="modal fade" id="{{ $id  }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true" {!! $forward !!}@if(isset($attr)) {!! $attr !!}@endif>
    <div class="modal-dialog" role="document" @yield('prop') >
        <div class="modal-content">
            @if(isset($title))
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="exampleModalLabel">{{ $title }}</h4>

                </div>
            @endif
            <div class="errorzone">

            </div>
            <div class="modal-body">
                @if(!isset($title))
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                @endif
                @yield('content_modal')
            </div>
            @if($footer==true)
                <div class="modal-footer">
                    @yield('footer')

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    @yield('buttons')

                </div>
            @endif
        </div>
    </div>
</div>


@if($open==true)
@section('javascript')

    //$('#{{ $id }}').modal('show')

@endsection
@endif
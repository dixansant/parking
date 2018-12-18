@php
    $total = intval(($items-1)/12) +1;
    $page = isset($page)?$page:1;
@endphp
<ul id="pagination{{$filtro}}" class="pagination" style="margin: 0px;">
    <li>
        <a href="?previous" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
        </a>
    </li>
    <li>
        <a>
    <select style="border: 0px;" onchange="runActionMode(this)">
    @for( $t=1 ; $t<=$total; $t++)
        <option href="?page={{$t}}" @if($t==$page) selected @endif><a >{{$t}}</a></option>
    @endfor

    </select> / <b>{{$total}}</b>
        </a>
    </li>
    <li>
        <a href="?next" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
        </a>
    </li>
</ul>

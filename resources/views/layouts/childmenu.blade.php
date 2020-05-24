@foreach($childs as $child)
   <li>
        <a class="dropdown-item {{ count($child['children']) ? 'dropdown-toggle' :'' }}" href="#">{{ $child['childName'] }}</a>
        @if(count($child['children']))
            <ul class="dropdown-menu">
                @include('layouts.childmenu',['childs' => $child['children']])
            </ul>
        @endif
   </li>
@endforeach
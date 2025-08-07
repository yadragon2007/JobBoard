@php
    $back = (url()->previous() === url()->current() || url()->previous() === route("login") || request("comeBack") == "0") ? $default : url()->previous();
    $return = $comeBack;
@endphp


    <a href="{{url()->query($back, ['comeBack' => $return]);}}">
        Cancel
    </a>
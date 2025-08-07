@php
    $back = (url()->previous() === url()->current() || url()->previous() === route("login") || request("comeBack") == "0") ? $default : url()->previous();
    $return = $comeBack;
@endphp

<div class="mb-4 flex items-center space-x-2">
    <a href="{{url()->query($back, ['comeBack' => $return]);}}">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
            class="bi bi-arrow-right-short rotate-180" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
        </svg>
    </a>

</div>
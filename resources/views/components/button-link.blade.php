<a id="{{ $id }}" name="{{ $name }}" href="{{ $href }}"
    class="bg-{{ $color }} text-white active:bg-{{ $color }} font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
    type="button"
    onclick="modalHandler(true,'modal_banner')">
    {{ $title }}
</a>

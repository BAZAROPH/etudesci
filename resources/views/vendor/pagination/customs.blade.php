@if ($paginator->hasPages())
<nav aria-label="Page navigation example">
    <ul class="pagination flex justify-left items-center gap-4">
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link pointer-events-none bg-gray-200 text-gray-600 px-2 py-1 rounded-lg" href="#"
                tabindex="-1">Précédent</a>
            </li>
            @else
            <li class="page-item"><a class="page-link bg-etudes-blue text-white px-2 py-1 rounded-lg hover:bg-etudes-orange duration-300 hover:text-white"
                href="{{ $paginator->previousPageUrl() }}">
                    Précédent</a>
          </li>
        @endif

        @foreach ($elements as $element)
        @if (is_string($element))
        <li class="page-item disabled">{{ $element }}</li>
        @endif

        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="page-item text-white bg-etudes-orange px-2 rounded-lg font-semibold">
            <a class="page-link">{{ $page }}</a>
        </li>
        @else
        <li class="page-item">
            <a class="page-link bg-gray-300 text-gray-500 px-2 py-1 rounded-lg hover:bg-etudes-orange duration-300 hover:text-white"
               href="{{ $url }}">{{ $page }}</a>
        </li>
        @endif
        @endforeach
        @endif
        @endforeach

        @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link bg-etudes-blue text-white px-2 py-1 rounded-lg hover:bg-etudes-orange duration-300 hover:text-white"
               href="{{ $paginator->nextPageUrl() }}"
               rel="next">Suivant</a>
        </li>
        @else
        <li class="page-item disabled">
            <a class="page-link pointer-events-none bg-gray-200 text-gray-600 px-2 py-1 rounded-lg" href="#">Suivant</a>
        </li>
        @endif
    </ul>
  </nav>
@endif

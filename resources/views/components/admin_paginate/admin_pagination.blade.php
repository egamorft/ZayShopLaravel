@if ($paginator->hasPages())
<!-- Pagination -->
<div div="row">
    <ul class="pagination pagination-circle pagination-lg justify-content-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="page-item disabled" aria-disabled="true" aria-label="&laquo; Previous">
            <span class="page-link" aria-hidden="true">&lsaquo;</span>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="&laquo; Previous">&lsaquo;</a>
        </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="page-item disabled">
            <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0" href="#">
                {{ $page }}
            </a>
        </li>
        @else
        <li class="page-item">
            <a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" href="{{ $url }}">
                {{ $page }}
            </a>
        </li>
        @endif
        @endforeach
        @endif
        @endforeach

        <!-- Next Page Link -->
        @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next &raquo;">&rsaquo;</a>
        </li>
        @else
        <li class="page-item disabled" aria-disabled="true" aria-label="Next &raquo;">
            <span class="page-link" aria-hidden="true">&rsaquo;</span>
        </li>
        @endif
        <!-- Next Page Link -->
    </ul>
</div>
<!-- Pagination -->
@endif
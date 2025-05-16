@if ($paginator->hasPages())
<nav class="pagination-nav">
    <ul class="pagination-list">
        {{-- 前へ --}}
        @if ($paginator->onFirstPage())
        <li class="pagination-item disabled"><span>&lt;</span></li>
        @else
        <li class="pagination-item">
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&lt;</a>
        </li>
        @endif

        {{-- ページ番号 --}}
        @foreach ($elements as $element)
        @if (is_string($element))
        <li class="pagination-item disabled"><span>{{ $element }}</span></li>
        @endif

        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="pagination-item active"><span>{{ $page }}</span></li>
        @else
        <li class="pagination-item"><a href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- 次へ --}}
        @if ($paginator->hasMorePages())
        <li class="pagination-item">
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">&gt;</a>
        </li>
        @else
        <li class="pagination-item disabled"><span>&gt;</span></li>
        @endif
    </ul>
</nav>
@endif
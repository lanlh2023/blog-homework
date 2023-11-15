@if ($paginator->hasPages())
    <nav class="d-flex justify-items-center justify-content-between w-100" id="pagination-basic">
        <div class="d-flex justify-content-between flex-fill">
            <ul class="pagination w-100 d-flex justify-content-center">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}"
                                rel="next">@lang('pagination.nextForIndex')</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">@lang('pagination.nextForIndex')</span>
                        </li>
                    @endif
                @endif

                @if ($paginator->currentPage() > 1)
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">@lang('pagination.previousForIndex')</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}"
                                rel="prev">@lang('pagination.previousForIndex')</a>
                        </li>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}"
                                rel="next">@lang('pagination.nextForIndex')</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">@lang('pagination.nextForIndex')</span>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
    </nav>
@endif

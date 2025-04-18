<style>
    .left {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 1px solid #ffdd00;
        color: #000000;
    }

    .right {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 1px solid #ffdd00;
        color: #000000;
    }

    .currentPage {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #ffdd00;
        display: flex; /* 中央揃えのためにflexboxを使用 */
        align-items: center; /* 縦方向の中央揃え */
        justify-content: center; /* 横方向の中央揃え */
        color: #ffffff;
        font-size: 30px;
    }

    .url-page {
        width: 50px;
        height: 50px;
        border: 1px solid #ffdd00;
        border-radius: 50%;
        display: flex; /* 中央揃えのためにflexboxを使用 */
        align-items: center; /* 縦方向の中央揃え */
        justify-content: center; /* 横方向の中央揃え */
        color: #000000;
        font-size: 30px;
        text-decoration: none;
    }

    .flex {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 100px;
        gap: 10px;
    }


</style>

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="">
        <div class="flex">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                    <span aria-hidden="true">
                        <svg class="left" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="" aria-label="{{ __('pagination.previous') }}">
                    <svg class="left" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span aria-disabled="true">
                        <span class="">{{ $element }}</span>
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page">
                                <span class="currentPage">{{ $page }}</span>
                            </span>
                        @else
                            <a href="{{ $url }}" class="url-page" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="" aria-label="{{ __('pagination.next') }}">
                    <svg class="right" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            @else
                <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                    <span class="" aria-hidden="true">
                        <svg class="right" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </span>
            @endif
        </div>
    </nav>
@endif

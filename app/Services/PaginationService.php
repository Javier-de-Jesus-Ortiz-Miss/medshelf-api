<?php

namespace App\Services;

use App\Core\Shared\Domain\CursorRequest;
use App\Core\Shared\Domain\CursorResponse;
use App\Core\Shared\Domain\OffsetRequest;
use App\Core\Shared\Domain\OffsetResponse;
use App\Core\Shared\Domain\PaginableByCursor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\Cursor;

final class PaginationService
{
    private function __construct()
    {
    }

    // :V
    public static function paginate(
        Request   $request,
        callable  $dataFetcherByCursor,
        callable  $dataFetcherByOffset,
        ?callable $itemFormatter = null
    ): JsonResponse
    {
        $page = $request->query('page', 0);
        $size = $request->query('size', 10);
        $cursor = $request->query('cursor');

        if ($cursor && $page) {
            return response()->json(['message' => 'Cannot use both cursor and offset for pagination.'], 400);
        }

        if ($cursor) {
            $cursorRequest = new CursorRequest($cursor, $size);
            $result = $dataFetcherByCursor($cursorRequest);
            if (!$result instanceof CursorResponse) {
                return response()->json(['message' => 'Invalid response from cursor data fetcher.'], 500);
            }
            return response()->json([
                'items' => $result->items,
                'nextCursor' => $result->nextCursor,
            ]);
        } else {
            $offsetRequest = new OffsetRequest($page, $size);
            $result = $dataFetcherByOffset($offsetRequest);
            if (!$result instanceof OffsetResponse) {
                return response()->json(['message' => 'Invalid response from offset data fetcher.'], 500);
            }
            $items = $result->items;
            if ($itemFormatter) {
                $items = array_map($itemFormatter, $items);
            }
            return response()->json([
                'items' => $items,
                'totalCount' => $result->totalCount,
                'page' => $size,
                'size' => $page,
                'hasNextPage' => $result->hasNextPage,
            ]);
        }
    }

    public static function buildCursorQuery(
        Builder  $query,
        ?Cursor  $cursor,
        int      $size,
        callable $mapper
    ): CursorResponse
    {
        $result = $query->cursorPaginate(perPage: $size, cursor: $cursor);

        /** @var PaginableByCursor[] $items */
        $items = collect($result->items())
            ->map(fn($item) => $mapper($item))
            ->toArray();

        return new CursorResponse(
            nextCursor: $result->hasMorePages() ? end($items)?->getCursor() : null,
            items: $items
        );
    }
}

<?php

namespace App\Services;

use App\Core\Shared\Domain\CursorRequest;
use App\Core\Shared\Domain\CursorResponse;
use App\Core\Shared\Domain\OffsetRequest;
use App\Core\Shared\Domain\OffsetResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        $limit = $request->query('limit', 10);
        $offset = $request->query('offset', 0);
        $cursor = $request->query('cursor');

        if ($cursor && $offset) {
            return response()->json(['message' => 'Cannot use both cursor and offset for pagination.'], 400);
        }

        $result = null;
        if ($cursor) {
            $cursorRequest = new CursorRequest($cursor, $limit);
            $result = $dataFetcherByCursor($cursorRequest);
            if (!$result instanceof CursorResponse) {
                return response()->json(['message' => 'Invalid response from cursor data fetcher.'], 500);
            }
            $responseData = [
                'items' => $result->items,
                'nextCursor' => $result->nextCursor,
            ];
        } else {
            $offsetRequest = new OffsetRequest($offset, $limit);
            $result = $dataFetcherByOffset($offsetRequest);
            if (!$result instanceof OffsetResponse) {
                return response()->json(['message' => 'Invalid response from offset data fetcher.'], 500);
            }
            $items = $result->items;
            if ($itemFormatter) {
                $items = array_map($itemFormatter, $items);
            }
            $responseData = [
                'items' => $items,
                'totalCount' => $result->totalCount,
                'limit' => $limit,
                'offset' => $offset,
                'hasNextPage' => $result->hasNextPage,
            ];
        }

        return response()->json($responseData);
    }
}

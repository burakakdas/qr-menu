<?php

namespace App\Http\Controllers;

use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    const CLIENT_MESSAGE_TEXT = 'clientMessage';

    protected function successJsonResponse(string $clientMessage = '', array|null $data = null, int $status = Response::HTTP_OK, array $headers = []): JsonResponse
    {
        $responseData['success'] = true;

        $responseData[self::CLIENT_MESSAGE_TEXT] = $clientMessage;

        $responseData['data'] = $data;

        return response()->json($responseData, $status, $headers);
    }

    protected function failedJsonResponse(string $clientMessage = '', array|null $data = null, int $status = Response::HTTP_INTERNAL_SERVER_ERROR, array $headers = []): JsonResponse
    {
        $responseData['success'] = false;

        $responseData[self::CLIENT_MESSAGE_TEXT] = $clientMessage;

        $responseData['data'] = $data;

        return response()->json($responseData, $status, $headers);
    }

    protected function notFoundJsonResponse(mixed $dataId, string|null $messageForClient = null): JsonResponse
    {
        [, $caller] = debug_backtrace(false, 2);

        Log::error(sprintf('[%s][%s] Not found. DataId: %s, UserId: %s', $caller['class'], $caller['function'], $dataId, Auth::id()));

        if ($messageForClient === null) {
            $messageForClient = '';
        }

        return $this->failedJsonResponse($messageForClient, status: Response::HTTP_NOT_FOUND);
    }

    protected function conflictJsonResponse(string|null $messageForClient = null): JsonResponse
    {
        if ($messageForClient === null) {
            $messageForClient = '';
        }

        return $this->failedJsonResponse($messageForClient, status: Response::HTTP_CONFLICT);
    }

    protected function destroyResponse(Model|null $model, $instanceof, BaseService $service, string|null $methodName = 'destroyByModel'): JsonResponse
    {
        if (! $model instanceof $instanceof) {
            Log::error(sprintf('[%s][%s] Data not found. DataId: %s, UserId: %s', __CLASS__, __FUNCTION__, $model?->id, auth()?->id()));

            return new JsonResponse(['success' => false, self::CLIENT_MESSAGE_TEXT => __('messages.errors.unexpected_error')], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $success = $service->{$methodName}($model);

        return new JsonResponse([
            'success' => $success,
            self::CLIENT_MESSAGE_TEXT => $success ? __('messages.info.deleted') : __('messages.info.failed_to_delete'),
        ]);
    }
}

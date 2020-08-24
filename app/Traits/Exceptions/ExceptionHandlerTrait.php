<?php

namespace App\Traits\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

trait ExceptionHandlerTrait
{

    use JSONErrorResponser;

    /**
     * Creates a new JSON response based on exception type.
     *
     * @param Request $request
     * @param Exception $e
     * @return \Illuminate\Http\JsonResponse
     */

    protected function handleAjaxException($request, Exception $exception)
    {
        if ($exception instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($exception, $request);
        }

        if ($exception instanceof ModelNotFoundException) {
            $modelName = strtolower(class_basename($exception->getModel()));

            return $this->errorResponse(__('exceptions.model_not_found'), 404);
        }

        if ($exception instanceof AuthenticationException) {
            return $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof AuthorizationException) {
            return $this->errorResponse(__('exceptions.authorization'), 403);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->errorResponse(__('exceptions.method_not_allowed_http'), 405);
        }

        if ($exception instanceof NotFoundHttpException) {
            return $this->errorResponse(__('exceptions.not_found_http'), 404);
        }

        if ($exception instanceof HttpException) {
            return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
        }

        if ($exception instanceof QueryException) {
            $CODE_POSITION = 0;
            $errorCode = $exception->errorInfo[$CODE_POSITION];
            if ($errorCode == 23503) {
                return $this->errorResponse(__('exceptions.query.code_23503'), 409);
            }

            if ($errorCode == 23000) {
                return $this->errorResponse(__('exceptions.query.code_23000'), 409);
            }
        }

        if ($exception instanceof TokenMismatchException) {
            return $this->errorResponse(__('exceptions.token_mismatch'), 403);
        }

        return $this->errorResponse("{$exception->getMessage()}", 500);
    }

    /**
     * Create a response object from the given validation exception.
     *
     * @param  \Illuminate\Validation\ValidationException  $e
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();

        if ($this->isFrontend($request)) {
            return $request->ajax() ? response()->json($errors, 422) : redirect()
                ->back()
                ->withInput($request->input())
                ->withErrors($errors);
        }

        return $this->errorResponse($errors, 422);
    }

    private function isFrontend($request)
    {
        return $request->acceptsHtml() && collect($request->route()->middleware())->contains('web');
    }
}

<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Http\Resources\ErrorTransformer;
use App\Http\Resources\ErrorValidationTransformer;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            $errorValidation = [
                'message' => 'El registro no fue encontrado',
            ];
            $errorTransformer = new ErrorTransformer($errorValidation);

            return $errorTransformer->response()->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof NotFoundHttpException){
            $errorValidation = [
                'message' => 'No se encontró la URL',
            ];
            $errorTransformer = new ErrorTransformer($errorValidation);

            return $errorTransformer->response()->setStatusCode($exception->getStatusCode());
        }

        if($exception instanceof MethodNotAllowedHttpException){
            $errorValidation = [
                'message' => 'Metodo no permitido',
            ];
            $errorTransformer = new ErrorTransformer($errorValidation);

            return $errorTransformer->response()->setStatusCode($exception->getStatusCode());
        }

        if($exception instanceof FatalThrowableError){
            $errorValidation = [
                'message' => $exception->getMessage()
            ];
            $errorTransformer = new ErrorTransformer($errorValidation);

            return $errorTransformer->response()->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        if($exception instanceof ValidationException){
            $errorValidation = [
                'message' => 'Error en los campos de la petición',
                'errors' => $exception->errors()
            ];

            return new ErrorValidationTransformer($errorValidation);
        }

        return parent::render($request, $exception);
    }
}

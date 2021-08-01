<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Request;
use Swift_TransportException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof Swift_TransportException) {
            return $this->handleSwiftException($request, $e);
        }
        
        if ($exception instanceof ValidationException && $request->ajax()) {
            return response()->json([
                'message' => trans('base::messages.the_given_data_was_invalid'),
                'errors' => $exception->validator->getMessageBag(),
            ], 422);
        }
        
        if ($this->shouldRedirectToAdminDashboard($exception)) {
            return redirect()->route('admin.dashboard.index');
        } 

        if ($this->shouldShowNotFoundPage($exception)) {
            return response()->view('errors.404');
        }

        return parent::render($request, $exception);
        
    }
    
    private function handleSwiftException(Request $request, Swift_TransportException $exception)
    {
        if (config('app.debug')) {
            throw $exception;
        }

        if ($request->ajax()) {
            abort(400, trans('base::messages.mail_is_not_configured'));
        }

        return back()->withInput()
            ->with('error', trans('base::messages.mail_is_not_configured'));
    }

    
    private function shouldRedirectToAdminDashboard(Throwable $exception)
    {
        if (config('app.debug') || ! $this->inAdminPanel()) {
            return false;
        }

        return $exception instanceof NotFoundHttpException || $exception instanceof ModelNotFoundException;
    }
    
    private function shouldShowNotFoundPage(Throwable $exception)
    {
        if ($this->inAdminPanel()) {
            return false;
        }

        return $exception instanceof NotFoundHttpException || $exception instanceof ModelNotFoundException;
    }
    
    /**
     * Determine if the request is from admin panel.
     *
     * @return bool
     */
    private function inAdminPanel()
    {
        return $this->container->has('inAdmin') && $this->container['inAdmin'];
    }
}

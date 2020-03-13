<?php

namespace Rekamy\Generator\Console\Traits;

trait ResponseHandler
{
  public $internalServerException;

  public function successResponse($message, array $data = null, $code = 200)
  {
    return response()->json([
      'success' => true,
      'message' => $message,
      'data' => $data
    ], $code);
  }

  public function failResponse($message, $code)
  {
    return response()->json([
      'success' => false,
      'message' => $message,
    ], $code);
  }
}

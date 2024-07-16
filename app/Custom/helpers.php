<?php

use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


function respJson($status, $message, $data)
{
    return response()->json([
        "status" => $status,
        "message" => $message,
        "data" => $data
    ], $status);
}

function badReq($message = "Bad Resquest")
{
    return response()->json([
        "status" => Response::HTTP_BAD_REQUEST,
        "message" => $message
    ], 400);
}
function badData($status = Response::HTTP_UNPROCESSABLE_ENTITY, $errors = "Vérifier les champ à renseigner")
{
    return response()->json([
        "status" => Response::HTTP_UNPROCESSABLE_ENTITY,
        "message" => $errors,
    ], $status);
}

function notFound($message = "Not Found")
{
    return response()->json([
        "status" => Response::HTTP_NOT_FOUND,
        "message" => $message
    ]);
}

function customValidation(array $data, array $rules)
{
    // Validator creation
    $validator = Validator::make($data, $rules);
    // Data validation
    $validator->validate();
    // Return Validate Data
    return $validator->validated();
}

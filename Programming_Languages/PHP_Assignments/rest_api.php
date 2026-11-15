<?php

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

$headers = getallheaders();

$input = file_get_contents("php://input");
$data = json_decode($input, true);

$response = [];

switch ($method) {

    case "GET":
        http_response_code(200);

        $response = [
            "success" => true,
            "method" => "GET",
            "message" => "GET request received successfully"
        ];

        break;

    case "POST":
        if ($data === null) {
            http_response_code(400);

            $response = [
                "success" => false,
                "error" => "Invalid JSON data"
            ];

            break;
        }

        http_response_code(200);

        $response = [
            "success" => true,
            "method" => "POST",
            "message" => "POST request received successfully",
            "data" => $data
        ];

        break;

    case "PUT":
        if ($data === null) {
            http_response_code(400);

            $response = [
                "success" => false,
                "error" => "Invalid JSON data"
            ];

            break;
        }

        http_response_code(200);

        $response = [
            "success" => true,
            "method" => "PUT",
            "message" => "PUT request received successfully",
            "data" => $data
        ];

        break;

    case "DELETE":
        http_response_code(200);

        $response = [
            "success" => true,
            "method" => "DELETE",
            "message" => "DELETE request received successfully"
        ];

        break;

    default:
        http_response_code(405);

        $response = [
            "success" => false,
            "error" => "Method not allowed"
        ];

        break;
}

$response["authorization_header"] =
    $headers["Authorization"] ?? "Not provided";

echo json_encode($response, JSON_PRETTY_PRINT);
?>
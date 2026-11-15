<?php

header("Content-Type: application/json");

// Configuration
$max_file_size = 5 * 1024 * 1024; // 5 MB

$allowed_extensions = [
    "jpg",
    "jpeg",
    "png",
    "pdf"
];

$allowed_mime_types = [
    "image/jpeg",
    "image/png",
    "application/pdf"
];

// Upload directory
$upload_directory = __DIR__ . DIRECTORY_SEPARATOR . "uploads";

// Check if upload directory exists
if (!is_dir($upload_directory)) {
    mkdir($upload_directory, 0755, true);
}

// Check if file was uploaded
if (!isset($_FILES["uploaded_file"])) {
    http_response_code(400);

    echo json_encode([
        "success" => false,
        "error" => "No file uploaded"
    ], JSON_PRETTY_PRINT);

    exit;
}

$file = $_FILES["uploaded_file"];

// Check upload error
if ($file["error"] !== UPLOAD_ERR_OK) {
    http_response_code(400);

    echo json_encode([
        "success" => false,
        "error" => "File upload failed"
    ], JSON_PRETTY_PRINT);

    exit;
}

// Check file size
if ($file["size"] > $max_file_size) {
    http_response_code(400);

    echo json_encode([
        "success" => false,
        "error" => "File size exceeds the 5 MB limit"
    ], JSON_PRETTY_PRINT);

    exit;
}

// Get original filename
$original_filename = $file["name"];

// Extract extension
$extension = strtolower(
    pathinfo($original_filename, PATHINFO_EXTENSION)
);

// Check extension whitelist
if (!in_array($extension, $allowed_extensions, true)) {
    http_response_code(400);

    echo json_encode([
        "success" => false,
        "error" => "File extension is not allowed"
    ], JSON_PRETTY_PRINT);

    exit;
}

// Detect actual MIME type
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime_type = $finfo->file($file["tmp_name"]);

// Check MIME type whitelist
if (!in_array($mime_type, $allowed_mime_types, true)) {
    http_response_code(400);

    echo json_encode([
        "success" => false,
        "error" => "File content type is not allowed",
        "detected_mime_type" => $mime_type
    ], JSON_PRETTY_PRINT);

    exit;
}

// Generate a cryptographically secure random filename
$random_filename = bin2hex(random_bytes(16)) . "." . $extension;

$destination = $upload_directory . DIRECTORY_SEPARATOR . $random_filename;

// Move uploaded file
if (!move_uploaded_file($file["tmp_name"], $destination)) {
    http_response_code(500);

    echo json_encode([
        "success" => false,
        "error" => "Failed to store uploaded file"
    ], JSON_PRETTY_PRINT);

    exit;
}

// Successful upload
http_response_code(200);

echo json_encode([
    "success" => true,
    "message" => "File uploaded successfully",
    "original_filename" => $original_filename,
    "stored_filename" => $random_filename,
    "mime_type" => $mime_type,
    "size" => $file["size"]
], JSON_PRETTY_PRINT);

?>
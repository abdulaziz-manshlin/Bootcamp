<?php

header("Content-Type: application/json");

try {
    // Create an in-memory SQLite database
    $pdo = new PDO("sqlite::memory:");

    // Configure PDO error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create users table
    $pdo->exec("
        CREATE TABLE users (
            id INTEGER PRIMARY KEY,
            username TEXT NOT NULL,
            email TEXT NOT NULL
        )
    ");

    // Insert test users
    $pdo->exec("
        INSERT INTO users (username, email) VALUES
        ('abdulaziz', 'abdulaziz@example.com'),
        ('ahmed', 'ahmed@example.com'),
        ('mohammed', 'mohammed@example.com')
    ");

    // Get username from URL
    $username = $_GET['username'] ?? '';

    /*
     * UNSAFE QUERY
     * Directly inserting user input into SQL.
     * This is vulnerable to SQL Injection.
     */
    $unsafe_sql = "SELECT id, username, email FROM users WHERE username = '$username'";

    /*
     * SAFE QUERY
     * Prepared statement separates SQL code from user input.
     */
    $safe_sql = "SELECT id, username, email FROM users WHERE username = :username";

    $stmt = $pdo->prepare($safe_sql);
    $stmt->execute([
        ':username' => $username
    ]);

    $safe_results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return only safe query results
    echo json_encode([
        "success" => true,
        "username_searched" => $username,
        "safe_query_results" => $safe_results,
        "protection" => "PDO Prepared Statement"
    ], JSON_PRETTY_PRINT);

} catch (PDOException $e) {

    // Do not expose database details to the user
    http_response_code(500);

    echo json_encode([
        "success" => false,
        "error" => "Internal database error"
    ], JSON_PRETTY_PRINT);
}
?>
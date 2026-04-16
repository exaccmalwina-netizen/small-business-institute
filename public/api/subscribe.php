<?php
/**
 * Local Hostinger MySQL Newsletter Signup Endpoint
 * 
 * This file receives the AJAX POST JSON payload from the Astro frontend
 * and securely inserts it into the MySQL database hosted on Hostinger.
 */

// 1. Set headers to strictly return JSON
header('Content-Type: application/json');

// Enable CORS if ever needed, but usually not required for same-domain
// header("Access-Control-Allow-Origin: *"); 
// header("Access-Control-Allow-Headers: Content-Type");

// 2. Database Configuration (User MUST update these!)
$host = 'TUTAJ_WPISZ_HOST_BAZY'; // np. 'localhost' albo '127.0.0.1' na Hostingerze
$db   = 'TUTAJ_WPISZ_NAZWE_BAZY';
$user = 'TUTAJ_WPISZ_UZYTKOWNIKA';
$pass = 'TUTAJ_WPISZ_HASLO';
$charset = 'utf8mb4';

// 3. Process the incoming JSON body
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid JSON payload.']);
    exit;
}

// 4. Extract data (with fallbacks if optional fields are missing)
$email = $data['EMAIL'] ?? '';
$fname = $data['FNAME'] ?? '';
$lname = $data['LNAME'] ?? '';
$postcode = $data['POSTCODE'] ?? '';
$emp_no = $data['EMP_NO'] ?? null; // Can be null if empty
$subcontractors = $data['MMERGE7'] ?? ''; // Frequently, Sometimes, Never
$industry = $data['INDUSTRY'] ?? '';

// Basic validation
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Valid email is required.']);
    exit;
}

if ($emp_no === '') {
    $emp_no = null; // Ensure clean NULL for database integers
}

// 5. Connect to the database and Insert
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // Prepare SQL Statement (Prevents SQL Injection securely)
    $stmt = $pdo->prepare("
        INSERT INTO newsletter_subscribers (
            email, first_name, last_name, postcode, employees, subcontractors, industry, created_at
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, NOW()
        )
    ");
    
    // Execute with mapped fields
    $stmt->execute([
        $email,
        $fname,
        $lname,
        $postcode,
        $emp_no,
        $subcontractors,
        $industry
    ]);

    // Setup success response
    echo json_encode(['success' => true]);

} catch (\PDOException $e) {
    // Check if the error is a duplicate email entry (Constraint violation)
    if ($e->getCode() == 23000) {
        // Soft success if they are already subscribed, or return specific error
        echo json_encode(['success' => true, 'message' => 'Already subscribed']);
    } else {
        http_response_code(500);
        // Only output generic message to user, log actual error to php_error.log
        error_log('Database Insert Error: ' . $e->getMessage());
        echo json_encode(['success' => false, 'error' => 'Could not save to database.']);
    }
}
?>

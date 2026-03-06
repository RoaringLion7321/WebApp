<?php
// email_generator.php - Generates student email ID

// Get form data
$firstName = isset($_POST['firstName']) ? trim($_POST['firstName']) : '';
$lastName = isset($_POST['lastName']) ? trim($_POST['lastName']) : '';
$dateOfBirth = isset($_POST['dateOfBirth']) ? $_POST['dateOfBirth'] : '';
$department = isset($_POST['department']) ? strtolower(trim($_POST['department'])) : '';

// Input validation
if (empty($firstName) || empty($lastName) || empty($dateOfBirth) || empty($department)) {
    die("Error: All fields are required!");
}

// Email generation logic
function generateEmailID($firstName, $lastName, $dateOfBirth, $department) {
    // Step 1: Get first 4 letters of first name (lowercase)
    $firstNamePart = strtolower(substr($firstName, 0, 4));
    
    // Step 2: Get first 4 letters of last name (lowercase)
    $lastNamePart = strtolower(substr($lastName, 0, 4));
    
    // Step 3: Extract year from date of birth and get last 2 digits
    $year = date('Y', strtotime($dateOfBirth));
    $yearSuffix = substr($year, -2);
    
    // Step 4: Combine all parts
    // Format: department_first4last4year@jbu.edu
    $emailID = $department . "_" . $firstNamePart . $lastNamePart . $yearSuffix . "@jbu.edu";
    
    return $emailID;
}

// Generate the email ID
$generatedEmail = generateEmailID($firstName, $lastName, $dateOfBirth, $department);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Generated Successfully</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }
        
        h1 {
            color: #667eea;
            margin-bottom: 20px;
        }
        
        .success-icon {
            width: 80px;
            height: 80px;
            background: #4caf50;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 40px;
        }
        
        .details {
            background: #f5f5f5;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            text-align: left;
        }
        
        .detail-row {
            margin: 10px 0;
            color: #333;
        }
        
        .label {
            font-weight: bold;
            color: #667eea;
        }
        
        .email-display {
            background: #667eea;
            color: white;
            padding: 15px;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            margin: 20px 0;
            word-break: break-all;
        }
        
        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        
        .back-link:hover {
            background: #764ba2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-icon">✓</div>
        <h1>Email ID Generated Successfully!</h1>
        
        <div class="details">
            <div class="detail-row">
                <span class="label">Name:</span> <?php echo htmlspecialchars($firstName . " " . $lastName); ?>
            </div>
            <div class="detail-row">
                <span class="label">Date of Birth:</span> <?php echo htmlspecialchars($dateOfBirth); ?>
            </div>
            <div class="detail-row">
                <span class="label">Department:</span> <?php echo htmlspecialchars(strtoupper($department)); ?>
            </div>
        </div>
        
        <div class="email-display">
            <?php echo htmlspecialchars($generatedEmail); ?>
        </div>
        
        <p>Your official student email ID has been created!</p>
        
        <a href="EmailGenerator.html" class="back-link">Generate Another Email</a>
    </div>
</body>
</html>

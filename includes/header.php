<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php if(isset($page_title)){ echo "$page_title";} ?>  - Logo Name
  </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <style>
        /* ===== Background for full page ===== */
        body {
            background: url("Assets/image/body.avif") no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            
        }
        .card {
            background-color: #ffe6f0; /* light pink */
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* soft shadow */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* Hover effect for card */
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
        }

        /* ===== Card Header ===== */
        .card-header {
            background: #ff8d9eff; /* pinkish header */
            border-radius: 12px 12px 0 0;
        }

        /* ===== Input Fields ===== */
        .form-control {
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 10px;
        }

        /* Focus effect on input */
        .form-control:focus {
            border-color: #ff6699;
            box-shadow: 0 0 5px rgba(255, 105, 180, 0.6);
        }

        /* ===== Button Styling ===== */
        .btn-danger {
            background-color: #ff4d6d;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #e63950;
        }

        /* ===== Centering the login form vertically ===== */
        .py-5 {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
  

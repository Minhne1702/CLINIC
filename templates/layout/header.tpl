<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .navbar-nav .nav-link { font-weight: 500; color: #333; }
        .navbar-nav .nav-link:hover { color: #0d6efd; }
        .btn-login { border-radius: 20px; padding: 5px 20px; }
        .navbar .btn {
    padding: 8px 20px !important;
    width: auto !important;
    display: inline-block !important;
    text-transform: none !important;
    font-size: 14px !important;
}
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="index.php">
            <i class="fa-solid fa-heart-pulse"></i> CLINIC-SYSTEM
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-content="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=doctors">Doctors</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=services">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=appointments">Appointments</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=contact">Contact</a></li>
            </ul>

            <div class="d-flex align-items-center">
                <a href="index.php?page=login" class="btn btn-outline-primary btn-login me-2">Login</a>
                <a href="index.php?page=register" class="btn btn-primary btn-login text-white">Register</a>
            </div>
        </div>
    </div>
</nav>

<div class="main-content">
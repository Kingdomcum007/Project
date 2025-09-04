<?php
// includes/header.php
session_start();
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['username']) && basename($_SERVER['PHP_SELF']) != 'login.php' && basename($_SERVER['PHP_SELF']) != 'register.php') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness App - <?php echo isset($page_title) ? $page_title : 'หน้าแรก'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5; /* Light grey background */
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .card {
            border-radius: 0.75rem;
            box-shadow: 0 4px 8px rgba(0,0,0,.05);
        }
        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .btn {
            border-radius: 0.5rem;
        }
        .alert {
            border-radius: 0.5rem;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php"><i class="fas fa-dumbbell me-2"></i>Fitness App</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php if (isset($_SESSION['username'])): ?>
        <li class="nav-item"><a class="nav-link" href="mode.php"><i class="fas fa-running me-1"></i>เลือกโหมด</a></li>
        <li class="nav-item"><a class="nav-link" href="exercise.php"><i class="fas fa-calendar-alt me-1"></i>ตารางออกกำลังกาย</a></li>
        <li class="nav-item"><a class="nav-link" href="bmi.php"><i class="fas fa-calculator me-1"></i>คำนวน BMI/BMR</a></li>
        <li class="nav-item"><a class="nav-link" href="food_recommend.php"><i class="fas fa-utensils me-1"></i>แนะนำอาหาร</a></li>
        <li class="nav-item"><a class="nav-link" href="profile.php"><i class="fas fa-user-circle me-1"></i>โปรไฟล์</a></li>
        <?php endif; ?>
      </ul>
      <div class="d-flex">
        <?php if (isset($_SESSION['username'])): ?>
          <span class="navbar-text me-3 text-white">สวัสดี, <strong class="text-warning"><?= htmlspecialchars($_SESSION['username']) ?></strong></span>
          <a href="logout.php" class="btn btn-outline-light"><i class="fas fa-sign-out-alt me-1"></i>ออกจากระบบ</a>
        <?php else: ?>
          <a href="login.php" class="btn btn-outline-light me-2"><i class="fas fa-sign-in-alt me-1"></i>เข้าสู่ระบบ</a>
          <a href="register.php" class="btn btn-light"><i class="fas fa-user-plus me-1"></i>สมัครสมาชิก</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
<main class="py-4">
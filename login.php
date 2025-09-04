<?php
$page_title = "เข้าสู่ระบบ";
include 'header.php';
include 'db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
    }
}
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 450px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4 text-primary"><i class="fas fa-sign-in-alt me-2"></i>เข้าสู่ระบบ</h2>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $error ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <form method="post" action="login.php">
                <div class="mb-3">
                    <label for="username" class="form-label"><i class="fas fa-user me-2"></i>ชื่อผู้ใช้</label>
                    <input type="text" class="form-control" id="username" name="username" required autofocus />
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label"><i class="fas fa-lock me-2"></i>รหัสผ่าน</label>
                    <input type="password" class="form-control" id="password" name="password" required />
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-sign-in-alt me-2"></i>เข้าสู่ระบบ</button>
                    <a href="register.php" class="btn btn-outline-success btn-lg mt-2"><i class="fas fa-user-plus me-2"></i>สมัครสมาชิก</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
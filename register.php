<?php
$page_title = "สมัครสมาชิก";
include 'header.php';
include 'db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = intval($_POST['age']);
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password']; // In a real app, hash this password!

    // Check if username or email already exists
    $sql_check = "SELECT * FROM users WHERE username=? OR email=?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ss", $username, $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $existing_user = $result_check->fetch_assoc();
        if ($existing_user['username'] == $username) {
            $error = "ชื่อผู้ใช้นี้มีคนใช้แล้ว";
        } else {
            $error = "อีเมลนี้ถูกใช้ไปแล้ว";
        }
    } else {
        $sql = "INSERT INTO users (id, name, age, email, phone, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sissss", $name, $age, $email, $phone, $username, $password);
        if ($stmt->execute()) {
            $_SESSION['registration_success'] = "สมัครสมาชิกสำเร็จ! กรุณาเข้าสู่ระบบ";
            header("Location: login.php");
            exit();
        } else {
            $error = "เกิดข้อผิดพลาดในการสมัครสมาชิก: " . $conn->error;
        }
    }
}
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 600px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4 text-success"><i class="fas fa-user-plus me-2"></i>สมัครสมาชิก</h2>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $error ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <form method="post" action="register.php">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label"><i class="fas fa-signature me-2"></i>ชื่อ-นามสกุล</label>
                        <input type="text" class="form-control" id="name" name="name" required />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="age" class="form-label"><i class="fas fa-birthday-cake me-2"></i>อายุ</label>
                        <input type="number" class="form-control" id="age" name="age" required min="1" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label"><i class="fas fa-envelope me-2"></i>อีเมล</label>
                        <input type="email" class="form-control" id="email" name="email" required />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label"><i class="fas fa-phone me-2"></i>โทรศัพท์</label>
                        <input type="text" class="form-control" id="phone" name="phone" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label"><i class="fas fa-user me-2"></i>ชื่อผู้ใช้</label>
                        <input type="text" class="form-control" id="username" name="username" required />
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="password" class="form-label"><i class="fas fa-lock me-2"></i>รหัสผ่าน</label>
                        <input type="password" class="form-control" id="password" name="password" required />
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-user-plus me-2"></i>สมัครสมาชิก</button>
                    <a href="login.php" class="btn btn-outline-secondary btn-lg mt-2"><i class="fas fa-arrow-left me-2"></i>กลับไปหน้าเข้าสู่ระบบ</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
<?php
$page_title = "โปรไฟล์";
include 'header.php';
include 'db.php';

$username = $_SESSION['username'];

$sql = "SELECT name, age, email, phone FROM users WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<div class="container py-5">
    <div class="card shadow-lg p-4 mx-auto" style="max-width: 700px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4 text-info"><i class="fas fa-user-circle me-2"></i>โปรไฟล์ของคุณ</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                        <tr>
                            <th scope="row" class="w-25"><i class="fas fa-signature me-2"></i>ชื่อ-นามสกุล</th>
                            <td><?= htmlspecialchars($user['name']) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fas fa-birthday-cake me-2"></i>อายุ</th>
                            <td><?= htmlspecialchars($user['age']) ?> ปี</td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fas fa-envelope me-2"></i>อีเมล</th>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fas fa-phone me-2"></i>โทรศัพท์</th>
                            <td><?= htmlspecialchars($user['phone']) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fas fa-user me-2"></i>ชื่อผู้ใช้</th>
                            <td><?= htmlspecialchars($username) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-4">
                <a href="index.php" class="btn btn-secondary btn-lg"><i class="fas fa-arrow-left me-2"></i>กลับหน้าแรก</a>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
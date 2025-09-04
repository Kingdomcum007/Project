<?php
$page_title = "บันทึก Bodybuilding";
include 'header.php';
include 'db.php';

$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $history = $_POST['history'];
    $username = $_SESSION['username'];

    $sql = "INSERT INTO bodybuilding_records (username, date, history) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $date, $history);
    if ($stmt->execute()) {
        $success = "บันทึกข้อมูล Bodybuilding เรียบร้อยแล้ว!";
    } else {
        $error = "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $conn->error;
    }
}
?>

<div class="container py-5">
    <div class="card shadow-lg p-4 mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4 text-info"><i class="fas fa-dumbbell me-2"></i>บันทึกประวัติการออกกำลังกาย Bodybuilding</h2>
            <?php if (!empty($success)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $success ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $error ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <form method="post" action="record_bodybuilding.php">
                <div class="mb-3">
                    <label for="date" class="form-label"><i class="fas fa-calendar-alt me-2"></i>วันที่</label>
                    <input type="date" class="form-control" id="date" name="date" required />
                </div>
                <div class="mb-4">
                    <label for="history" class="form-label"><i class="fas fa-clipboard-list me-2"></i>ประวัติการออกกำลังกาย</label>
                    <textarea class="form-control" id="history" name="history" rows="5" placeholder="เช่น อก-ไตรเซ็ปส์: Bench Press 3x10, Triceps Pushdown 3x12" required></textarea>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-info btn-lg"><i class="fas fa-save me-2"></i>บันทึก</button>
                    <a href="mode.php" class="btn btn-outline-secondary btn-lg mt-2"><i class="fas fa-arrow-left me-2"></i>กลับ</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
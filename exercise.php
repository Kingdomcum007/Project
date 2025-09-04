<?php
$page_title = "ตารางออกกำลังกาย";
include 'header.php';
include 'db.php';

$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $part = $_POST['part'];
    $history = $_POST['history'];
    $username = $_SESSION['username'];

    $sql = "INSERT INTO exercise_records (username, date, part, history) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $date, $part, $history);
    if ($stmt->execute()) {
        $success = "บันทึกข้อมูลการออกกำลังกายเรียบร้อยแล้ว!";
    } else {
        $error = "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $conn->error;
    }
}

// Fetch all exercise records for the logged-in user
$username = $_SESSION['username'];
$records = [];
$sql_fetch = "SELECT date, part, history FROM exercise_records WHERE username=? ORDER BY date DESC, id DESC";
$stmt_fetch = $conn->prepare($sql_fetch);
$stmt_fetch->bind_param("s", $username);
$stmt_fetch->execute();
$result_fetch = $stmt_fetch->get_result();
while ($row = $result_fetch->fetch_assoc()) {
    $records[] = $row;
}
?>

<div class="container py-5">
    <div class="card shadow-lg p-4 mb-5">
        <div class="card-body">
            <h2 class="card-title text-center mb-4 text-success"><i class="fas fa-plus-circle me-2"></i>บันทึกผลการออกกำลังกาย</h2>
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
            <form method="post" action="exercise.php">
                <div class="mb-3">
                    <label for="date" class="form-label"><i class="fas fa-calendar-alt me-2"></i>วันที่</label>
                    <input type="date" class="form-control" id="date" name="date" required />
                </div>
                <div class="mb-3">
                    <label for="part" class="form-label"><i class="fas fa-running me-2"></i>ส่วนที่ออก</label>
                    <select class="form-select" id="part" name="part" required>
                        <option value="">-- เลือกส่วนที่ออก --</option>
                        <option value="ขา">ขา</option>
                        <option value="แขน">แขน</option>
                        <option value="อก">อก</option>
                        <option value="หลัง">หลัง</option>
                        <option value="ไหล่">ไหล่</option>
                        <option value="ท้อง">ท้อง</option>
                        <option value="Cardio">Cardio</option>
                        <option value="Yoga">Yoga</option>
                        <option value="Full Body">Full Body</option>
                        <option value="อื่นๆ">อื่นๆ</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="history" class="form-label"><i class="fas fa-clipboard-list me-2"></i>ประวัติการออกกำลังกาย</label>
                    <textarea class="form-control" id="history" name="history" rows="5" placeholder="เช่น วิ่ง 5 กม. ใน 30 นาที, Squats 3x10, Deadlifts 3x5" required></textarea>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-save me-2"></i>บันทึก</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-lg p-4">
        <div class="card-body">
            <h2 class="card-title text-center mb-4 text-info"><i class="fas fa-history me-2"></i>ประวัติการออกกำลังกายของคุณ</h2>
            <?php if (empty($records)): ?>
                <div class="alert alert-info text-center" role="alert">
                    ยังไม่มีประวัติการออกกำลังกาย บันทึกครั้งแรกของคุณเลย!
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">วันที่</th>
                                <th scope="col">ส่วนที่ออก</th>
                                <th scope="col">ประวัติ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($records as $record): ?>
                                <tr>
                                    <td><?= htmlspecialchars($record['date']) ?></td>
                                    <td><?= htmlspecialchars($record['part']) ?></td>
                                    <td><?= nl2br(htmlspecialchars($record['history'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
            <div class="text-center mt-4">
                <a href="index.php" class="btn btn-secondary btn-lg"><i class="fas fa-arrow-left me-2"></i>กลับหน้าแรก</a>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
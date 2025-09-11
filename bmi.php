<?php
$page_title = "คำนวณ BMI/BMR";
include 'header.php';
include 'db.php';
// db.php is not needed here as no database operations are performed
$bmi = null;
$bmr = null;
$bmi_category = '';
$bmr_info = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $weight = floatval($_POST['weight']);
    $height = floatval($_POST['height']); // cm to m
    $age = intval($_POST['age']);
    $gender = $_POST['gender'];
    $sql = "UPDATE users SET weight=?, height=?, age=?, gender=? WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ddiss", $weight, $height, $age, $gender ,$_SESSION['username']);
    $stmt->execute();

    if ($height > 0) {
        // Calculate BMI
        $bmi = $weight / (($height/100) * ($height/100));

        // Determine BMI category
        if ($bmi < 18.5) {
            $bmi_category = "น้ำหนักน้อยกว่าปกติ";
        } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
            $bmi_category = "น้ำหนักปกติ";
        } elseif ($bmi >= 25 && $bmi <= 29.9) {
            $bmi_category = "น้ำหนักเกิน";
        } elseif ($bmi >= 30 && $bmi <= 34.9) {
            $bmi_category = "โรคอ้วนระดับ 1";
        } elseif ($bmi >= 35 && $bmi <= 39.9) {
            $bmi_category = "โรคอ้วนระดับ 2";
        } else {
            $bmi_category = "โรคอ้วนระดับ 3 (อันตรายมาก)";
        }

        // Calculate BMR (Mifflin-St Jeor Equation)
        if ($gender == "male") {
            $bmr = (10 * $weight) + (6.25 * ($height/100) * 100) - (5 * $age) + 5;
            $bmr_info = "สำหรับผู้ชาย";
        } else { // female
            $bmr = (10 * $weight) + (6.25 * ($height/100) * 100) - (5 * $age) - 161;
            $bmr_info = "สำหรับผู้หญิง";
        }
    }
}
?>

<div class="container py-5">
    <div class="card shadow-lg p-4 mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4 text-danger"><i class="fas fa-calculator me-2"></i>คำนวณ BMI และ BMR</h2>
            <form method="post" action="bmi.php">
                <div class="mb-3">
                    <label for="weight" class="form-label"><i class="fas fa-weight me-2"></i>น้ำหนัก (kg)</label>
                    <input type="number" step="0.1" class="form-control" id="weight" name="weight" required min="1" />
                </div>
                <div class="mb-3">
                    <label for="height" class="form-label"><i class="fas fa-ruler-vertical me-2"></i>ส่วนสูง (cm)</label>
                    <input type="number" step="0.1" class="form-control" id="height" name="height" required min="1" />
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label"><i class="fas fa-birthday-cake me-2"></i>อายุ</label>
                    <input type="number" class="form-control" id="age" name="age" required min="1" />
                </div>
                <div class="mb-4">
                    <label for="gender" class="form-label"><i class="fas fa-venus-mars me-2"></i>เพศ</label>
                    <select class="form-select" id="gender" name="gender" required>
                        <option value="">-- เลือกเพศ --</option>
                        <option value="male">ชาย</option>
                        <option value="female">หญิง</option>
                    </select>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-warning btn-lg"><i class="fas fa-calculator me-2"></i>คำนวณ</button>
                </div>
            </form>

            <?php if ($bmi !== null && $bmr !== null): ?>
                <div class="mt-4 p-4 bg-light rounded border border-primary shadow-sm">
                    <h4 class="text-primary mb-3"><i class="fas fa-chart-bar me-2"></i>ผลลัพธ์การคำนวณ:</h4>
                    <p class="fs-5 mb-2"><strong>BMI:</strong> <span class="text-success"><?= number_format($bmi, 2) ?></span></p>
                    <p class="fs-5 mb-2"><strong>หมวดหมู่ BMI:</strong> <span class="text-info"><?= $bmi_category ?></span></p>
                    <p class="fs-5 mb-0"><strong>BMR:</strong> <span class="text-danger"><?= number_format($bmr, 2) ?></span> kcal/วัน <small class="text-muted">(<?= $bmr_info ?>)</small></p>
                    <hr>
                    <small class="text-muted">
                        * BMI (Body Mass Index) คือดัชนีมวลกาย<br>
                        * BMR (Basal Metabolic Rate) คืออัตราการเผาผลาญพลังงานพื้นฐานของร่างกาย
                    </small>
                </div>
            <?php endif; ?>
            <div class="text-center mt-4">
                <a href="index.php" class="btn btn-secondary btn-lg"><i class="fas fa-arrow-left me-2"></i>กลับหน้าแรก</a>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
<?php
$page_title = "แนะนำอาหาร";
include 'header.php';
include 'db.php';

// Fetch user info for BMI calculation
$username = $_SESSION['username'];
$sql = "SELECT age, gender, weight, height FROM users WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// For demo, if weight or height missing, ask user to calculate BMI first
$weight = isset($user['weight']) ? floatval($user['weight']) : null;
$height = isset($user['height']) ? floatval($user['height']) : null;
$age = isset($user['age']) ? intval($user['age']) : null;
$gender = isset($user['gender']) ? $user['gender'] : null;

$bmi = null;
$bmi_category = null;

if ($weight && $height) {
    $height_m = $height / 100;
    $bmi = $weight / ($height_m * $height_m);

    if ($bmi < 18.5) {
        $bmi_category = "underweight";
    } elseif ($bmi < 25) {
        $bmi_category = "normal";
    } elseif ($bmi < 30) {
        $bmi_category = "overweight";
    } else {
        $bmi_category = "obese";
    }
}

// Exercise modes for selection
$exercise_modes = [
    "none" => "ไม่ระบุ",
    "cardio" => "Cardio",
    "yoga" => "Yoga",
    "bodybuilding" => "Bodybuilding"
];

// Handle form submission
$selected_mode = "none";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_mode = $_POST['exercise_mode'] ?? "none";
}

// Food recommendations data
$recommendations = [
    "underweight" => [
        "general" => [
            "เพิ่มปริมาณแคลอรี่ด้วยอาหารที่มีพลังงานสูง เช่น ถั่ว, อะโวคาโด, น้ำมันมะกอก",
            "เน้นโปรตีนคุณภาพสูง เช่น ไก่, ปลา, ไข่, นม",
            "ทานอาหารบ่อยขึ้น วันละ 5-6 มื้อเล็กๆ"
        ],
        "cardio" => [
            "เพิ่มคาร์โบไฮเดรตเชิงซ้อน เช่น ข้าวกล้อง, มันฝรั่ง, ขนมปังโฮลวีต",
            "ดื่มน้ำผลไม้สดเพื่อเพิ่มพลังงาน"
        ],
        "yoga" => [
            "เน้นอาหารที่ย่อยง่าย เช่น ผักต้ม, ซุป, ผลไม้สด",
            "เพิ่มโปรตีนจากพืช เช่น เต้าหู้, ถั่วต่างๆ"
        ],
        "bodybuilding" => [
            "เพิ่มโปรตีนและคาร์โบไฮเดรตหลังออกกำลังกาย เช่น ไก่ย่างกับข้าวกล้อง",
            "ทานอาหารเสริมโปรตีนถ้าจำเป็น"
        ]
    ],
    "normal" => [
        "general" => [
            "ทานอาหารให้ครบ 5 หมู่ในสัดส่วนที่เหมาะสม",
            "เน้นผักและผลไม้สด",
            "ดื่มน้ำให้เพียงพอ"
        ],
        "cardio" => [
            "ทานคาร์โบไฮเดรตเชิงซ้อนเพื่อพลังงาน เช่น ข้าวโอ๊ต, ธัญพืช",
            "เพิ่มอาหารที่มีโพแทสเซียม เช่น กล้วย, มันฝรั่ง"
        ],
        "yoga" => [
            "เน้นอาหารที่ช่วยลดการอักเสบ เช่น ขิง, ขมิ้น, ผักใบเขียว",
            "ดื่มน้ำสมุนไพร เช่น ชาเขียว"
        ],
        "bodybuilding" => [
            "ทานโปรตีนคุณภาพสูงและคาร์โบไฮเดรตหลังออกกำลังกาย",
            "เพิ่มอาหารที่มีแมกนีเซียม เช่น ถั่ว, เมล็ดฟักทอง"
        ]
    ],
    "overweight" => [
        "general" => [
            "ลดอาหารที่มีน้ำตาลและไขมันทรานส์",
            "เพิ่มผักและไฟเบอร์ในมื้ออาหาร",
            "ควบคุมปริมาณแคลอรี่"
        ],
        "cardio" => [
            "เน้นอาหารที่มีแคลอรี่ต่ำแต่ให้พลังงาน เช่น ผักสด, ผลไม้",
            "หลีกเลี่ยงอาหารทอดและน้ำอัดลม"
        ],
        "yoga" => [
            "ทานอาหารที่ช่วยลดน้ำหนัก เช่น ถั่ว, ธัญพืชเต็มเมล็ด",
            "ดื่มน้ำมากๆ เพื่อช่วยระบบเผาผลาญ"
        ],
        "bodybuilding" => [
            "ควบคุมปริมาณโปรตีนและไขมัน",
            "เลือกโปรตีนไขมันต่ำ เช่น ปลา, ไก่ไม่ติดหนัง"
        ]
    ],
    "obese" => [
        "general" => [
            "ปรึกษานักโภชนาการเพื่อวางแผนอาหาร",
            "ลดอาหารแปรรูปและน้ำตาล",
            "เพิ่มการออกกำลังกายอย่างสม่ำเสมอ"
        ],
        "cardio" => [
            "เน้นอาหารที่มีแคลอรี่ต่ำและไฟเบอร์สูง",
            "หลีกเลี่ยงอาหารที่มีไขมันสูง"
        ],
        "yoga" => [
            "ทานอาหารที่ช่วยลดการอักเสบและน้ำหนัก",
            "ดื่มน้ำสมุนไพรและชาเขียว"
        ],
        "bodybuilding" => [
            "ควบคุมปริมาณอาหารและเน้นโปรตีนไขมันต่ำ",
            "หลีกเลี่ยงอาหารที่มีไขมันอิ่มตัวสูง"
        ]
    ]
];

// Select recommendations based on BMI and mode
$general_recs = $bmi_category && isset($recommendations[$bmi_category]) ? $recommendations[$bmi_category]['general'] : [];
$mode_recs = ($bmi_category && $selected_mode != "none" && isset($recommendations[$bmi_category][$selected_mode])) ? $recommendations[$bmi_category][$selected_mode] : [];

?>

<div class="container py-5">
    <div class="card shadow-lg p-4 mx-auto" style="max-width: 800px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4 text-success"><i class="fas fa-utensils me-2"></i>แนะนำอาหารและโภชนาการ</h2>

            <?php if (!$bmi_category): ?>
                <div class="alert alert-warning text-center">
                    กรุณาคำนวณ <a href="bmi.php" class="alert-link">BMI/BMR</a> ก่อนเพื่อรับคำแนะนำอาหารที่เหมาะสม
                </div>
            <?php else: ?>
                <form method="post" action="food_recommend.php" class="mb-4">
                    <label for="exercise_mode" class="form-label fw-bold">เลือกโหมดการออกกำลังกาย (ถ้ามี):</label>
                    <select class="form-select w-auto" id="exercise_mode" name="exercise_mode" onchange="this.form.submit()">
                        <?php foreach ($exercise_modes as $key => $label): ?>
                            <option value="<?= $key ?>" <?= $selected_mode == $key ? 'selected' : '' ?>><?= $label ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>

                <h4 class="text-primary mb-3">คำแนะนำทั่วไปสำหรับคุณ (BMI: <?= number_format($bmi, 1) ?>)</h4>
                <ul class="list-group mb-4">
                    <?php foreach ($general_recs as $rec): ?>
                        <li class="list-group-item"><?= htmlspecialchars($rec) ?></li>
                    <?php endforeach; ?>
                </ul>

                <?php if ($selected_mode != "none"): ?>
                    <h4 class="text-info mb-3">คำแนะนำสำหรับโหมด <?= htmlspecialchars($exercise_modes[$selected_mode]) ?></h4>
                    <ul class="list-group">
                        <?php foreach ($mode_recs as $rec): ?>
                            <li class="list-group-item"><?= htmlspecialchars($rec) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            <?php endif; ?>

            <div class="text-center mt-4">
                <a href="index.php" class="btn btn-secondary btn-lg"><i class="fas fa-arrow-left me-2"></i>กลับหน้าแรก</a>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
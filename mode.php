<?php
$page_title = "เลือกโหมดออกกำลังกาย";
include 'header.php';
?>

<div class="container py-5">
    <div class="card shadow-lg p-4 mx-auto" style="max-width: 800px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-5 text-warning"><i class="fas fa-running me-2"></i>เลือกโหมดออกกำลังกาย</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4 text-center">
                <div class="col">
                    <div class="card h-100 border-primary">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <i class="fas fa-heartbeat fa-4x text-primary mb-3"></i>
                            <h5 class="card-title text-primary">Cardio</h5>
                            <p class="card-text">การออกกำลังกายเพื่อเสริมสร้างความแข็งแรงของหัวใจและปอด</p>
                            <a href="record_cardio.php" class="btn btn-primary mt-3"><i class="fas fa-plus-circle me-2"></i>บันทึก Cardio</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 border-success">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <i class="fas fa-leaf fa-4x text-success mb-3"></i>
                            <h5 class="card-title text-success">Yoga</h5>
                            <p class="card-text">การฝึกโยคะเพื่อความยืดหยุ่น ความแข็งแรง และความสงบ</p>
                            <a href="record_yoga.php" class="btn btn-success mt-3"><i class="fas fa-plus-circle me-2"></i>บันทึก Yoga</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 border-info">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <i class="fas fa-dumbbell fa-4x text-info mb-3"></i>
                            <h5 class="card-title text-info">Bodybuilding</h5>
                            <p class="card-text">การสร้างกล้ามเนื้อและเพิ่มความแข็งแรงของร่างกาย</p>
                            <a href="record_bodybuilding.php" class="btn btn-info mt-3"><i class="fas fa-plus-circle me-2"></i>บันทึก Bodybuilding</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="index.php" class="btn btn-secondary btn-lg"><i class="fas fa-arrow-left me-2"></i>กลับหน้าแรก</a>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
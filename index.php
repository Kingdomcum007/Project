<?php
$page_title = "หน้าแรก";
include 'header.php';
// No db.php include here as it's not directly used on the index page, but header.php ensures session and login check.
?>

<div class="container text-center py-5">
    <div class="p-5 mb-4 bg-light rounded-3 shadow-sm">
        <div class="container-fluid py-5">
            <h1 class="display-4 fw-bold text-primary mb-4">
                <i class="fas fa-heartbeat me-3"></i>ยินดีต้อนรับสู่ Fitness App
            </h1>
            <p class="col-md-8 fs-4 mx-auto mb-4">
                แพลตฟอร์มที่จะช่วยให้คุณจัดการการออกกำลังกายและสุขภาพได้อย่างมีประสิทธิภาพ
            </p>
            <p class="lead mb-5">
                เริ่มต้นการเดินทางสู่สุขภาพที่ดีขึ้นได้แล้ววันนี้!
            </p>
            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                <a href="mode.php" class="btn btn-primary btn-lg px-4 me-sm-3"><i class="fas fa-running me-2"></i>เลือกโหมดออกกำลังกาย</a>
                <a href="bmi.php" class="btn btn-outline-secondary btn-lg px-4"><i class="fas fa-calculator me-2"></i>คำนวณ BMI/BMR</a>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <div class="card h-100 text-center border-primary">
                <div class="card-body">
                    <i class="fas fa-chart-line fa-3x text-primary mb-3"></i>
                    <h5 class="card-title text-primary">ติดตามความก้าวหน้า</h5>
                    <p class="card-text">บันทึกและดูประวัติการออกกำลังกายของคุณได้อย่างง่ายดาย</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 text-center border-success">
                <div class="card-body">
                    <i class="fas fa-apple-alt fa-3x text-success mb-3"></i>
                    <h5 class="card-title text-success">โภชนาการที่ดี</h5>
                    <p class="card-text">รับคำแนะนำอาหารเพื่อสุขภาพที่เหมาะสมกับคุณ</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 text-center border-info">
                <div class="card-body">
                    <i class="fas fa-user-cog fa-3x text-info mb-3"></i>
                    <h5 class="card-title text-info">โปรไฟล์ส่วนตัว</h5>
                    <p class="card-text">จัดการข้อมูลส่วนตัวและเป้าหมายสุขภาพของคุณ</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
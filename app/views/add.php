<?php require_once '../app/Views/Layouts/header.php'; ?>
<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold text-primary mb-4">
                        <i class="fa fa-plus-circle me-2"></i>Thêm công việc mới
                    </h4>
                    <form action="?url=task/store" method="POST">
                        <div class="mb-3">
                            <label for="ten_cong_viec" class="form-label fw-bold">Tên công việc</label>
                            <input type="text" id="ten_cong_viec" name="ten_cong_viec" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nguoi_thuc_hien_id" class="form-label fw-bold">Phụ trách</label>
                                <select id="nguoi_thuc_hien_id" name="nguoi_thuc_hien_id" class="form-select" required>
                                    <?php foreach ($users as $user): ?>
                                        <option value="<?= $user->id ?>"><?= htmlspecialchars($user->ho_ten) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="han_hoan_thanh" class="form-label fw-bold">Hạn hoàn thành</label>
                                <input type="date" id="han_hoan_thanh" name="han_hoan_thanh" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="mo_ta" class="form-label fw-bold">Mô tả</label>
                            <textarea id="mo_ta" name="mo_ta" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary fw-bold btn-lg">LƯU CÔNG VIỆC</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once '../app/Views/Layouts/footer.php'; ?>
<?php require_once '../app/Views/Layouts/header.php'; ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#"><i class="fa-solid fa-briefcase me-2"></i>WORK MS</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-home me-1"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link active fw-bold" href="#"><i class="fa fa-list-check me-1"></i> Công việc</a></li>
            </ul>
            <div class="navbar-nav align-items-center">
                <a class="nav-link text-white" href="#"><i class="fa-solid fa-circle-user me-1"></i> Chào, <strong>Quản trị viên</strong></a>
                <a class="btn btn-outline-light btn-sm ms-2" href="#">Đăng xuất</a>
            </div>
        </div>
    </div>
</nav>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary text-uppercase m-0">
            <i class="fa-solid fa-list-check me-2"></i>Quản lý công việc
        </h3>
        <a href="?url=task/create" class="btn btn-primary shadow-sm px-4 rounded-pill">
            <i class="fa fa-plus-circle me-2"></i>Thêm việc mới
        </a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col">
            <div class="card border-0 shadow-sm border-start border-primary border-4 rounded-3 p-3">
                <div class="text-muted small fw-bold text-uppercase">Tổng số</div>
                <h3 class="fw-bold m-0 text-primary"><?= $stats['total'] ?></h3>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm border-start border-secondary border-4 rounded-3 p-3">
                <div class="text-muted small fw-bold text-uppercase">Chưa thực hiện</div>
                <h3 class="fw-bold m-0 text-secondary"><?= $stats['chua_thuc_hien'] ?></h3>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm border-start border-success border-4 rounded-3 p-3">
                <div class="text-muted small fw-bold text-uppercase">Hoàn thành</div>
                <h3 class="fw-bold m-0 text-success"><?= $stats['hoan_thanh'] ?></h3>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm border-start border-danger border-4 rounded-3 p-3">
                <div class="text-muted small fw-bold text-uppercase">Quá hạn</div>
                <h3 class="fw-bold m-0 text-danger"><?= $stats['qua_han'] ?></h3>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4 rounded-3">
        <div class="card-body p-3">
            <form action="?url=task/index" method="GET" class="row g-2">
                <input type="hidden" name="url" value="task/index">

                <div class="col-md-5">
                    <input type="text" name="keyword" class="form-control"
                        placeholder="Tìm kiếm công việc..."
                        value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
                </div>

                <div class="col-md-4">
                    <select name="status" class="form-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="Đang thực hiện" <?= ($_GET['status'] ?? '') == 'Đang thực hiện' ? 'selected' : '' ?>>Đang thực hiện</option>
                        <option value="Đã hoàn thành" <?= ($_GET['status'] ?? '') == 'Đã hoàn thành' ? 'selected' : '' ?>>Đã hoàn thành</option>
                        <option value="Quá hạn" <?= ($_GET['status'] ?? '') == 'Quá hạn' ? 'selected' : '' ?>>Quá hạn</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100 fw-bold">
                        <i class="fa fa-filter me-2"></i>LỌC
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center py-3">STT</th>
                        <th class="py-3 text-center">Nội dung</th>
                        <th class="text-center py-3">Người thực hiện</th>
                        <th class="text-center py-3">Hạn hoàn thành</th>
                        <th class="text-center py-3">Trạng thái</th>
                        <th class="text-center py-3">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php foreach ($tasks as $index => $task): ?>
                        <?php
                        // Kiểm tra trạng thái để gán class màu đỏ
                        $textClass = ($task->trang_thai == 'Quá hạn') ? 'text-danger fw-bold' : '';
                        ?>
                        <tr>
                            <td class="text-center"><?= $index + 1 ?></td>

                            <td class="<?= $textClass ?>">
                                <div class="fw-bold"><?= htmlspecialchars($task->ten_cong_viec) ?></div>

                                <?php if (!empty($task->mo_ta)): ?>
                                    <?php
                                    $moTa = $task->mo_ta;
                                    $displayMoTa = mb_strlen($moTa) > 100 ? mb_substr($moTa, 0, 100) . '...' : $moTa;
                                    ?>
                                    <small class="d-block text-muted fst-italic" style="opacity: 0.7;">
                                        <?= htmlspecialchars($displayMoTa) ?>
                                    </small>
                                <?php endif; ?>
                            </td>

                            <td class="text-center">
                                <?php
                                try {
                                    $date = new DateTime($task->han_hoan_thanh);
                                    echo $date->format('d/m/Y');
                                } catch (Exception $e) {
                                    echo 'N/A';
                                }
                                ?>
                            </td>
                            <td><?= htmlspecialchars($task->nguoi_thuc_hien_ten ?? 'Chưa phân công') ?></td>

                            <td class="text-center">
                                <?= (new DateTime($task->han_hoan_thanh))->format('d/m/Y') ?>
                            </td>

                            <td class="text-center text-nowrap">
                                <div><?= renderBadge($task->trang_thai) ?></div>

                                <?php if ($task->trang_thai === 'Quá hạn' && isset($task->so_ngay_qua_han)): ?>
                                    <div class="mt-1">
                                        <small class="text-danger fw-bold">
                                            <i class="fa fa-clock"></i> +<?= (int)$task->so_ngay_qua_han ?> ngày
                                        </small>
                                    </div>
                                <?php endif; ?>
                            </td>

                            <td class="text-center text-nowrap">
                                <a href="view.php?id=<?= $task->id ?>" class="btn btn-sm btn-outline-info p-1 lh-1" title="Xem chi tiết">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a href="edit.php?id=<?= $task->id ?>" class="btn btn-sm btn-outline-primary p-1 lh-1 " title="Chỉnh sửa">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <a href="delete.php?id=<?= $task->id ?>" class="btn btn-sm btn-outline-danger p-1 lh-1"
                                    title="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once '../app/Views/Layouts/footer.php'; ?>
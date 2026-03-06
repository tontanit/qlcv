<?php
// app/Core/Helpers.php

function renderBadge($trang_thai)
{
    $badgeClass = match ($trang_thai) {
        'Đã hoàn thành'  => 'bg-success',
        'Đang thực hiện' => 'bg-primary',
        'Quá hạn'        => 'bg-danger',
        default          => 'bg-secondary'
    };

    return '<span class="badge ' . $badgeClass . '">' . htmlspecialchars($trang_thai) . '</span>';
}

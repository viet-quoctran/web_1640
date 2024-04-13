window.addEventListener('DOMContentLoaded', event => {
    // Sử dụng querySelectorAll để lấy tất cả các bảng mà bạn muốn áp dụng DataTables
    const datatablesSimpleAll = document.querySelectorAll('table[id^="datatablesSimple"]');

    // Áp dụng DataTables cho mỗi bảng tìm được
    datatablesSimpleAll.forEach(datatable => {
        new simpleDatatables.DataTable(datatable);
    });
});

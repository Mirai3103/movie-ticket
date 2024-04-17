<?php
title("Quản lý phim");
require ('app/views/admin/header.php');
?>
<?php

//   public static function getTatCaPhim($query = [])
//     {
//         $queryBuilder = new QueryBuilder();
//         $keyword = getArrayValueSafe($query, 'tu-khoa');
//         $statuses = getArrayValueSafe($query, 'trang-thais');
//         $ngayPhatHanhTu = getArrayValueSafe($query, 'ngay-phat-hanh-tu');
//         $ngayPhatHanhDen = getArrayValueSafe($query, 'ngay-phat-hanh-den');
//         $page = ifNullOrEmptyString(getArrayValueSafe($query, 'trang'), 1);
//         $limit = ifNullOrEmptyString(getArrayValueSafe($query, 'limit'), 10);
//         $offset = ($page - 1) * $limit;
//         $queryBuilder->select(['Phim.*'])
//             ->from('Phim')
//             ->where('1', '=', '1');
//         if (!isNullOrEmptyString($keyword)) {
//             $queryBuilder->and();
//             $queryBuilder->startGroup();
//             $queryBuilder->where('TenPhim', 'LIKE', "%$keyword%");
//             $queryBuilder->orWhere('DaoDien', 'LIKE', "%$keyword%");
//             $queryBuilder->orWhere('NgonNgu', 'LIKE', "%$keyword%");
//             $queryBuilder->endGroup();
//         }
//         if (!isNullOrEmptyArray($statuses)) {
//             $queryBuilder->and();
//             $queryBuilder->where('TrangThai', 'IN', $statuses);
//         }
//         if (!isNullOrEmptyString($ngayPhatHanhTu)) {
//             $queryBuilder->andWhere('NgayPhatHanh', '>=', $ngayPhatHanhTu);
//         }
//         if (!isNullOrEmptyString($ngayPhatHanhDen)) {
//             $queryBuilder->andWhere('NgayPhatHanh', '<=', $ngayPhatHanhDen);
//         }
//         $total = $queryBuilder->count();
//         $queryBuilder->limit($limit, $offset);
//         $phims = $queryBuilder->get();
//         Request::setQueryCount($total);
//         return $phims;
//     }
?>
<script>
const trangthais = <?= json_encode($phimStatuses) ?>;
</script>
<link rel="stylesheet" href="/public/tiendat/movie.css">
<div x-data="dataTable({
    endpoint:'/api/phim',
    initialQuery :{
        'trang': 1,
        'limit': 10,
    }
})" style="flex-grow: 1; flex-shrink: 1; overflow-y: auto ; max-height: 100vh;" class="wrapper p-5">
    <div x-data="{
        onApllyFilter(){
            console.log(query);
            refresh({
                   resetPage: true,
                });
        },
        onClearFilter(){
            query={};
            $nextTick(()=>{
                refresh();
            })
        }

    }" class="movie container-fluid shadow">
        <!-- thanh phan loai phim -->
        <div class="border-bottom mb-4">
            <div>
                <input type="button" class="btn button fw-semibold" value="Tất cả"
                    :class="{'button-nav-active': query['trang-thai']==undefined}"
                    x-on:click="query['trang-thai']=undefined;onApllyFilter()" onclick="optionOfList(this)">
                <?php foreach ($phimStatuses as $status): ?>
                <input type="button" class="btn button fw-semibold" value="<?= $status['Ten'] ?>"
                    :class="{'button-nav-active': query['trang-thai']=='<?= $status['MaTrangThai'] ?>'}"
                    x-on:click="query['trang-thai']='<?= $status['MaTrangThai'] ?>';onApllyFilter()"
                    onclick="optionOfList(this)">
                <?php endforeach; ?>
            </div>
        </div>
        <!-- thanh tim kiem va nut them phim moi -->
        <div class="row justify-content-between px-5">
            <div class="col-6">
                <div class="input-group">
                    <input x-on:keyup.enter="onApllyFilter()" x-model="query['tu-khoa']" type="text" name
                        id="searchMovie" placeholder="Nhập tên phim cần tìm" class="form-control">
                    <button x-on:click="onApllyFilter()" class="btn btn-outline-secondary align-items-center"
                        type="button" id="searchMovie">
                        <i class="fa-solid fa-magnifying-glass" style="display: flex;"></i>
                    </button>
                </div>
            </div>

            <div class="col-6">
                <a href="/admin/phim/them" class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-primary me-md-2" type="button">Thêm phim mới</button>
                </a>
            </div>
        </div>

        <!-- chua bang phim -->
        <div class="row m-3 table-responsive" style="flex: 1;">
            <table class="table table-hover align-middle" style="height: 100%;">
                <thead class="table-light">
                    <tr>
                        <th scope="col">
                            <div class="col-name">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-sort"
                                    width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 9l4 -4l4 4m-4 -4v14" />
                                    <path d="M21 15l-4 4l-4 -4m4 4v-14" />
                                </svg>
                                Mã phim
                            </div>
                        </th>
                        <th scope="col">
                            <div class="col-name">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-sort"
                                    width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 9l4 -4l4 4m-4 -4v14" />
                                    <path d="M21 15l-4 4l-4 -4m4 4v-14" />
                                </svg>
                                Tên phim
                            </div>
                        </th>
                        <th scope="col">Tag</th>
                        <th scope="col">
                            Thời lượng
                        </th>
                        <th scope="col">
                            Định dạng
                        </th>
                        <th scope="col">Trailer</th>

                        <th scope="col">Trạng thái</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <template x-if="isFetching">
                        <td class="tw-border-b tw-border-gray-50" colspan="7">
                            <div class='tw-w-full tw-flex tw-py-32 tw-items-center tw-justify-center'>
                                <span class="tw-loading tw-loading-dots tw-loading-lg"></span>
                            </div>
                        </td>
                    </template>
                    <template x-for="movie in data" :key="movie.MaPhim">
                        <tr>
                            <th scope="row">
                                <span x-text="movie.MaPhim"></span>
                            </th>
                            <td>
                                <div class='tw-flex tw-gap-x-1'>
                                    <a :href="movie.HinhAnh" target="_blank">
                                        <img :src="movie.HinhAnh" alt="poster" class="img-fluid"
                                            style="max-width: 100px;">

                                    </a>
                                    <span style="max-width: 200px;" class='tw-mt-2' x-text="movie.TenPhim"></span>
                                </div>
                            </td>
                            <td>
                                <span x-text="movie.HanCheDoTuoi"> </span>
                            </td>

                            <td>
                                <span x-text="movie.ThoiLuong+' phút'"></span>
                            </td>
                            <td>
                                <span x-text="movie.DinhDang"></span>
                            </td>
                            <td>
                                <span x-text="movie.TrangThai"></span>
                            </td>
                            <td>
                                <a class="tw-text-blue-500 " "href=" movie.Trailer" target="_blank">Xem
                                    Trailer</a>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-light btn-icon rounded-circle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <div class="dropdown-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                </svg>
                                                <span class="px-xl-3 ">Sửa</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-item ">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                                </svg>
                                                <span class="px-xl-3 ">
                                                    Đừng chiếu
                                                </span>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="dropdown-item ">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                                </svg>
                                                <span class="px-xl-3 ">Xóa</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </template>

                </tbody>
            </table>
        </div>
        <!-- het chua bang phim -->

        <!-- thanh phan trang -->
        <div class="d-flex justify-content-end column-gap-3 tw-mb-3">
            <div class="d-flex input-group h-50 w-25">
                <label class="input-group-text border-0 bg-white " for="inputGroupSelect01">Rows per
                    page</label>
                <select x-model="query['limit']" x-on:change="
                $nextTick(()=>{
                    refresh({
                       resetPage: true,
                    });
                })
                " class="form-select rounded" id="inputGroupSelect01">
                    <option value="20">10</option>
                    <option value="30">20</option>
                    <option value="40">30</option>
                    <option value="50">40</option>
                </select>
            </div>

            <div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li x-on:click="
                        if(query['trang']>1){
                            query['trang']--;
                            refresh();
                        }
                        " class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <!-- <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li> -->
                        <template x-for="item in getArrayPages()" :key="item">
                            <li x-on:click="query['trang']=item;refresh()" class="page-item"
                                :class="{'active': query['trang']==item}">
                                <a class="page-link" href="#" x-text="item"></a>
                            </li>
                        </template>
                        <li class="page-item">
                            <a x-on:click="
                                let totalPages = Math.ceil(totalItems/query['limit']);
                                if(query['trang']<totalPages){
                                    query['trang']++;
                                    refresh();
                                }
                                " class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- het thanh phan trang -->
    </div>
</div>



<script>
const allMovie_btn = document.getElementById('all');
const movieShowing_btn = document.getElementById('movieshowing');
const upComingMovie_btn = document.getElementById('upcomingmovie');
const movieShown_btn = document.getElementById('movieshown');
const sortNumDown_icon = document.getElementById('sortNumDown_icon');
const sortNumUp_icon = document.getElementById('sortNumUp_icon');
const sortAlphaDown_icon = document.getElementById('sortAlphaDown_icon');
const sortAlphaUp_icon = document.getElementById('sortAlphaUp_icon');

function optionOfList(button) {
    button.remove
    if (button.id == 'all') {
        allMovie_btn.classList.add('button-nav-active');
        setupButtonInavActive(movieShowing_btn);
        setupButtonInavActive(upComingMovie_btn);
        setupButtonInavActive(movieShown_btn);
    } else if (button.id == 'movieshowing') {
        movieShowing_btn.classList.add('button-nav-active');
        setupButtonInavActive(allMovie_btn);
        setupButtonInavActive(upComingMovie_btn);
        setupButtonInavActive(movieShown_btn);
    } else if (button.id == 'upcomingmovie') {
        upComingMovie_btn.classList.add('button-nav-active');
        setupButtonInavActive(allMovie_btn);
        setupButtonInavActive(movieShowing_btn);
        setupButtonInavActive(movieShown_btn);
    } else {
        movieShown_btn.classList.add('button-nav-active');
        setupButtonInavActive(allMovie_btn);
        setupButtonInavActive(movieShowing_btn);
        setupButtonInavActive(upComingMovie_btn);
    }
}

function setupButtonInavActive(button) {
    button.classList.remove('button-nav-active');
}
</script>
<?php
require ('app/views/admin/footer.php');


?>
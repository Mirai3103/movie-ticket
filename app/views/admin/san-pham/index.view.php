<?php
title("Quản lý sản phẩm");
require('app/views/admin/header.php')
?>

<link rel="stylesheet" href="/public/san-pham/home.css">

<div style="flex-grow: 1; flex-shrink: 1; overflow-y: auto ; max-height: 100vh;" class="wrapper p-5">
            <div class="access container-fluid  shadow">
                <!-- thanh tiềm kiếm và nút lọc dữ liệu  -->
                <div class="row justify-content-between px-5 mt-4">
                    <div class="col-6">
                        <div class="input-group">
                            <input type="text" name id="searchMovie" placeholder="Nhập tên sản phẩm cần tìm"
                                class="form-control">
                            <button class="btn btn-outline-secondary align-items-center" type="button" id="searchMovie">
                                <i class="fa-solid fa-magnifying-glass" style="display: flex;"></i>
                            </button>
                        </div>
                    </div>

                    <!-- filter -->
                    <div class="col-6 d-flex flex-nowrap justify-content-end">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mx-2">
                            <div class="dropdown">
                                <button class="btn border-0 fw-medium" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-filter-filled" width="18" height="18"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M20 3h-16a1 1 0 0 0 -1 1v2.227l.008 .223a3 3 0 0 0 .772 1.795l4.22 4.641v8.114a1 1 0 0 0 1.316 .949l6 -2l.108 -.043a1 1 0 0 0 .576 -.906v-6.586l4.121 -4.12a3 3 0 0 0 .879 -2.123v-2.171a1 1 0 0 0 -1 -1z"
                                            stroke-width="0" fill="currentColor" />
                                    </svg>
                                    Filters
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="d-flex justify-content-between align-items-center px-2 pb-2">
                                            <div>
                                                <label class="fw-semibold" for>Lọc</label>
                                            </div>

                                            <div class="d-flex flex-nowrap">
                                                <button class="btn btn-light mx-2">Xóa
                                                    lọc</button>
                                                <button class="btn btn-primary">Áp
                                                    dụng</button>
                                            </div>
                                        </div>

                                    </li>

                                    <li>
                                        <hr class="dropdown-divider m-0">
                                    </li>

                                    <li>
                                        <form class="d-flex flex-wrap p-2">
                                            <div class="row">
                                                <label class="form-label" for>khoảng thời
                                                    gian</label>
                                            </div>

                                            <div class="row d-flex flex-nowrap">
                                                <div class="col">
                                                    <input class="form-control" type="date" name id>
                                                </div>
                                                <div class="col">
                                                    <input class="form-control" type="date" name id>
                                                </div>
                                            </div>
                                        </form>
                                    </li>

                                    <li>
                                        <hr class="dropdown-divider m-0">
                                    </li>

                                    <li>
                                        <form class="d-flex flex-wrap p-2">
                                            <div class="row">
                                                <label class="form-label" for>Khoảng tiền</label>
                                            </div>

                                            <div class="row d-flex flex-nowrap">
                                                <div class="col">
                                                    <input class="form-control" type="number" name id>
                                                </div>
                                                <div class="col">
                                                    <input class="form-control" type="number" name id>
                                                </div>
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div>
                            <button type="button" class="btn btn-secondary" id="btn-create" data-bs-toggle="modal"
                                data-bs-target="#product-detail-modal" type="button">Thêm mới
                            </button>
                        </div>
                    </div>
                </div>
                <!-- hết thanh tìm kiếm và nút lọc dữ liệu -->

                <!-- bảng dữ liệu hóa đơn -->
                <div class="row m-3 table-responsive" style="flex: 1;">
                    <table class="table table-hover align-middle" style="height: 100%;" id="">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">
                                    <div class="col-name">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-arrows-sort" width="16" height="16"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M3 9l4 -4l4 4m-4 -4v14" />
                                            <path d="M21 15l-4 4l-4 -4m4 4v-14" />
                                        </svg>
                                        Mã sản phẩm
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="col-name">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-arrows-sort" width="16" height="16"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M3 9l4 -4l4 4m-4 -4v14" />
                                            <path d="M21 15l-4 4l-4 -4m4 4v-14" />
                                        </svg>
                                        Tên sản phẩm
                                    </div>
                                </th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Phân loại</th>
                                <th scope="col">
                                    <div class="col-name">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-arrows-sort" width="16" height="16"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M3 9l4 -4l4 4m-4 -4v14" />
                                            <path d="M21 15l-4 4l-4 -4m4 4v-14" />
                                        </svg>
                                        Giá tiền
                                    </div>
                                </th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr onclick="window.location.href=''">
                                <th scope="row" class="col-id table-plus">1</th>
                                <td class="col-name ps-0">
                                    <div class="d-flex align-items-center">
                                        <div class="tb-img-product mr-2 flex-shrink-0">
                                            <img src="./assets/img/pepsi.jpg" alt="Ly nước pepsi" width="40"
                                                height="40">
                                        </div>
                                        <div>
                                            <span class="">Pepsi</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="col-des">Nước ngọt Pepsi</td>
                                <td class="col-type">nước ngọt</td>
                                <td class="col-price">5</td>
                                <td class="col-status">còn hàng</td>
                                <td class="col-crud">
                                    <div class="dropdown position-relative">
                                        <span href="" class="btn menu-crud">
                                            <i class="menu-crud-icon fa-solid fa-ellipsis"></i>
                                            <div class="list-item-crud position-absolute">
                                                <a href="" class="item-crud">
                                                    <i class="fa-regular fa-eye"></i>
                                                    <span>Xem</span>
                                                </a>
                                                <a href="" class="item-crud">
                                                    <i class="fa-solid fa-eye-dropper"></i>
                                                    <span>Sửa</span>
                                                </a>
                                                <a href="" class="item-crud">
                                                    <i class="fa-solid fa-trash"></i>
                                                    <span>Xóa</span>
                                                </a>
                                            </div>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- hết bảng dữ liệu hóa đơn -->

                <!-- thanh phân trang và số dòng hiển thị -->
                <div class="d-flex justify-content-end column-gap-3">
                    <div class="d-flex input-group h-50 w-25">
                        <label class="input-group-text border-0 bg-white " for="inputGroupSelect01">Hiển thị</label>
                        <select class="form-select rounded" id="inputGroupSelect01">
                            <option value="1">5</option>
                            <option value="2">10</option>
                            <option value="3">15</option>
                            <option value="3">20</option>
                        </select>
                        <label class="input-group-text border-0 bg-white " for="inputGroupSelect01">hóa đơn</label>
                    </div>

                    <div>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- hết thanh phân trang và số dòng hiển thị -->
            </div>


            <!-- Product Details Modal -->
            <div class="modal fade bs-example-modal-lg" id="product-detail-modal" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">
                                Thông tin sản phẩm
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                                id="btn-close-product-detail">
                                ×
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="create-product container bg-white">
                                <div class="row d-flex mt-2">
                                    <label for="product-id" class="col-xl-2">
                                        Mã sản phẩm
                                    </label>
                                    <div class="input-group has-validation col-xl-10 p-0">
                                        <input type="text" class="form-control is-invalid" id="product-id"
                                            aria-describedby="product-id-feedback" required>
                                        <div id="product-id-feedback" class="invalid-feedback">
                                            Please choose a username.
                                        </div>
                                    </div>
                                </div>

                                <div class="row d-flex mt-2">
                                    <label for="product-name" class="col-xl-2">
                                        Tên sản phẩm
                                    </label>
                                    <div class="input-group has-validation col-xl-10 p-0">
                                        <input type="text" class="form-control is-invalid" id="product-name"
                                            aria-describedby="product-price-feedback" required>
                                        <div id="product-name-feedback" class="invalid-feedback">
                                            Please choose a username.
                                        </div>
                                    </div>
                                </div>

                                <div class="row d-flex mt-2">
                                    <label for="product-img" class="col-xl-2">Hình ảnh</label>
                                    <div class="has-validation col-xl-10 p-0">
                                        <input type="file" class="form-control" aria-label="file example" required id="product-img">
                                        <div class="invalid-feedback">Example invalid form file feedback</div>
                                    </div>
                                </div>

                                <div class="row d-flex mt-2">
                                    <label for="product-des" class="col-xl-2">
                                        Mô tả
                                    </label>
                                    <div class="input-group has-validation col-xl-10 p-0">
                                        <textarea id="product-des" required class="form-control is-invalid"
                                            aria-describedby="product-des-feedback"></textarea>
                                        <div id="product-des-feedback" class="invalid-feedback">
                                            Please choose a username.
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-flex mt-2">
                                    <label for="combo-product-type" class="col-xl-2">
                                        Phân loại
                                    </label>
                                    <div class="col-xl-10 p-0">
                                        <select class="form-select is-invalid text-danger" id="combo-product-type"
                                            aria-describedby="combo-product-type-feedback" required>
                                            <option selected disabled value="">Choose...</option>
                                            <option>...</option>
                                        </select>
                                        <div id="combo-product-type-feedback" class="invalid-feedback">
                                            Please select a valid state.
                                        </div>
                                    </div>
                                </div>

                                <div class="row d-flex mt-2">
                                    <label for="product-price" class="col-xl-2">
                                        Giá tiền
                                    </label>
                                    <div class="input-group has-validation col-xl-10 p-0">
                                        <input type="text" class="form-control is-invalid" id="product-price"
                                            aria-describedby="product-price-feedback" required>
                                        <div id="product-price-feedback" class="invalid-feedback">
                                            Please choose a username.
                                        </div>
                                    </div>
                                </div>

                                <div class="row d-flex mt-2">
                                    <label for="combo-product-status" class="col-xl-2">
                                        Trạng thái
                                    </label>
                                    <div class="col-xl-10 p-0">
                                        <select class="form-select is-invalid text-danger" id="validationServer04"
                                            aria-describedby="validationServer04Feedback" required>
                                            <option selected disabled value="">Choose...</option>
                                            <option>...</option>
                                        </select>
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            Please select a valid state.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                id="btn-clear-ticket-detail">
                                Cancel
                            </button>
                            <button type="button" class="btn btn-primary" id="btn-save-ticket-detail">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php 
script('/public/san-pham/product.js');
require('app/views/admin/footer.php');
?>
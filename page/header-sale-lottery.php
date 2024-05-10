<header class="main-header" id="header">
    <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
        <!-- Sidebar toggle button -->
        <button id="sidebar-toggler" class="sidebar-toggle">
            <span class="sr-only">Toggle navigation</span>
        </button>

        <span class="page-title"><?php echo "$header_name"; ?></span>

        <div class="navbar-right ">


            <?php
            $count_cart = $conn->query("  
            select count(customer_order_cart_id) as count_cart
            from tbl_customer_order_cart
            where add_by = '$id_users'
            group by add_by ")->fetch(PDO::FETCH_ASSOC);

            if (empty($count_cart['count_cart'])) {
                $cart_item = 0;
            } else {
                $cart_item = $count_cart['count_cart'];
            }
            ?>

            <ul class="nav navbar-nav">

                <!-- Offcanvas -->
                <li class="custom-dropdown">
                    <a class="offcanvas-toggler active custom-dropdown-toggler" id="cart-show" data-offcanvas="cart-buy" href="javascript:">
                        <i class="mdi mdi-cart icon"></i>
                        <span class="badge badge-xs rounded-circle"><?php echo $cart_item; ?></span>
                    </a>
                </li>
                <?php
                $bill_count = $conn->query("  
                select count(customer_order_id) as count_bill_sale 
                from tbl_customer_order  
                where order_by = '$id_users'  
                ")->fetch(PDO::FETCH_ASSOC);

                ?>
                <li class="custom-dropdown">
                    <a class="offcanvas-toggler active custom-dropdown-toggler" id="bill-show" data-offcanvas="sale-list" href="javascript:">
                        <i class="mdi mdi-history icon"></i>
                        <span class="badge badge-xs rounded-circle"><?php echo $bill_count['count_bill_sale']; ?></span>
                    </a>
                </li>

                <!-- User Account -->
                <li class="dropdown user-menu">
                    <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <img src="../images/iconmenu.png" class="user-image rounded-circle" alt="User Image" />
                        <span class="d-none d-lg-inline-block"><?php echo "$full_name"; ?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">


                        <li>
                            <a class="dropdown-link-item" href="user-account-settings.php">
                                <i class="mdi mdi-account-outline"></i>
                                <span class="nav-text">ຂໍ້ມູນຜູ້ໃຊ້</span>
                            </a>
                        </li>



                        <li class="dropdown-footer">
                            <a class="dropdown-link-item" href="logout.php"> <i class="mdi mdi-logout"></i>ອອກລະບົບ</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>


</header>
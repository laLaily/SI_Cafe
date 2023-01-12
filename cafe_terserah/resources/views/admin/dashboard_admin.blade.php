<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard-admin</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="styledashboard.css">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class="las la-accusoft"></span>Menu Admin</h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="" class="active"><span class="las la-igloo"></span>
                        <span>Dashboard</span></a>
                </li>
                <li>
                    <a href=""><span class="las la-users"></span>
                        <span>Data Admin</span></a>
                </li>
                <li>
                    <a href=""><span class="las la-shopping-cart"></span>
                        <span>Data Transaksi</span></a>
                </li>
                <li>
                    <a href=""><span class="las la-plus"></span>
                        <span>Data Reservasi</span></a>
                </li>
                <li>
                    <a href=""><span class="las la-shopping-bag"></span>
                        <span>Data Detail Transaksi</span></a>
                </li>
                <li>
                    <a href=""><span class="las la-hamburger"></span>
                        <span>Data Produk</span></a>
                </li>
                <li>
                    <a href=""><span class="las la-chair"></span>
                        <span>Data Seat</span></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <header>
            <h2>
                <label for="">
                    <span class="las la bars"></span>
                </label>
                Dashboard
            </h2>
            <div class="search-wrapper">
                <span class="las la-search"></span>
                <input type="search" placeholder="Search Here">
            </div>
            <div class="user-wrapper">
                <img src="bestot.JPG" width="40px" height="40px" alt="">
                <div>
                    <h4>bestot</h4>
                    <small>Super Admin</small>
                </div>
            </div>
        </header>
        <main>
            <div class="cards">
                <div class="cards-single">
                    <div>
                        <h1>3</h1>
                            <span>Admin</span>
                    </div>    
                    <div>
                        <span class="las la-users"></span>
                    </div>    
                </div>
                <div class="cards-single">
                    <div>
                        <h1>135</h1>
                            <span>Transaksi</span>
                    </div>
                    <div>
                        <span class="las la-shopping-cart"></span>
                    </div>
                </div>
                <div class="cards-single">
                    <div>
                        <h1>70</h1>
                            <span>Reservasi</span>
                    </div>
                    <div>
                        <span class="las la-plus"></span>
                    </div>
                </div>
                
                <div class="cards-single">
                    <div>
                        <h1>135</h1>
                            <span>Detail Trx</span>
                    </div>
                    <div>
                        <span class="las la-shopping-bag"></span>
                    </div>
                </div>
                <a href="">
                    <div class="cards-single">
                        <div>
                            <h1>20</h1>
                                <span>Produk</span>
                        </div>
                        <div>
                            <span class="las la-hamburger"></span>
                        </div>
                    </div>
                </a>
                
                
                <div class="cards-single">
                    <div>
                        <h1>140</h1>
                            <span>Seat</span>
                    </div>
                    <div>
                        <span class="las la-chair"></span>
                    </div>
                </div>
                
            </div>
        </main>

    </div>
</body>
</html>
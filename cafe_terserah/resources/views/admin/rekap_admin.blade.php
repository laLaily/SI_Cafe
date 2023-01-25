<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ mix('css/styledashboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Document</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }

        .sidebar a,
        .sidebar li {
            list-style-type: none;
            text-decoration: none;
        }

        body {
            background-color: #EED6C4;
        }

        .btn {
            background-color: #483434;
            color: white;
            border: 2px solid #483434;
        }

        .btn:hover {
            background-color: white;
            border: 2px solid #483434;
            color: #483434;
        }
    </style>
    <script>
        $.ajax({
            url: "/admin/dineintrx/recap/process",
            type: "POST",
            data: {
                filter: $('#filter option:selected').val()
            },
            success: function(result) {
                const ctx = $('#chart');
                ctx.css('display', 'block')
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: result.date,
                        datasets: [{
                            label: '# income per ' + $('#filter option:selected').val(),
                            data: result.income,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        layout: {
                            padding: 50,
                        }
                    }
                });
            }
        })

        function filterDate() {
            console.log($('#filter option:selected').val());
            let myChart = Chart.getChart('chart');
            if (myChart != undefined) {
                myChart.destroy();
            }
            $.ajax({
                url: "http://127.0.0.1:8000/admin/dineintrx/recap/process",
                type: "POST",
                data: {
                    filter: $('#filter option:selected').val()
                },
                success: function(result) {
                    const ctx = $('#chart');
                    ctx.css('display', 'block')
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: result.date,
                            datasets: [{
                                label: '# income per ' + $('#filter option:selected').val(),
                                data: result.income,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            layout: {
                                padding: 50,
                            }
                        }
                    });
                }
            });
        }
    </script>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class="las la-accusoft"></span>Menu Admin</h2>
        </div>
        <div class="sidebar-menu">
            <a href="/admin/dashboard"><span class="las la-igloo"></span>
                <span>Dashboard</span></a>

            <a href="/admin/view"><span class="las la-users"></span>
                <span>Data Admin</span></a>

            <a href="/admin/dineintrx/view"><span class="las la-shopping-cart"></span>
                <span>Data Transaksi</span></a>

            <a href="/admin/reservationtrx/view"><span class="las la-plus"></span>
                <span>Data Reservasi</span></a>

            <a href="/admin/product/view"><span class="las la-hamburger"></span>
                <span>Data Produk</span></a>

            <a href="/admin/seat/view"><span class="las la-chair"></span>
                <span>Data Seat</span></a>

            <a href="/admin/dineintrx/recap" class="active"><span class="las la-shopping-bag"></span>
                <span>Data Recap Transaction</span></a>

            <a href="/admin/logout"><span class="las la-sign-out-alt"></span>
                <span>Logout</span></a>
        </div>
    </div>
    <div class="main-content">
        <header>
            <h2>
                <label for="">
                    <span class="las la bars"></span>
                </label>
                Data Rekap
            </h2>
            <h1>CAFE TERSERAH</h1>
            <div class="user-wrapper">
                <img src="bestot.JPG" width="40px" height="40px" alt="">
                <div class="profile-wrapper">
                    <h4>bestot</h4>
                    <small>Super Admin</small>
                </div>
            </div>
        </header>
        <main>
            <div class="m-auto" style="width: 600px;">
                <div class="input-group">
                    <select class="form-select" name="transaction_date" id="filter" aria-label="Example select with button addon">
                        <option value="week">Weekly Income</option>
                        <option value="month">Monthly Income</option>
                        <option value="year">Yearly Income</option>
                    </select>
                    <button class="btn" type="button" onclick="filterDate()">Filter</button>
                </div>
            </div>
            <div class="mx-5" style="width: 860px;">
                <canvas id="chart" style="display: none;"></canvas>
            </div>
        </main>
    </div>

</body>

</html>
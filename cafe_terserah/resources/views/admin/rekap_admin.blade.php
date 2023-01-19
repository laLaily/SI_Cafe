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
    <title>Document</title>
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
    <div class="m-auto" style="width: 600px;">
        <div class="input-group">
            <select class="form-select" name="transaction_date" id="filter" aria-label="Example select with button addon">
                <option value="week">Weekly Income</option>
                <option value="month">Monthly Income</option>
                <option value="year">Yearly Income</option>
            </select>
            <button class="btn btn-primary" type="button" onclick="filterDate()">Filter</button>
        </div>
    </div>
    <div style="width: 1000px; height: 800px;">
        <canvas id="chart" style="display: none;"></canvas>
    </div>
</body>

</html>
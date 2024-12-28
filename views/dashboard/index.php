<?php
$cardHeight = '550px';
?>
<style>
    @media (max-width: 768px) {

        *, div {
            margin: 0 !important;
        }

        .inner-content {
            margin: 0 !important;
            padding: 0 !important;
        }
        #sidebar-wrapper-level2 {
            margin: 0 !important;
            padding: 0 !important;
        }
        .container {
            display: flex;
            justify-content: center; /* Horizontally center */
            align-items: center; /* Vertically center */
            text-align: center; /* Align text (if any) to the center */
            flex-direction: column; /* Keep children stacked vertically */
            height: 100vh; /* Optional: Make div take full viewport height */
        }

    }
</style>
<div class="row gap-3">
    <div class="col-md-5 d-flex flex-column gap-3 m-0" style="height: <?= $cardHeight ?>">

        <div class="d-flex flex-wrap gap-3 m-0" style="width: 100%; height: 70%;">
            <!-- First Card Section -->
            <div class="card flex-grow-1 col-md-6 col-12 shadow d-flex flex-column justify-content-between align-items-stretch"
                 style="height: 100%;">
                <div class="d-flex justify-content-between pt-5 mb-4 style="width: 100%; height: 40%;">
                    <div class="text-center d-flex flex-column justify-content-center align-items-center"
                         style="width: 50%; border-right: 1px solid #F2F2F2;">
                        <h1 class="fw-bold"><?= $empCount['active_emp'] ?></h1>
                        <p>Active Employees</p>
                    </div>
                    <div class="text-center d-flex flex-column justify-content-center align-items-center" style="width: 50%;">
                        <h1 class="fw-bold"><?= $empCount['inactive_emp'] ?></h1>
                        <p>In-Active Employees</p>
                    </div>
                </div>
                <hr>
                <div class="d-flex flex-column  justify-content-center align-items-center text-center"
                     style="width: 100%; height: 50%;">
                    <h1 class="fw-bold" style="font-size: 4rem"><?= $empCount['total_emp'] ?></h1>
                    <div id="totalEmps">
                        <a class="text-dark" href="<?= \yii\helpers\Url::to(['/employee/index']) ?>">
                            <p id="empText">Total Employees</p>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Second Section -->
            <div class="col-md-5 d-flex flex-column gap-2" style="height: 100%;">
                <div class="card shadow flex-grow-1 d-flex justify-content-center align-items-center text-center">
                    <h2 style="font-size: 3rem"><?= $empCount['total_emp'] ?></h2>
                    <div id="totalEmps">
                        <a class="text-dark" href="<?= \yii\helpers\Url::to(['/employee/index']) ?>">
                            <p id="empText">Total Departments</p>
                        </a>
                    </div>
                </div>
                <div class="card shadow flex-grow-1 d-flex justify-content-center align-items-center text-center">
                    <h2 style="font-size: 3rem"><?= $empCount['total_emp'] ?></h2>
                    <div id="totalEmps">
                        <a class="text-dark" href="<?= \yii\helpers\Url::to(['/employee/index']) ?>">
                            <p id="empText">Total Designations</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>



        <div class="card p-3 flex-grow shadow" style="height: 250px;">
            <canvas id="category-chart" style="height: 100%; width:100%"></canvas>
        </div>
    </div>

    <div class="col-md-7 row p-0 flex-grow-1 gap-3" style="height: 100%">
        <div class="col-md-6 card p-3 shadow m-0" style="height: <?= $cardHeight ?>">
            <canvas id="designation-chart" style="height: 100%"></canvas>
        </div>
        <div class="d-flex justify-content-between align-items-center col-md-5 card shadow " >
            <div style="border-bottom: 1px solid #F2F2F2" class="pb-4">
                <canvas id="gender-chart" style="height: 100%; width:93%"></canvas>
            </div>
            <div class="pb-4">
                <canvas id="type-chart" style="height: 100%; width:93%"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row card mt-3 m-1 shadow">
    <div class="card-header search-form w-100">
        <input class="p-3 w-100" type="text" id="department-filter" placeholder="Filter by Department">
    </div>
    <div id="grid-container">
        <?= \yii\grid\GridView::widget([
            'id' => 'department-grid',
            'dataProvider' => $dataProvider,
            'pager' => [
                'options' => ['class' => 'pagination pagination-sm'],
                'activePageCssClass' => 'active',
                'maxButtonCount' => 5,
                'linkOptions' => [
                    'class' => 'page-link', // Custom class for <a> elements
                ],
            ],
            'columns' => [
                [
                    'attribute' => 'name',
                    'label' => 'Department',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return \yii\helpers\Html::a($model['name'], ['/employee/index', 'EmployeeSearch' => ['department' => $model['id']]],['class' => 'text-black']);
                    }
                ],
                [
                    'attribute' => 'count',
                    'label' => 'Total Employees',
                ],
            ],
        ]); ?>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.js"
        integrity="sha256-/tanOfjQ8GhxdN5s0UdF/A/HgJFEqxE9IpCKJr8Nf+o=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"
        integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>



    const EmployeeTypeChart = document.getElementById('type-chart').getContext('2d');
    const empTypeRawData = <?= json_encode($empTypeData) ?>;
    let empTypeData = [];
    empTypeRawData.forEach(item => {
        switch (item.type) {
            case 'Permanent':
                empTypeData[0] = item.count;
                break;
            case 'Contractual':
                empTypeData[1] = item.count;
                break;
            default:
                break;
        }
    })
    new Chart(EmployeeTypeChart, {
        type: 'pie',
        data: {
            labels: ['Permanent', 'Contractual'],
            datasets: [
                {
                    label: 'Type Of Employee',
                    data: empTypeData,
                    backgroundColor: ['#a59eb8', '#8bb8d3'],
                    borderColor: '#4549ff',
                    borderWidth: 0,
                },
            ]
        },
        options: {
            indexAxis: 'x',
            responsive: true,
            plugins: {
                datalabels: {
                    anchor: 'end', // Position at the top of the bar
                    align: 'start', // Align the label above the top
                    offset: 0, // Move label slightly above the top of the bar
                    clip: false, // Ensure label is not clipped (visible outside chart area)
                    color: 'rgb(255,255,255)', // Color of the labels
                    font: {
                        weight: 'bold',
                    },
                    formatter: function (value) {
                        return value; // Display the actual data value
                    }
                },
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            let label = 'Total ';
                            if (label) {
                                label += context.label+': ';
                            }
                            if (context.parsed !== null) {
                                label += context.parsed;
                            }
                            return label;
                        }
                    }
                }
            },
        },
        plugins: [ChartDataLabels] // Add this line to include the plugin
    });






    const categoryChart = document.getElementById('category-chart').getContext('2d');
    const categoryData = <?= json_encode($categoryData) ?>;
    const categoryLabels = categoryData.map(item => {
        return item.category;
    });
    const categoryCount = categoryData.map(item => {
        return item.count;
    });

    new Chart(categoryChart, {
        type: 'bar',
        data: {
            labels: categoryLabels,
            datasets: [
                {
                    label: 'Employees by Social Category',
                    data: categoryCount,
                    backgroundColor: ['#9aa88c', '#8ca8a8', '#9a8ca8', '#aaaaaa', '#697f85', '#7a7290', '#497c9d'],
                    borderColor: '#4549ff',
                    borderWidth: 0,
                },
            ]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                datalabels: {
                    anchor: 'end', // Position at the top of the bar
                    align: 'end', // Align the label above the top
                    offset: 0, // Move label slightly above the top of the bar
                    clip: false, // Ensure label is not clipped (visible outside chart area)
                    color: 'rgba(0,0,0,0.38)', // Color of the labels
                    font: {
                        weight: 'bold',
                    },
                    formatter: function (value) {
                        return value; // Display the actual data value
                    }
                },
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            let label = context.label+' Employees: ';
                            if (context.parsed.y !== null) {
                                label += context.parsed.y;
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    stacked: false,
                    barPercentage: 0.3, // Adjust width of bars
                    categoryPercentage: 0.8 // Adjust width of groups
                },
                x: {
                    stacked: false,
                    beginAtZero: true,
                    max: function () {
                        const maxValue = Math.max(...categoryCount);
                        const roundedMax = Math.ceil((maxValue + 10) / 10) * 10;
                        return roundedMax;
                    }(),
                }
            }
        },
        plugins: [ChartDataLabels] // Add this line to include the plugin
    });


    const designationChart = document.getElementById('designation-chart').getContext('2d');
    const designationData = <?= json_encode($designationData) ?>;
    const designationLabels = designationData.map(item => {
        return item.name;
    });
    const designationCount = designationData.map(item => {
        return item.count;
    });

    new Chart(designationChart, {
        type: 'bar',
        data: {
            labels: designationLabels,
            datasets: [
                {
                    label: 'Employees by Designations',
                    data: designationCount,
                    backgroundColor: ['#9aa88c', '#8ca8a8', '#9a8ca8', '#aaaaaa', '#697f85', '#7a7290', '#497c9d'],
                    borderColor: '#4549ff',
                    borderWidth: 0,
                },
            ]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                datalabels: {
                    anchor: 'end', // Position at the top of the bar
                    align: 'end', // Align the label above the top
                    offset: 0, // Move label slightly above the top of the bar
                    clip: false, // Ensure label is not clipped (visible outside chart area)
                    color: 'rgba(0,0,0,0.38)', // Color of the labels
                    font: {
                        weight: 'bold',
                    },
                    formatter: function (value) {
                        return value; // Display the actual data value
                    }
                },
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            let label = 'Employee On Position';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += context.parsed.y;
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    stacked: false,
                    barPercentage: 0.3, // Adjust width of bars
                    categoryPercentage: 0.8 // Adjust width of groups
                },
                x: {
                    stacked: false,
                    beginAtZero: true,
                    max: function () {
                        const maxValue = Math.max(...designationCount);
                        const roundedMax = Math.ceil((maxValue + 10) / 10) * 10;
                        return roundedMax;
                    }(),
                }
            }
        },
        plugins: [ChartDataLabels] // Add this line to include the plugin
    });


    const genderChart = document.getElementById('gender-chart').getContext('2d');
    const genderRawData = <?= json_encode($genderData) ?>;
    let genderData = [];
    genderRawData.forEach(item => {
        switch (item.gender) {
            case 'Male':
                genderData[0] = item.count;
                break;
            case 'Female':
                genderData[1] = item.count;
                break;
            case 'Other':
                genderData[2] = item.count;
                break;
            default:
                break;
        }
    })
    new Chart(genderChart, {
        type: 'pie',
        data: {
            labels: ['Male', 'Female', 'Other'],
            datasets: [
                {
                    label: 'Gender',
                    data: genderData,
                    backgroundColor: ['#98b6fa', '#fdc4f1', '#8e8e8e'],
                    borderColor: '#4549ff',
                    borderWidth: 0,
                },
            ]
        },
        options: {
            indexAxis: 'x',
            responsive: true,
            plugins: {
                datalabels: {
                    anchor: 'end', // Position at the top of the bar
                    align: 'start', // Align the label above the top
                    offset: 0, // Move label slightly above the top of the bar
                    clip: false, // Ensure label is not clipped (visible outside chart area)
                    color: 'rgb(255,255,255)', // Color of the labels
                    font: {
                        weight: 'bold',
                    },
                    formatter: function (value) {
                        return value; // Display the actual data value
                    }
                },
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            let label = 'Total ';
                            if (label) {
                                label += context.label+': ';
                            }
                            if (context.parsed !== null) {
                                label += context.parsed;
                            }
                            return label;
                        }
                    }
                }
            },
        },
        plugins: [ChartDataLabels] // Add this line to include the plugin
    });


    document.addEventListener('DOMContentLoaded', function () {
        const fullData = <?= json_encode($fullDataProvider->getModels()) ?>;
        const gridContainer = document.getElementById('grid-container');

        // keeping original data of gridview to revert back if search filter is empty
        let originalHtml = gridContainer.innerHTML;

        function filterGridView() {
            const filterValue = document.getElementById('department-filter').value.toLowerCase();

            // putting paginated gridview data back into the table
            if (filterValue === '') {
                gridContainer.innerHTML = originalHtml;
                return;
            }

            // preparing filtered data
            const filteredData = fullData.filter(item => {
                const designation = item['name']; // Ensure this matches the correct key in your data
                return typeof designation === 'string' && designation.toLowerCase().includes(filterValue);
            });

            // putting filtered data into the table
            const filteredHtml = generateGridViewHtml(filteredData);
            gridContainer.innerHTML = filteredHtml;
        }

        function generateGridViewHtml(data) {
            let html = '<table class="table table-striped"><thead><tr>';
            html += '<th>Name</th><th>Total</th></tr></thead><tbody>';
            data.forEach(item => {
                html += '<tr>';
                html += `<td>${item['name']}</td>`;
                html += `<td>${item['count']}</td>`;
                html += '</tr>';
            });
            html += '</tbody></table>';
            return html;
        }

        document.getElementById('department-filter').addEventListener('input', filterGridView);


        $('#totalEmps').mouseover(function () {
            $('#empText').fadeOut(150, function () {
                $(this).text('Click To View All Employee').fadeIn(150);
            });
        });

        $('#totalEmps').mouseout(function () {
            $('#empText').fadeOut(150, function () {
                $(this).text('Total Employee').fadeIn(150);
            });
        });


    });


</script>


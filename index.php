<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welding</title>

    <link rel="stylesheet" href="styles.css">

    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <script src="chart.js"></script>
</head>

<body>

    <table>
        <tr>
            <td class="tdmenu" colspan="2"> MENU<!-- <button id="btndd1">dingdong</button> <button id="btnng1">ng</button> --> </td>
        </tr>
        <tr>
            <td class="tdtitle" colspan="2">
                <table>
                    <tr>
                        <td style="width: 70%;">Ov1k Welding Monitor</td>
                        <td style="width: 30%;"><img src="logo.jpg" class="logo"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="tdleft">
                <table>
                    <tr>
                        <td rowspan="3" class="tdimg"><img src='/img/LH.png'></td>
                        <td class="tdamp">
                            <canvas id="lineChart1"></canvas>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdvolt">
                            <canvas id="lineChart2"></canvas>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdflow">
                            <canvas id="lineChart3"></canvas>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="tddata">
                            <table id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Jig</th>
                                        <th>Point</th>
                                        <th>Amp Min</th>
                                        <th>Amp Value</th>
                                        <th>Amp Max</th>
                                        <th>Volt Min</th>
                                        <th>Volt Value</th>
                                        <th>Volt Max</th>
                                        <th>Flow Min</th>
                                        <th>Flow Value</th>
                                        <th>Flow Max</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody id="dataBody">
                                    <!-- 데이터가 여기에 추가됩니다 -->
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
            <td class="tdright">
                <table>
                    <tr>
                        <td class="tdplc">
                            <table id="plcTable">
                                <tr>
                                    <td class="status" data-index="1">용접1</td>
                                    <td class="status" data-index="2">용접2</td>
                                    <td class="status" data-index="3">용접3</td>
                                    <td class="status" data-index="4">용접4</td>
                                    <td class="status" data-index="5">용접5</td>
                                </tr>
                                <tr>
                                    <td class="status" data-index="6">용접6</td>
                                    <td class="status" data-index="7">용접7</td>
                                    <td class="status" data-index="8">용접8</td>
                                    <td class="status" data-index="9">용접9</td>
                                    <td class="status" data-index="10">용접10</td>
                                </tr>
                                <tr>
                                    <td class="status" data-index="11">용접11</td>
                                    <td class="status" data-index="12">용접12</td>
                                    <td class="status" data-index="13">용접13</td>
                                    <td class="status" data-index="14">용접14</td>
                                    <td class="status" data-index="15">용접15</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdcount">
                            <table id="countTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>PartName</th>
                                    <th>Count</th>
                                </tr>
                                </thead>
                                <tbody id="countBody">
                                    <!-- 데이터가 여기에 추가됩니다 -->
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdcontrol">
                            <table>
                                <tr>
                                    <td><button>버튼</button></td>
                                    <td><button>버튼</button></td>
                                    <td><button>버튼</button></td>
                                </tr>
                                <tr>
                                    <td><button>버튼</button></td>
                                    <td><button>버튼</button></td>
                                    <td><button>버튼</button></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="tdinfo" colspan="2">INFO</td>
        </tr>
    </table>
    <script src="/plugins/jquery.min.js"></script>
    <script>
        let chart1, chart2, chart3;
        let data88, data99;

        // 차트 생성 함수
        function createChart(canvasId) {
            const ctx = document.getElementById(canvasId).getContext('2d');
            return new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [
                        '01', '02', '03', '04', '05',
                        '06', '07', '08', '09', '10',
                        '11', '12', '13', '14', '15',
                        '16', '17', '18', '19', '20',
                        '21', '22', '23', '24', '25',
                        '26', '27', '28', '29', '20'
                    ],
                    datasets: [{
                        label: `Data for ${canvasId}`,
                        data: [
                            0, 0, 0, 0, 0,
                            0, 0, 0, 0, 0,
                            0, 0, 0, 0, 0,
                            0, 0, 0, 0, 0,
                            0, 0, 0, 0, 0,
                            0, 0, 0, 0, 0
                        ],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                        }
                    },
                    scales: {
                        x: {
                            display: true
                        },
                        y: {
                            display: true,
                            beginAtZero: false,
                            min: 0,
                            max: 65535
                        }
                    }
                }
            });
        }

        // 차트를 업데이트하는 함수
        function updateChart(chart, newData) {
            chart.data.datasets[0].data.shift(); // 가장 오래된 데이터 제거
            chart.data.datasets[0].data.push(newData); // 새로운 데이터 추가
            chart.update(); // 차트 갱신
        }

        // 1초마다 데이터를 가져와 차트를 업데이트
        function fetchAndUpdateCharts() {
            fetch('jsonprocess.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('네트워크 응답에 문제가 있습니다.');
                    }
                    return response.json(); // JSON 형식으로 변환
                })
                .then(data => {
                    updateChart(chart1, data.data10); // 차트 1 업데이트
                    updateChart(chart2, data.data11); // 차트 2 업데이트
                    updateChart(chart3, data.data12); // 차트 3 업데이트

                    // data88 = data.data8;
                    // data99 = data.data9;

                    // if (data88 == 1) {
                    //     const dd1 = document.getElementById('dd1');
                    //     dd1.play();
                    // }

                    // if (data99 == 1) {
                    //     const ng1 = document.getElementById('ng1');
                    //     ng1.play();
                    // }

                })
                .catch(error => {
                    console.error('Fetch 오류:', error);
                });
        }

        function get_data() {
            $.ajax({
                url: '/get/get_data.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {

                    // 테이블 바디 초기화
                    $('#dataBody').empty();

                    // 데이터를 5줄로 표시
                    data.forEach((row, index) => {
                        $('#dataBody').append(`
                    <tr>
                        <td>${row.id}</td> <!-- Jig (여기서는 임의로 설정) -->
                        <td>${row.lot}</td> <!-- Point (여기서는 임의로 설정) -->
                        <td>${row.data22}</td>   <!-- Amp Min -->
                        <td>${row.data23}</td> // Amp Value
                        <td>${row.data24}</td> // Amp Max
                        <td>${row.data26}</td> // Volt Min
                        <td>${row.data27}</td> // Volt Value
                        <td>${row.data28}</td> // Volt Max
                        <td>${row.data30}</td> // Flow Min
                        <td>${row.data31}</td> // Flow Value
                        <td>${row.data32}</td> // Flow Max
                        <td>${row.time}</td> // 현재 시간
                    </tr>
                `);
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('오류:', textStatus, errorThrown);
                }
            });
        }

        function get_plc_control() {
            $.ajax({
                url: '/get/get_plc_control.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // data33 값을 가져온다
                    const data33Value = data[0]; // data33 값은 배열의 첫 번째 요소

                    // 모든 td의 색상을 초기화
                    $('.status').css('background-color', 'pink');

                    // 해당 숫자에 맞는 td에 색상을 추가
                    if (data33Value >= 1 && data33Value <= 15) {
                        $(`.status[data-index='${data33Value}']`).css('background-color', 'lightgreen'); // 색상 변경
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('오류:', textStatus, errorThrown);
                }
            });
        }

        function get_count() {
            $.ajax({
                url: '/get/get_count.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {

                    // 테이블 바디 초기화
                    $('#countBody').empty();

                    // 데이터를 5줄로 표시
                    data.forEach((row, index) => {
                        $('#countBody').append(`
                    <tr>
                        <td>${row.id}</td> <!-- Jig (여기서는 임의로 설정) -->
                        <td>${row.lot}</td> <!-- Point (여기서는 임의로 설정) -->
                        <td>${row.count}</td> // 현재 시간
                    </tr>
                `);
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('오류:', textStatus, errorThrown);
                }
            });
        }

function update(){
    get_data();
    get_plc_control();
    get_count();
}

        document.addEventListener('DOMContentLoaded', function() {
            // 차트 초기화
            chart1 = createChart('lineChart1');
            chart2 = createChart('lineChart2');
            chart3 = createChart('lineChart3');

            setInterval(update,1000);

            // 0.2초마다 fetchAndUpdateCharts 호출
            setInterval(fetchAndUpdateCharts, 200);
        });
    </script>

    <audio id="dd1">
        <source src="DINGDONG.wav" type="audio/wav">
    </audio>

    <audio id="ng1">
        <source src="NG.wav" type="audio/wav">
    </audio>

    <script>
        // 버튼 클릭 이벤트 핸들러
        document.getElementById('btndd1').addEventListener('click', function() {
            const dd1 = document.getElementById('dd1');
            dd1.play();
        });

        document.getElementById('btnng1').addEventListener('click', function() {
            const ng1 = document.getElementById('ng1');
            ng1.play();
        });
    </script>


</body>

</html>
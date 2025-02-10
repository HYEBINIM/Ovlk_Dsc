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
                            max: 5000
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
                    updateChart(chart1, data.data0); // 차트 1 업데이트
                    updateChart(chart2, data.data1); // 차트 2 업데이트
                    updateChart(chart3, data.data2); // 차트 3 업데이트

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

        function get_data1() {
            $.ajax({
                url: '/get/get_data1.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    // console.log('get_data1 응답:', data); // 추가된 로그
                    $('#dataBody1').empty(); // dataBody1로 수정

                    data.forEach((row) => {
                        $('#dataBody1').append(`
                    <tr>
                        <td>${row.data1}</td>
                        <td>${row.data2}</td>
                        <td>${row.data3}</td>
                        <td>${row.data4}</td>
                        <td>${row.data5}</td>
                    </tr>
                `);
                    });
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('오류:', textStatus, errorThrown);
                }
            });
        }

        function get_data2() {
            $.ajax({
                url: '/get/get_data2.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    // console.log('get_data2 응답:', data); // 추가된 로그
                    $('#dataBody2').empty(); // dataBody2로 수정

                    data.forEach((row) => {
                        $('#dataBody2').append(`
                    <tr>
                        <td>${row.data1}</td>
                        <td>${row.data2}</td>
                        <td>${row.data3}</td>
                        <td>${row.data4}</td>
                        <td>${row.data5}</td>
                    </tr>
                `);
                    });
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('오류:', textStatus, errorThrown);
                }
            });
        }


        function get_plc_control() {
            $.ajax({
                url: '/get/get_plc_control.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    // 모든 status div의 색상을 초기화
                    $('.status').css('background-color', 'gray');
        
                    // 첫 번째 데이터 객체를 사용하여 색상 변경
                    if (data.length > 0) {
                        const plcData = data[0]; // 첫 번째 객체를 사용
        
                        // 각 데이터 값에 따라 색상 변경
                        for (let i = 1; i <= 20; i++) {
                            if (plcData[`data${i}`] == "1") {
                                $(`.status[data-index='${i}']`).css('background-color', 'lightgreen'); // 색상 변경
                            }
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('오류:', textStatus, errorThrown);
                }
            });
        }
        
        

        function get_count() {
            $.ajax({
                url: '/get/get_count.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {

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
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('오류:', textStatus, errorThrown);
                }
            });
        }

        document.getElementById('dataTable1').style.display = 'table'; // dataTable1 보이기
        document.getElementById('dataTable2').style.display = 'none';  // dataTable2 숨기기

        function get_state() {
            $.ajax({
                url: '/get/get_state.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data.length > 0) {
                        const stateValue = data[0].data9; // data9 값을 가져옴
        
                        // 테이블 표시 로직
                        if (stateValue == 1) {
                            document.getElementById('dataTable1').style.display = 'table'; // dataTable1 보이기
                            document.getElementById('dataTable2').style.display = 'none';  // dataTable2 숨기기
                        } else if (stateValue == 2) {
                            document.getElementById('dataTable1').style.display = 'none';  // dataTable1 숨기기
                            document.getElementById('dataTable2').style.display = 'table'; // dataTable2 보이기
                        } else if (stateValue == 0) {
                            // 이전 상태를 유지하도록 설정, 변화를 주지 않음
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('오류:', textStatus, errorThrown);
                }
            });
        }

        function update() {
            get_data1();
            get_data2();
            get_plc_control();
            get_count();
            get_state()
        }

        document.addEventListener('DOMContentLoaded', function () {
            // 차트 초기화
            chart1 = createChart('lineChart1');
            chart2 = createChart('lineChart2');
            chart3 = createChart('lineChart3');

            setInterval(update, 1000);

            // 0.2초마다 fetchAndUpdateCharts 호출
            setInterval(fetchAndUpdateCharts, 200);
        });

        // 버튼 클릭 이벤트 핸들러
        document.getElementById('btndd1').addEventListener('click', function () {
            const dd1 = document.getElementById('dd1');
            dd1.play();
        });

        document.getElementById('btnng1').addEventListener('click', function () {
            const ng1 = document.getElementById('ng1');
            ng1.play();
        });

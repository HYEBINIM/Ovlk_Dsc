<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DSC OV1k Monitoring System</title>
    <link rel="stylesheet" href="index.css">
    <script src="chart.js"></script>
</head>

<body>

    <div class="wrapper">
        <div class="top">
            <div class="logo"><img src="logo.jpg"></div>
            <div class="title">Ov1k Welding Monitor</div>
        </div>
        <div class="content">
            <div class="content_top">
                <div class="img">
                    <img src="/img/1.jpg" alt="">
                </div>
                <div class="graph">
                    <div class=" graph_item graph1"><canvas id="Voltage"></canvas></div>
                    <div class=" graph_item graph2"><canvas id="Current"></canvas></div>
                    <div class=" graph_item graph3"><canvas id="Flow"></canvas></div>
                </div>
                <div class="plc">
                    <div class="plc_item">
                        <div class="row">
                            <div class="status" data-index="1">실린더1</div>
                            <div class="status" data-index="2">실린더2</div>
                            <div class="status" data-index="3">실린더3</div>
                            <div class="status" data-index="4">실린더4</div>
                            <div class="status" data-index="5">실린더5</div>
                        </div>
                        <div class="row">
                            <div class="status" data-index="6">실린더6</div>
                            <div class="status" data-index="7">실린더7</div>
                            <div class="status" data-index="8">실린더8</div>
                            <div class="status" data-index="9">실린더9</div>
                            <div class="status" data-index="10">문1</div>
                        </div>
                        <div class="row">
                            <div class="status" data-index="11">실린더11</div>
                            <div class="status" data-index="12">실린더12</div>
                            <div class="status" data-index="13">실린더13</div>
                            <div class="status" data-index="14">실린더14</div>
                            <div class="status" data-index="15">실린더15</div>
                        </div>
                        <div class="row">
                            <div class="status" data-index="16">실린더16</div>
                            <div class="status" data-index="17">실린더17</div>
                            <div class="status" data-index="18">실린더18</div>
                            <div class="status" data-index="19">실린더19</div>
                            <div class="status" data-index="20">문2</div>
                        </div>
                    </div>
                    <div class="okng">OK</div>
                </div>
            </div>
            <div class="content_bottom">
                <table class="bottom_table" id="dataTable1">
                    <tbody id="dataBody1">
                        <!-- 데이터가 여기에 추가됩니다 -->
                    </tbody>
                </table>
                <table class="bottom_table" id="dataTable2">
                    <tbody id="dataBody2">
                        <!-- 데이터가 여기에 추가됩니다 -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <audio id="dd1">
        <source src="DINGDONG.wav" type="audio/wav">
    </audio>
    <audio id="ng1">
        <source src="NG.wav" type="audio/wav">
    </audio>
    <script src="/plugins/jquery.min.js"></script>
    <script src="/index.js"></script>
</body>

</html>
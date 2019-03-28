<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Report Statistics</title>

        <!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

		<!-- Jquery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- Bootstrap JS -->
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<style>
            body {
                font-size: 16px;
            }
            .table {
                font-size: 14px;
            }
            .title {
                font-size: 18px;
                margin-bottom: 20px;
            }
            .title p {
                margin-bottom: 0;
            }
			.table td, .table th, .table thead th {
				vertical-align: middle;
			}
            .table-responsive {
                width: 1691px;
            }
            .table tbody tr th:nth-child(2), .table tbody tr td:nth-child(2) {
                text-align: left;
            }
            .table tbody tr th:nth-child(1), .table tbody tr td:nth-child(1) {
                text-align: center;
            }
            .table th.parent {
                text-transform: uppercase;
            }
		</style>
    </head>
    <body>
        <main>
        	<div class="container-fluid">
        		<div class="table-responsive m-auto">
                    <div class="clearfix">
                        <div class="float-right font-italic text-center clearfix">
                            <p>
                                <strong>Biểu số 03</strong><br>
                                (Số liệu tính đến ngày 31/12/2018)
                            </p>
                        </div>
                    </div>
                    <div class="text-center title">
                        <p class="text-uppercase font-weight-bold">Tổng hợp các khoản thu các quỹ tài chính ngoài ngân sách do địa phương quản lý giai đoạn 2011-2020</p>
                        <p class="font-italic">(Kèm theo công văn số         /UBND-TH ngày    /03/2019 của UBND tỉnh Thừa Thiên Huế)</p>
                    </div>
                    <div class="float-right font-italic">
                        Đơn vị tính: Triệu đồng
                    </div>
        			<table class="table table-sm table-hover table-bordered text-right">
        				<thead class="text-center">
        					<tr>
        						<th scope="col" rowspan="2" style="width: 40px;">TT</th>
        						<th scope="col" rowspan="2" style="width: 250px;">Nguồn thu của Quỹ</th>
        						<th scope="col" rowspan="2" style="width: 120px;">Chi tiết (tỷ lệ % hoặc mức đóng góp, đối tượng nộp và nội dung nguồn thu của Quỹ)</th>
        						<th scope="col" colspan="2" style="width: 140px;">Năm 2011</th>
        						<th scope="col" colspan="2" style="width: 140px;">Năm 2012</th>
        						<th scope="col" colspan="2" style="width: 140px;">Năm 2013</th>
        						<th scope="col" colspan="2" style="width: 140px;">Năm 2014</th>
        						<th scope="col" colspan="2" style="width: 140px;">Năm 2015</th>
        						<th scope="col" colspan="2" style="width: 140px;">Năm 2016</th>
        						<th scope="col" colspan="2" style="width: 140px;">Năm 2017</th>
        						<th scope="col" colspan="2" style="width: 140px;">Năm 2018</th>
        						<th scope="col" rowspan="2" style="width: 80px;">Kế hoạch 2019</th>
        						<th scope="col" rowspan="2" style="width: 80px;">Kế hoạch 2020</th>
        					</tr>
        					<tr>
        						<th style="width: 70px;">KH</th>
        						<th style="width: 70px;">TH</th>
        						<th style="width: 70px;">KH</th>
        						<th style="width: 70px;">TH</th>
        						<th style="width: 70px;">KH</th>
        						<th style="width: 70px;">TH</th>
        						<th style="width: 70px;">KH</th>
        						<th style="width: 70px;">TH</th>
        						<th style="width: 70px;">KH</th>
        						<th style="width: 70px;">TH</th>
        						<th style="width: 70px;">KH</th>
        						<th style="width: 70px;">TH</th>
        						<th style="width: 70px;">KH</th>
        						<th style="width: 70px;">TH</th>
        						<th style="width: 70px;">KH</th>
        						<th style="width: 70px;">TH</th>
        					</tr>
        					<tr>
        						<th>A</th>
                                <th>B</th>
                                <td>1</td>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                                <td>6</td>
                                <td>7</td>
                                <td>8</td>
                                <td>9</td>
                                <td>10</td>
                                <td>11</td>
                                <td>12</td>
                                <td>13</td>
                                <td>14</td>
                                <td>15</td>
                                <td>16</td>
                                <td>17</td>
                                <td>18</td>
                                <td>19</td>
        					</tr>
        				</thead>
        				<tbody>
                            {{-- department I --}}
        					<tr>
        						<th scope="row">I</th>
        						<th class="parent">Qũy đầu tư phát triển và bảo lãnh tín dụng cho DNNVV</th>
        						<th></th>
        						<th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>9.559</th>
                                <th>16.760</th>
                                <th>27.688</th>
                                <th>18.255</th>
                                <th>26.555</th>
                                <th>25.071</th>
                                <th>32.394</th>
                                <th></th>
                                <th></th>
        					</tr>
                            <tr>
                                <td scope="row">1</td>
                                <td>Cho vay</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>8.800</td>
                                <td></td>
                                <td>3.577</td>
                                <td></td>
                                <td>12.747</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td scope="row">2</td>
                                <td>Doanh thu</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>5.284</td>
                                <td>9.915</td>
                                <td>10.687</td>
                                <td>10.726</td>
                                <td>12.948</td>
                                <td>14.375</td>
                                <td>6.623</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td scope="3">3</td>
                                <td>Chênh lệch thu chi trước thuế</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>4.275</td>
                                <td>6.845</td>
                                <td>8.201</td>
                                <td>7.529</td>
                                <td>10.030</td>
                                <td>10.696</td>
                                <td>13.024</td>
                                <td></td>
                                <td></td>
                            </tr>
                            {{-- department I.1  --}}
                            <tr>
                                <th scope="row">I.1</th>
                                <th>Quỹ Đầu tư phát triển (tách ra từ I)</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>51.504</th>
                                <th>63.500</th>
                            </tr>
                            <tr>
                                <td scope="row">1</td>
                                <td>Cho vay</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>30.000</td>
                                <td>40.000</td>
                            </tr>
                            <tr>
                                <td scope="row">2</td>
                                <td>Doanh thu</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>12.834</td>
                                <td>14.000</td>
                            </tr>
                            <tr>
                                <td scope="3">3</td>
                                <td>Chênh lệch thu chi trước thuế</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>8.670</td>
                                <td>9.500</td>
                            </tr>
                            {{-- department I.2  --}}
                            <tr>
                                <th scope="row">I.2</th>
                                <th>Quỹ BLTD cho DNNVV (tách ra từ I)</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>11.132</th>
                                <th>12.100</th>
                            </tr>
                            <tr>
                                <td scope="row">1</td>
                                <td>Cho vay</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>1.000</td>
                                <td>1.500</td>
                            </tr>
                            <tr>
                                <td scope="row">2</td>
                                <td>Doanh thu</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>5.141</td>
                                <td>5.500</td>
                            </tr>
                            <tr>
                                <td scope="3">3</td>
                                <td>Chênh lệch thu chi trước thuế</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>4.991</td>
                                <td>9.100</td>
                            </tr>
                            {{-- department II --}}
                            <tr>
                                <th scope="row">II</th>
                                <th class="parent">Quỹ bảo vệ và phát triển rừng</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>43.499</th>
                                <th>10.700</th>
                                <th>17.881</th>
                                <th>24.676</th>
                                <th>23.975</th>
                                <th>36.155</th>
                                <th>23.211</th>
                                <th>20.109</th>
                                <th>39.031</th>
                                <th>38.615</th>
                                <th>20.710</th>
                                <th>31.358</th>
                                <th>50.060</th>
                                <th>52.000</th>
                            </tr>
                            <tr>
                                <td scope="row">1</td>
                                <td>Thu từ thủy điện</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>39.630</td>
                                <td>7.096</td>
                                <td>16.197</td>
                                <td>22.932</td>
                                <td>22.223</td>
                                <td>34.054</td>
                                <td>21.381</td>
                                <td>17.891</td>
                                <td>36.612</td>
                                <td>36.156</td>
                                <td>18.814</td>
                                <td>28.763</td>
                                <td>47.392</td>
                                <td>49.270</td>
                            </tr>
                            <tr>
                                <td scope="row">2</td>
                                <td>Thu từ Cty CP cấp nước</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>3.869</td>
                                <td>3.511</td>
                                <td>1.683</td>
                                <td>1.620</td>
                                <td>1.751</td>
                                <td>1.727</td>
                                <td>1.830</td>
                                <td>1.821</td>
                                <td>2.419</td>
                                <td>2.276</td>
                                <td>1.896</td>
                                <td>2.494</td>
                                <td>2.548</td>
                                <td>2.600</td>
                            </tr>
                            <tr>
                                <td scope="3">3</td>
                                <td>Lãi tiền gửi ngân hàng</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>93</td>
                                <td></td>
                                <td>124</td>
                                <td></td>
                                <td>374</td>
                                <td></td>
                                <td>397</td>
                                <td></td>
                                <td>183</td>
                                <td></td>
                                <td>101</td>
                                <td>120</td>
                                <td>130</td>
                            </tr>
                            {{-- department III --}}
                            <tr>
                                <th scope="row">III</th>
                                <th class="parent">Quỹ phát triển đất</th>
                                <th></th>
                                <th>90.277</th>
                                <th>90.277</th>
                                <th>70.694</th>
                                <th>70.694</th>
                                <th>44.888</th>
                                <th>12.888</th>
                                <th>33.174</th>
                                <th>65.174</th>
                                <th>23.623</th>
                                <th>23.565</th>
                                <th>61.970</th>
                                <th>44.245</th>
                                <th>19.049</th>
                                <th>16.930</th>
                                <th>37.448</th>
                                <th>29.836</th>
                                <th>151.140</th>
                                <th>50.300</th>
                            </tr>
                            <tr>
                                <td scope="row">1</td>
                                <td>Hỗ trợ từ NS tỉnh</td>
                                <td></td>
                                <td>90.000</td>
                                <td>90.000</td>
                                <td>70.000</td>
                                <td>70.000</td>
                                <td>10.000</td>
                                <td>10.000</td>
                                <td>14.375</td>
                                <td>14.375</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>10.600</td>
                                <td></td>
                                <td>10.125</td>
                                <td></td>
                                <td></td>
                                <td>102.715</td>
                                <td>30.000</td>
                            </tr>
                            <tr>
                                <td scope="row">2</td>
                                <td>Thu sự nghiệp Qũy</td>
                                <td></td>
                                <td>277</td>
                                <td>277</td>
                                <td>694</td>
                                <td>694</td>
                                <td>888</td>
                                <td>888</td>
                                <td>659</td>
                                <td>659</td>
                                <td>577</td>
                                <td>577</td>
                                <td>353</td>
                                <td>353</td>
                                <td>305</td>
                                <td>305</td>
                                <td>250</td>
                                <td>250</td>
                                <td>300</td>
                                <td>300</td>
                            </tr>
                            <tr>
                                <td scope="3">3</td>
                                <td>Thu hồi tạm ứng vốn</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>34.000</td>
                                <td>2.000</td>
                                <td>18.140</td>
                                <td>50.140</td>
                                <td>23.046</td>
                                <td>22.988</td>
                                <td>61.617</td>
                                <td>33.292</td>
                                <td>18.744</td>
                                <td>6.500</td>
                                <td>37.198</td>
                                <td>29.586</td>
                                <td>48.125</td>
                                <td>20.000</td>
                            </tr>
        				</tbody>
        			</table>
        		</div>
        	</div>
        </main>
    </body>
</html>

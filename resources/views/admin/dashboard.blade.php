@extends('admin.layouts.main')
@section('styles')

@endsection


@section('content')
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Thống kê doanh thu</h3>
                  <div class="card-tools">
                    <div title="Export pdf" id="downloadTurnover" class="btn btn-tool btn-sm">
                      <i class="fas fa-download"></i>
                    </div>
                    {{-- <select class="form-select" aria-label="Default select example" style="outline: none">
                      <option selected value="6">6</option>
                      <option value="8">8</option>
                      <option value="10">10</option>
                      <option value="12">12</option>
                    </select> --}}
                    {{-- <a href="#" class="btn btn-tool btn-sm">
                      <i class="fas fa-bars"></i>
                    </a> --}}
                  </div>
                </div>
              </div>
              <div class="card-body">
                {{-- <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">820</span>
                    <span>Visitors Over Time</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 12.5%
                    </span>
                    <span class="text-muted">Since last week</span>
                  </p>
                </div> --}}
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  {{-- <canvas id="visitors-chart" height="200"></canvas> --}}
                  <canvas id="myChart"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  Unit: VND
                </div>
              </div>
            </div>
            <!-- /.card -->

        
            <!-- /.card -->
          </div>
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Top 5 sản phẩm bán chạy nhất</h3>
                <div class="card-tools">

                  <select id="topSelling" class="form-select" aria-label="Default select example" style="outline: none">
                    <option selected value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                  </select>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng bán</th>
                  </tr>
                  </thead>
                  <tbody>
                  {{-- <tr>
                    <td>
                      <img src="{{asset('assets/dist/img/default-150x150.png')}}" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Some Product
                    </td>
                    <td>$13 USD</td>
                    <td>
                      <small class="text-success mr-1">
                        <i class="fas fa-arrow-up"></i>
                        12%
                      </small>
                      12,000 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="{{asset('assets/dist/img/default-150x150.png')}}" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Another Product
                    </td>
                    <td>$29 USD</td>
                    <td>
                      <small class="text-warning mr-1">
                        <i class="fas fa-arrow-down"></i>
                        0.5%
                      </small>
                      123,234 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr> --}}
                  @if($topSelling)
                    @foreach($topSelling as $key => $selling)
                    <tr>
                      <td>{{$key + 1}}</td>
                      <td>
                        <img src="{{url('assets')}}/uploads/products/{{$selling->avatar_pro}}" alt="Product 1" class="img-circle img-size-32 mr-2">
                        {{$selling->name}}
                      </td>
                      <td>{{ number_format((int) $selling->price, 0, ',', '.') }} đ</td>
                      <td>
                        {{-- <small class="text-success mr-1">
                          <i class="fas fa-arrow-up"></i>
                          12%
                        </small> --}}
                        {{$selling->total_quantity}}
                      </td>
                    </tr>
                    @endforeach
                  @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
          {{-- <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Sales</h3>
                  <a href="javascript:void(0);">View Report</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">$18,230.00</span>
                    <span>Sales Over Time</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                    <span class="text-muted">Since last month</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="sales-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This year
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last year
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Online Store Overview</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-sm btn-tool">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-sm btn-tool">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                  <p class="text-success text-xl">
                    <i class="ion ion-ios-refresh-empty"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold">
                      <i class="ion ion-android-arrow-up text-success"></i> 12%
                    </span>
                    <span class="text-muted">CONVERSION RATE</span>
                  </p>
                </div>
                <!-- /.d-flex -->
                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                  <p class="text-warning text-xl">
                    <i class="ion ion-ios-cart-outline"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold">
                      <i class="ion ion-android-arrow-up text-warning"></i> 0.8%
                    </span>
                    <span class="text-muted">SALES RATE</span>
                  </p>
                </div>
                <!-- /.d-flex -->
                <div class="d-flex justify-content-between align-items-center mb-0">
                  <p class="text-danger text-xl">
                    <i class="ion ion-ios-people-outline"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold">
                      <i class="ion ion-android-arrow-down text-danger"></i> 1%
                    </span>
                    <span class="text-muted">REGISTRATION RATE</span>
                  </p>
                </div>
                <!-- /.d-flex -->
              </div>
            </div>
          </div> --}}
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.com/libraries/Chart.js"></script>

<script>
  const monthAbbreviations = [
      "Jan", "Feb", "Mar",
      "Apr", "May", "Jun",
      "Jul", "Aug", "Sep",
      "Oct", "Nov", "Dec"
  ];

  // Lấy thời gian hiện tại
  const currentDate = new Date();

  // Lấy tên viết tắt của 6 tháng gần đây
  const recentMonthsAbbreviated = [];
  for (let i = 11; i >= 0; i--) {
      // Giảm thời gian hiện tại đi i tháng
      const pastMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() - i, 1);
      const monthAbbreviation = monthAbbreviations[pastMonth.getMonth()];
      recentMonthsAbbreviated.push(monthAbbreviation);
  }

  var totalIncomes = @json($totalIncomeData);

  // Lấy thẻ canvas để vẽ biểu đồ
  const ctx = document.getElementById('myChart').getContext('2d');

  // Tạo biểu đồ
  const chart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: recentMonthsAbbreviated,
          datasets: [
              {
                  label: 'Mức độ thu nhập từng tháng',
                  data: totalIncomes,
                  borderColor: 'red',
                  backgroundColor: 'rgba(0, 255, 255, 0)',
                  type: 'line',
              },

              {
                  label: 'Tổng thu nhập',
                  data: totalIncomes,
                  borderColor: 'rgba(0, 0, 255, 244, 1)',
                  backgroundColor: 'rgba(0, 0, 255, 0.6)',
                  borderWidth: 1,
                  type: 'bar',
              },
          ]
      },
      options: {
        title: {
            display: true,
            text: 'Doanh thu bán hàng trong 12 tháng gần nhất'
        },
        scales: {
            y: {
              stacked: true
            }
        }
    }
  });

  window.jsPDF = window.jspdf.jsPDF;
  // Xử lý sự kiện khi nhấp vào nút "downloadTurnover"
  document.getElementById('downloadTurnover').addEventListener('click', function() {
      // Tạo một đối tượng jsPDF
      const pdf = new jsPDF();

      // Lấy hình ảnh của biểu đồ dưới dạng dữ liệu URL
      const imgData = chart.canvas.toDataURL('image/png');

      // Thêm hình ảnh của biểu đồ vào file PDF
      pdf.addImage(imgData, 'PNG', 10, 10, 180, 100); // (imgData, type, x, y, width, height)

      // Tải xuống file PDF
      pdf.save('chart.pdf');
  });

  $( document ).ready(function() {
    const urlParams = new URLSearchParams(window.location.search);
    const topSellingIn = urlParams.get('topSellingIn');

    if (topSellingIn) {
        $('#topSelling').val(topSellingIn);
    }
    $('#topSelling').on('change', function() {
      const monthAgo = $('#topSelling').val();
      const currentUrl = new URL(window.location.href);
      currentUrl.searchParams.set('topSellingIn', monthAgo);
      window.location.href = currentUrl.toString();
    })

    $('#exportTopSelling').on('click', function() {
      const urlParams = new URLSearchParams(window.location.search);
      const topSellingIn = urlParams.get('topSellingIn');
      const exportUrl = "{{ route('export.topSelling') }}?topSellingIn=" + topSellingIn;
      window.location.href = exportUrl;
    })
  });
</script>

@endsection
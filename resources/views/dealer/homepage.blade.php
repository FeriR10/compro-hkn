@extends('layout/master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css">
    </section>

    <style>
        .carousel-control-prev, .carousel-control-next {
            width: auto;
            background: none;
            border: none;
        }

        .carousel-control-prev-icon, .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            padding: 10px;
        }

        .carousel-inner img {
            width: 100%;
            height: 300px; /* Set a fixed height */
            object-fit: contain; /* Ensure images cover the container while maintaining aspect ratio */
            align: center;
        }
    </style>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="crad">
            <div class="card-header ">
                <h3 class="card-title ">Pengumuman</h3>
            </div>
            <div class="card-body">
            <div id="carouselExample" class="carousel slide mb-3" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($pengumuman as $key => $gambar)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ $gambar->thumbnail ? asset('storage/'.$gambar->thumbnail) : asset('storage/images/default.png') }}" class="d-block w-100 " alt="...">
                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden"></span>
                    </button>
                </div>
            </div>
        </div>
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Histori Pesan<strong></strong></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if (Session::has('status'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="btn btn-success close" data-dismiss="alert">&times;</button>
                    {{ Session::get('message') }}
                </div>
                @endif

                

                <table id="example1" class="table table-bordered table-striped" style="text-align: center">
                    <thead>
                        <tr class="highlight">
                            <th>Tanggal</th>
                            <th>NO Order</th>
                            <th>Jumlah</th>
                            <th>Jenis Payment</th>
                            <th>Status Payment</th>
                            <th>Status Kirim</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($home as $item)
                        <tr>
                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->total_harga }}</td>
                            <td>{{ $item->payment->jenis_payment->jenis_payment ?? '' }}</td>
                            <td>{{ $item->status ?? '' }}</td>
                            <td>
                                @if (in_array($item->status, ['Menunggu', 'DP lunas', 'Lunas']))
                                    @if ($item->payment->status == 'Berhasil Bayar')
                                        <span class="badge badge-success">Delivered</span>
                                    @elseif ($item->payment->status == 'Belum Di Transfer')
                                        <span class="badge badge-warning">On Process</span>
                                    @endif
                                @elseif ($item->status == 'Dibatalkan')
                                    <span class="badge badge-danger">Dibatalkan</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script>
    $('.center').slick({
        centerMode: true,
        centerPadding: '60px',
        slidesToShow: 3,
        arrows: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: true,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: true,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
        ]
    });
</script>

@endsection

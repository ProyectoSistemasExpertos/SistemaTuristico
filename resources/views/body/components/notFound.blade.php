@extends('body.master_body')
@section('body')


<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-6 mb-4">
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <style>
            .frame {
                position: absolute;
                top: 50%;
                left: 50%;
                width: 400px;
                height: 400px;
                margin-top: -200px;
                margin-left: -200px;
                border-radius: 2px;
                box-shadow: 1px 2px 10px 0px rgba(0, 0, 0, 0.3);
                background: #43389F;
                background: -webkit-linear-gradient(bottom left, #43389F 0%, #4ec6ca 100%);
                background: -moz-linear-gradient(bottom left, #43389F 0%, #4ec6ca 100%);
                background: -o-linear-gradient(bottom left, #43389F 0%, #4ec6ca 100%);
                background: linear-gradient(to top right, #43389F 0%, #4ec6ca 100%);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#43389F', endColorstr='#4ec6ca', GradientType=1);
                font-family: 'Courier New', 'Courier', sans-serif;
                color: #fff;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            .center {
                position: absolute;
                top: 50.8%;
                left: 50.5%;
                transform: translate(-50%, -50%);
            }

            .number {
                position: relative;
                height: 100px;
                width: 200px;

                .one-one {
                    position: absolute;
                    z-index: 1;
                    top: 0;
                    left: -16px;
                    height: 40px;
                    width: 20px;
                    background: #fff;
                    border-radius: 3px;
                    transform: rotate(50deg);
                    box-shadow: 0 0 13px 0 rgba(0, 0, 0, 0.2);
                }

                .one-two {
                    position: absolute;
                    z-index: 10;
                    top: 0;
                    left: 0px;
                    height: 100px;
                    width: 24px;
                    background: #fff;
                    border-radius: 3px;
                    box-shadow: 0 0 13px 0 rgba(0, 0, 0, 0.2);
                }

                .zero-one,
                .zero-two {
                    position: absolute;
                    z-index: 8;
                    top: 0;
                    left: 17px;
                    box-sizing: border-box;
                    height: 100px;
                    width: 100px;
                    border-radius: 50%;
                    border: 24px solid #fff;
                    box-shadow: 0 0 13px 0 rgba(0, 0, 0, 0.2);
                }

                .zero-two {
                    z-index: 6;
                    left: 100px;
                }
            }

            .big {
                position: relative;
                z-index: 20;
                display: block;
                font-size: 40px;
                line-height: 60px;
                text-transform: uppercase;
                font-weight: 700;
                margin-top: 6px;
            }

            .small {
                position: relative;
                z-index: 20;
                display: block;
                font-size: 23px;
                line-height: 20px;
                text-transform: uppercase;
                font-weight: 700;
                letter-spacing: .04em;
            }
        </style>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" style="background-color: #F1E9E7;">

        <div class="frame">
            <div class="center">
                
                <span class="big">No hay registros de reservaciones.</span>
                <span class="small">Crea una reservación para utilizar esta función.</span>
            </div>
        </div>
    </section>

</div>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>



@endsection
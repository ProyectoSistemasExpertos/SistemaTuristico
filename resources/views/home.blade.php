<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TUplas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">
    @php
        $imageUrls = [
            "https://www.govisitcostarica.co.cr/images/photos/desk-la-paz-waterfall-costa-rica(1).jpg",
            "https://www.govisitcostarica.co.cr/images/photos/desk-montezuma-waterfall-on-the-nicoya-peninsula-near-santa-teresa.jpg",
            "https://www.govisitcostarica.co.cr/images/photos/desk-hills-in-monteverde.jpg",
            "https://www.govisitcostarica.co.cr/images/photos/desk-cloudforest-monteverde.jpg",
            "https://www.govisitcostarica.co.cr/images/photos/desk-corcovado-national-park-beach-sunset.jpg"
        ];
    @endphp
</head>
<body>
    <div class="bg-purple-900 absolute top-0 left-0 bottom-0 right-0 leading-5 overflow-hidden">
        <div class="relative min-h-screen sm:flex sm:flex-row justify-center bg-transparent rounded-3xl shadow-xl">
            <div class="w-full">
                <div class="slick-carousel">

                    @foreach ($imageUrls as $index => $imageUrl)
                        <div>
                            <img src="{{ $imageUrl }}" alt="Imagen {{ $index + 1 }}" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-center self-center z-10 absolute top-10 right-11 h-center">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
            <div class="p-12 bg-white mx-auto rounded-3xl w-96 mt-25">
                    @yield('content') <!-- Aquí es donde se renderizará tu vista específica (login o register) -->
                </div>
            </div>
        </div>
        <footer class="bg-transparent absolute bottom-0 z-20">
                <div class="flex mr-auto h-8">
                    <a style="color: #ffffff; font-size: 24px;">
                        <strong>TU</strong>plas
                    </a>
            </div>
        </footer>
        <svg class="absolute bottom-0 left-0 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#4B1B92E6" fill-opacity="1" d="M0,0L40,42.7C80,85,160,171,240,197.3C320,224,400,192,480,154.7C560,117,640,75,720,74.7C800,75,880,117,960,154.7C1040,192,1120,224,1200,213.3C1280,203,1360,149,1400,122.7L1440,96L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path>
        </svg>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.slick-carousel').slick({
                dots: true,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
            });
            setTimeout(function() {
            // Ajusta el selector del enlace según tu estructura actual
            $('a[href="login"]').click();
        }, 100);
        });

    </script>
</body>
</html>

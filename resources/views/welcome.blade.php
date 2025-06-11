<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alquiler de coches: pgLang</title>

    {{-- Estilos CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- Icon Fonts --}}
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    {{-- Favicon --}}
    <link rel="shortcut icon" href="https://i.postimg.cc/gcZdykyW/jeep.png">

    {{-- ScrollReveal --}}
    <script src="https://unpkg.com/scrollreveal"></script>
</head>

<body>
    <header>
        <a href="#" class="logo"><img src="https://i.postimg.cc/gcZdykyW/jeep.png" alt="car logo"></a>

        <i class='bx bx-menu' id="menu-icon"></i>

        <ul class="navbar">
            <li><a href="#index">Inicio</a></li>
            <li><a href="#ride">Ride</a></li>
            <li><a href="#services">Servicios</a></li>
            <li><a href="#about">Sobre</a></li>
            <li><a href="#contact">Contáctanos</a></li>
        </ul>

        <div class="header-btn">
            <a href="#" class="sign-up">Sign Up</a>
            <a href="#" class="sign-in">Sign In</a>
        </div>
    </header>

    <section class="index" id="index">
        <div class="text">
            <h1><span>Buscando</span> un <br>carro que rentar</h1>
            <p>¿Adónde le llevará la carretera? Alquile un coche y descúbralo.</p>
        </div>
    </section>

    <section class="ride" id="ride">
        <div class="heading">
            <span>¿Cómo funciona?</span>
            <h1>Alquila con 3 pasos</h1>
        </div>
        <div class="ride-container">
            <div class="box">
                <i class="ri-map-2-line"></i>
                <h2>Elija una ubicación</h2>
                <p>Navegue por nuestra amplia selección de vehículos según su ubicación</p>
            </div>

            <div class="box">
                <i class="ri-calendar-line"></i>
                <h2>Elija una fecha</h2>
                <p>Elija una fecha que se ajuste a sus necesidades y presupuesto</p>
            </div>

            <div class="box">
                <i class="ri-bookmark-line"></i>
                <h2>Reservar un coche</h2>
                <p>Introduzca sus datos para una reserva rápida y segura</p>
            </div>
        </div>
    </section>

    <section class="services" id="services">
        <div class="heading">
            <span>Los mejores servicios</span>
            <h1>Descubra nuestras mejores ofertas <br> De los mejores distribuidores </h1>
        </div>
        <div class="services-container">
            <div class="box">
                <div class="box-img"><img src="https://i.postimg.cc/T31DwXXs/car1.jpg" alt="car image"></div>
                <p>2025</p>
                <h3>Honda Civic Type R</h3>
                <h2>$45,895 | $276 <span>/por mes</span></h2>
                <a href="#" class="btn">Alquilar Ahora</a>
            </div>

            <div class="box">
                <div class="box-img"><img src="https://i.postimg.cc/QdvHd9mB/car2.jpg" alt="car image"></div>
                <p>2025</p>
                <h3>Honda Civic</h3>
                <h2>$28,450 | $171 <span>/por mes</span></h2>
                <a href="#" class="btn">Alquilar Ahora</a>
            </div>

            <div class="box">
                <div class="box-img"><img src="https://i.postimg.cc/s2S1QjHT/car3.jpg" alt="car image"></div>
                <p>2025</p>
                <h3>Honda Civic Si</h3>
                <h2>$29,000 | $174 <span>/por mes</span></h2>
                <a href="#" class="btn">Alquilar Ahora</a>
            </div>

            <div class="box">
                <div class="box-img"><img src="https://i.postimg.cc/rsYqZ3Yd/car4.jpg" alt="car image"></div>
                <p>2023</p>
                <h3>Honda Civic Type R</h3>
                <h2>$43,000 | $258 <span>/por mes</span></h2>
                <a href="#" class="btn">Alquilar Ahora</a>
            </div>

            <div class="box">
                <div class="box-img"><img src="https://i.postimg.cc/jqnj5QCR/car5.jpg" alt="car image"></div>
                <p>2023</p>
                <h3>Honda Civic Type R</h3>
                <h2>$43,000 | $258 <span>/por mes</span></h2>
                <a href="#" class="btn">Alquilar Ahora</a>
            </div>

            <div class="box">
                <div class="box-img"><img src="https://i.postimg.cc/DZSFDFRq/car6.jpg" alt="car image"></div>
                <p>2025</p>
                <h3>Porsche Cayman GT4</h3>
                <h2>$100,000 | $600 <span>/por mes</span></h2>
                <a href="#" class="btn">Alquilar Ahora</a>
            </div>
        </div>
    </section>

    <section class="about" id="about">
        <div class="heading">
            <span>About Us</span>
            <h1>Best Customer Experience</h1>
        </div>
        <div class="about-container">
            <div class="about-img"><img src="https://i.postimg.cc/KjtmmbFC/about.png" alt="about banner"></div>
            <div class="about-text">
                <span>Sobre nosotros</span>
                <p>Nos apasiona ofrecerte el vehículo perfecto para tus necesidades. Tanto si buscas un alquiler a corto plazo como una compra a largo plazo, ofrecemos una variada selección de coches para todos los gustos y presupuestos.</p>
                <p>Nuestro compromiso con la excelencia comienza con nuestro extenso inventario, cuidadosamente seleccionado para incluir una amplia gama de marcas, modelos y años. Nos enorgullecemos de mantener un alto nivel de calidad de los vehículos, asegurando que cada coche se somete a un riguroso proceso de inspección antes de ser puesto a la venta o alquiler.</p>
            </div>
        </div>
    </section>

    <section class="contact">
        <h2>Contáctanos</h2>
        <form action="{{ route('contact.send') }}" method="POST" class="box">
            @csrf

            <input type="text" name="name" placeholder="Tu nombre" required>
            <input type="email" name="email" placeholder="Tu correo electrónico" required>
            <textarea name="message" rows="5" placeholder="Tu mensaje" required></textarea>

            <button type="submit" class="btn">Enviar mensaje</button>
        </form>

        @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
        @endif
    </section>

    <div class="copyright">
        <p>&#169; <span>ULTRA CODE</span> All rights reserved</p>
        <div class="social">
            <a href="#"><i class="ri-facebook-fill"></i></a>
            <a href="#"><i class="ri-twitter-x-line"></i></a>
            <a href="#"><i class="ri-instagram-line"></i></a>
        </div>
    </div>

    <script src="main.js"></script>
    <!-- Begin Zoho SalesIQ Script -->
    <script type='text/javascript'>
        var $zoho = $zoho || {};
        $zoho.salesiq = $zoho.salesiq || {
            widgetcode: "UN-CÓDIGO-LARGO-AQUÍ",
            values: {},
            ready: function() {}
        };
        var d = document;
        s = d.createElement("script");
        s.type = "text/javascript";
        s.id = "zsiqscript";
        s.defer = true;
        s.src = "https://salesiq.zoho.com/widget";
        t = d.getElementsByTagName("script")[0];
        t.parentNode.insertBefore(s, t);
    </script>
    <!-- End Zoho SalesIQ Script -->

    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
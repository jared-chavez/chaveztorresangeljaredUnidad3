@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
    <section class="home" id="home">
        <div class="text">
            <h1><span>¿Buscas</span> <br>rentar un auto?</h1>
            <p>¿A dónde te llevará el camino? ¡Renta un auto y descúbrelo!</p>
        </div>
    </section>

    {{-- Ride/Steps Section --}}
    <section class="ride" id="ride">
        <div class="heading">
            <span>¿Cómo funciona?</span>
            <h1>Renta en 3 pasos sencillos</h1>
        </div>
        <div class="ride-container">
            <div class="box">
                <i class="ri-map-2-line"></i>
                <h2>Elige una ubicación</h2>
                <p>Explora nuestra amplia selección de vehículos según la ubicación</p>
            </div>
            <div class="box">
                <i class="ri-calendar-line"></i>
                <h2>Elige una fecha</h2>
                <p>Selecciona la fecha que se ajuste a tus necesidades y presupuesto</p>
            </div>
            <div class="box">
                <i class="ri-bookmark-line"></i>
                <h2>Reserva un auto</h2>
                <p>Ingresa tus datos para una reserva rápida y segura</p>
            </div>
        </div>
    </section>

    {{-- About Section --}}
    <section class="about" id="about">
        <div class="heading">
            <span>Sobre Nosotros</span>
            <h1>La mejor experiencia para el cliente</h1>
        </div>
        <div class="about-container">
            <div class="about-img"><img src="https://i.postimg.cc/KjtmmbFC/about.png" alt="sobre nosotros"></div>
            <div class="about-text">
                <span>Sobre nosotros</span>
                <p>Nos apasiona ofrecerte el vehículo perfecto para tus necesidades. Tanto si buscas un alquiler a corto plazo como una compra a largo plazo, ofrecemos una variada selección de autos para todos los gustos y presupuestos.</p>
                <p>Nuestro compromiso con la excelencia comienza con nuestro extenso inventario, cuidadosamente seleccionado para incluir una amplia gama de marcas, modelos y años. Nos enorgullecemos de mantener un alto nivel de calidad de los vehículos, asegurando que cada auto se somete a un riguroso proceso de inspección antes de ser puesto a la venta o alquiler.</p>
                <a href="#" class="btn">Saber más</a>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/684dffc60973de19088f189e/1itoau7ri';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
</body>
</html>
    <!-- End Zoho SalesIQ Script -->
@endsection
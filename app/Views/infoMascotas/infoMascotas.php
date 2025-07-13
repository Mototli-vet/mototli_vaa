<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Importancia del Cuidado de las Mascotas</title>
    <!-- Bootstrap CSS -->
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        .navbar {
            background-color: grey;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            padding: 10px 0;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-weight: 800;
            margin: 0 15px;
            padding: 8px 15px;
            border-radius: 20px;
            transition: background 0.3s ease;
        }

        .navbar a:hover {
            background-color: #ffcc00;
            color: #000;
        }

        :root {
            --color-primary-grey: #9CA3AF;
            --color-accent-yellow: #F8E71C;
            --color-light-bg-1: #F9FAFB;
            --color-light-bg-2: #F3F4F6;
            --color-dark-text: #333333;
            --color-light-text: #FFFFFF;
            --color-dark-grey: #4B5563;
            --color-hero-text-light-grey: #D1D5DB;
            --color-header-title-light-grey: #E5E7EB;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--color-light-bg-1);
            color: var(--color-dark-text);
        }

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://placehold.co/1200x600/9CA3AF/FFFFFF?text=Mascotas+Felices') no-repeat center center / cover;
            min-height: 550px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--color-light-text);
            position: relative;
            border-bottom-left-radius: 3rem;
            border-bottom-right-radius: 3rem;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
            animation: fadeIn 1s ease-out;
        }


        .section-bg-1 {
            background-color: var(--color-light-bg-1);
        }

        .section-bg-2 {
            background-color: var(--color-light-bg-2);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .modal.show {
            opacity: 1;
        }

        .modal-content {
            background-color: var(--color-light-text);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 550px;
            position: relative;
            transform: translateY(-50px);
            transition: transform 0.3s ease-in-out;
        }

        .modal.show .modal-content {
            transform: translateY(0);
        }

        .close-button {
            color: #aaa;
            font-size: 32px;
            font-weight: bold;
            position: absolute;
            top: 15px;
            right: 25px;
            cursor: pointer;
            transition: color 0.2s ease-in-out;
        }

        .close-button:hover,
        .close-button:focus {
            color: var(--color-dark-text);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideInUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .btn-primary {
            background-color: var(--color-accent-yellow);
            color: var(--color-dark-grey);
            font-weight: 700;
            padding: 1rem 2.5rem;
            border-radius: 9999px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #FDD835;
            transform: scale(1.05);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary {
            background-color: var(--color-light-text);
            color: var(--color-primary-grey);
            font-weight: 700;
            padding: 1rem 2.5rem;
            border-radius: 9999px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        .btn-secondary:hover {
            background-color: #F0F0F0;
            transform: scale(1.05);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
        }

        .card {
            background-color: var(--color-light-text);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body class="antialiased">

    <header class="bg-gray-600 shadow-lg py-4 px-6 md:px-12 rounded-b-lg">
        <nav class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-gray-200 text-3xl font-extrabold rounded-lg p-2 hover:bg-gray-700 transition duration-300 transform hover:scale-105">
                🐾 Mascotas Felices
            </a>
            </div>
            <nav class="navbar">
                <a href="<?= site_url('/') ?>">Inicio</a>
                <a href="<?= site_url('mascotas/informacion') ?>">Mascotas</a>
                <a href="<?= site_url('mascotas/nuevo') ?>">Registrar Mascota</a>
                <a href="#">QR</a>
                <a href="#">Servicios</a>
                <a href="#">Blog</a>
            </nav>
        </nav>
    </header>

    <section class="hero-section">
        <div class="max-w-4xl mx-auto p-8">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-6 leading-tight drop-shadow-xl animate-slideInUp text-gray-300">
                La Importancia de Cuidar a Nuestros Compañeros Peludos
            </h1>
            <p class="text-xl md:text-2xl mb-10 drop-shadow-md animate-slideInUp text-gray-300" style="animation-delay: 0.3s;">
                Ellos nos dan amor incondicional, ¿qué les damos nosotros a cambio?
            </p>
            <button id="learnMoreBtn" class="btn-primary animate-slideInUp" style="animation-delay: 0.6s;">
                Descubre Más
            </button>
        </div>
    </section>

    <section id="importancia" class="py-20 px-6 md:px-12 section-bg-1 rounded-3xl mx-auto my-16 max-w-7xl shadow-2xl">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-700 mb-12">¿Por Qué es Crucial su Cuidado?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="text-left animate-slideInUp">
                    <p class="text-lg md:text-xl text-gray-700 mb-6 leading-relaxed">
                        Las mascotas son más que simples animales; son miembros de nuestra familia que dependen completamente de nosotros para su bienestar. Un cuidado adecuado no solo garantiza su salud física, sino también su felicidad y desarrollo emocional. Ignorar sus necesidades puede llevar a problemas de salud, comportamiento y, en última instancia, a una vida de sufrimiento.
                    </p>
                    <p class="text-lg md:text-xl text-gray-700 leading-relaxed">
                        Desde una alimentación balanceada y visitas regulares al veterinario hasta el ejercicio diario y el afecto constante, cada aspecto de su cuidado contribuye a una vida plena y saludable para ellos.
                    </p>
                </div>
                <div class="flex justify-center animate-slideInUp" style="animation-delay: 0.2s;">
                    <img src="perrito8.jpg" alt="Perro feliz jugando" class="rounded-2xl shadow-xl w-full max-w-lg object-cover">
                </div>
            </div>
        </div>
    </section>

    <section id="beneficios" class="py-20 px-6 md:px-12 section-bg-2 rounded-3xl mx-auto my-16 max-w-7xl shadow-2xl">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-yellow-800 mb-12">Beneficios Mutuos</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="flex justify-center order-2 md:order-1 animate-slideInUp">
                    <img src="./img/GATO1.JPG" alt="Gato cariñoso" class="rounded-2xl shadow-xl w-full max-w-lg object-cover">
                </div>
                <div class="text-left order-1 md:order-2 animate-slideInUp" style="animation-delay: 0.2s;">
                    <p class="text-lg md:text-xl text-gray-700 mb-6 leading-relaxed">
                        Cuidar de una mascota no es solo una responsabilidad, es una fuente inagotable de alegría y beneficios para los humanos. Estudios demuestran que tener mascotas reduce el estrés, disminuye la presión arterial y combate la soledad. Nos enseñan sobre el amor incondicional, la paciencia y la responsabilidad.
                    </p>
                    <p class="text-lg md:text-xl text-gray-700 leading-relaxed">
                        Además, nos motivan a ser más activos, a socializar y a vivir el presente. La conexión que formamos con ellos es única y enriquecedora, mejorando nuestra calidad de vida de innumerables maneras.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="responsabilidad" class="py-20 px-6 md:px-12 section-bg-1 rounded-3xl mx-auto my-16 max-w-7xl shadow-2xl">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-700 mb-12">Nuestra Responsabilidad</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="card animate-slideInUp">
                    <h3 class="text-2xl font-semibold text-gray-700 mb-4">Salud y Nutrición</h3>
                    <p class="text-gray-700">
                        Proveer una dieta adecuada y visitas regulares al veterinario para vacunas y chequeos.
                    </p>
                </div>
                <div class="card animate-slideInUp" style="animation-delay: 0.1s;">
                    <h3 class="text-2xl font-semibold text-gray-700 mb-4">Ejercicio y Juego</h3>
                    <p class="text-gray-700">
                        Asegurar suficiente actividad física y mental para su bienestar.
                    </p>
                </div>
                <div class="card animate-slideInUp" style="animation-delay: 0.2s;">
                    <h3 class="text-2xl font-semibold text-gray-700 mb-4">Amor y Atención</h3>
                    <p class="text-gray-700">
                        Ofrecer afecto, paciencia y un ambiente seguro y amoroso.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="contacto" class="py-20 px-6 md:px-12 bg-gray-600 text-white rounded-3xl mx-auto my-16 max-w-7xl shadow-2xl text-center">
        <div class="container mx-auto">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">¡Haz la Diferencia!</h2>
            <p class="text-xl md:text-2xl mb-10">
                Cada mascota merece una vida digna y llena de amor. Si estás pensando en adoptar o quieres apoyar una causa, ¡es el momento!
            </p>
            <button id="contactUsBtn" class="btn-secondary">
                Contáctanos / Apoya
            </button>
        </div>
    </section>

    <footer class="bg-gray-800 text-white py-8 px-6 md:px-12 text-center rounded-t-lg shadow-inner">
        <p>&copy; 2025 MOTOTLI. Todos los derechos reservados.</p>
        <p class="mt-2 text-sm">Hecho con amor para nuestros amigos de cuatro patas.</p>
    </footer>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2 class="text-3xl font-bold text-gray-700 mb-6">¡Gracias por tu Interés!</h2>
            <p class="text-lg text-gray-700 mb-6">
                Nos alegra que te interese el bienestar de las mascotas. Aquí podrías encontrar más información sobre cómo adoptar, hacer voluntariado o donar para apoyar a refugios de animales.
            </p>
            <p class="text-lg text-gray-700">
                Para más detalles, visita <a href="#" class="text-gray-600 hover:underline font-semibold">nuestro blog</a> o síguenos en redes sociales.
            </p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();

                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            const modal = document.getElementById('myModal');
            const learnMoreBtn = document.getElementById('learnMoreBtn');
            const contactUsBtn = document.getElementById('contactUsBtn');
            const closeButton = document.querySelector('.close-button');

            const showModal = () => {
                modal.classList.add('show');
                modal.style.display = 'flex';
            };

            const hideModal = () => {
                modal.classList.remove('show');
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 300);
            };

            learnMoreBtn.addEventListener('click', showModal);

            contactUsBtn.addEventListener('click', showModal);

            closeButton.addEventListener('click', hideModal);

            window.addEventListener('click', (event) => {
                if (event.target === modal) {
                    hideModal();
                }
            });
        });
    </script>
    <!-- Bootstrap JS -->
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>
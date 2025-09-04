<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon - HIMASI UNSUB</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }

        .floating-animation:nth-child(2) {
            animation-delay: -2s;
        }

        .floating-animation:nth-child(3) {
            animation-delay: -4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .fade-in-up {
            animation: fadeInUp 1s ease-out forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        .fade-in-up.delay-1 {
            animation-delay: 0.2s;
        }

        .fade-in-up.delay-2 {
            animation-delay: 0.4s;
        }

        .fade-in-up.delay-3 {
            animation-delay: 0.6s;
        }

        .fade-in-up.delay-4 {
            animation-delay: 0.8s;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .pulse-glow {
            animation: pulseGlow 2s infinite;
        }

        @keyframes pulseGlow {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(139, 92, 246, 0.3);
            }

            50% {
                box-shadow: 0 0 30px rgba(139, 92, 246, 0.6);
            }
        }

        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: particleFloat 8s infinite linear;
        }

        @keyframes particleFloat {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        .typing-animation {
            border-right: 2px solid #fff;
            animation: typing 4s steps(20, end) infinite, blink 1s infinite;
            white-space: nowrap;
            overflow: hidden;
        }

        @keyframes typing {
            0% {
                width: 0;
            }

            50% {
                width: 100%;
            }

            100% {
                width: 0;
            }
        }

        @keyframes blink {
            50% {
                border-color: transparent;
            }
        }

        .glass-morphism {
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body class="gradient-bg min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Animated particles background -->
    <div class="particles"></div>

    <!-- Floating geometric shapes -->
    {{-- <div class="absolute top-20 left-20 w-16 h-16 bg-white bg-opacity-10 rounded-full floating-animation"></div> --}}
    <div class="absolute top-40 right-32 w-8 h-8 bg-purple-300 bg-opacity-20 rounded-full floating-animation"></div>
    <div class="absolute bottom-32 left-32 w-12 h-12 bg-blue-300 bg-opacity-15 rotate-45 floating-animation"></div>
    <div class="absolute bottom-20 right-20 w-20 h-20 bg-pink-300 bg-opacity-10 rounded-full floating-animation"></div>

    <!-- Main content container -->
    <div class="text-center z-10 px-6 max-w-4xl mx-auto">
        <!-- Logo/Brand -->
        <div class="fade-in-up mb-8">
            <div
                class="w-20 h-20 mx-auto bg-white bg-opacity-20 rounded-full flex items-center justify-center glass-morphism pulse-glow">
                <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>

        <!-- Main heading -->
        <h1 class="text-6xl md:text-8xl font-bold text-white mb-6 fade-in-up delay-1">
            Coming Soon
        </h1>

        <!-- Animated subtitle -->
        <div class="text-xl md:text-2xl text-white text-opacity-90 mb-8 fade-in-up delay-2 h-8">
            <span class="typing-animation">Something amazing is on the way...</span>
        </div>

        <!-- Description -->
        <p class="text-lg text-white text-opacity-80 mb-12 max-w-2xl mx-auto leading-relaxed fade-in-up delay-3">
            We're crafting an extraordinary experience that will revolutionize the way you think about innovation.
            Stay tuned for the big reveal!
        </p>

        <!-- Social media links -->
        <div class="flex justify-center space-x-10 fade-in-up delay-4 gap-4">
            <a href="mailto:himasi@unsub.ac.id" target="_blank"
                class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center glass-morphism hover:bg-opacity-30 transition-all duration-300 transform hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 text-white" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
                    <rect x="2" y="4" width="20" height="16" rx="2" />
                </svg>
            </a>
            <a href="https://instagram.com/himasiunsub" target="_blank" rel="noopener noreferrer"
                class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center glass-morphism hover:bg-opacity-30 transition-all duration-300 transform hover:scale-110">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                </svg>
            </a>
        </div>
    </div>

    <script>
        // Create animated particles
        function createParticle() {
            const particle = document.createElement('div');
            particle.className = 'particle';

            const size = Math.random() * 4 + 2;
            particle.style.width = size + 'px';
            particle.style.height = size + 'px';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDuration = (Math.random() * 6 + 4) + 's';

            document.querySelector('.particles').appendChild(particle);

            setTimeout(() => {
                particle.remove();
            }, 10000);
        }

        // Create particles periodically
        setInterval(createParticle, 300);

        // Add hover effects to floating shapes
        document.querySelectorAll('.floating-animation').forEach(shape => {
            shape.addEventListener('mouseenter', () => {
                shape.style.transform = 'scale(1.2) translateY(-20px)';
                shape.style.transition = 'all 0.3s ease';
            });

            shape.addEventListener('mouseleave', () => {
                shape.style.transform = '';
                shape.style.transition = '';
            });
        });
    </script>
</body>

</html>

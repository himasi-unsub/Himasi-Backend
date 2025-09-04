<div class="font-sans leading-relaxed text-gray-800 bg-gradient-to-br from-primary-500 to-purple-600 min-h-screen">
    <!-- Header -->
    <header class="bg-white/95 backdrop-blur-md shadow-lg sticky top-0 z-50 transition-all duration-300" id="header">
        <nav class="max-w-6xl mx-auto px-6 flex justify-between items-center py-4">
            <a href="#" class="text-3xl font-bold text-primary-500 hover:text-primary-600 transition-colors">
                Twibbonizer
            </a>
            <ul class="hidden md:flex space-x-8">
                <li><a href="#beranda"
                        class="font-medium text-gray-700 hover:text-primary-500 transition-colors">Beranda</a></li>
                <li><a href="#fitur"
                        class="font-medium text-gray-700 hover:text-primary-500 transition-colors">Fitur</a></li>
                <li><a href="#tentang"
                        class="font-medium text-gray-700 hover:text-primary-500 transition-colors">Tentang</a></li>
                <li><a href="#kontak"
                        class="font-medium text-gray-700 hover:text-primary-500 transition-colors">Kontak</a></li>
                {{-- CTA Login --}}
                <li><a href="{{ url('/twibbonizer/client') }}"
                        class="font-medium text-white bg-gradient-to-r from-accent-500 to-accent-600 px-4 py-2 rounded-full hover:shadow-lg hover:-translate-y-05 transition-all duration-300">
                        Masuk
                    </a></li>
            </ul>
            <!-- Mobile menu button -->
            <button class="md:hidden text-gray-700 hover:text-primary-500" id="mobile-menu-btn">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </nav>

        <!-- Mobile menu -->
        <div class="md:hidden bg-white/95 backdrop-blur-md border-t hidden" id="mobile-menu">
            <div class="px-6 py-4 space-y-4">
                <a href="#beranda"
                    class="block font-medium text-gray-700 hover:text-primary-500 transition-colors">Beranda</a>
                <a href="#fitur"
                    class="block font-medium text-gray-700 hover:text-primary-500 transition-colors">Fitur</a>
                <a href="#tentang"
                    class="block font-medium text-gray-700 hover:text-primary-500 transition-colors">Tentang</a>
                <a href="#kontak"
                    class="block font-medium text-gray-700 hover:text-primary-500 transition-colors">Kontak</a>
                {{-- CTA Login --}}
                <a href="{{ url('/twibbonizer/client') }}"
                    class="block font-medium text-white bg-gradient-to-r from-accent-500 to-accent-600 px-4 py-2 rounded-full text-center hover:shadow-lg hover:-translate-y-05 transition-all duration-300">
                    Masuk
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="text-center py-16 px-6 text-white" id="beranda">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 drop-shadow-lg">
                Buat Twibbon dengan Mudah
            </h1>
            <p class="text-lg md:text-xl mb-8 opacity-90 max-w-2xl mx-auto">
                Platform gratis untuk membuat twibbon berkualitas tinggi tanpa watermark. Dari mahasiswa, untuk
                mahasiswa!
            </p>
            <button onclick="startCreating()"
                class="bg-gradient-to-r from-accent-500 to-accent-600 text-white px-10 py-4 rounded-full text-lg font-semibold hover:shadow-xl hover:-translate-y-1 transition-all duration-300 shadow-lg">
                Mulai Sekarang
            </button>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 px-6" id="fitur">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white/95 backdrop-blur-md rounded-3xl shadow-2xl p-8 md:p-12">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-800">
                    Mengapa Memilih Twibbonizer?
                </h2>

                <div class="grid md:grid-cols-3 gap-8">
                    <div
                        class="bg-white rounded-2xl p-8 text-center shadow-lg hover:shadow-xl hover:-translate-y-2 transition-all duration-300 border-2 border-transparent hover:border-primary-500 animate-fade-in-up">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-primary-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 text-3xl">
                            📸
                        </div>
                        <h3 class="text-xl font-semibold mb-4 text-gray-800">Upload Mudah</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Upload foto dari perangkat Anda dengan mudah. Mendukung berbagai format gambar populer
                            dengan kualitas terbaik.
                        </p>
                    </div>

                    <div
                        class="bg-white rounded-2xl p-8 text-center shadow-lg hover:shadow-xl hover:-translate-y-2 transition-all duration-300 border-2 border-transparent hover:border-primary-500 animate-fade-in-up-delay-1">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-primary-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 text-3xl">
                            🎨
                        </div>
                        <h3 class="text-xl font-semibold mb-4 text-gray-800">Editor Canggih</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Sesuaikan ukuran dan posisi foto Anda agar pas dengan frame twibbon. Interface yang intuitif
                            dan mudah digunakan.
                        </p>
                    </div>

                    <div
                        class="bg-white rounded-2xl p-8 text-center shadow-lg hover:shadow-xl hover:-translate-y-2 transition-all duration-300 border-2 border-transparent hover:border-primary-500 animate-fade-in-up-delay-2">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-primary-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 text-3xl">
                            ⬇️
                        </div>
                        <h3 class="text-xl font-semibold mb-4 text-gray-800">Download Gratis</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Download hasil twibbon Anda dengan kualitas HD tanpa watermark. Sepenuhnya gratis untuk
                            semua pengguna.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-16 px-6 text-white">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-12 drop-shadow-lg">
                Cara Menggunakan Twibbonizer
            </h2>

            <div class="grid md:grid-cols-3 gap-8 mb-12">
                <div
                    class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 hover:bg-white/15 transition-all duration-300">
                    <div
                        class="w-12 h-12 bg-accent-500 rounded-full flex items-center justify-center font-bold text-lg mx-auto mb-6 text-white">
                        1
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Upload Foto</h3>
                    <p class="opacity-90">
                        Pilih dan upload foto terbaik Anda dari galeri atau kamera
                    </p>
                </div>

                <div
                    class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 hover:bg-white/15 transition-all duration-300">
                    <div
                        class="w-12 h-12 bg-accent-500 rounded-full flex items-center justify-center font-bold text-lg mx-auto mb-6 text-white">
                        2
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Atur Posisi</h3>
                    <p class="opacity-90">
                        Sesuaikan ukuran dan posisi foto agar pas dengan frame twibbon
                    </p>
                </div>

                <div
                    class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 hover:bg-white/15 transition-all duration-300">
                    <div
                        class="w-12 h-12 bg-accent-500 rounded-full flex items-center justify-center font-bold text-lg mx-auto mb-6 text-white">
                        3
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Download Hasil</h3>
                    <p class="opacity-90">
                        Download twibbon Anda dengan kualitas terbaik tanpa watermark
                    </p>
                </div>
            </div>

            <button onclick="startCreating()"
                class="bg-gradient-to-r from-accent-500 to-accent-600 text-white px-10 py-4 rounded-full text-lg font-semibold hover:shadow-xl hover:-translate-y-1 transition-all duration-300 shadow-lg">
                Coba Sekarang
            </button>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-16 px-6" id="tentang">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white/95 backdrop-blur-md rounded-3xl shadow-2xl p-8 md:p-12 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-8 text-gray-800">
                    Tentang Twibbonizer
                </h2>

                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    Twibbonizer adalah platform yang dikembangkan khusus untuk membantu mahasiswa dan komunitas dalam
                    membuat twibbon dengan mudah dan gratis. Tanpa perlu software rumit atau keahlian desain, siapa pun
                    dapat membuat twibbon berkualitas profesional.
                </p>

                <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                    Kami percaya bahwa setiap orang berhak mendapatkan akses ke tools kreatif yang berkualitas tanpa
                    harus mengeluarkan biaya. Oleh karena itu, Twibbonizer hadir sebagai solusi yang sepenuhnya gratis
                    dan mudah digunakan.
                </p>

                <div
                    class="inline-block bg-gradient-to-r from-primary-500 to-purple-600 text-white px-8 py-4 rounded-full font-semibold text-lg">
                    Dikembangkan oleh HIMASI Universitas Subang
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-16 px-6 text-white text-center" id="kontak">
        <div class="max-w-2xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 drop-shadow-lg">
                Hubungi Kami
            </h2>
            <p class="text-lg mb-8 opacity-90">
                Ada pertanyaan atau saran? Jangan ragu untuk menghubungi tim kami!
            </p>
            <a href="mailto:himasi@unsub.ac.id" target="_blank" rel="noopener noreferrer"
                class="inline-block bg-white/20 backdrop-blur-sm text-white px-8 py-3 border-2 border-white rounded-full font-semibold hover:bg-white hover:text-primary-500 transition-all duration-300">
                Kirim Email
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black/80 text-white text-center py-8">
        <div class="max-w-4xl mx-auto px-6">
            <p class="opacity-80">
                &copy; {{ date('Y') }} Twibbonizer. Semua hak cipta dilindungi.
                <br class="md:hidden">
                Dibuat dengan <span class="text-red-400">❤️</span> oleh HIMASI Universitas Subang
            </p>
        </div>
    </footer>

    <script>
        function startCreating() {
            // alert('Fitur upload akan segera tersedia! Terima kasih atas minat Anda menggunakan Twibbonizer.');
            window.location.href = "{{ url('/twibbonizer/client/register') }}";
        }

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Close mobile menu when clicking on a link
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Header background change on scroll
        window.addEventListener('scroll', () => {
            const header = document.getElementById('header');
            if (window.scrollY > 100) {
                header.classList.remove('bg-white/95');
                header.classList.add('bg-white/98');
            } else {
                header.classList.remove('bg-white/98');
                header.classList.add('bg-white/95');
            }
        });

        // Trigger animations when elements come into view
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                }
            });
        }, observerOptions);

        // Observe all animated elements
        document.querySelectorAll('.animate-fade-in-up, .animate-fade-in-up-delay-1, .animate-fade-in-up-delay-2').forEach(
            el => {
                observer.observe(el);
            });
    </script>
    </body>

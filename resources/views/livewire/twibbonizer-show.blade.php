<div class="font-sans bg-gradient-to-br from-primary-500 to-purple-600 min-h-screen">

    <div x-data="twibbonEditor('{{ asset('storage/' . $twibbon->file) }}', '{{ Str::slug($twibbon->nama, '_') }}', '{{ $twibbon->keterangan }}')" x-init="init()" class="min-h-screen flex flex-col">

        <!-- Header -->
        <header class="bg-white/95 backdrop-blur-md shadow-lg">
            <nav class="max-w-6xl mx-auto px-6 flex justify-between items-center py-4">
                <div>
                    <a href="#"
                        class="text-3xl font-bold text-primary-500 hover:text-primary-600 transition-colors">
                        Twibbonizer
                    </a>
                </div>
                <button onclick="goHome()"
                    class="bg-primary-500 hover:bg-primary-600 text-white px-4 py-2 rounded-lg transition-colors">
                    Kembali
                </button>
            </nav>
        </header>

        <!-- Main Content -->
        <main class="flex-grow py-8">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid lg:grid-cols-3 gap-8">

                    <!-- Preview Section -->
                    <div class="lg:col-span-2">
                        <div class="bg-white/95 backdrop-blur-md rounded-3xl shadow-2xl p-6 md:p-8">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Preview Twibbon</h2>

                            <!-- Canvas Container -->
                            <div class="relative bg-gray-100 rounded-2xl overflow-hidden flex justify-center"
                                style="max-width: 500px; margin: 0 auto;">
                                <canvas x-ref="canvas" width="1080" height="1080"
                                    class="max-w-full h-auto rounded-2xl shadow-lg">
                                </canvas>
                            </div>

                            {{-- <!-- Download Button -->
                            <div class="mt-8 text-center">
                                <button @click="download()" :disabled="!image"
                                    :class="image ?
                                        'bg-gradient-to-r from-accent-500 to-accent-600 hover:shadow-xl hover:-translate-y-1' :
                                        'bg-gray-400 cursor-not-allowed'"
                                    class="text-white px-8 py-3 rounded-full text-lg font-semibold transition-all duration-300 shadow-lg disabled:opacity-50">
                                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    Unduh Twibbon
                                </button>
                            </div> --}}
                            <!-- Download & Share Buttons -->
                            <div
                                class="mt-8 text-center space-y-4 flex flex-col md:flex-row md:justify-center md:space-x-4 md:space-y-0">
                                <!-- Download -->
                                <button @click="download()" :disabled="!image"
                                    :class="image ?
                                        'bg-gradient-to-r from-accent-500 to-accent-600 hover:shadow-xl hover:-translate-y-1' :
                                        'bg-gray-400 cursor-not-allowed'"
                                    class="flex items-center justify-center text-white px-8 py-3 rounded-full text-lg font-semibold transition-all duration-300 shadow-lg disabled:opacity-50 align-middle content-center">
                                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    Unduh Twibbon
                                </button>

                                <!-- Share -->
                                <div x-data="{ open: false }" class="relative inline-block text-left">
                                    <div>
                                        <button @click="open = !open" :disabled="!image"
                                            :class="image
                                                ?
                                                'bg-gradient-to-r from-green-500 to-green-600 hover:shadow-xl hover:-translate-y-1' :
                                                'bg-gray-400 cursor-not-allowed'"
                                            class="flex items-center justify-center w-full text-white px-8 py-3 rounded-full text-lg font-semibold transition-all duration-300 shadow-lg disabled:opacity-50 gap-2">

                                            <!-- Icon kiri -->
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 8a3 3 0 10-6 0v2a3 3 0 006 0V8zM19 12a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>

                                            <!-- Teks -->
                                            <span>Bagikan</span>

                                            <!-- Icon panah dropdown -->
                                            <svg class="w-5 h-5 transform transition-transform duration-300"
                                                :class="open ? 'rotate-180' : 'rotate-0'"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Dropdown versi Desktop -->
                                    <div x-show="open" @click.away="open = false"
                                        class="hidden md:block absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg ring-1 ring-black ring-opacity-5 z-50">
                                        <div class="py-1">
                                            <button @click="shareTo('whatsapp')"
                                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">WhatsApp</button>
                                            <button @click="shareTo('facebook')"
                                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Facebook</button>
                                            <button @click="shareTo('twitter')"
                                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Twitter
                                                / X</button>
                                            <button @click="shareTo('telegram')"
                                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Telegram</button>
                                            <button @click="shareTo('instagram')"
                                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Instagram</button>
                                            <button @click="shareTo('intent')"
                                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Android
                                                Share Intent</button>
                                        </div>
                                    </div>

                                    <!-- Modal versi Mobile -->
                                    <div x-show="open" x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                        x-transition:leave="transition ease-in duration-200"
                                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                        @click.away="open = false"
                                        class="block md:hidden fixed inset-0 z-50 flex items-end bg-black/10 rounded-2xl">

                                        <div x-transition:enter="transform transition ease-out duration-300"
                                            x-transition:enter-start="translate-y-full"
                                            x-transition:enter-end="translate-y-0"
                                            x-transition:leave="transform transition ease-in duration-200"
                                            x-transition:leave-start="translate-y-0"
                                            x-transition:leave-end="translate-y-full"
                                            class="bg-white w-full rounded-2xl shadow-lg p-6">

                                            <h2 class="text-lg font-semibold text-gray-800 mb-4 text-center">Bagikan ke
                                            </h2>
                                            <div class="flex flex-col gap-2">
                                                <button @click="shareTo('whatsapp'); open = false"
                                                    class="w-full px-4 py-2 rounded-lg bg-green-500 text-white">WhatsApp</button>
                                                <button @click="shareTo('facebook'); open = false"
                                                    class="w-full px-4 py-2 rounded-lg bg-blue-600 text-white">Facebook</button>
                                                <button @click="shareTo('twitter'); open = false"
                                                    class="w-full px-4 py-2 rounded-lg bg-sky-500 text-white">Twitter /
                                                    X</button>
                                                <button @click="shareTo('telegram'); open = false"
                                                    class="w-full px-4 py-2 rounded-lg bg-cyan-500 text-white">Telegram</button>
                                                <button @click="shareTo('instagram'); open = false"
                                                    class="w-full px-4 py-2 rounded-lg bg-pink-500 text-white">Instagram</button>
                                                <button @click="shareTo('intent'); open = false"
                                                    class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white">Android
                                                    Share Intent</button>
                                            </div>
                                            <button @click="open = false"
                                                class="mt-4 w-full px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Controls Section -->
                    <div class="space-y-6">

                        <!-- Upload Section -->
                        <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-lg p-6" x-show="!image"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-4">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-primary-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                    </path>
                                </svg>
                                Pilih Foto
                            </h3>

                            <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-primary-500 transition-colors cursor-pointer"
                                @click="$refs.fileInput.click()" @drop.prevent="handleDrop($event)" @dragover.prevent
                                @dragenter.prevent="$event.target.classList.add('border-primary-500', 'bg-primary-50')"
                                @dragleave.prevent="$event.target.classList.remove('border-primary-500', 'bg-primary-50')">
                                <input x-ref="fileInput" type="file" @change="loadFile($event)" accept="image/*"
                                    class="hidden">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <p class="text-gray-600 mb-2">Klik untuk memilih foto</p>
                                <p class="text-sm text-gray-500">Atau drag & drop file di sini</p>
                                <p class="text-xs text-gray-400 mt-2">Format: JPG, PNG, WebP (Max 2MB)</p>
                            </div>
                        </div>

                        <!-- Size Control -->
                        <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-lg p-6" x-show="image"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-4" x-data="{
                                min: 0.3,
                                max: 3,
                                step: 0.3,
                                get steps() {
                                    let arr = [];
                                    for (let v = this.min; v <= this.max + 0.0001; v += this.step) { arr.push(parseFloat(v.toFixed(2))); }
                                    return arr;
                                }
                            }">

                            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-primary-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 8V4m0 0h4M4 4l5 5m11-5h-4m4 0v4m0-4l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                                </svg>
                                Atur Ukuran
                            </h3>

                            <div class="mb-4 relative">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Ukuran: <span x-text="Math.round(scale * 100) + '%'"></span>
                                </label>

                                <!-- Range -->
                                <input type="range" x-model="scale" @input="render()" :min="min"
                                    :max="max" :step="step"
                                    class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-primary-500">

                                <!-- Label dinamis -->
                                <div class="relative w-full h-6 mt-2">
                                    <template x-for="val in steps" :key="val">
                                        <span class="absolute text-xs text-gray-500 -translate-x-1/2"
                                            :style="`left: ${( (val - min) / (max - min) * 100 )}%`"
                                            x-text="Math.round(val * 100) + '%'"></span>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <!-- Position Controls -->
                        <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-lg p-6" x-show="image"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-4">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-primary-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4">
                                    </path>
                                </svg>
                                Geser Posisi
                            </h3>

                            <div class="text-center">
                                <p class="text-sm font-medium text-gray-700 mb-4">Gunakan tombol atau keyboard arrow
                                </p>
                                <div class="inline-block bg-gray-100 rounded-2xl p-4">
                                    <!-- D-pad Style Controls -->
                                    <div class="grid grid-cols-3 gap-2 w-32 h-32">
                                        <div></div>
                                        <button @click="move(0, -15)"
                                            class="bg-primary-500 hover:bg-primary-600 text-white rounded-lg flex items-center justify-center transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 15l7-7 7 7"></path>
                                            </svg>
                                        </button>
                                        <div></div>

                                        <button @click="move(-15, 0)"
                                            class="bg-primary-500 hover:bg-primary-600 text-white rounded-lg flex items-center justify-center transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 19l-7-7 7-7"></path>
                                            </svg>
                                        </button>
                                        <button @click="resetPosition()"
                                            class="bg-gray-500 hover:bg-gray-600 text-white rounded-lg flex items-center justify-center transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                                </path>
                                            </svg>
                                        </button>
                                        <button @click="move(15, 0)"
                                            class="bg-primary-500 hover:bg-primary-600 text-white rounded-lg flex items-center justify-center transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </button>

                                        <div></div>
                                        <button @click="move(0, 15)"
                                            class="bg-primary-500 hover:bg-primary-600 text-white rounded-lg flex items-center justify-center transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-lg p-6" x-show="image"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-4">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-primary-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Aksi Cepat
                            </h3>

                            <div class="space-y-3">
                                <button @click="fitToFrame()"
                                    class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg transition-colors flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 8V4m0 0h4M4 4l5 5m11-5h-4m4 0v4m0-4l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4">
                                        </path>
                                    </svg>
                                    Pas ke Frame
                                </button>

                                <button @click="centerImage()"
                                    class="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg transition-colors flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z">
                                        </path>
                                    </svg>
                                    Tengahkan
                                </button>

                                <button @click="clearImage()"
                                    class="w-full bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg transition-colors flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    Hapus Foto
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

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
    </div>

    <script>
        function goHome() {
            if (confirm('Yakin ingin kembali? Perubahan yang belum disimpan akan hilang.')) {
                window.location.href = "{{ url('/twibbonizer') }}";
            }
        }

        function twibbonEditor(frameUrl, fileName, keterangan) {
            return {
                ctx: null,
                image: null,
                x: 0,
                y: 0,
                scale: 1,
                frame: null,
                canvas: null,
                fileName: fileName,
                keterangan: keterangan,

                init() {
                    this.canvas = this.$refs.canvas;
                    this.ctx = this.canvas.getContext('2d');

                    // Load twibbon frame
                    this.frame = new Image();
                    this.frame.onload = () => this.render();
                    this.frame.src = frameUrl;

                    // Add keyboard event listeners
                    this.setupKeyboardControls();
                },

                setupKeyboardControls() {
                    document.addEventListener('keydown', (e) => {
                        if (!this.image) return;

                        switch (e.key) {
                            case 'ArrowUp':
                                e.preventDefault();
                                this.move(0, -15);
                                break;
                            case 'ArrowDown':
                                e.preventDefault();
                                this.move(0, 15);
                                break;
                            case 'ArrowLeft':
                                e.preventDefault();
                                this.move(-15, 0);
                                break;
                            case 'ArrowRight':
                                e.preventDefault();
                                this.move(15, 0);
                                break;
                            case 'r':
                                if (e.ctrlKey || e.metaKey) {
                                    e.preventDefault();
                                    this.resetPosition();
                                }
                                break;
                        }
                    });
                },

                loadFile(e) {
                    const file = e.target.files[0];
                    if (!file) return;

                    // Validate file size (3MB max)
                    if (file.size > 3 * 1024 * 1024) {
                        alert('Ukuran file terlalu besar! Maksimal 3MB.');
                        return;
                    }

                    // Validate file type
                    if (!file.type.startsWith('image/')) {
                        alert('Format file tidak didukung! Gunakan JPG, PNG, atau WebP.');
                        return;
                    }

                    this.image = new Image();
                    this.image.onload = () => {
                        // Auto-fit and center the image
                        this.fitToFrame();
                    };
                    this.image.src = URL.createObjectURL(file);
                },

                handleDrop(e) {
                    e.target.classList.remove('border-primary-500', 'bg-primary-50');
                    const files = e.dataTransfer.files;
                    if (files.length > 0) {
                        this.$refs.fileInput.files = files;
                        const event = new Event('change', {
                            bubbles: true
                        });
                        this.$refs.fileInput.dispatchEvent(event);
                    }
                },

                render() {
                    if (!this.ctx) return;
                    this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

                    // Draw user image
                    if (this.image) {
                        const w = this.image.width * this.scale;
                        const h = this.image.height * this.scale;
                        this.ctx.drawImage(this.image, this.x, this.y, w, h);
                    }

                    // Draw frame overlay
                    if (this.frame) {
                        this.ctx.drawImage(this.frame, 0, 0, this.canvas.width, this.canvas.height);
                    }
                },

                move(dx, dy) {
                    if (!this.image) return;
                    this.x += dx;
                    this.y += dy;
                    this.render();
                },

                fitToFrame() {
                    if (!this.image) return;

                    // Calculate optimal scale to fit image within frame
                    const canvasRatio = this.canvas.width / this.canvas.height;
                    const imageRatio = this.image.width / this.image.height;

                    if (imageRatio > canvasRatio) {
                        // Image is wider, fit to height
                        this.scale = this.canvas.height / this.image.height;
                    } else {
                        // Image is taller, fit to width
                        this.scale = this.canvas.width / this.image.width;
                    }

                    // Center the image
                    this.centerImage();
                },

                centerImage() {
                    if (!this.image) return;

                    const w = this.image.width * this.scale;
                    const h = this.image.height * this.scale;
                    this.x = (this.canvas.width - w) / 2;
                    this.y = (this.canvas.height - h) / 2;
                    this.render();
                },

                resetPosition() {
                    if (!this.image) return;

                    this.scale = 1;
                    this.centerImage();
                },

                clearImage() {
                    if (!this.image) return;

                    if (confirm('Hapus foto yang sudah diupload?')) {
                        this.image = null;
                        this.x = 0;
                        this.y = 0;
                        this.scale = 1;
                        this.$refs.fileInput.value = '';
                        this.render();
                    }
                },

                download() {
                    if (!this.image) {
                        alert('Upload foto terlebih dahulu!');
                        return;
                    }

                    const link = document.createElement('a');
                    link.download = `${this.fileName || 'twibbon'}.png`;
                    link.href = this.canvas.toDataURL("image/png", 1.0);
                    link.click();
                },

                shareTo(platform) {
                    if (!this.image) {
                        alert("Upload foto terlebih dahulu!");
                        return;
                    }

                    this.canvas.toBlob((blob) => {
                        if (!blob) return;

                        const file = new File([blob], `${this.fileName || "twibbon"}.png`, {
                            type: "image/png"
                        });
                        const url = URL.createObjectURL(blob);
                        const shareText =
                            `${this.keterangan}\n\nDibuat dengan Twibbonizer: ${window.location.href}`;

                        switch (platform) {
                            case "whatsapp":
                                window.open(
                                    `https://wa.me/?text=${encodeURIComponent(shareText)}%20${encodeURIComponent(window.location.href)}`,
                                    "_blank");
                                break;

                            case "facebook":
                                window.open(
                                    `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.href)}`,
                                    "_blank");
                                break;

                            case "twitter":
                                window.open(
                                    `https://twitter.com/intent/tweet?text=${encodeURIComponent(shareText)}&url=${encodeURIComponent(window.location.href)}`,
                                    "_blank");
                                break;

                            case "telegram":
                                window.open(
                                    `https://t.me/share/url?url=${encodeURIComponent(window.location.href)}&text=${encodeURIComponent(shareText)}`,
                                    "_blank");
                                break;

                            case "instagram":
                                this.canvas.toBlob((blob) => {
                                    if (!blob) return;

                                    const url = URL.createObjectURL(blob);

                                    // Auto download foto
                                    const link = document.createElement("a");
                                    link.href = url;
                                    link.download = `${this.fileName || "twibbon"}.png`;
                                    link.click();

                                    // Copy caption otomatis
                                    const caption = `${encodeURIComponent(shareText)}`;
                                    navigator.clipboard.writeText(caption)
                                        .then(() => {
                                            alert(
                                                "✅ Twibbon otomatis terunduh!\n📋 Caption juga sudah disalin, tinggal paste di Instagram."
                                            );
                                        })
                                        .catch(() => {
                                            alert(
                                                "Twibbon terunduh, tapi gagal menyalin caption. Silakan copy manual."
                                            );
                                        });
                                }, "image/png");
                                break;


                            case "intent":
                                if (navigator.share) {
                                    navigator.share({
                                        title: "Twibbonizer",
                                        text: shareText,
                                        url: window.location.href,
                                        files: [file] // Android 13+ support share file
                                    }).catch((err) => console.error("Share gagal:", err));
                                } else {
                                    alert("Browser tidak mendukung Web Share API");
                                }
                                break;

                            case "download":
                                const link = document.createElement("a");
                                link.href = url;
                                link.download = `${this.fileName || "twibbon"}.png`;
                                link.click();
                                break;
                        }
                    }, "image/png");
                }
            }
        }
    </script>
</div>

<div class="font-sans bg-gradient-to-br from-primary-500 to-purple-600 min-h-screen">

    <div x-data="twibbonEditor('{{ asset('storage/' . $twibbon->file) }}', '{{ Str::slug($twibbon->nama, '_') }}', '{{ strip_tags($twibbon->keterangan) }}', '{{ $twibbon->nama }}')" x-init="init()" class="min-h-screen flex flex-col">

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

                <!-- Twibbon Title Section -->
                <div class="text-center mb-8">
                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                        {{ $twibbon->nama }}
                    </h1>
                </div>

                <div class="grid lg:grid-cols-3 gap-8">

                    <!-- Preview Section -->
                    <div class="lg:col-span-2">
                        <div class="bg-white/95 backdrop-blur-md rounded-3xl shadow-2xl p-6 md:py-8 md:px-0">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Preview Twibbon</h2>

                            <!-- Canvas Container -->
                            <div class="relative bg-gray-100 rounded-2xl overflow-hidden flex justify-center"
                                style="max-width: 500px; margin: 0 auto;">
                                <canvas x-ref="canvas" width="1080" height="1080"
                                    class="max-w-full h-auto rounded-2xl shadow-lg">
                                </canvas>
                            </div>

                            <!-- Download & Share Buttons -->
                            <div
                                class="mt-8 text-center space-y-4 flex flex-col md:flex-row md:justify-center md:space-x-4 md:space-y-0">
                                <!-- Download -->
                                <button @click="showDownloadModal = true" :disabled="!image"
                                    :class="image ?
                                        'bg-gradient-to-r from-accent-500 to-accent-600 hover:shadow-xl hover:-translate-y-1' :
                                        'bg-gray-400 cursor-not-allowed'"
                                    class="flex items-center justify-center text-white px-8 py-3 rounded-full text-lg font-semibold transition-all duration-300 shadow-lg disabled:opacity-50">
                                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    Unduh Twibbon
                                </button>

                                <!-- Share -->
                                {{-- <div x-data="{ open: false }" class="relative inline-block text-left">
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
                                </div> --}}
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
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <p class="text-gray-600 mb-2">Klik untuk memilih foto</p>
                                <p class="text-sm text-gray-500">Atau drag & drop file di sini</p>
                                <p class="text-xs text-gray-400 mt-2">Format: JPG, PNG, WebP (Max 2MB)</p>
                            </div>
                        </div>

                        <!-- Upload Section -->
                        {{-- <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-lg p-6" x-show="!image"
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
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <p class="text-gray-600 mb-2">Klik untuk memilih foto</p>
                                <p class="text-sm text-gray-500">Atau drag & drop file di sini</p>
                                <p class="text-xs text-gray-400 mt-2">Format: JPG, PNG, WebP (Max 3MB)</p>
                            </div>
                        </div> --}}

                        <!-- Cropper Section -->
                        {{-- <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-lg p-6" x-show="showCropper"
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
                                        d="M4 8V4m0 0h4M4 4l5 5m11-5h-4m4 0v4m0-4l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4">
                                    </path>
                                </svg>
                                Sesuaikan Foto
                            </h3>

                            <!-- Cropper Container -->
                            <div class="mb-4" style="max-height: 400px; overflow: hidden;">
                                <img x-ref="cropperImage" class="max-w-full block" style="max-height: 400px;"
                                    alt="Image to crop">
                            </div>

                            <!-- Cropper Controls -->
                            <div class="flex flex-wrap gap-2 justify-center">
                                <button @click="cropperZoomIn()"
                                    class="px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-lg transition-colors">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7">
                                        </path>
                                    </svg>
                                    Zoom In
                                </button>
                                <button @click="cropperZoomOut()"
                                    class="px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-lg transition-colors">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM13 10H7"></path>
                                    </svg>
                                    Zoom Out
                                </button>
                                <button @click="cropperRotateLeft()"
                                    class="px-3 py-2 bg-purple-500 hover:bg-purple-600 text-white text-sm rounded-lg transition-colors">
                                    ↺ Putar Kiri
                                </button>
                                <button @click="cropperRotateRight()"
                                    class="px-3 py-2 bg-purple-500 hover:bg-purple-600 text-white text-sm rounded-lg transition-colors">
                                    ↻ Putar Kanan
                                </button>
                                <button @click="cropperReset()"
                                    class="px-3 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm rounded-lg transition-colors">
                                    Reset
                                </button>
                                <button @click="applyCrop()"
                                    class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white text-sm rounded-lg transition-colors font-medium">
                                    ✓ Terapkan
                                </button>
                                <button @click="cancelCrop()"
                                    class="px-3 py-2 bg-red-500 hover:bg-red-600 text-white text-sm rounded-lg transition-colors">
                                    ✕ Batal
                                </button>
                            </div>
                        </div> --}}

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

                        <!-- Edit Controls -->
                        {{-- <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-lg p-6"
                            x-show="image && !showCropper" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-4">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-primary-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Edit Foto
                            </h3>

                            <div class="space-y-4">
                                <button @click="editImage()"
                                    class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 px-4 rounded-lg transition-colors flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 8V4m0 0h4M4 4l5 5m11-5h-4m4 0v4m0-4l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4">
                                        </path>
                                    </svg>
                                    Edit Ulang Foto
                                </button>
                            </div>
                        </div> --}}

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
                        <!-- Quick Actions -->
                        {{-- <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-lg p-6"
                            x-show="image && !showCropper" x-transition:enter="transition ease-out duration-300"
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
                        </div> --}}
                    </div>
                </div>
            </div>
        </main>

        <!-- Download Modal -->
        <div x-show="showDownloadModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click.away="showDownloadModal = false"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">

            <div x-transition:enter="transform transition ease-out duration-300"
                x-transition:enter-start="scale-95 opacity-0" x-transition:enter-end="scale-100 opacity-100"
                x-transition:leave="transform transition ease-in duration-200"
                x-transition:leave-start="scale-100 opacity-100" x-transition:leave-end="scale-95 opacity-0"
                class="bg-white rounded-2xl shadow-2xl max-w-md w-full max-h-[90vh] overflow-y-auto">

                <!-- Modal Header -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-bold text-gray-800">Twibbon Siap Diunduh!</h3>
                        <button @click="showDownloadModal = false" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-6 space-y-6">

                    <!-- Caption Section -->
                    <div class="bg-gray-50 rounded-xl p-4">
                        <h4 class="font-semibold text-gray-800 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                            Caption untuk Media Sosial:
                        </h4>
                        <div class="bg-white border rounded-lg p-3 text-sm text-gray-700 relative">
                            <p x-text="getShareCaption()"></p>
                            <button @click="copyCaption()"
                                class="absolute top-2 right-2 text-gray-400 hover:text-primary-500"
                                title="Copy Caption">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Caption akan otomatis disalin saat membagikan</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-3">

                        <!-- Direct Download Button -->
                        <button @click="download(); showDownloadModal = false"
                            class="w-full bg-gradient-to-r from-accent-500 to-accent-600 hover:shadow-xl hover:-translate-y-0.5 text-white py-3 px-4 rounded-xl font-semibold transition-all duration-300 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Unduh Langsung
                        </button>

                        <!-- Separator -->
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500">atau bagikan ke</span>
                            </div>
                        </div>

                        <!-- Share Options Grid -->
                        <div class="grid grid-cols-2 gap-3">

                            <!-- WhatsApp -->
                            <button @click="shareToFromModal('whatsapp')"
                                class="flex items-center justify-center py-3 px-4 bg-green-500 hover:bg-green-600 text-white rounded-xl font-medium transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.520-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" />
                                </svg>
                                WhatsApp
                            </button>

                            <!-- Facebook -->
                            <button @click="shareToFromModal('facebook')"
                                class="flex items-center justify-center py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                                Facebook
                            </button>

                            <!-- Twitter -->
                            <button @click="shareToFromModal('twitter')"
                                class="flex items-center justify-center py-3 px-4 bg-sky-500 hover:bg-sky-600 text-white rounded-xl font-medium transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                </svg>
                                Twitter
                            </button>

                            <!-- Telegram -->
                            <button @click="shareToFromModal('telegram')"
                                class="flex items-center justify-center py-3 px-4 bg-cyan-500 hover:bg-cyan-600 text-white rounded-xl font-medium transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z" />
                                </svg>
                                Telegram
                            </button>

                            <!-- Instagram -->
                            <button @click="shareToFromModal('instagram')"
                                class="flex items-center justify-center py-3 px-4 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white rounded-xl font-medium transition-all">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                                Instagram
                            </button>

                            <!-- Android Share -->
                            <button @click="shareToFromModal('intent')"
                                class="flex items-center justify-center py-3 px-4 bg-gray-700 hover:bg-gray-800 text-white rounded-xl font-medium transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z">
                                    </path>
                                </svg>
                                Lainnya
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="p-6 bg-gray-50 rounded-b-2xl">
                    <button @click="showDownloadModal = false"
                        class="w-full py-2 px-4 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl font-medium transition-colors">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

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

        // function twibbonEditor(frameUrl, fileName, keterangan, twibbonTitle) {
        //     return {
        //         ctx: null,
        //         image: null,
        //         croppedImage: null,
        //         cropper: null,
        //         showCropper: false,
        //         frame: null,
        //         canvas: null,
        //         fileName: fileName,
        //         keterangan: keterangan,
        //         twibbonTitle: twibbonTitle,
        //         showDownloadModal: false,
        //         cropperReady: false,

        //         init() {
        //             this.canvas = this.$refs.canvas;
        //             this.ctx = this.canvas.getContext('2d');
        //             this.frame = new Image();
        //             this.frame.onload = () => this.render();
        //             this.frame.src = frameUrl;
        //             this.setupKeyboardControls();
        //             if (typeof Cropper === 'undefined') {
        //                 alert('Editor foto tidak tersedia. Silakan refresh halaman.');
        //             }
        //         },

        //         setupKeyboardControls() {
        //             document.addEventListener('keydown', (e) => {
        //                 if (this.showDownloadModal || this.showCropper) return;
        //                 switch (e.key) {
        //                     case 'Escape':
        //                         if (this.showDownloadModal) {
        //                             e.preventDefault();
        //                             this.showDownloadModal = false;
        //                         } else if (this.showCropper) {
        //                             e.preventDefault();
        //                             this.cancelCrop();
        //                         }
        //                         break;
        //                 }
        //             });
        //         },

        //         loadFile(e) {
        //             const file = e.target.files[0];
        //             if (!file) return;
        //             if (file.size > 3 * 1024 * 1024) {
        //                 alert('Ukuran file terlalu besar! Maksimal 3MB.');
        //                 return;
        //             }
        //             if (!file.type.startsWith('image/')) {
        //                 alert('Format file tidak didukung! Gunakan JPG, PNG, atau WebP.');
        //                 return;
        //             }
        //             const url = URL.createObjectURL(file);
        //             this.cropperReady = false;
        //             this.destroyCropper();
        //             this.showCropper = true;
        //             this.$nextTick(() => {
        //                 this.setupCropperImage(url);
        //             });
        //         },

        //         setupCropperImage(url) {
        //             const img = this.$refs.cropperImage;
        //             if (!img) return;
        //             img.onload = () => {
        //                 setTimeout(() => {
        //                     this.initCropper();
        //                 }, 200);
        //             };
        //             img.onerror = () => {
        //                 alert('Gagal memuat gambar. Silakan coba lagi.');
        //             };
        //             img.src = url;
        //         },

        //         initCropper() {
        //             if (typeof Cropper === 'undefined') {
        //                 alert('Editor foto tidak tersedia.');
        //                 return;
        //             }
        //             const img = this.$refs.cropperImage;
        //             if (!img) return;
        //             if (!img.complete || !img.naturalWidth) {
        //                 img.onload = () => this.initCropper();
        //                 return;
        //             }
        //             this.destroyCropper();
        //             try {
        //                 this.cropper = new Cropper(img, {
        //                     aspectRatio: 1,
        //                     viewMode: 1,
        //                     dragMode: 'move',
        //                     autoCropArea: 0.8,
        //                     restore: false,
        //                     guides: true,
        //                     center: true,
        //                     highlight: false,
        //                     cropBoxMovable: true,
        //                     cropBoxResizable: true,
        //                     toggleDragModeOnDblclick: false,
        //                     responsive: true,
        //                     checkOrientation: false,
        //                     modal: true,
        //                     background: true,
        //                     ready: () => {
        //                         this.cropperReady = true;
        //                     }
        //                 });
        //             } catch (error) {
        //                 alert('Gagal menginisialisasi editor foto. Silakan refresh halaman.');
        //                 this.cropper = null;
        //                 this.cropperReady = false;
        //             }
        //         },

        //         destroyCropper() {
        //             if (this.cropper) {
        //                 try {
        //                     this.cropper.destroy();
        //                 } catch (error) {}
        //                 this.cropper = null;
        //             }
        //             this.cropperReady = false;
        //         },

        //         // Cropper control methods (refactored to use set/getData for rotate)
        //         cropperRotateLeft() {
        //             if (this.cropperReady && this.cropper) {
        //                 // Get current data
        //                 const data = this.cropper.getData();
        //                 // Set new rotate value
        //                 this.cropper.setData({
        //                     rotate: (data.rotate || 0) - 90
        //                 });
        //             } else {
        //                 alert('Editor foto belum siap. Tunggu sebentar lalu coba lagi.');
        //             }
        //         },

        //         cropperRotateRight() {
        //             if (this.cropperReady && this.cropper) {
        //                 const data = this.cropper.getData();
        //                 this.cropper.setData({
        //                     rotate: (data.rotate || 0) + 90
        //                 });
        //             } else {
        //                 alert('Editor foto belum siap. Tunggu sebentar lalu coba lagi.');
        //             }
        //         },

        //         cropperZoomIn() {
        //             if (this.cropperReady && this.cropper) {
        //                 this.cropper.zoom(0.1);
        //             } else {
        //                 alert('Editor foto belum siap. Tunggu sebentar lalu coba lagi.');
        //             }
        //         },

        //         cropperZoomOut() {
        //             if (this.cropperReady && this.cropper) {
        //                 this.cropper.zoom(-0.1);
        //             } else {
        //                 alert('Editor foto belum siap. Tunggu sebentar lalu coba lagi.');
        //             }
        //         },

        //         cropperReset() {
        //             if (this.cropperReady && this.cropper) {
        //                 this.cropper.reset();
        //             } else {
        //                 alert('Editor foto belum siap. Tunggu sebentar lalu coba lagi.');
        //             }
        //         },

        //         applyCrop() {
        //             if (!this.cropperReady || !this.cropper) {
        //                 alert('Editor foto belum siap. Tunggu sebentar lalu coba lagi.');
        //                 return;
        //             }
        //             try {
        //                 const croppedCanvas = this.cropper.getCroppedCanvas({
        //                     width: 1080,
        //                     height: 1080,
        //                     imageSmoothingEnabled: true,
        //                     imageSmoothingQuality: 'high',
        //                 });
        //                 if (!croppedCanvas) throw new Error('Failed to get cropped canvas');
        //                 const croppedDataUrl = croppedCanvas.toDataURL('image/png', 1.0);
        //                 this.croppedImage = new Image();
        //                 this.croppedImage.onload = () => {
        //                     this.image = this.croppedImage;
        //                     this.showCropper = false;
        //                     this.destroyCropper();
        //                     this.render();
        //                 };
        //                 this.croppedImage.onerror = () => {
        //                     alert('Gagal memproses foto. Silakan coba lagi.');
        //                 };
        //                 this.croppedImage.src = croppedDataUrl;
        //             } catch (error) {
        //                 alert('Gagal memotong foto. Silakan coba lagi.');
        //             }
        //         },

        //         cancelCrop() {
        //             this.destroyCropper();
        //             this.showCropper = false;
        //             if (this.$refs.fileInput) {
        //                 this.$refs.fileInput.value = '';
        //             }
        //         },

        //         editImage() {
        //             if (!this.image) return;
        //             this.cropperReady = false;
        //             this.destroyCropper();
        //             this.showCropper = true;
        //             this.$nextTick(() => {
        //                 this.setupCropperImage(this.image.src);
        //             });
        //         },

        //         render() {
        //             if (!this.ctx) return;
        //             this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        //             if (this.image) {
        //                 this.ctx.drawImage(this.image, 0, 0, this.canvas.width, this.canvas.height);
        //             }
        //             if (this.frame) {
        //                 this.ctx.drawImage(this.frame, 0, 0, this.canvas.width, this.canvas.height);
        //             }
        //         },

        //         clearImage() {
        //             if (!this.image && !this.showCropper) return;
        //             if (confirm('Hapus foto yang sudah diupload?')) {
        //                 this.destroyCropper();
        //                 this.image = null;
        //                 this.croppedImage = null;
        //                 this.showCropper = false;
        //                 if (this.$refs.fileInput) {
        //                     this.$refs.fileInput.value = '';
        //                 }
        //                 this.render();
        //             }
        //         },

        //         getShareCaption() {
        //             return `${this.keterangan}\n\nDibuat dengan Twibbonizer: ${window.location.href}`;
        //         },

        //         copyCaption() {
        //             const caption = this.getShareCaption();
        //             navigator.clipboard.writeText(caption)
        //                 .then(() => {
        //                     alert('Caption berhasil disalin!');
        //                 })
        //                 .catch(() => {
        //                     alert('Gagal menyalin caption. Silakan copy manual.');
        //                 });
        //         },

        //         download() {
        //             if (!this.image) {
        //                 alert('Upload foto terlebih dahulu!');
        //                 return;
        //             }
        //             const link = document.createElement('a');
        //             link.download = `${this.fileName || 'twibbon'}.png`;
        //             link.href = this.canvas.toDataURL("image/png", 1.0);
        //             link.click();
        //         },

        //         shareToFromModal(platform) {
        //             this.showDownloadModal = false;
        //             setTimeout(() => {
        //                 this.shareTo(platform);
        //             }, 300);
        //         },

        //         shareTo(platform) {
        //             if (!this.image) {
        //                 alert("Upload foto terlebih dahulu!");
        //                 return;
        //             }
        //             this.canvas.toBlob((blob) => {
        //                 if (!blob) return;
        //                 const file = new File([blob], `${this.fileName || "twibbon"}.png`, {
        //                     type: "image/png"
        //                 });
        //                 const url = URL.createObjectURL(blob);
        //                 const shareText = this.getShareCaption();
        //                 switch (platform) {
        //                     case "whatsapp":
        //                         window.open(`https://wa.me/?text=${encodeURIComponent(shareText)}`, "_blank");
        //                         break;
        //                     case "facebook":
        //                         window.open(
        //                             `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.href)}&quote=${encodeURIComponent(shareText)}`,
        //                             "_blank");
        //                         break;
        //                     case "twitter":
        //                         window.open(
        //                             `https://twitter.com/intent/tweet?text=${encodeURIComponent(shareText)}`,
        //                             "_blank");
        //                         break;
        //                     case "telegram":
        //                         window.open(
        //                             `https://t.me/share/url?url=${encodeURIComponent(window.location.href)}&text=${encodeURIComponent(shareText)}`,
        //                             "_blank");
        //                         break;
        //                     case "instagram":
        //                         const link = document.createElement("a");
        //                         link.href = url;
        //                         link.download = `${this.fileName || "twibbon"}.png`;
        //                         link.click();
        //                         navigator.clipboard.writeText(shareText)
        //                             .then(() => {
        //                                 alert(
        //                                     "✅ Twibbon otomatis terunduh!\n📋 Caption juga sudah disalin, tinggal paste di Instagram."
        //                                     );
        //                             })
        //                             .catch(() => {
        //                                 alert(
        //                                     "Twibbon terunduh, tapi gagal menyalin caption. Silakan copy manual."
        //                                     );
        //                             });
        //                         break;
        //                     case "intent":
        //                         if (navigator.share) {
        //                             navigator.share({
        //                                 title: this.twibbonTitle || "Twibbonizer",
        //                                 text: shareText,
        //                                 url: window.location.href,
        //                                 files: [file]
        //                             }).catch((err) => console.error("Share gagal:", err));
        //                         } else {
        //                             alert("Browser tidak mendukung Web Share API");
        //                         }
        //                         break;
        //                 }
        //             }, "image/png");
        //         },

        //         handleDrop(e) {
        //             e.target.classList.remove('border-primary-500', 'bg-primary-50');
        //             const files = e.dataTransfer.files;
        //             if (files.length > 0) {
        //                 this.$refs.fileInput.files = files;
        //                 const event = new Event('change', {
        //                     bubbles: true
        //                 });
        //                 this.$refs.fileInput.dispatchEvent(event);
        //             }
        //         }
        //     }
        // }

        function twibbonEditor(frameUrl, fileName, keterangan, twibbonTitle) {
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
                twibbonTitle: twibbonTitle,
                showDownloadModal: false,

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
                        if (!this.image || this.showDownloadModal) return;

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
                            case 'Escape':
                                if (this.showDownloadModal) {
                                    e.preventDefault();
                                    this.showDownloadModal = false;
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
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            icon: 'error',
                            title: 'Ukuran file terlalu besar!',
                            text: 'Maksimal 3MB.',
                        });
                        return;
                    }

                    // Validate file type
                    if (!file.type.startsWith('image/')) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            icon: 'error',
                            title: 'Format file tidak didukung!',
                            text: 'Gunakan JPG, PNG, atau WebP.',
                        });
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

                    Swal.fire({
                        title: 'Hapus foto yang sudah diupload?',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal',
                        icon: 'warning'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.image = null;
                            this.x = 0;
                            this.y = 0;
                            this.scale = 1;
                            if (this.$refs.fileInput) {
                                this.$refs.fileInput.value = '';
                            }
                            this.render();
                        }
                    });

                },

                getShareCaption() {
                    return `${this.keterangan}\n\nDibuat dengan Twibbonizer: ${window.location.href}`;
                },

                copyCaption() {
                    const caption = this.getShareCaption();
                    navigator.clipboard.writeText(caption)
                        .then(() => {
                            // Simple feedback - you could enhance this with a toast notification
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                                icon: 'success',
                                title: 'Caption berhasil disalin!',
                            });
                        })
                        .catch(() => {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                                icon: 'error',
                                title: 'Gagal menyalin caption.',
                                text: 'Silakan copy manual.',
                            });
                        });
                },

                download() {
                    if (!this.image) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            icon: 'error',
                            title: 'Upload foto terlebih dahulu!',
                        });
                        return;
                    }

                    const link = document.createElement('a');
                    link.download = `${this.fileName || 'twibbon'}.png`;
                    link.href = this.canvas.toDataURL("image/png", 1.0);
                    link.click();
                },

                shareToFromModal(platform) {
                    this.showDownloadModal = false;
                    setTimeout(() => {
                        this.shareTo(platform);
                    }, 300);
                },

                shareTo(platform) {
                    if (!this.image) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            icon: 'error',
                            title: 'Upload foto terlebih dahulu!',
                        });
                        return;
                    }

                    this.canvas.toBlob((blob) => {
                        if (!blob) return;

                        const file = new File([blob], `${this.fileName || "twibbon"}.png`, {
                            type: "image/png"
                        });
                        const url = URL.createObjectURL(blob);
                        const shareText = this.getShareCaption();

                        switch (platform) {
                            case "whatsapp":
                                window.open(
                                    `https://wa.me/?text=${encodeURIComponent(shareText)}`,
                                    "_blank");
                                break;

                            case "facebook":
                                window.open(
                                    `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.href)}&quote=${encodeURIComponent(shareText)}`,
                                    "_blank");
                                break;

                            case "twitter":
                                window.open(
                                    `https://twitter.com/intent/tweet?text=${encodeURIComponent(shareText)}`,
                                    "_blank");
                                break;

                            case "telegram":
                                window.open(
                                    `https://t.me/share/url?url=${encodeURIComponent(window.location.href)}&text=${encodeURIComponent(shareText)}`,
                                    "_blank");
                                break;

                            case "instagram":
                                // Auto download foto dan copy caption
                                const link = document.createElement("a");
                                link.href = url;
                                link.download = `${this.fileName || "twibbon"}.png`;
                                link.click();

                                // Copy caption otomatis
                                navigator.clipboard.writeText(shareText)
                                    .then(() => {
                                        Swal.fire({
                                            toast: true,
                                            position: 'top-end',
                                            timer: 5000,
                                            timerProgressBar: true,
                                            showConfirmButton: false,
                                            icon: 'success',
                                            title: '✅ Twibbon otomatis terunduh!\n📋 Caption juga sudah disalin, tinggal paste di Instagram.',
                                        });
                                    })
                                    .catch(() => {
                                        Swal.fire({
                                            toast: true,
                                            position: 'top-end',
                                            timer: 5000,
                                            timerProgressBar: true,
                                            showConfirmButton: false,
                                            icon: 'warning',
                                            title: 'Twibbon terunduh, tapi gagal menyalin caption.',
                                            text: 'Silakan copy manual.',
                                        });
                                    });
                                break;

                            case "intent":
                                if (navigator.share) {
                                    navigator.share({
                                        title: this.twibbonTitle || "Twibbonizer",
                                        text: shareText,
                                        url: window.location.href,
                                        files: [file] // Android 13+ support share file
                                    }).catch((err) => console.error("Share gagal:", err));
                                } else {
                                    Swal.fire({
                                        toast: true,
                                        position: 'top-end',
                                        timer: 3000,
                                        timerProgressBar: true,
                                        showConfirmButton: false,
                                        icon: 'error',
                                        title: 'Browser tidak mendukung Web Share API',
                                    });
                                }
                                break;

                            case "download":
                                const downloadLink = document.createElement("a");
                                downloadLink.href = url;
                                downloadLink.download = `${this.fileName || "twibbon"}.png`;
                                downloadLink.click();
                                break;
                        }
                    }, "image/png");
                }
            }
        }
    </script>
</div>

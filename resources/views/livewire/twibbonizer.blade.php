<div x-data="twibbonEditor('{{ asset('storage/' . $twibbon->file) }}', '{{ Str::slug($twibbon->nama, '_') }}')" x-init="init()">
    <div class="min-h-screen flex flex-col bg-gray-50">

        <!-- Header / Judul -->
        <header class="py-6">
            <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-[1fr,auto] gap-6">
                <!-- Judul sejajar canvas -->
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-red-600">
                        Twibbonizer
                    </h1>
                    <p class="text-gray-600 text-sm md:text-base">
                        Upload fotomu dan pasang twibbon dengan mudah
                    </p>
                </div>
            </div>
        </header>

        <!-- Konten Utama -->
        <main class="flex-grow flex items-center justify-center">
            <div class="grid grid-cols-1 md:grid-cols-[1fr,auto] gap-6 max-w-6xl w-full p-6 justify-center items-start">

                <!-- Preview -->
                <div>
                    <div class="relative">
                        <!-- Canvas dengan resolusi asli 1080x1080 -->
                        <canvas x-ref="canvas" width="1080" height="1080"
                            class="rounded-lg shadow max-w-full sm:max-w-full h-auto">
                        </canvas>
                    </div>
                </div>

                <!-- Controls -->
                <div class="flex justify-center">
                    <div class="bg-white shadow-md p-4 rounded-xl flex flex-col gap-4 w-72 h-fit">

                        <!-- Upload -->
                        <div>
                            <label class="block text-sm font-medium mb-1">Pilih Foto</label>
                            <input type="file" @change="loadFile($event)"
                                class="w-full text-sm border border-gray-300 p-2 rounded focus:ring-2 focus:ring-red-500">
                        </div>

                        <!-- Slider zoom -->
                        <div>
                            <label class="block text-sm font-medium mb-1">Atur Ukuran</label>
                            <input type="range" min="0.5" max="2" step="0.1" x-model="scale"
                                @input="render()" class="w-full accent-red-500">
                        </div>

                        <!-- Tombol Arah -->
                        <div class="flex justify-center">
                            <div class="w-52 h-52 bg-red-500 rounded-full flex items-center justify-center relative">
                                <!-- Tombol Atas -->
                                <button @click="move(0, -10)"
                                    class="absolute top-1.5 w-16 h-16 bg-red-700 text-white rounded-full flex items-center justify-center text-lg">▲</button>

                                <!-- Tombol Bawah -->
                                <button @click="move(0, 10)"
                                    class="absolute bottom-1.5 w-16 h-16 bg-red-700 text-white rounded-full flex items-center justify-center text-lg">▼</button>

                                <!-- Tombol Kiri -->
                                <button @click="move(-10, 0)"
                                    class="absolute left-1.5 w-16 h-16 bg-red-700 text-white rounded-full flex items-center justify-center text-lg">◀</button>

                                <!-- Tombol Kanan -->
                                <button @click="move(10, 0)"
                                    class="absolute right-1.5 w-16 h-16 bg-red-700 text-white rounded-full flex items-center justify-center text-lg">▶</button>
                            </div>
                        </div>

                        <!-- Unduh -->
                        <button @click="download()"
                            class="px-4 py-2 bg-red-600 text-white rounded shadow hover:bg-red-700 transition text-sm">
                            Unduh
                        </button>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="py-4 ">
            <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-[1fr,auto] gap-6">
                <!-- Footer sejajar canvas -->
                <div class="text-gray-500 text-sm">
                    © 2025 <span class="font-semibold text-red-600">HIMASI Universitas Subang</span>.
                    Dibuat dengan ❤️ dari mahasiswa untuk mahasiswa.
                </div>
            </div>
        </footer>
    </div>


    <script>
        function twibbonEditor(frameUrl, fileName) {
            return {
                ctx: null,
                image: null,
                x: 0,
                y: 0,
                scale: 1,
                frame: null,
                canvas: null,
                fileName: fileName, // nama file dari backend

                init() {
                    this.canvas = this.$refs.canvas;
                    this.ctx = this.canvas.getContext('2d');

                    // load twibbon frame
                    this.frame = new Image();
                    this.frame.onload = () => this.render();
                    this.frame.src = frameUrl;
                },

                loadFile(e) {
                    const file = e.target.files[0];
                    if (!file) return;

                    this.image = new Image();
                    this.image.onload = () => {
                        // reset posisi tengah
                        this.scale = 1;
                        const w = this.image.width;
                        const h = this.image.height;
                        this.x = (this.canvas.width - w) / 2;
                        this.y = (this.canvas.height - h) / 2;
                        this.render();
                    };
                    this.image.src = URL.createObjectURL(file);
                },

                render() {
                    if (!this.ctx) return;
                    this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

                    // gambar foto user
                    if (this.image) {
                        const w = this.image.width * this.scale;
                        const h = this.image.height * this.scale;
                        this.ctx.drawImage(this.image, this.x, this.y, w, h);
                    }

                    // gambar frame (sesuai ukuran canvas)
                    if (this.frame) {
                        this.ctx.drawImage(this.frame, 0, 0, this.canvas.width, this.canvas.height);
                    }
                },

                move(dx, dy) {
                    this.x += dx;
                    this.y += dy;
                    this.render();
                },

                download() {
                    const link = document.createElement('a');
                    link.download = `${this.fileName || 'twibbon'}.png`;
                    link.href = this.canvas.toDataURL("image/png");
                    link.click();
                }
            }
        }
    </script>
</div>

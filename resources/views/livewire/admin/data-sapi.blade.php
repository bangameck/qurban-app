<div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-primary-100 text-primary-700 rounded-xl shadow-sm">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800 tracking-wide">Data Master Sapi {{ $tahun_aktif }}</h2>
                <p class="text-sm text-gray-500 mt-1">Monitoring status proses pemotongan hewan qurban tahun ini.</p>
            </div>
        </div>
        <button wire:click="openModal" class="px-5 py-2.5 bg-primary-600 text-white font-bold rounded-xl shadow-lg shadow-primary-900/20 hover:bg-primary-700 transition transform hover:-translate-y-0.5 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Sapi
        </button>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        @php
            $stats = [
                ['label' => 'Menunggu', 'count' => \App\Models\Sapi::where('tahun', $tahun_aktif)->where('status_proses', 'Menunggu')->count(), 'color' => 'gray'],
                ['label' => 'Disembelih', 'count' => \App\Models\Sapi::where('tahun', $tahun_aktif)->where('status_proses', 'Disembelih')->count(), 'color' => 'red'],
                ['label' => 'Dikuliti', 'count' => \App\Models\Sapi::where('tahun', $tahun_aktif)->where('status_proses', 'Dikuliti')->count(), 'color' => 'amber'],
                ['label' => 'Selesai', 'count' => \App\Models\Sapi::where('tahun', $tahun_aktif)->where('status_proses', 'Selesai')->count(), 'color' => 'emerald'],
            ];
        @endphp
        @foreach($stats as $stat)
            <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm">
                <p class="text-xs font-bold text-gray-400 uppercase">{{ $stat['label'] }}</p>
                <p class="text-2xl font-black text-{{ $stat['color'] }}-600">{{ $stat['count'] }} <span class="text-sm font-medium text-gray-400">Ekor</span></p>
            </div>
        @endforeach
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden relative z-0">
        <div class="p-4 border-b border-gray-100 bg-gray-50/50">
            <input wire:model.live.debounce.300ms="search" type="text" class="w-full md:w-72 pl-4 pr-4 py-2 rounded-xl border border-gray-200 focus:border-primary-500 outline-none transition" placeholder="Cari Kode atau Jenis Sapi...">
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-700 font-bold uppercase text-xs tracking-wider border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4">Sapi</th>
                        <th class="px-6 py-4">Info Detail</th>
                        <th class="px-6 py-4">Status Proses</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($sapis as $sapi)
                        <tr class="hover:bg-primary-50/30 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <img src="{{ $sapi->path_foto_sapi ? asset('storage/'.$sapi->path_foto_sapi) : 'https://ui-avatars.com/api/?name='.$sapi->kode_sapi.'&background=random' }}" class="w-12 h-12 rounded-xl object-cover shadow-sm border border-gray-100">
                                    <div>
                                        <div class="font-black text-gray-800">{{ $sapi->kode_sapi }}</div>
                                        <div class="text-xs text-gray-400">{{ $sapi->jenis_sapi }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-gray-700 font-medium">{{ $sapi->berat }} KG <span class="text-xs text-gray-400">({{ $sapi->jenis_kelamin }})</span></div>
                                <div class="text-[10px] text-gray-400 italic">{{ $sapi->nama_peternakan ?? 'Peternakan Lokal' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColor = [
                                        'Menunggu' => 'bg-gray-100 text-gray-600',
                                        'Disembelih' => 'bg-red-100 text-red-700',
                                        'Dikuliti' => 'bg-amber-100 text-amber-700',
                                        'Selesai' => 'bg-emerald-100 text-emerald-700',
                                    ];
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $statusColor[$sapi->status_proses] }}">
                                    {{ $sapi->status_proses }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <button wire:click="openModal({{ $sapi->id }})" class="p-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-600 hover:text-white transition" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>

                                    @if($sapi->kelompok_count == 0)
                                        <button wire:click="confirmDelete({{ $sapi->id }})" class="p-2 text-red-600 bg-red-50 rounded-lg hover:bg-red-600 hover:text-white transition" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    @else
                                        <button class="p-2 text-gray-400 bg-gray-50 rounded-lg cursor-not-allowed" title="Sapi sudah terikat dengan kelompok qurban">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100 bg-gray-50">
            {{ $sapis->links() }}
        </div>
    </div>

    <div x-show="$wire.isModalOpen" style="display: none;" class="relative z-[100]">
        <div x-show="$wire.isModalOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div @click.away="$wire.closeModal()" class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:w-full sm:max-w-2xl">
                    <form wire:submit.prevent="save">
                        <div class="p-8">
                            <h3 class="text-2xl font-bold text-gray-800 mb-8 border-b pb-4">{{ $editId ? 'Edit Data Sapi' : 'Input Sapi Baru' }}</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-8">
                                
                                <div class="relative">
                                    <input type="text" id="kode_sapi" wire:model="kode_sapi" readonly class="peer block px-4 py-3 w-full text-sm text-gray-500 bg-gray-50 rounded-xl border-2 border-gray-100 appearance-none focus:outline-none focus:ring-0 focus:border-primary-600 cursor-not-allowed font-bold tracking-widest transition-all" placeholder=" " />
                                    <label for="kode_sapi" class="absolute text-sm text-gray-500 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-3 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">Kode Sapi (Otomatis)</label>
                                    @error('kode_sapi') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                                </div>

                                <div class="relative">
                                    <input type="text" id="jenis_sapi" wire:model="jenis_sapi" class="peer block px-4 py-3 w-full text-sm text-gray-900 bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-primary-600 transition-all" placeholder=" " />
                                    <label for="jenis_sapi" class="absolute text-sm text-gray-500 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-3 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">Jenis Sapi (Contoh: Limousin)</label>
                                    @error('jenis_sapi') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                                </div>

                                <div class="relative">
                                    <input type="number" id="berat" wire:model="berat" class="peer block px-4 py-3 w-full text-sm text-gray-900 bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-primary-600 transition-all" placeholder=" " />
                                    <label for="berat" class="absolute text-sm text-gray-500 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-3 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">Estimasi Berat (KG)</label>
                                    @error('berat') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                                </div>

                                <div class="relative">
                                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2 ml-1">Jenis Kelamin</label>
                                    <select wire:model="jenis_kelamin" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-gray-50 focus:bg-white focus:outline-none focus:ring-0 focus:border-primary-600 transition-all">
                                        <option value="Jantan">Jantan</option>
                                        <option value="Betina">Betina</option>
                                    </select>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-xs font-bold text-gray-400 uppercase mb-3 ml-1">Status Proses Pemotongan</label>
                                    <div class="grid grid-cols-4 gap-2">
                                        @foreach(['Menunggu', 'Disembelih', 'Dikuliti', 'Selesai'] as $status)
                                            <button type="button" wire:click="$set('status_proses', '{{ $status }}')" class="py-2.5 text-[10px] font-black rounded-xl border-2 transition-all {{ $status_proses == $status ? 'bg-primary-600 border-primary-600 text-white shadow-lg shadow-primary-900/20 scale-105' : 'border-gray-100 text-gray-400 bg-gray-50 hover:border-primary-300' }}">
                                                {{ $status }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="md:col-span-2" 
                                     x-data="{ 
                                        isCompressing: false,
                                        compressProgress: 0,
                                        get currentPreview() {
                                            if ($wire.new_image_base64) { return $wire.new_image_base64; }
                                            if ($wire.existing_image) { return '/storage/' + $wire.existing_image + '?v=' + new Date().getTime(); }
                                            return null;
                                        },
                                        async handleFile(e) {
                                            const file = e.target.files[0];
                                            if (!file) return;
                                            this.isCompressing = true;
                                            this.compressProgress = 20;
                                            const reader = new FileReader();
                                            reader.onload = (event) => {
                                                const img = new Image();
                                                img.onload = () => {
                                                    const canvas = document.createElement('canvas');
                                                    const MAX_WIDTH = 1000;
                                                    let width = img.width; let height = img.height;
                                                    if (width > MAX_WIDTH) { height *= MAX_WIDTH / width; width = MAX_WIDTH; }
                                                    this.compressProgress = 50;
                                                    canvas.width = width; canvas.height = height;
                                                    const ctx = canvas.getContext('2d'); ctx.drawImage(img, 0, 0, width, height);
                                                    const base64 = canvas.toDataURL('image/jpeg', 0.7);
                                                    this.compressProgress = 80;
                                                    setTimeout(() => {
                                                        $wire.set('new_image_base64', base64);
                                                        this.compressProgress = 100;
                                                        setTimeout(() => { 
                                                            this.isCompressing = false; this.compressProgress = 0; 
                                                            document.getElementById('sapi-photo').value = '';
                                                        }, 300);
                                                    }, 500);
                                                };
                                                img.src = event.target.result;
                                            };
                                            reader.readAsDataURL(file);
                                        }
                                     }">
                                    
                                    <label class="block text-xs font-bold text-gray-400 uppercase mb-3 ml-1">Foto Sapi (Dikompres Otomatis)</label>
                                    <div class="relative overflow-hidden p-6 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200 hover:border-primary-400 transition group">
                                        <div x-show="isCompressing" x-transition.opacity class="absolute inset-0 z-20 bg-white/80 backdrop-blur-[2px] flex flex-col items-center justify-center p-6">
                                            <div class="w-full max-w-[200px] bg-gray-200 rounded-full h-2 mb-3">
                                                <div class="bg-primary-600 h-2 rounded-full transition-all duration-300" :style="`width: ${compressProgress}%`"></div>
                                            </div>
                                            <p class="text-[10px] font-black text-primary-700 uppercase animate-pulse text-center">Sedang Mengompres Gambar... <span x-text="compressProgress + '%'"></span></p>
                                        </div>
                                        <div class="flex flex-col sm:flex-row items-center gap-6 relative z-10">
                                            <div class="relative w-32 h-32 bg-white rounded-2xl overflow-hidden border-4 border-white shadow-md flex-shrink-0 group-hover:scale-105 transition transform">
                                                <template x-if="currentPreview">
                                                    <img :src="currentPreview" class="w-full h-full object-cover">
                                                </template>
                                                <template x-if="!currentPreview">
                                                    <div class="flex flex-col items-center justify-center h-full text-gray-300 bg-gray-50">
                                                        <svg class="w-10 h-10 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                        <span class="text-[8px] font-bold uppercase">No Photo</span>
                                                    </div>
                                                </template>
                                            </div>
                                            <div class="flex-1 text-center sm:text-left">
                                                <p class="text-sm font-bold text-gray-700 mb-1">Ambil Foto Terbaru</p>
                                                <p class="text-[10px] text-gray-400 mb-4 leading-relaxed">Sistem mengecilkan ukuran gambar secara otomatis untuk performa maksimal.</p>
                                                <input type="file" @change="handleFile" accept="image/*" class="hidden" id="sapi-photo">
                                                <label for="sapi-photo" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-600 text-white rounded-xl text-xs font-bold cursor-pointer hover:bg-primary-700 transition shadow-lg shadow-primary-900/20">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                                    Pilih File
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 px-8 py-5 flex flex-row-reverse gap-3 rounded-b-3xl border-t border-gray-100">
                            <button type="submit" class="px-8 py-3 bg-primary-600 text-white font-black text-sm rounded-xl shadow-lg shadow-primary-900/20 hover:bg-primary-700 transition transform hover:-translate-y-0.5">
                                <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                Simpan Data Sapi
                            </button>
                            <button type="button" @click="$wire.closeModal()" class="px-8 py-3 bg-white text-gray-500 font-bold text-sm rounded-xl border border-gray-200 hover:bg-gray-50 transition">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div x-show="$wire.isDeleteModalOpen" style="display: none;" class="relative z-[150]" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div x-show="$wire.isDeleteModalOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="$wire.isDeleteModalOpen" 
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     @click.away="$wire.isDeleteModalOpen = false"
                     class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl border border-gray-100 transition-all sm:my-8 sm:w-full sm:max-w-md">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-lg font-bold leading-6 text-gray-900">Hapus Data Sapi?</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Tindakan ini tidak dapat dibatalkan. Gambar dan data sapi ini akan dihapus secara permanen dari sistem.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button wire:click="executeDelete" type="button" class="inline-flex w-full justify-center rounded-xl bg-red-600 px-6 py-3 text-sm font-bold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto transition">
                            <svg wire:loading wire:target="executeDelete" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            Ya, Hapus Saja
                        </button>
                        <button @click="$wire.isDeleteModalOpen = false" type="button" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-6 py-3 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
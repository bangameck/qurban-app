<div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-primary-100 text-primary-700 rounded-xl shadow-sm">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800 tracking-wide">Kelompok Sapi {{ $tahun_aktif }}</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola pembagian 7 Pendaftar (Mudhohi) ke dalam 1 Sapi tahun ini.</p>
            </div>
        </div>
        <button wire:click="openModal" class="px-5 py-2.5 bg-primary-600 text-white font-bold rounded-xl shadow-lg shadow-primary-900/20 hover:bg-primary-700 transition transform hover:-translate-y-0.5 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Buat Kelompok
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden relative z-0">
        <div class="p-4 border-b border-gray-100 bg-gray-50/50">
            <input wire:model.live.debounce.300ms="search" type="text" class="w-full md:w-72 pl-4 pr-4 py-2 rounded-xl border border-gray-200 focus:border-primary-500 outline-none transition" placeholder="Cari Kelompok atau Sapi...">
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-700 font-bold uppercase text-xs tracking-wider border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4">Nama Kelompok</th>
                        <th class="px-6 py-4">Sapi Terkait</th>
                        <th class="px-6 py-4 w-64">Kuota Mudhohi</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($kelompoks as $kelompok)
                        <tr class="hover:bg-primary-50/30 transition">
                            <td class="px-6 py-4">
                                <div class="font-black text-gray-800 text-base">{{ $kelompok->nama_kelompok }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if($kelompok->sapi)
                                    <div class="flex items-center gap-3">
                                        @if($kelompok->sapi->path_foto_sapi)
                                            <img src="{{ asset('storage/' . $kelompok->sapi->path_foto_sapi) }}?v={{ time() }}" 
                                                 class="w-10 h-10 rounded-xl object-cover shadow-sm border border-gray-100">
                                        @else
                                            <div class="w-10 h-10 rounded-xl bg-primary-100 text-primary-700 flex items-center justify-center font-black text-sm shadow-inner">SP</div>
                                        @endif
                                        
                                        <div>
                                            <div class="font-bold text-primary-700">{{ $kelompok->sapi->kode_sapi }}</div>
                                            <div class="text-[10px] text-gray-400">{{ $kelompok->sapi->jenis_sapi }} • {{ $kelompok->sapi->berat }}KG</div>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-red-400 italic text-xs font-bold">Sapi Terhapus</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $terisi = $kelompok->mudhohis_count ?? 0;
                                    $isFull = $terisi >= 7;
                                @endphp
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-xs font-bold {{ $isFull ? 'text-primary-600' : 'text-gray-600' }}">
                                        {{ $terisi }} / 7 Orang
                                    </span>
                                    @if($isFull)
                                        <span class="text-[9px] font-black uppercase text-primary-600 bg-primary-100 px-2 py-0.5 rounded">Penuh</span>
                                    @endif
                                </div>
                                <div class="flex gap-1">
                                    @for($i = 0; $i < 7; $i++)
                                        <div class="h-2 w-full rounded-sm {{ $i < $terisi ? 'bg-primary-500' : 'bg-gray-200' }}"></div>
                                    @endfor
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <button wire:click="openDetailModal({{ $kelompok->id }})" class="p-2 text-emerald-600 bg-emerald-50 rounded-lg hover:bg-emerald-600 hover:text-white transition" title="Lihat Daftar Anggota">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </button>

                                    <button wire:click="openModal({{ $kelompok->id }})" class="p-2 text-primary-600 bg-primary-50 rounded-lg hover:bg-primary-600 hover:text-white transition" title="Edit Kelompok">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                    
                                    @if($terisi == 0)
                                        <button wire:click="confirmDelete({{ $kelompok->id }})" class="p-2 text-red-600 bg-red-50 rounded-lg hover:bg-red-600 hover:text-white transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    @else
                                        <button class="p-2 text-gray-400 bg-gray-50 rounded-lg cursor-not-allowed" title="Sudah ada pendaftar">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                Belum ada kelompok sapi yang dibentuk tahun ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100 bg-gray-50">
            {{ $kelompoks->links() }}
        </div>
    </div>

    <div x-show="$wire.isDetailModalOpen" style="display: none;" class="relative z-[150]">
        <div x-show="$wire.isDetailModalOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm" @click="$wire.closeDetailModal()"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto flex items-center justify-center p-4">
            <div class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl sm:w-full sm:max-w-2xl border border-gray-100 flex flex-col max-h-[90vh]">
                @if($detailKelompok)
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50 flex justify-between items-center sticky top-0 z-20">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-100 text-primary-700 rounded-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-gray-800">{{ $detailKelompok->nama_kelompok }}</h3>
                            <p class="text-xs font-bold text-gray-500 mt-0.5">Sapi Terkait: <span class="text-primary-600">{{ $detailKelompok->sapi->kode_sapi ?? 'Belum Diatur' }}</span></p>
                        </div>
                    </div>
                    <button wire:click="closeDetailModal" class="p-2 bg-white border border-gray-200 rounded-full text-gray-400 hover:text-red-500 hover:bg-red-50 transition shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="p-6 overflow-y-auto flex-1 bg-gray-50/50">
                    <div class="space-y-3">
                        @forelse($detailKelompok->mudhohis as $index => $mudhohi)
                            <div class="flex items-start gap-4 p-4 rounded-2xl border border-gray-200 bg-white shadow-sm hover:shadow-md hover:border-primary-300 transition group">
                                <div class="w-8 h-8 rounded-full bg-gray-100 text-gray-500 group-hover:bg-primary-100 group-hover:text-primary-700 flex items-center justify-center font-black text-sm shrink-0 transition">
                                    {{ $index + 1 }}
                                </div>
                                <img src="{{ $mudhohi->warga->path_img ? asset('storage/'.$mudhohi->warga->path_img) : 'https://ui-avatars.com/api/?name='.urlencode($mudhohi->warga->nama).'&background=random' }}" class="w-14 h-14 rounded-xl object-cover shadow-sm border border-gray-100 shrink-0">
                                <div class="flex-1">
                                    <div class="flex justify-between items-start">
                                        <h4 class="font-black text-gray-800 text-base">{{ $mudhohi->warga->nama }}</h4>
                                        <span class="text-[9px] font-black uppercase text-primary-600 bg-primary-50 border border-primary-100 px-2 py-0.5 rounded-lg">{{ $mudhohi->tipe_qurban }}</span>
                                    </div>
                                    <p class="text-xs font-mono text-gray-500 mt-1 mb-2">NIK: {{ $mudhohi->warga->nik }}</p>
                                    <div class="flex items-start gap-1.5 text-[11px] text-gray-500 bg-gray-50 p-2 rounded-lg">
                                        <svg class="w-3.5 h-3.5 mt-0.5 shrink-0 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        <span class="leading-relaxed">{{ $mudhohi->warga->alamat ?? 'Alamat belum diisi di data warga.' }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10 bg-white rounded-2xl border-2 border-dashed border-gray-200">
                                <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                <p class="text-gray-500 font-bold">Belum ada pendaftar di kelompok ini.</p>
                                <p class="text-xs text-gray-400 mt-1">Silakan tambahkan melalui menu Pendaftar (Mudhohi).</p>
                            </div>
                        @endforelse
                        
                        @if($detailKelompok->mudhohis->count() > 0 && $detailKelompok->mudhohis->count() < 7)
                            <div class="p-4 rounded-2xl border-2 border-dashed border-primary-200 bg-primary-50/50 flex items-center justify-center">
                                <p class="text-xs font-black text-primary-600 uppercase tracking-widest">Tersedia {{ 7 - $detailKelompok->mudhohis->count() }} Kuota Kosong</p>
                            </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div x-show="$wire.isModalOpen" style="display: none;" class="relative z-[100]">
        <div x-show="$wire.isModalOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div @click.away="$wire.closeModal()" class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:w-full sm:max-w-xl">
                    <form wire:submit.prevent="save">
                        <div class="p-8">
                            <h3 class="text-2xl font-bold text-gray-800 mb-8 border-b pb-4">{{ $editId ? 'Edit Kelompok' : 'Buat Kelompok Baru' }}</h3>
                            
                            <div class="grid grid-cols-1 gap-y-8">
                                <div class="relative">
                                    <input type="text" id="nama_kelompok" wire:model="nama_kelompok" class="peer block px-4 py-3 w-full text-sm text-gray-900 bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-primary-600 transition-all" placeholder=" " />
                                    <label for="nama_kelompok" class="absolute text-sm text-gray-500 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-3 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">Nama Kelompok (Contoh: Kelompok Abu Bakar)</label>
                                    @error('nama_kelompok') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                                </div>

                                <div class="relative">
                                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2 ml-1">Pasangkan Dengan Sapi</label>
                                    <select wire:model="id_sapi" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-gray-50 focus:bg-white focus:outline-none focus:ring-0 focus:border-primary-600 transition-all">
                                        <option value="">-- Pilih Sapi Yang Tersedia --</option>
                                        @foreach($sapiTersedia as $sapi)
                                            <option value="{{ $sapi->id }}">{{ $sapi->kode_sapi }} - {{ $sapi->jenis_sapi }} ({{ $sapi->berat }} KG)</option>
                                        @endforeach
                                    </select>
                                    <p class="text-[10px] text-gray-400 mt-1 ml-1">*Hanya sapi tahun ini yang belum memiliki kelompok yang muncul di daftar ini.</p>
                                    @error('id_sapi') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 px-8 py-5 flex flex-row-reverse gap-3 rounded-b-3xl border-t border-gray-100">
                            <button type="submit" class="px-8 py-3 bg-primary-600 text-white font-black text-sm rounded-xl shadow-lg shadow-primary-900/20 hover:bg-primary-700 transition transform hover:-translate-y-0.5">
                                <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                Simpan Kelompok
                            </button>
                            <button type="button" @click="$wire.closeModal()" class="px-8 py-3 bg-white text-gray-500 font-bold text-sm rounded-xl border border-gray-200 hover:bg-gray-50 transition">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div x-show="$wire.isDeleteModalOpen" style="display: none;" class="relative z-[150]">
        <div x-show="$wire.isDeleteModalOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center">
                <div @click.away="$wire.isDeleteModalOpen = false" class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl sm:w-full sm:max-w-md">
                    <div class="bg-white px-6 py-6">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-lg font-bold text-gray-900">Bubarkan Kelompok?</h3>
                                <p class="text-sm text-gray-500 mt-2">Sapi akan kembali berstatus 'tersedia' dan bisa dimasukkan ke kelompok lain.</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse gap-3">
                        <button wire:click="executeDelete" type="button" class="px-6 py-2.5 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition">Bubarkan</button>
                        <button @click="$wire.isDeleteModalOpen = false" type="button" class="px-6 py-2.5 bg-white text-gray-700 font-bold rounded-xl border border-gray-200">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
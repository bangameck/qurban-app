<div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="p-4 bg-primary-100 text-primary-700 rounded-2xl">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase">Total Kupon</p>
                <h4 class="text-2xl font-black text-gray-800">{{ \App\Models\Mustahiq::count() }}</h4>
            </div>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="p-4 bg-emerald-100 text-emerald-700 rounded-2xl">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase">Sudah Ambil</p>
                <h4 class="text-2xl font-black text-emerald-600">{{ \App\Models\Mustahiq::where('status_pengambilan', 'Sudah')->count() }}</h4>
            </div>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
            <button wire:click="openModal" class="w-full h-full text-white rounded-2xl font-bold flex items-center justify-center gap-3 transition shadow-lg transform hover:-translate-y-0.5" style="background-color: var(--color-primary-600);">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Buat Kupon Baru
            </button>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-4 border-b border-gray-100 bg-gray-50/50">
            <input wire:model.live.debounce.300ms="search" type="text" class="w-full md:w-72 pl-4 pr-4 py-2 rounded-xl border border-gray-200 focus:border-primary-500 outline-none transition" placeholder="Cari Kode atau Nama...">
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-[10px] font-black uppercase text-gray-400 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4">Penerima</th>
                        <th class="px-6 py-4">Kode & Sesi</th>
                        <th class="px-6 py-4">Status Ambil</th> 
                        <th class="px-6 py-4 text-center">QR Code</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm">
                    @foreach($mustahiqs as $m)
                    <tr class="hover:bg-primary-50/30 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $m->warga->path_img ? asset('storage/'.$m->warga->path_img) : 'https://ui-avatars.com/api/?name='.urlencode($m->warga->nama).'&background=random' }}" class="w-10 h-10 rounded-xl object-cover border border-gray-200">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <p class="font-bold text-gray-800">{{ $m->warga->nama }}</p>
                                        @if($m->kategori_penerima == 'Mudhohi')
                                            <span class="px-2 py-0.5 bg-amber-100 text-amber-700 text-[9px] font-black uppercase rounded">Pendaftar</span>
                                        @endif
                                    </div>
                                    <p class="text-[10px] text-gray-400 font-mono">{{ $m->warga->phone_number ?? 'No WA Kosong' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="inline-block px-3 py-1.5 bg-gray-100 rounded-lg text-xs font-mono font-black text-gray-700 mb-1 border border-gray-200 tracking-wider">
                                {{ $m->kode_unik_kupon }}
                            </div>
                            <p class="text-[10px] font-bold text-primary-600">{{ $m->sesiDistribusi->nama_sesi }}</p>
                        </td>

                        <td class="px-6 py-4">
                            @if($m->status_pengambilan == 'Sudah')
                                <div class="flex flex-col">
                                    <span class="inline-flex items-center justify-center w-fit px-3 py-1 rounded-full text-[9px] font-black uppercase bg-emerald-100 text-emerald-700 border border-emerald-200 shadow-sm">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        Sudah Ambil
                                    </span>
                                    <span class="text-[9px] text-gray-400 mt-1 font-bold">Jam: {{ $m->waktu_diambil?->format('H:i') }} WIB</span>
                                </div>
                            @else
                                <span class="inline-flex items-center justify-center w-fit px-3 py-1 rounded-full text-[9px] font-black uppercase bg-amber-100 text-amber-600 border border-amber-200 shadow-sm animate-pulse">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Belum Ambil
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-center">
                            <img src="{{ asset('storage/'.$m->path_qr_code) }}" class="w-12 h-12 rounded-lg border border-gray-100 p-1 bg-white shadow-sm mx-auto blur-[3px] hover:blur-none transition-all duration-300 cursor-pointer" title="Hover untuk melihat QR Code">
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button wire:click="openDetailModal({{ $m->id }})" class="p-2 text-primary-600 bg-primary-50 rounded-lg hover:bg-primary-600 hover:text-white transition" title="Lihat Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                                
                                @if($m->status_pengambilan == 'Sudah')
                                    <button disabled class="p-2 text-gray-400 bg-gray-100 rounded-lg opacity-60 cursor-not-allowed" title="Terkunci: Daging sudah diambil">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                @else
                                    <button wire:click="confirmDelete({{ $m->id }})" class="p-2 text-red-600 bg-red-50 rounded-lg hover:bg-red-600 hover:text-white transition" title="Hapus Data">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
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
            {{ $mustahiqs->links() }}
        </div>
    </div>

    <div x-show="$wire.isModalOpen" style="display: none;" class="relative z-[100]">
        <div x-show="$wire.isModalOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto flex items-center justify-center p-4">
            <div @click.away="$wire.closeModal()" class="bg-white w-full max-w-lg rounded-3xl shadow-2xl overflow-visible">
                <form wire:submit.prevent="save">
                    <div class="p-8">
                        <h3 class="text-2xl font-black text-gray-800 mb-6 border-b pb-4">Generate Kupon Digital</h3>
                        
                        <div class="space-y-6">
                            <div wire:ignore x-data='{
                                tomSelectInstance: null,
                                init() {
                                    this.tomSelectInstance = new TomSelect(this.$refs.wargaSelect, {
                                        valueField: "id",
                                        searchField: ["nama", "nik", "kk"],
                                        placeholder: "Ketik Nama, NIK, atau No KK...",
                                        render: {
                                            option: function(data, escape) {
                                                return `<div class="flex items-center gap-3 p-3 border-b border-gray-50">
                                                    <img class="w-10 h-10 rounded-full object-cover shadow-sm" src="${data.img}">
                                                    <div>
                                                        <div class="font-bold text-gray-800">${escape(data.nama)}</div>
                                                        <div class="text-[10px] text-gray-500 font-mono mt-0.5">NIK: ${escape(data.nik)} | KK: ${escape(data.kk)}</div>
                                                    </div>
                                                </div>`;
                                            },
                                            item: function(data, escape) {
                                                return `<div class="flex items-center gap-2">
                                                    <img class="w-6 h-6 rounded-full object-cover" src="${data.img}">
                                                    <span class="font-bold text-sm text-gray-800">${escape(data.nama)}</span>
                                                </div>`;
                                            }
                                        },
                                        onChange: (v) => $wire.set("id_warga", v)
                                    });
                                    $wire.$watch("id_warga", (value) => {
                                        if (!value) this.tomSelectInstance.clear(true);
                                    });
                                }
                            }'>
                                <label class="text-xs font-black uppercase text-gray-400 ml-1">Pilih Warga Penerima</label>
                                <select x-ref="wargaSelect" class="w-full mt-2">
                                    <option value="">Cari Warga...</option>
                                    @foreach($wargas as $w)
                                        @php
                                            $imgUrl = $w->path_img ? asset('storage/'.$w->path_img) : 'https://ui-avatars.com/api/?name='.urlencode($w->nama).'&background=random';
                                            $no_kk = $w->no_kk ?? 'Tidak Ada KK';
                                        @endphp
                                        <option value="{{ $w->id }}" data-nama="{{ $w->nama }}" data-nik="{{ $w->nik }}" data-kk="{{ $no_kk }}" data-img="{{ $imgUrl }}">
                                            {{ $w->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('id_warga') <span class="text-red-500 text-xs font-bold">{{ $message }}</span> @enderror

                            <div>
                                <label class="text-xs font-black uppercase text-gray-400 ml-1">Sesi Pengambilan</label>
                                <select wire:model="id_sesi_distribusi" class="w-full mt-2 px-4 py-3 rounded-xl border-2 border-gray-100 bg-gray-50 focus:bg-white focus:border-primary-500 outline-none transition font-bold text-gray-700">
                                    <option value="">-- Pilih Jam Pengambilan --</option>
                                    @foreach($sesis as $s)
                                        <option value="{{ $s->id }}">{{ $s->nama_sesi }} (Terisi: {{ $s->mustahiqs_count }}/{{ $s->kuota_maksimal }})</option>
                                    @endforeach
                                </select>
                                @error('id_sesi_distribusi') <span class="text-red-500 text-xs font-bold">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="text-xs font-black uppercase text-gray-400 ml-1">Kategori Kupon</label>
                                <div class="grid grid-cols-3 gap-2 mt-2">
                                    @foreach(['Mustahiq', 'Mudhohi', 'Panitia'] as $kat)
                                        <button type="button" wire:click="$set('kategori_penerima', '{{ $kat }}')" class="py-2.5 text-xs font-black rounded-xl border-2 transition-all {{ $kategori_penerima == $kat ? 'text-white shadow-lg' : 'border-gray-100 text-gray-400 bg-gray-50 hover:border-gray-300' }}" style="{{ $kategori_penerima == $kat ? 'background-color: var(--color-primary-600); border-color: var(--color-primary-600);' : '' }}">
                                            {{ $kat }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-8 py-5 flex gap-3 border-t border-gray-100 rounded-b-3xl">
                        <button type="button" @click="$wire.closeModal()" class="flex-1 py-3 bg-white text-gray-500 font-bold rounded-xl border border-gray-200 transition">Batal</button>
                        <button type="submit" class="flex-1 py-3 text-white font-black rounded-xl shadow-lg transition transform hover:-translate-y-0.5" style="background-color: var(--color-primary-600);">
                            <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            Generate & WA
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div x-show="$wire.isDetailModalOpen" style="display: none;" class="relative z-[150]">
        <div x-show="$wire.isDetailModalOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm" @click="$wire.closeDetailModal()"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto flex items-center justify-center p-4 text-center pointer-events-none">
            <div @click.away="$wire.closeDetailModal()" class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl sm:w-full sm:max-w-md border border-gray-100 pointer-events-auto">
                @if($detailData)
                <div class="relative h-32" style="background-color: var(--color-primary-600);">
                    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 20px 20px;"></div>
                </div>
                <div class="px-6 pb-6 relative">
                    <div class="flex justify-center -mt-12 mb-4">
                        <img src="{{ $detailData->warga->path_img ? asset('storage/'.$detailData->warga->path_img) : 'https://ui-avatars.com/api/?name='.urlencode($detailData->warga->nama).'&background=random' }}" class="w-24 h-24 rounded-2xl object-cover border-4 border-white shadow-lg bg-white">
                    </div>
                    
                    <div class="text-center mb-6">
                        <h3 class="text-xl font-black text-gray-800">{{ $detailData->warga->nama }}</h3>
                        <p class="text-sm text-gray-500 font-mono mt-1">{{ $detailData->warga->nik }}</p>
                        @if($detailData->kategori_penerima == 'Mudhohi')
                            <span class="inline-block mt-2 px-3 py-1 bg-amber-100 text-amber-700 text-[10px] font-black uppercase rounded-full tracking-wider">Status: Pendaftar Qurban</span>
                        @else
                            <span class="inline-block mt-2 px-3 py-1 bg-primary-100 text-primary-700 text-[10px] font-black uppercase rounded-full tracking-wider">Status: {{ $detailData->kategori_penerima }}</span>
                        @endif
                    </div>

                    <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100 mb-6">
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase">Kode Kupon</p>
                                <p class="font-mono font-black text-gray-800 tracking-wider">{{ $detailData->kode_unik_kupon }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase">Jadwal Sesi</p>
                                <p class="font-bold text-primary-600">{{ $detailData->sesiDistribusi->nama_sesi }}</p>
                            </div>
                            <div class="col-span-2 flex justify-center mt-2">
                                <img src="{{ asset('storage/'.$detailData->path_qr_code) }}" class="w-32 h-32 rounded-xl border-2 border-dashed border-gray-200 p-2 bg-white">
                            </div>
                        </div>
                    </div>

                    @if($detailData->kategori_penerima == 'Mudhohi' && $detailSapi)
                    <div class="border-t border-dashed border-gray-200 pt-4 mb-4">
                        <p class="text-[10px] font-bold text-gray-400 uppercase mb-2 text-center">Hak Potong (Sapi Anda)</p>
                        <div class="flex items-center gap-3 bg-primary-50 p-3 rounded-xl border border-primary-100">
                            <div class="w-10 h-10 rounded-lg bg-white text-primary-700 flex items-center justify-center font-black shadow-sm">SP</div>
                            <div>
                                <p class="font-black text-gray-800 text-sm">{{ $detailSapi->kode_sapi }}</p>
                                <p class="text-xs text-gray-500">{{ $detailSapi->jenis_sapi }} • {{ $detailSapi->berat }} KG</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="flex flex-col gap-3 mt-4">
                        <a href="{{ route('kupon.detail', $detailData->kode_unik_kupon) }}" 
                           target="_blank" 
                           class="w-full py-3 text-white font-bold rounded-xl text-center shadow-lg transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2" 
                           style="background-color: var(--color-primary-600);">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            Lihat Halaman Publik
                        </a>
                        
                        <button wire:click="closeDetailModal" class="w-full py-3 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition">
                            Tutup Detail
                        </button>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div x-show="$wire.isDeleteModalOpen" style="display: none;" class="relative z-[150]">
        <div x-show="$wire.isDeleteModalOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto flex items-center justify-center p-4">
            <div @click.away="$wire.isDeleteModalOpen = false" class="bg-white rounded-3xl shadow-2xl w-full max-w-sm text-center p-6">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-100 mb-4">
                    <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <h3 class="text-xl font-black text-gray-800 mb-2">Batalkan Kupon?</h3>
                <p class="text-sm text-gray-500 mb-6">QR Code yang sudah dikirim tidak akan berlaku lagi untuk di-scan.</p>
                <div class="flex gap-3">
                    <button @click="$wire.isDeleteModalOpen = false" class="flex-1 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl">Batal</button>
                    <button wire:click="executeDelete" class="flex-1 py-3 bg-red-600 text-white font-bold rounded-xl">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>

</div>
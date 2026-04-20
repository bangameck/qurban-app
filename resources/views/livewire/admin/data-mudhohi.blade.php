<div>
    <style>
        .ts-control { border-radius: 0.75rem; border-width: 2px; border-color: #f3f4f6; padding: 0.75rem 1rem; background-color: #f9fafb; transition: all 0.3s ease; }
        .ts-control.focus { border-color: var(--color-primary-500); box-shadow: none; background-color: #ffffff; }
        .ts-dropdown { border-radius: 0.75rem; border: 1px solid #e5e7eb; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); overflow: hidden; margin-top: 4px; }
        .ts-dropdown .active { background-color: var(--color-primary-50); color: var(--color-primary-700); }
    </style>

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-primary-100 text-primary-700 rounded-xl shadow-sm">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800 tracking-wide">Pendaftar (Mudhohi) {{ $tahun_aktif }}</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola data warga pendaftar dan kupon QR qurban tahun ini.</p>
            </div>
        </div>
        <button wire:click="openModal" class="px-5 py-2.5 text-white font-bold rounded-xl shadow-lg shadow-primary-900/20 transition transform hover:-translate-y-0.5 flex items-center gap-2" style="background-color: var(--color-primary-600);">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Pendaftar
        </button>
    </div>

    <div class="mb-10 relative max-w-md">
        <div class="relative group">
            <input wire:model.live.debounce.300ms="search" type="text" id="floating_search"
                class="block px-12 py-5 w-full text-sm font-black text-gray-900 bg-white rounded-[2rem] border-2 border-gray-100 appearance-none focus:outline-none focus:ring-4 focus:ring-primary-500/10 focus:border-primary-600 peer shadow-sm transition-all" 
                placeholder=" " />
            <label for="floating_search" 
                class="absolute text-sm font-bold text-gray-400 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-11 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-5 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">
                Cari Nama, NIK, atau Kode Kupon...
            </label>
            <div class="absolute left-4 top-1/2 -translate-y-1/2 p-1.5 bg-primary-50 text-primary-600 rounded-xl group-focus-within:bg-primary-600 group-focus-within:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
        @forelse ($mudhohis as $mudhohi)
            <div class="group bg-white rounded-[2.5rem] p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:shadow-primary-900/5 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden flex flex-col h-full">
                <div class="absolute top-0 right-0 p-4 opacity-30 group-hover:opacity-100 transition-opacity flex gap-2 z-10">
                    <a href="{{ route('mudhohi.detail', $mudhohi->id) }}" target="_blank" class="p-2 bg-emerald-50 text-emerald-600 rounded-xl hover:bg-emerald-600 hover:text-white transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                    
                    @if($mudhohi->status_pengambilan == 'Sudah')
                        <button disabled class="p-2 bg-gray-100 text-gray-400 rounded-xl cursor-not-allowed shadow-sm" title="Data yang sudah diambil tidak dapat diubah">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </button>
                        <button disabled class="p-2 bg-gray-100 text-gray-400 rounded-xl cursor-not-allowed shadow-sm" title="Data yang sudah diambil tidak dapat dihapus">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    @else
                        <button wire:click="openModal({{ $mudhohi->id }})" class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </button>
                        <button wire:click="confirmDelete({{ $mudhohi->id }})" class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    @endif
                </div>

                <div class="flex flex-col items-center mb-6">
                    @php
                        $imgUrl = $mudhohi->warga->path_img ? asset('storage/'.$mudhohi->warga->path_img).'?v='.time() : 'https://ui-avatars.com/api/?name='.urlencode($mudhohi->warga->nama).'&background=random&color=fff&bold=true';
                    @endphp
                    <div class="relative mb-4">
                        <img src="{{ $imgUrl }}" class="w-24 h-24 rounded-full object-cover shadow-md border-4 border-white ring-4 ring-primary-50 transition group-hover:scale-105 duration-500">
                        @if($mudhohi->status_pengambilan == 'Sudah')
                            <span class="absolute -bottom-1 -right-1 bg-emerald-500 text-white p-1.5 rounded-full border-4 border-white shadow-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </span>
                        @endif
                    </div>
                    <h3 class="text-lg font-black text-gray-900 text-center leading-tight group-hover:text-primary-700 transition-colors">{{ $mudhohi->warga->nama }}</h3>
                    
                    <div class="mt-2 flex flex-col items-center gap-1.5">
                        <div class="px-3 py-1 bg-gray-50 rounded-full border border-gray-200">
                            <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest">NIK: {{ $mudhohi->warga->nik ?? '-' }}</p>
                        </div>
                        @if($mudhohi->warga->no_kk)
                            <div class="px-3 py-1 bg-gray-50 rounded-full border border-gray-200">
                                <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest">KK: {{ $mudhohi->warga->no_kk }}</p>
                            </div>
                        @endif
                        <div class="px-3 py-1 bg-primary-50 rounded-full border border-primary-100">
                            <p class="text-[9px] font-black text-primary-600 uppercase tracking-widest">KODE: {{ $mudhohi->kode_unik_kupon }}</p>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-gray-50 rounded-[2.5rem] border-2 border-dashed border-gray-100 relative group/qr overflow-hidden shadow-inner transition-all hover:bg-white hover:border-primary-200 hover:shadow-xl hover:shadow-primary-900/5">
                        @if($mudhohi->path_qr_code)
                            <img src="{{ asset('storage/'.$mudhohi->path_qr_code) }}" 
                                class="w-32 h-32 object-contain blur-[12px] group-hover/qr:blur-none group-hover/qr:scale-110 transition-all duration-700 cursor-zoom-in">
                            <div class="absolute inset-0 flex items-center justify-center opacity-100 group-hover/qr:opacity-0 transition-opacity duration-300 pointer-events-none">
                                <div class="p-3 bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100">
                                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                </div>
                            </div>
                        @else
                            <div class="w-32 h-32 flex items-center justify-center text-[10px] text-gray-300 font-black">NO QR CODE</div>
                        @endif
                    </div>
                </div>

                <div class="space-y-4 flex-1">
                    <div class="bg-gray-50 p-4 rounded-3xl border border-gray-100 flex flex-col gap-3">
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Kelompok</span>
                            <span class="text-xs font-black text-gray-800">{{ $mudhohi->kelompokSapi->nama_kelompok ?? 'Individu' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Sapi</span>
                            <span class="text-xs font-black text-primary-600">{{ $mudhohi->kelompokSapi->sapi->kode_sapi ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Tipe Qurban</span>
                            <span class="px-2 py-0.5 rounded-lg text-[9px] font-black uppercase {{ $mudhohi->tipe_qurban == 'Patungan' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ $mudhohi->tipe_qurban }}
                            </span>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-3 rounded-2xl border border-gray-100 flex flex-col items-center justify-center">
                        <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Status Pengambilan</span>
                        <span class="text-[10px] font-black {{ $mudhohi->status_pengambilan == 'Sudah' ? 'text-emerald-600' : 'text-amber-500' }} uppercase tracking-[0.2em]">
                            {{ $mudhohi->status_pengambilan == 'Sudah' ? 'SUDAH DIAMBIL' : 'BELUM DIAMBIL' }}
                        </span>
                    </div>
                </div>

                @if($mudhohi->warga->phone_number)
                    <div class="mt-6">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $mudhohi->warga->phone_number) }}" target="_blank" class="w-full py-3 px-4 bg-emerald-50 text-emerald-700 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-emerald-600 hover:text-white transition-all shadow-sm flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217s.231.001.332.005c.109.004.258-.041.404.314.145.356.491 1.197.535 1.285.044.088.072.19.014.307s-.088.134-.175.235c-.087.101-.183.225-.261.303-.093.093-.19.194-.081.381.109.187.485.802 1.039 1.296.714.637 1.316.833 1.503.927.187.094.297.078.406-.047.109-.125.462-.535.586-.717.124-.182.248-.153.419-.089s1.085.512 1.273.6c.188.089.312.134.358.21.046.076.046.438-.098.843z"/></svg>
                            {{ $mudhohi->warga->phone_number }}
                        </a>
                    </div>
                @endif
            </div>
        @empty
            <div class="col-span-full py-20 bg-white rounded-[3rem] border-2 border-dashed border-gray-100 flex flex-col items-center justify-center text-center">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                </div>
                <h3 class="text-xl font-black text-gray-800">Tidak ada pendaftar qurban</h3>
                <p class="text-gray-400 font-bold mt-1 uppercase tracking-widest text-xs">Pendaftar baru belum ada di tahun ini, wak!</p>
            </div>
        @endforelse
    </div>

    @if ($mudhohis->hasMorePages())
        <div class="flex justify-center pb-10">
            <button wire:click="loadMore" wire:loading.attr="disabled" class="group relative px-12 py-4 bg-white border-2 border-primary-100 text-primary-700 font-black rounded-2xl shadow-sm hover:bg-primary-600 hover:text-white hover:border-primary-600 transition-all duration-300 flex items-center gap-3 active:scale-95">
                <span wire:loading.remove wire:target="loadMore">LOAD MORE PENDAFTAR</span>
                <span wire:loading wire:target="loadMore" class="flex items-center gap-3">
                    <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    LOADING...
                </span>
                <svg wire:loading.remove wire:target="loadMore" class="w-5 h-5 group-hover:translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
            </button>
        </div>
    @endif

    @if ($mudhohis->total() > 0 && !$mudhohis->hasMorePages())
        <div class="text-center pb-10">
            <span class="px-6 py-2 bg-gray-100 text-gray-400 font-black text-[10px] uppercase tracking-[0.2em] rounded-full">SEMUA DATA TELAH DITAMPILKAN</span>
        </div>
    @endif


    <div x-show="$wire.isModalOpen" style="display: none;" class="relative z-[100]">
        <div x-show="$wire.isModalOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div @click.away="$wire.closeModal()" class="relative transform overflow-visible rounded-3xl bg-white text-left shadow-2xl transition-all sm:w-full sm:max-w-2xl">
                    <form wire:submit.prevent="save">
                        <div class="p-8">
                            <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">{{ $editId ? 'Edit Pendaftar' : 'Input Pendaftar Baru' }}</h3>
                            
                            <div class="mb-6 bg-emerald-50 border border-emerald-100 p-4 rounded-xl flex items-center justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="p-3 bg-emerald-100 text-emerald-600 rounded-xl">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black text-emerald-600 uppercase tracking-wider">Biaya Patungan Sapi {{ $tahun_aktif }}</p>
                                        <p class="text-xl font-black text-emerald-800">Rp {{ number_format($harga_patungan_display, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-y-5">
                                @if(!$editId)
                                    <div wire:ignore x-data='{
                                            tomSelectInstance: null,
                                            init() {
                                                this.tomSelectInstance = new TomSelect(this.$refs.wargaSelect, {
                                                    valueField: "id", searchField: ["nama", "nik"], placeholder: "Ketik Nama atau NIK Warga...",
                                                    render: {
                                                        option: function(data, escape) {
                                                            return `<div class="flex items-center gap-3 p-2"><img class="w-8 h-8 rounded-full object-cover" src="${data.img}"><div><div class="font-bold text-gray-800">${escape(data.nama)}</div><div class="text-xs text-gray-400">NIK: ${escape(data.nik)}</div></div></div>`;
                                                        },
                                                        item: function(data, escape) {
                                                            return `<div class="flex items-center gap-2"><img class="w-5 h-5 rounded-full object-cover" src="${data.img}"><span class="font-bold text-sm">${escape(data.nama)}</span></div>`;
                                                        }
                                                    },
                                                    onChange: (value) => { $wire.set("id_warga", value); }
                                                });
                                                $wire.$watch("id_warga", (value) => {
                                                    if (value) { this.tomSelectInstance.setValue(value, true); } 
                                                    else { this.tomSelectInstance.clear(true); }
                                                });
                                            }
                                         }'>
                                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 ml-1">Pilih Warga (Mudhohi)</label>
                                        <select x-ref="wargaSelect" class="w-full">
                                            <option value="">Cari Warga...</option>
                                            @foreach($wargas as $warga)
                                                @php $imgUrl = $warga->path_img ? asset('storage/'.$warga->path_img) : 'https://ui-avatars.com/api/?name='.urlencode($warga->nama).'&background=random'; @endphp
                                                <option value="{{ $warga->id }}" data-nama="{{ $warga->nama }}" data-nik="{{ $warga->nik }}" data-img="{{ $imgUrl }}">{{ $warga->nama }} ({{ $warga->nik }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('id_warga') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                                @else
                                    @php
                                        $editWarga = \App\Models\Warga::find($id_warga);
                                    @endphp
                                    
                                    @if($editWarga)
                                    <div class="relative animate-fadeIn">
                                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-3 ml-1 tracking-widest flex items-center gap-2">
                                            Identitas Mudhohi
                                            <span class="px-2 py-0.5 bg-gray-200 text-gray-500 rounded text-[8px] metallic-effect">TERKUNCI</span>
                                        </label>
                                        
                                        <div class="relative flex items-center justify-between p-5 bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl shadow-inner cursor-not-allowed border border-gray-100 overflow-hidden">
                                            
                                            <div class="absolute -left-5 -top-5 w-24 h-24 rounded-full bg-primary-100/50"></div>
                                            <div class="absolute -right-5 -bottom-5 w-32 h-32 rounded-full bg-primary-200/40"></div>
                                            <div class="absolute top-1/2 left-0 w-full h-1 bg-gradient-to-r from-transparent via-primary-500/10 to-transparent"></div>

                                            <div class="flex items-center gap-5 relative z-10">
                                                <img src="{{ $editWarga->path_img ? asset('storage/'.$editWarga->path_img) : 'https://ui-avatars.com/api/?name='.urlencode($editWarga->nama).'&background=10b981&color=fff&size=150' }}" class="w-14 h-14 rounded-full object-cover border-4 border-white shadow-md shadow-primary-900/10 grayscale-[15%]">
                                                <div>
                                                    <h4 class="font-black text-gray-700 text-lg leading-tight">{{ $editWarga->nama }}</h4>
                                                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-1">NIK: {{ $editWarga->nik }}</p>
                                                </div>
                                            </div>
                                            
                                            <div class="w-12 h-12 rounded-xl metallic-effect bg-gray-200 flex items-center justify-center text-gray-400 shadow-lg relative z-10 border border-gray-100">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                            </div>
                                        </div>
                                        <p class="text-[9px] text-gray-400 font-bold mt-2 ml-1 italic">* Identitas Mudhohi tidak dapat diubah setelah terdaftar.</p>
                                    </div>
                                    @error('id_warga') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                                    @endif
                                @endif

                                <div>
                                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 ml-1">Tipe Qurban</label>
                                    <div class="grid grid-cols-3 gap-2">
                                        @foreach(['Patungan', 'Individu', 'Kambing'] as $tipe)
                                            <button type="button" wire:click="$set('tipe_qurban', '{{ $tipe }}')" class="py-2.5 text-[11px] font-black rounded-xl border-2 transition-all {{ $tipe_qurban == $tipe ? 'text-white shadow-md scale-[1.02]' : 'border-gray-100 text-gray-400 bg-gray-50 hover:border-gray-300' }}" style="{{ $tipe_qurban == $tipe ? 'background-color: var(--color-primary-600); border-color: var(--color-primary-600);' : '' }}">{{ $tipe }}</button>
                                        @endforeach
                                    </div>
                                    @error('tipe_qurban') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                                </div>

                                @if($tipe_qurban !== 'Individu')
                                <div class="relative animate-fadeIn">
                                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 ml-1">Pilih Kelompok Sapi</label>
                                    <select wire:model="id_kelompok_sapi" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-gray-50 focus:bg-white focus:outline-none focus:ring-0 focus:border-primary-600 transition-all font-bold text-gray-700 cursor-pointer">
                                        <option value="">-- Pilih Kelompok --</option>
                                        @foreach($kelompoks as $kelompok)
                                            <option value="{{ $kelompok->id }}">{{ $kelompok->nama_kelompok }} (Terisi: {{ $kelompok->mudhohis_count }}/7) @if($kelompok->sapi) - {{ $kelompok->sapi->kode_sapi }} @endif</option>
                                        @endforeach
                                    </select>
                                    @error('id_kelompok_sapi') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                                </div>
                                @endif

                                <div class="bg-gray-50 p-5 rounded-2xl border border-gray-200 mt-6 shadow-inner" 
                                     x-data="{
                                        isCompressing: false, progress: 0, originalSize: '...', compressedSize: 'Proses...', previewUrl: null,
                                        formatBytes(bytes) {
                                            if (bytes === 0) return '0 B'; const k = 1024; const sizes = ['B', 'KB', 'MB', 'GB'];
                                            const i = Math.floor(Math.log(bytes) / Math.log(k));
                                            return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
                                        },
                                        processImage(event) {
                                            const file = event.target.files[0]; if (!file) return;
                                            this.isCompressing = true; this.progress = 10; this.originalSize = this.formatBytes(file.size);
                                            this.compressedSize = 'Nge-press...'; this.previewUrl = null;
                                            
                                            const reader = new FileReader(); reader.readAsDataURL(file);
                                            reader.onload = (e) => {
                                                const img = new Image(); img.src = e.target.result;
                                                img.onload = () => {
                                                    this.progress = 30;
                                                    const canvas = document.createElement('canvas'); const ctx = canvas.getContext('2d');
                                                    const MAX_DIM = 800; let w = img.width; let h = img.height;
                                                    if (w > h && w > MAX_DIM) { h *= MAX_DIM / w; w = MAX_DIM; } else if (h > MAX_DIM) { w *= MAX_DIM / h; h = MAX_DIM; }
                                                    canvas.width = w; canvas.height = h;
                                                    ctx.fillStyle = 'white'; ctx.fillRect(0, 0, w, h); ctx.drawImage(img, 0, 0, w, h);
                                                    
                                                    this.progress = 60; let quality = 0.9;
                                                    let base64data = canvas.toDataURL('image/jpeg', quality);
                                                    let calcSize = Math.round((base64data.length - 814) / 1.37);

                                                    while (calcSize > 100000 && quality > 0.1) {
                                                        quality -= 0.1; base64data = canvas.toDataURL('image/jpeg', Math.max(0.1, quality));
                                                        calcSize = Math.round((base64data.length - 814) / 1.37);
                                                    }

                                                    this.progress = 80; this.compressedSize = this.formatBytes(calcSize); this.previewUrl = base64data;
                                                    
                                                    try {
                                                        const byteString = atob(base64data.split(',')[1]);
                                                        const mimeString = base64data.split(',')[0].split(':')[1].split(';')[0];
                                                        const ab = new ArrayBuffer(byteString.length);
                                                        const ia = new Uint8Array(ab);
                                                        for (let i = 0; i < byteString.length; i++) { ia[i] = byteString.charCodeAt(i); }
                                                        const blob = new Blob([ab], { type: mimeString });
                                                        
                                                        const newFilename = file.name.replace(/\.[^/.]+$/, '') + '_compressed.jpg';
                                                        const newFile = new File([blob], newFilename, { type: 'image/jpeg' });
                                                        this.$wire.upload('bukti_pendaftaran', newFile, 
                                                            (u) => { this.progress = 100; setTimeout(() => { this.isCompressing = false; }, 1500); }, 
                                                            () => { this.isCompressing = false; alert('Gagal upload ke server!'); }, 
                                                            (ev) => { this.progress = 80 + (ev.detail.progress * 0.2); }
                                                        );
                                                    } catch (err) {
                                                        console.error(err);
                                                        alert('Terjadi kesalahan saat memproses gambar.');
                                                        this.isCompressing = false;
                                                    }
                                                }
                                            }
                                        }
                                     }" 
                                     x-init="$watch('$wire.isModalOpen', v => { if(!v) { previewUrl=null; progress=0; isCompressing=false; document.getElementById('fileInputBukti').value=''; } })">
                                    
                                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-4">Bukti Pembayaran / Transfer (Opsional)</label>
                                    <div class="flex items-start gap-5">
                                        <div class="shrink-0 relative">
                                            <template x-if="previewUrl">
                                                <img :src="previewUrl" class="w-20 h-20 object-cover rounded-xl border-2 border-emerald-400 shadow-md">
                                            </template>
                                            <template x-if="!previewUrl">
                                                <div>
                                                    @if($existing_bukti && !$bukti_pendaftaran)
                                                        <img src="{{ asset('storage/'.$existing_bukti) }}" class="w-20 h-20 object-cover rounded-xl border border-gray-300 shadow-sm">
                                                    @else
                                                        <div class="w-20 h-20 bg-white rounded-xl border-2 border-dashed border-gray-300 flex items-center justify-center text-gray-300">
                                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                                                        </div>
                                                    @endif
                                                </div>
                                            </template>
                                            <div x-show="progress === 100 && !isCompressing" x-cloak class="absolute -top-2 -right-2 bg-emerald-500 text-white rounded-full p-1 shadow-lg">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                            </div>
                                        </div>

                                        <div class="flex-1 w-full pt-1">
                                            <input type="file" accept="image/png, image/jpeg, image/jpg" @change="processImage($event)" id="fileInputBukti" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-wider file:bg-primary-600 file:text-white hover:file:bg-primary-700 cursor-pointer transition shadow-sm mb-2">
                                            
                                            <div x-show="isCompressing" x-cloak class="w-full mt-3">
                                                <div class="flex justify-between text-[10px] font-bold text-primary-600 mb-1.5">
                                                    <span>Ukuran: <span class="text-gray-400 line-through" x-text="originalSize"></span> <span class="text-emerald-600 ml-1" x-text="compressedSize"></span></span>
                                                    <span x-text="Math.round(progress) + '%'"></span>
                                                </div>
                                                <div class="w-full bg-primary-100 rounded-full h-2 overflow-hidden shadow-inner">
                                                    <div class="bg-primary-600 h-2 rounded-full transition-all duration-300 relative" :style="`width: ${progress}%`"></div>
                                                </div>
                                            </div>
                                            
                                            <div x-show="progress === 100 && !isCompressing" x-cloak class="text-[10px] text-emerald-600 mt-2 font-bold flex items-center gap-1 bg-emerald-50 py-1.5 px-3 rounded-lg border border-emerald-100">
                                                Gambar siap disimpan! (<span x-text="compressedSize"></span>)
                                            </div>
                                            @error('bukti_pendaftaran') <span class="text-red-500 text-xs mt-2 block font-bold">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 px-8 py-5 flex flex-row-reverse gap-3 rounded-b-3xl border-t border-gray-100">
                            <button type="submit" class="px-8 py-3 text-white font-black text-sm rounded-xl shadow-lg transition transform hover:-translate-y-0.5 flex items-center gap-2" style="background-color: var(--color-primary-600);">
                                <svg wire:loading wire:target="save" class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                Simpan Pendaftar
                            </button>
                            <button type="button" @click="$wire.closeModal()" class="px-8 py-3 bg-white text-gray-500 font-bold text-sm rounded-xl border border-gray-200 hover:bg-gray-100 transition">Batal</button>
                        </div>
                    </form>
                </div>
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
                <h3 class="text-xl font-black text-gray-800 mb-2">Hapus Pendaftar?</h3>
                <p class="text-sm text-gray-500 mb-6">Data, Kupon, dan QR Code akan dihapus permanen.</p>
                <div class="flex gap-3">
                    <button @click="$wire.isDeleteModalOpen = false" class="flex-1 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl">Batal</button>
                    <button wire:click="executeDelete" class="flex-1 py-3 bg-red-600 text-white font-bold rounded-xl">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>
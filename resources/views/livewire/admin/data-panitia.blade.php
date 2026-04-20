<div class="relative">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-primary-100 text-primary-700 rounded-xl shadow-sm">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800 tracking-wide">Struktur Panitia {{ $tahun_aktif }}</h2>
                <p class="text-sm text-gray-500 mt-1">Manajemen tim operasional dan kupon qurban khusus panitia.</p>
            </div>
        </div>
        <button wire:click="openModal" class="px-5 py-2.5 text-white font-bold rounded-xl shadow-lg shadow-primary-900/20 transition transform hover:-translate-y-0.5 flex items-center gap-2" style="background-color: var(--color-primary-600);">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Tim Panitia
        </button>
    </div>

    <div class="mb-10 relative max-w-md">
        <div class="relative group">
            <input wire:model.live.debounce.300ms="search" type="text" id="floating_search"
                class="block px-12 py-5 w-full text-sm font-black text-gray-900 bg-white rounded-[2rem] border-2 border-gray-100 appearance-none focus:outline-none focus:ring-4 focus:ring-primary-500/10 focus:border-primary-600 peer shadow-sm transition-all" 
                placeholder=" " />
            <label for="floating_search" 
                class="absolute text-sm font-bold text-gray-400 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-11 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-5 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">
                Cari Nama, NIK, atau Jabatan...
            </label>
            <div class="absolute left-4 top-1/2 -translate-y-1/2 p-1.5 bg-primary-50 text-primary-600 rounded-xl group-focus-within:bg-primary-600 group-focus-within:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
        @forelse ($panitias as $p)
            <div class="group bg-white rounded-[2.5rem] p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:shadow-primary-900/5 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden flex flex-col h-full">
                <div class="absolute top-0 right-0 p-4 opacity-30 group-hover:opacity-100 transition-opacity flex gap-2 z-10">
                    @if($p->status_pengambilan == 'Sudah')
                        <button disabled class="p-2 bg-gray-100 text-gray-400 rounded-xl cursor-not-allowed shadow-sm" title="Panitia yang sudah ambil jatah tidak dapat diubah">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </button>
                        <button disabled class="p-2 bg-gray-100 text-gray-400 rounded-xl cursor-not-allowed shadow-sm" title="Panitia yang sudah ambil jatah tidak dapat dihapus">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    @else
                        <button wire:click="openModal({{ $p->id }})" class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </button>
                        <button wire:click="confirmDelete({{ $p->id }})" class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    @endif
                </div>

                <div class="flex flex-col items-center mb-6">
                    @php
                        $imgUrl = $p->warga->path_img ? asset('storage/'.$p->warga->path_img).'?v='.time() : 'https://ui-avatars.com/api/?name='.urlencode($p->warga->nama).'&background=random&color=fff&bold=true';
                    @endphp
                    <div class="relative mb-4">
                        <img src="{{ $imgUrl }}" class="w-24 h-24 rounded-full object-cover shadow-md border-4 border-white ring-4 ring-primary-50 transition group-hover:scale-105 duration-500">
                        @if($p->status_pengambilan == 'Sudah')
                            <span class="absolute -bottom-1 -right-1 bg-emerald-500 text-white p-1.5 rounded-full border-4 border-white shadow-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </span>
                        @endif
                    </div>
                    <h3 class="text-lg font-black text-gray-900 text-center leading-tight group-hover:text-primary-700 transition-colors">{{ $p->warga->nama }}</h3>
                    
                    <div class="mt-2 flex flex-col items-center gap-1.5">
                        <div class="px-3 py-1 bg-gray-50 rounded-full border border-gray-200">
                            <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest">NIK: {{ $p->warga->nik ?? '-' }}</p>
                        </div>
                        <div class="px-3 py-1 bg-primary-50 rounded-full border border-primary-100">
                            <p class="text-[9px] font-black text-primary-600 uppercase tracking-widest">KODE: {{ $p->kode_unik_kupon }}</p>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-gray-50 rounded-[2.5rem] border-2 border-dashed border-gray-100 relative group/qr overflow-hidden shadow-inner transition-all hover:bg-white hover:border-primary-200 hover:shadow-xl hover:shadow-primary-900/5">
                        @if($p->path_qr_code)
                            <img src="{{ asset('storage/'.$p->path_qr_code) }}" 
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
                        <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Jabatan</span>
                            <span class="text-[10px] font-black text-gray-800 uppercase text-right leading-tight max-w-[120px]">{{ $p->jabatan }}</span>
                        </div>
                        @if($p->id_kelompok_sapi)
                            <button wire:click="openListModal({{ $p->id_kelompok_sapi }})" class="mt-1 flex justify-between items-center group/klp w-full">
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest group-hover/klp:text-primary-500 transition-colors">Unit/Klp</span>
                                <span class="text-[10px] font-black text-primary-600 uppercase group-hover/klp:underline decoration-dashed transition-all underline-offset-4">{{ $p->kelompokSapi->nama_kelompok }}</span>
                            </button>
                        @endif
                    </div>

                    <div class="bg-gray-50 p-3 rounded-2xl border border-gray-100 flex flex-col items-center justify-center">
                        <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Status Pengambilan</span>
                        @if($p->status_pengambilan == 'Sudah')
                            <div class="flex flex-col items-center">
                                <span class="text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em]">SUDAH DIAMBIL</span>
                                <span class="text-[8px] text-gray-400 font-bold mt-0.5">{{ $p->waktu_diambil?->format('H:i') }} WIB</span>
                            </div>
                        @else
                            <span class="text-[10px] font-black text-amber-500 uppercase tracking-[0.2em] animate-pulse">MENUNGGU</span>
                        @endif
                    </div>
                </div>

                @if($p->warga->phone_number)
                    <div class="mt-6">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $p->warga->phone_number) }}" target="_blank" class="w-full py-3 px-4 bg-emerald-50 text-emerald-700 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-emerald-600 hover:text-white transition-all shadow-sm flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217s.231.001.332.005c.109.004.258-.041.404.314.145.356.491 1.197.535 1.285.044.088.072.19.014.307s-.088.134-.175.235c-.087.101-.183.225-.261.303-.093.093-.19.194-.081.381.109.187.485.802 1.039 1.296.714.637 1.316.833 1.503.927.187.094.297.078.406-.047.109-.125.462-.535.586-.717.124-.182.248-.153.419-.089s1.085.512 1.273.6c.188.089.312.134.358.21.046.076.046.438-.098.843z"/></svg>
                            {{ $p->warga->phone_number }}
                        </a>
                    </div>
                @endif
            </div>
        @empty
            <div class="col-span-full py-20 bg-white rounded-[3rem] border-2 border-dashed border-gray-100 flex flex-col items-center justify-center text-center">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <h3 class="text-xl font-black text-gray-800">Tidak ada tim panitia</h3>
                <p class="text-gray-400 font-bold mt-1 uppercase tracking-widest text-xs">Belum ada panitia yang terdaftar di tahun ini, wak!</p>
            </div>
        @endforelse
    </div>

    @if ($panitias->hasMorePages())
        <div class="flex justify-center pb-10">
            <button wire:click="loadMore" wire:loading.attr="disabled" class="group relative px-12 py-4 bg-white border-2 border-primary-100 text-primary-700 font-black rounded-2xl shadow-sm hover:bg-primary-600 hover:text-white hover:border-primary-600 transition-all duration-300 flex items-center gap-3 active:scale-95">
                <span wire:loading.remove wire:target="loadMore">LOAD MORE PANITIA</span>
                <span wire:loading wire:target="loadMore" class="flex items-center gap-3">
                    <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    LOADING...
                </span>
                <svg wire:loading.remove wire:target="loadMore" class="w-5 h-5 group-hover:translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
            </button>
        </div>
    @endif

    @if ($panitias->total() > 0 && !$panitias->hasMorePages())
        <div class="text-center pb-10">
            <span class="px-6 py-2 bg-gray-100 text-gray-400 font-black text-[10px] uppercase tracking-[0.2em] rounded-full">SEMUA DATA TELAH DITAMPILKAN</span>
        </div>
    @endif


    <div x-cloak x-show="$wire.isModalOpen" class="relative z-[100]">
        <div x-show="$wire.isModalOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm"></div>
             
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto flex items-center justify-center p-4">
            <div @click.away="$wire.isModalOpen = false" class="bg-white rounded-[2.5rem] w-full max-w-2xl overflow-visible shadow-2xl relative">
                <form wire:submit.prevent="save">
                    <div class="p-8 md:p-10">
                        <h3 class="text-2xl font-black text-gray-800 mb-8 border-b pb-4 flex items-center gap-3">
                            <span class="p-2 bg-primary-100 text-primary-600 rounded-xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </span>
                            {{ $editId ? 'Sunting Data Panitia' : 'Registrasi Panitia Baru' }}
                        </h3>
                        
                        <div class="grid grid-cols-1 gap-y-7">
    
    @if(!$editId)
        <div wire:ignore x-data='{
                tom: null,
                init() {
                    this.tom = new TomSelect(this.$refs.wargaSelect, {
                        valueField: "id", searchField: ["nama", "nik"], placeholder: "Cari Warga...",
                        render: {
                            option: function(data, escape) {
                                return `<div class="flex items-center gap-3 p-2">
                                            <img class="w-9 h-9 rounded-full object-cover border border-gray-100 shadow-sm" src="${data.img}">
                                            <div>
                                                <div class="font-black text-gray-800">${escape(data.nama)}</div>
                                                <div class="text-[10px] text-gray-400 font-bold uppercase tracking-tight">NIK: ${escape(data.nik)}</div>
                                            </div>
                                        </div>`;
                            },
                            item: function(data, escape) {
                                return `<div class="flex items-center gap-2"><img class="w-6 h-6 rounded-full object-cover border border-white shadow-sm" src="${data.img}"><span class="font-bold text-sm text-gray-700">${escape(data.nama)}</span></div>`;
                            }
                        },
                        onChange: (value) => { $wire.set("id_warga", value); }
                    });

                    $wire.$watch("id_warga", (value) => {
                        if (!value) { this.tom.clear(true); }
                    });
                }
             }'>
            <label class="block text-[10px] font-black text-gray-400 uppercase mb-3 ml-1 tracking-widest">
                Identitas Panitia (Calon Warga)
            </label>
            <div>
                <select x-ref="wargaSelect" class="w-full ts-custom-premium">
                    <option value="">Cari Warga...</option>
                    @foreach($wargas as $warga)
                        @php 
                            $imgUrl = $warga->path_img 
                                ? asset('storage/'.$warga->path_img) 
                                : 'https://ui-avatars.com/api/?name='.urlencode($warga->nama).'&background=10b981&color=fff&size=150'; 
                        @endphp
                        <option value="{{ $warga->id }}" data-nama="{{ $warga->nama }}" data-nik="{{ $warga->nik }}" data-img="{{ $imgUrl }}">
                            {{ $warga->nama }} ({{ $warga->nik }})
                        </option>
                    @endforeach
                </select>
            </div>
            @error('id_warga') <span class="text-red-500 text-[10px] mt-2 block font-black uppercase tracking-tight">{{ $message }}</span> @enderror
        </div>

    @else
        @php
            $editWarga = \App\Models\Warga::find($id_warga);
        @endphp
        
        @if($editWarga)
        <div class="relative animate-fadeIn">
            <label class="block text-[10px] font-black text-gray-400 uppercase mb-3 ml-1 tracking-widest flex items-center gap-2">
                Identitas Panitia
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
            <p class="text-[9px] text-gray-400 font-bold mt-2 ml-1 italic">* Identitas Panitia Terintegrasi dan tidak dapat diubah setelah terdaftar. Ubah jabatan di bawah jika perlu.</p>
        </div>
        @endif
    @endif

    <div class="relative">
        <label class="block text-[10px] font-black text-gray-400 uppercase mb-3 ml-1 tracking-widest">Jabatan Kepanitiaan</label>
        <select wire:model.live="jabatan" class="w-full px-5 py-3.5 rounded-2xl border-2 border-gray-100 focus:border-primary-500 bg-gray-50 focus:bg-white transition-all outline-none font-bold text-gray-700 shadow-sm appearance-none">
            <option value="">-- Pilih Jabatan --</option>
            @foreach(['Penanggung Jawab Qurban', 'Ketua Qurban', 'Koordinator', 'Sekretaris Qurban', 'Bendahara Qurban', 'Ketua Prepare Sapi', 'Anggota Prepare Sapi', 'Ketua Kelompok Qurban', 'Anggota Kelompok Qurban'] as $j)
                <option value="{{ $j }}">{{ $j }}</option>
            @endforeach
        </select>
        <div class="absolute right-5 top-[46px] pointer-events-none text-gray-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
        </div>
        @error('jabatan') <span class="text-red-500 text-[10px] mt-2 block font-black uppercase tracking-tight">{{ $message }}</span> @enderror
    </div>

    @if(in_array($jabatan, ['Ketua Kelompok Qurban', 'Anggota Kelompok Qurban']))
        <div class="p-6 bg-primary-50/50 rounded-[2rem] border-2 border-dashed border-primary-100 animate-fadeIn relative overflow-hidden">
            <label class="block text-[10px] font-black uppercase mb-3 ml-1 tracking-widest" style="color: var(--color-primary-600);">Alokasi Kelompok Sapi</label>
            <select wire:model.live="id_kelompok_sapi" class="w-full px-5 py-3.5 rounded-2xl border-2 border-white focus:border-primary-500 transition-all outline-none font-bold text-gray-700 mb-4 shadow-md">
                <option value="">-- Pilih Kelompok --</option>
                @foreach($kelompoks as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_kelompok }}</option>
                @endforeach
            </select>
            
            @if($jabatan == 'Anggota Kelompok Qurban' && $id_kelompok_sapi)
                <div class="flex items-center gap-4 px-4 py-3 bg-white rounded-xl border border-primary-100 shadow-sm transition-all animate-slideDown">
                    <div class="w-10 h-10 rounded-lg bg-primary-50 flex items-center justify-center text-primary-600" style="color: var(--color-primary-600);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[9px] font-black uppercase tracking-widest opacity-50" style="color: var(--color-primary-600);">Ketua Kelompok:</p>
                        <p class="text-sm font-black text-gray-700 italic">"{{ $namaKetua }}"</p>
                    </div>
                </div>
            @endif
            @error('id_kelompok_sapi') <span class="text-red-500 text-[10px] mt-2 block font-black uppercase tracking-tight">{{ $message }}</span> @enderror
        </div>
    @endif
</div>
                    </div>

                    <div class="bg-gray-50 rounded-[2.5rem] px-8 py-6 flex flex-row-reverse gap-3 border-t border-gray-100">
                        <button type="submit" class="px-10 py-3.5 text-white font-black text-sm rounded-2xl shadow-lg shadow-primary-900/20 transition transform hover:-translate-y-1 active:scale-95 flex items-center gap-2 group" style="background-color: var(--color-primary-600);">
                            <svg wire:loading wire:target="save" class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            <span>Simpan Tim Panitia</span>
                        </button>
                        <button type="button" wire:click="$set('isModalOpen', false)" class="px-8 py-3.5 bg-white text-gray-500 font-bold text-sm rounded-2xl border-2 border-gray-100 hover:bg-gray-100 transition transition-all active:scale-95">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div x-cloak x-show="$wire.isDeleteModalOpen" class="relative z-[150]">
        <div x-show="$wire.isDeleteModalOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm"></div>
             
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto flex items-center justify-center p-4">
            <div @click.away="$wire.isDeleteModalOpen = false" class="bg-white rounded-[2rem] shadow-2xl w-full max-w-sm text-center p-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-red-500"></div>
                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-red-50 mb-6">
                    <svg class="h-10 w-10 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </div>
                <h3 class="text-xl font-black text-gray-800 mb-2 tracking-tight">Hapus Panitia?</h3>
                <p class="text-sm text-gray-500 mb-8 leading-relaxed">Menghapus panitia akan membatalkan kupon QR operasional mereka secara permanen.</p>
                <div class="flex flex-col gap-3">
                    <button wire:click="executeDelete" class="w-full py-3.5 bg-red-600 hover:bg-red-700 text-white font-black rounded-2xl shadow-lg shadow-red-900/20 transition transform hover:-translate-y-1">Ya, Hapus Permanen</button>
                    <button @click="$wire.isDeleteModalOpen = false" class="w-full py-3.5 bg-gray-100 text-gray-700 font-bold rounded-2xl hover:bg-gray-200 transition">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Daftar Panitia Kelompok -->
    <div x-cloak x-show="$wire.isListModalOpen" class="relative z-[150]">
        <div x-show="$wire.isListModalOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto flex items-center justify-center p-4">
            <div @click.away="$wire.isListModalOpen = false" class="bg-white rounded-[3rem] w-full max-w-md overflow-hidden shadow-2xl relative border border-gray-100">
                @if($selectedKelompok)
                    <div class="p-8">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="p-4 bg-primary-100 text-primary-600 rounded-2xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-black text-gray-800 leading-tight">{{ $selectedKelompok->nama_kelompok }}</h3>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">Daftar Panitia Kelompok</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <!-- BAGIAN KETUA -->
                            <div>
                                <label class="text-[10px] font-black text-primary-600 uppercase tracking-[0.2em] mb-4 block">Ketua Kelompok</label>
                                @forelse($panitiaKelompok['ketua'] as $pk)
                                    <div class="flex items-center gap-4 p-4 bg-primary-50 rounded-2xl border border-primary-100">
                                        <img src="{{ $pk->warga->path_img ? asset('storage/'.$pk->warga->path_img) : 'https://ui-avatars.com/api/?name='.urlencode($pk->warga->nama).'&background=random' }}" class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-sm">
                                        <div>
                                            <p class="font-black text-gray-800">{{ $pk->warga->nama }}</p>
                                            <p class="text-[10px] text-primary-600 font-bold uppercase tracking-widest mt-0.5">KODE: {{ $pk->kode_unik_kupon }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-xs text-gray-400 font-bold italic text-center py-2">Belum ada ketua</p>
                                @endforelse
                            </div>

                            <hr class="border-dashed border-gray-200">

                            <!-- BAGIAN ANGGOTA -->
                            <div>
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4 block">Anggota Kelompok</label>
                                <div class="space-y-3">
                                    @forelse($panitiaKelompok['anggota'] as $pa)
                                        <div class="flex items-center gap-4 p-3 hover:bg-gray-50 rounded-2xl transition-colors border border-transparent hover:border-gray-100">
                                            <img src="{{ $pa->warga->path_img ? asset('storage/'.$pa->warga->path_img) : 'https://ui-avatars.com/api/?name='.urlencode($pa->warga->nama).'&background=random' }}" class="w-10 h-10 rounded-full object-cover grayscale-[30%]">
                                            <div>
                                                <p class="text-sm font-black text-gray-700">{{ $pa->warga->nama }}</p>
                                                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">{{ $pa->kode_unik_kupon }}</p>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-xs text-gray-400 font-bold italic text-center py-4">Belum ada anggota</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <button @click="$wire.isListModalOpen = false" class="w-full mt-10 py-4 bg-gray-100 text-gray-500 font-black rounded-2xl hover:bg-gray-200 transition-all active:scale-95 text-xs uppercase tracking-widest">Tutup Daftar</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling agar TomSelect CREATE tetap premium */
    .ts-custom-premium .ts-control {
        border-radius: 1rem !important;
        border-width: 2px !important;
        padding-top: 0.75rem !important;
        padding-bottom: 0.75rem !important;
        border-color: #f3f4f6 !important;
        background-color: #f9fafb !important;
        font-weight: 700 !important;
        transition-property: all !important;
        transition-duration: 200ms !important;
    }
    .ts-custom-premium.focus .ts-control {
        border-color: #10b981 !important; /* emerald-500 */
        background-color: #ffffff !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
    }
    .ts-custom-premium .ts-control .item {
        color: #1f2937 !important;
    }
</style>
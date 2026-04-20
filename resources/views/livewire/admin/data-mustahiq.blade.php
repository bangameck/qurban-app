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
        @forelse ($mustahiqs as $m)
            <div class="group bg-white rounded-[2.5rem] p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:shadow-primary-900/5 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden flex flex-col h-full">
                <div class="absolute top-0 right-0 p-4 opacity-30 group-hover:opacity-100 transition-opacity flex gap-2 z-10">
                    <a href="{{ route('kupon.detail', $m->kode_unik_kupon) }}" target="_blank" class="p-2 bg-emerald-50 text-emerald-600 rounded-xl hover:bg-emerald-600 hover:text-white transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                    @if($m->status_pengambilan == 'Sudah')
                        <button disabled class="p-2 bg-gray-100 text-gray-400 rounded-xl cursor-not-allowed shadow-sm" title="Data yang sudah diambil tidak dapat dihapus">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    @else
                        <button wire:click="confirmDelete({{ $m->id }})" class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    @endif
                </div>

                <div class="flex flex-col items-center mb-6">
                    @php
                        $imgUrl = $m->warga->path_img ? asset('storage/'.$m->warga->path_img).'?v='.time() : 'https://ui-avatars.com/api/?name='.urlencode($m->warga->nama).'&background=random&color=fff&bold=true';
                    @endphp
                    <div class="relative mb-4">
                        <img src="{{ $imgUrl }}" class="w-24 h-24 rounded-full object-cover shadow-md border-4 border-white ring-4 ring-primary-50 transition group-hover:scale-105 duration-500">
                        @if($m->status_pengambilan == 'Sudah')
                            <span class="absolute -bottom-1 -right-1 bg-emerald-500 text-white p-1.5 rounded-full border-4 border-white shadow-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </span>
                        @endif
                    </div>
                    <h3 class="text-lg font-black text-gray-900 text-center leading-tight group-hover:text-primary-700 transition-colors">{{ $m->warga->nama }}</h3>
                    
                    <div class="mt-2 flex flex-col items-center gap-1.5">
                        <div class="px-3 py-1 bg-gray-50 rounded-full border border-gray-200">
                            <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest">NIK: {{ $m->warga->nik ?? '-' }}</p>
                        </div>
                        @if($m->warga->no_kk)
                            <div class="px-3 py-1 bg-gray-50 rounded-full border border-gray-200">
                                <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest">KK: {{ $m->warga->no_kk }}</p>
                            </div>
                        @endif
                        <div class="px-3 py-1 bg-primary-50 rounded-full border border-primary-100">
                            <p class="text-[9px] font-black text-primary-600 uppercase tracking-widest">KODE: {{ $m->kode_unik_kupon }}</p>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-gray-50 rounded-[2.5rem] border-2 border-dashed border-gray-100 relative group/qr overflow-hidden shadow-inner transition-all hover:bg-white hover:border-primary-200 hover:shadow-xl hover:shadow-primary-900/5">
                        @if($m->path_qr_code)
                            <img src="{{ asset('storage/'.$m->path_qr_code) }}" 
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
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Sesi</span>
                            <span class="text-xs font-black text-gray-800">{{ $m->sesiDistribusi->nama_sesi }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Kategori</span>
                            <span class="px-2 py-0.5 rounded-lg text-[9px] font-black uppercase {{ $m->kategori_penerima == 'Mudhohi' ? 'bg-amber-100 text-amber-700' : ($m->kategori_penerima == 'Panitia' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700') }}">
                                {{ $m->kategori_penerima }}
                            </span>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-3 rounded-2xl border border-gray-100 flex flex-col items-center justify-center">
                        <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Status Pengambilan</span>
                        @if($m->status_pengambilan == 'Sudah')
                            <div class="flex flex-col items-center">
                                <span class="text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em]">SUDAH DIAMBIL</span>
                                <span class="text-[8px] text-gray-400 font-bold mt-0.5">{{ $m->waktu_diambil?->format('H:i') }} WIB</span>
                            </div>
                        @else
                            <span class="text-[10px] font-black text-amber-500 uppercase tracking-[0.2em] animate-pulse text-center">BELUM DIAMBIL</span>
                        @endif
                    </div>
                </div>

                @if($m->warga->phone_number)
                    <div class="mt-6">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $m->warga->phone_number) }}" target="_blank" class="w-full py-3 px-4 bg-emerald-50 text-emerald-700 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-emerald-600 hover:text-white transition-all shadow-sm flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217s.231.001.332.005c.109.004.258-.041.404.314.145.356.491 1.197.535 1.285.044.088.072.19.014.307s-.088.134-.175.235c-.087.101-.183.225-.261.303-.093.093-.19.194-.081.381.109.187.485.802 1.039 1.296.714.637 1.316.833 1.503.927.187.094.297.078.406-.047.109-.125.462-.535.586-.717.124-.182.248-.153.419-.089s1.085.512 1.273.6c.188.089.312.134.358.21.046.076.046.438-.098.843z"/></svg>
                            {{ $m->warga->phone_number }}
                        </a>
                    </div>
                @endif
            </div>
        @empty
            <div class="col-span-full py-20 bg-white rounded-[3rem] border-2 border-dashed border-gray-100 flex flex-col items-center justify-center text-center">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                </div>
                <h3 class="text-xl font-black text-gray-800">Tidak ada data kupon</h3>
                <p class="text-gray-400 font-bold mt-1 uppercase tracking-widest text-xs">Belum ada kupon yang dibuat, wak!</p>
            </div>
        @endforelse
    </div>

    @if ($mustahiqs->hasMorePages())
        <div class="flex justify-center pb-10">
            <button wire:click="loadMore" wire:loading.attr="disabled" class="group relative px-12 py-4 bg-white border-2 border-primary-100 text-primary-700 font-black rounded-2xl shadow-sm hover:bg-primary-600 hover:text-white hover:border-primary-600 transition-all duration-300 flex items-center gap-3 active:scale-95">
                <span wire:loading.remove wire:target="loadMore">LOAD MORE KUPON</span>
                <span wire:loading wire:target="loadMore" class="flex items-center gap-3">
                    <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    LOADING...
                </span>
                <svg wire:loading.remove wire:target="loadMore" class="w-5 h-5 group-hover:translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
            </button>
        </div>
    @endif

    @if ($mustahiqs->total() > 0 && !$mustahiqs->hasMorePages())
        <div class="text-center pb-10">
            <span class="px-6 py-2 bg-gray-100 text-gray-400 font-black text-[10px] uppercase tracking-[0.2em] rounded-full">SEMUA DATA TELAH DITAMPILKAN</span>
        </div>
    @endif


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
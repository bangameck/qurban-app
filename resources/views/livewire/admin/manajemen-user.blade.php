<div class="relative">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-primary-100 text-primary-700 rounded-xl shadow-sm">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800 tracking-wide">Manajemen User</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola akun login dan hak akses pengguna sistem.</p>
            </div>
        </div>
        <button wire:click="openModal" class="px-5 py-2.5 bg-primary-600 text-white font-bold rounded-xl shadow-lg shadow-primary-900/20 hover:bg-primary-700 transition transform hover:-translate-y-0.5 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah User
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden relative z-0">
        <div class="p-4 border-b border-gray-100 bg-gray-50/50">
            <input wire:model.live.debounce.300ms="search" type="text"
                class="w-full md:w-72 pl-4 pr-4 py-2 rounded-xl border border-gray-200 focus:border-primary-500 outline-none transition"
                placeholder="Cari nama atau email...">
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-700 font-bold uppercase text-xs tracking-wider border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4">Pengguna</th>
                        <th class="px-6 py-4">Email / Role</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($users as $user)
                        <tr wire:key="user-row-{{ $user->id }}" class="hover:bg-primary-50/30 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $user->warga?->path_img ? asset('storage/'.$user->warga->path_img) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=6366f1&color=fff&size=150' }}"
                                         class="w-10 h-10 rounded-full object-cover shadow-sm border border-gray-200">
                                    <div>
                                        <div class="font-black text-gray-800">{{ $user->name }}</div>
                                        <div class="text-[10px] text-gray-400 font-mono">NIK: {{ $user->warga?->nik ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-700 text-xs">{{ $user->email }}</div>
                                @if($user->roles->count())
                                    <div class="flex flex-wrap gap-1 mt-1">
                                        @foreach($user->roles as $role)
                                            <span class="px-2 py-0.5 bg-violet-100 text-violet-700 rounded text-[9px] font-black uppercase">{{ $role->name }}</span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-[10px] text-gray-400 italic">Belum ada role</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button wire:click="toggleStatus({{ $user->id }})" title="{{ $user->status ? 'Nonaktifkan' : 'Aktifkan' }}">
                                    @if($user->status)
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-black rounded-full uppercase border border-emerald-200">
                                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span> Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-red-100 text-red-700 text-[10px] font-black rounded-full uppercase border border-red-200">
                                            <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span> Nonaktif
                                        </span>
                                    @endif
                                </button>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    {{-- Reset Password --}}
                                    <button wire:click="confirmResetPassword({{ $user->id }})" class="p-2 text-amber-600 bg-amber-50 rounded-lg hover:bg-amber-600 hover:text-white transition" title="Reset Password">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                                    </button>
                                    {{-- Edit --}}
                                    <button wire:click="openModal({{ $user->id }})" class="p-2 text-primary-600 bg-primary-50 rounded-lg hover:bg-primary-600 hover:text-white transition" title="Edit User">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    </button>
                                    {{-- Hapus --}}
                                    <button wire:click="confirmDelete({{ $user->id }})" class="p-2 text-red-600 bg-red-50 rounded-lg hover:bg-red-600 hover:text-white transition" title="Hapus User">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400 font-bold">Belum ada user yang terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100 bg-gray-50">
            {{ $users->links() }}
        </div>
    </div>

    {{-- ===== MODAL CREATE / EDIT ===== --}}
    <div x-cloak x-show="$wire.isModalOpen" class="relative z-[100]">
        <div x-show="$wire.isModalOpen"
             x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto flex items-center justify-center p-4">
            <div @click.away="$wire.closeModal()" class="bg-white rounded-[2.5rem] w-full max-w-xl overflow-visible shadow-2xl relative">
                <form wire:submit.prevent="save">
                    <div class="p-8 md:p-10">
                        <h3 class="text-2xl font-black text-gray-800 mb-8 border-b pb-4 flex items-center gap-3">
                            <span class="p-2 bg-primary-100 text-primary-600 rounded-xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </span>
                            {{ $editId ? 'Edit Data User' : 'Tambah User Baru' }}
                        </h3>

                        <div class="grid grid-cols-1 gap-y-7">

                            {{-- Pilih Warga (Tom Select, hanya saat create) --}}
                            @if(!$editId)
                                <div wire:ignore x-data='{
                                    tom: null,
                                    init() {
                                        this.tom = new TomSelect(this.$refs.wargaSelect, {
                                            valueField: "id", searchField: ["nama", "nik"],
                                            placeholder: "Cari Warga...",
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
                                }' class="relative z-50">
                                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-3 ml-1 tracking-widest">
                                        Pilih Warga
                                    </label>
                                    <select x-ref="wargaSelect" class="w-full ts-custom-premium">
                                        <option value="">Cari Warga...</option>
                                        @foreach($wargas as $warga)
                                            @php
                                                $imgUrl = $warga->path_img
                                                    ? asset('storage/'.$warga->path_img)
                                                    : 'https://ui-avatars.com/api/?name='.urlencode($warga->nama).'&background=6366f1&color=fff&size=150';
                                            @endphp
                                            <option value="{{ $warga->id }}"
                                                data-nama="{{ $warga->nama }}"
                                                data-nik="{{ $warga->nik }}"
                                                data-img="{{ $imgUrl }}">
                                                {{ $warga->nama }} ({{ $warga->nik }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_warga') <span class="text-red-500 text-[10px] mt-2 block font-black uppercase tracking-tight">{{ $message }}</span> @enderror
                                </div>
                                 @else
                                @php $editWarga = \App\Models\Warga::find($id_warga); @endphp
                                @if($editWarga)
                                <div class="relative">
                                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-3 ml-1 tracking-widest flex items-center gap-2">
                                        Identitas Warga <span class="px-2 py-0.5 bg-gray-200 text-gray-500 rounded text-[8px]">TERKUNCI</span>
                                    </label>
                                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-2xl border border-gray-100">
                                        <img src="{{ $editWarga->path_img ? asset('storage/'.$editWarga->path_img) : 'https://ui-avatars.com/api/?name='.urlencode($editWarga->nama).'&background=6366f1&color=fff&size=150' }}" class="w-12 h-12 rounded-full object-cover border-4 border-white shadow-md">
                                        <div>
                                            <h4 class="font-black text-gray-700">{{ $editWarga->nama }}</h4>
                                            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">NIK: {{ $editWarga->nik }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endif

                            {{-- Email --}}
                            <div class="relative">
                                <input type="email" id="user_email" wire:model="email"
                                    class="peer block px-4 py-3 w-full text-sm text-gray-900 bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-primary-600 transition-all"
                                    placeholder=" " />
                                <label for="user_email" class="absolute text-sm text-gray-500 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-3 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">Email Login</label>
                                @error('email') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                                @if(!$editId)
                                    <p class="text-[10px] text-gray-400 mt-1 ml-1">*Email akan di-generate otomatis saat memilih warga. Bisa diubah manual.</p>
                                @endif
                            </div>

                            @if(!$editId)
                                <div class="p-4 bg-amber-50 border border-amber-200 rounded-2xl flex items-start gap-3">
                                    <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <div>
                                        <p class="text-xs font-black text-amber-700">Password Default</p>
                                        <p class="text-[11px] text-amber-600 mt-0.5">Password awal akan di-set menjadi <span class="font-mono font-black">password123</span>. User dapat menggantinya setelah login.</p>
                                    </div>
                                </div>
                            @endif

                            {{-- Role --}}
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 ml-1 tracking-widest">Hak Akses (Role)</label>
                                <div class="relative">
                                    <select wire:model="role" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-gray-50 focus:bg-white focus:outline-none focus:ring-0 focus:border-primary-600 transition-all font-bold text-gray-700 appearance-none">
                                        <option value="">-- Tanpa Role --</option>
                                        @foreach($roles as $r)
                                            <option value="{{ $r->name }}">{{ ucfirst($r->name) }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute right-4 top-3.5 pointer-events-none text-gray-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </div>
                                </div>
                                @error('role') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                            </div>

                            {{-- Status --}}
                            <div class="flex items-center justify-between p-4 rounded-2xl border"
                                 :class="$wire.status ? 'bg-emerald-50 border-emerald-200' : 'bg-red-50 border-red-200'">
                                <div>
                                    <p class="text-sm font-black" :class="$wire.status ? 'text-emerald-800' : 'text-red-800'">Status Akun</p>
                                    <p class="text-[11px] mt-0.5" :class="$wire.status ? 'text-emerald-600' : 'text-red-500'">
                                        <span x-text="$wire.status ? 'Akun aktif — user dapat login' : 'Nonaktif — akses login dicabut'"></span>
                                    </p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" wire:model="status" class="sr-only peer">
                                    <div class="w-11 h-6 peer-focus:outline-none rounded-full peer
                                        peer-checked:after:translate-x-full peer-checked:after:border-white
                                        after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                        after:bg-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all
                                        bg-red-400 peer-checked:bg-emerald-500"></div>
                                </label>
                            </div>

                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-b-[2.5rem] px-8 py-6 flex flex-row-reverse gap-3 border-t border-gray-100">
                        <button type="submit" class="px-10 py-3.5 bg-primary-600 text-white font-black text-sm rounded-2xl shadow-lg shadow-primary-900/20 hover:bg-primary-700 transition transform hover:-translate-y-1 active:scale-95 flex items-center gap-2">
                            <svg wire:loading wire:target="save" class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            Simpan User
                        </button>
                        <button type="button" wire:click="closeModal" class="px-8 py-3.5 bg-white text-gray-500 font-bold text-sm rounded-2xl border-2 border-gray-100 hover:bg-gray-100 transition active:scale-95">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===== MODAL RESET PASSWORD ===== --}}
    <div x-cloak x-show="$wire.isResetPasswordModalOpen" class="relative z-[150]">
        <div x-show="$wire.isResetPasswordModalOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto flex items-center justify-center p-4">
            <div @click.away="$wire.isResetPasswordModalOpen = false" class="bg-white rounded-[2rem] shadow-2xl w-full max-w-sm text-center p-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-amber-500"></div>
                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-amber-50 mb-6">
                    <svg class="h-10 w-10 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                </div>
                <h3 class="text-xl font-black text-gray-800 mb-2">Reset Password?</h3>
                <p class="text-sm text-gray-500 mb-2 leading-relaxed">Password user akan direset menjadi:</p>
                <p class="font-mono font-black text-amber-600 text-lg mb-6">password123</p>
                <div class="flex flex-col gap-3">
                    <button wire:click="executeResetPassword" class="w-full py-3.5 bg-amber-500 hover:bg-amber-600 text-white font-black rounded-2xl shadow-lg transition transform hover:-translate-y-1">Ya, Reset Password</button>
                    <button @click="$wire.isResetPasswordModalOpen = false" class="w-full py-3.5 bg-gray-100 text-gray-700 font-bold rounded-2xl hover:bg-gray-200 transition">Batal</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== MODAL HAPUS ===== --}}
    <div x-cloak x-show="$wire.isDeleteModalOpen" class="relative z-[150]">
        <div x-show="$wire.isDeleteModalOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto flex items-center justify-center p-4">
            <div @click.away="$wire.isDeleteModalOpen = false" class="bg-white rounded-[2rem] shadow-2xl w-full max-w-sm text-center p-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-red-500"></div>
                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-red-50 mb-6">
                    <svg class="h-10 w-10 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </div>
                <h3 class="text-xl font-black text-gray-800 mb-2 tracking-tight">Hapus User?</h3>
                <p class="text-sm text-gray-500 mb-8 leading-relaxed">Akun login user ini akan dihapus secara permanen.</p>
                <div class="flex flex-col gap-3">
                    <button wire:click="executeDelete" class="w-full py-3.5 bg-red-600 hover:bg-red-700 text-white font-black rounded-2xl shadow-lg shadow-red-900/20 transition transform hover:-translate-y-1">Ya, Hapus Permanen</button>
                    <button @click="$wire.isDeleteModalOpen = false" class="w-full py-3.5 bg-gray-100 text-gray-700 font-bold rounded-2xl hover:bg-gray-200 transition">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .ts-custom-premium .ts-control {
        border-radius: 1rem !important;
        border-width: 2px !important;
        padding-top: 0.75rem !important;
        padding-bottom: 0.75rem !important;
        border-color: #e5e7eb !important;
        background-color: #f9fafb !important;
        font-weight: 700 !important;
        transition-property: all !important;
        transition-duration: 200ms !important;
    }
    .ts-custom-premium.focus .ts-control {
        border-color: var(--color-primary-600, #10b981) !important;
        background-color: #ffffff !important;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06) !important;
    }
    .ts-custom-premium .ts-control .item {
        color: #1f2937 !important;
    }
</style>

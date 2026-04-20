<div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Total Pemasukan</p>
                <h3 class="text-2xl font-black text-emerald-500">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Total Pengeluaran</p>
                <h3 class="text-2xl font-black text-rose-500">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-rose-50 flex items-center justify-center text-rose-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
            </div>
        </div>

        <div class="bg-gradient-to-br from-primary-600 to-primary-800 p-6 rounded-[2rem] shadow-lg shadow-primary-900/20 flex items-center justify-between text-white">
            <div>
                <p class="text-xs font-black text-primary-200 uppercase tracking-widest mb-1">Sisa Anggaran</p>
                <h3 class="text-2xl font-black">Rp {{ number_format($sisaDana, 0, ',', '.') }}</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center backdrop-blur-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <h2 class="text-xl font-black text-gray-800 tracking-wide">RAB QURBAN {{ $tahun_aktif }}</h2>
        <div class="flex items-center gap-3">
            <button wire:click="addRow" class="px-5 py-2.5 bg-white text-gray-700 font-bold rounded-xl border border-gray-200 hover:bg-gray-50 transition flex items-center gap-2 shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Baris
            </button>
            <span class="text-[10px] font-black uppercase text-gray-400 bg-gray-50 px-4 py-2 rounded-xl flex items-center gap-2 border border-gray-100 border-dashed">
                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                Otomatis Tersimpan
            </span>
           <div x-data="{ openExport: false }" class="relative">
                <button @click="openExport = !openExport" @click.away="openExport = false" class="px-5 py-2.5 bg-emerald-50 text-emerald-600 font-bold rounded-xl border border-emerald-200 hover:bg-emerald-100 transition flex items-center gap-2 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Export Data
                    <svg class="w-4 h-4 ml-1 transition-transform" :class="{'rotate-180': openExport}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                
                <div x-show="openExport" x-transition class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-2xl shadow-xl z-50 overflow-hidden" style="display: none;">
                    <a href="{{ route('admin.rab.pdf') }}" target="_blank" class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-gray-700 hover:bg-rose-50 hover:text-rose-600 transition border-b border-gray-50">
                        <svg class="w-5 h-5 text-rose-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                        Export to PDF
                    </a>
                    <a href="{{ route('admin.rab.excel') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition">
                        <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                        Export to Excel
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="p-4 text-xs font-black text-gray-400 uppercase tracking-widest">Jenis</th>
                        <th class="p-4 text-xs font-black text-gray-400 uppercase tracking-widest w-48">List Item (Kategori)</th>
                        <th class="p-4 text-xs font-black text-gray-400 uppercase tracking-widest w-56">Nama Barang</th>
                        <th class="p-4 text-xs font-black text-gray-400 uppercase tracking-widest w-24">Jumlah</th>
                        <th class="p-4 text-xs font-black text-gray-400 uppercase tracking-widest w-40">Harga Satuan</th>
                        <th class="p-4 text-xs font-black text-gray-400 uppercase tracking-widest w-40">Total</th>
                        <th class="p-4 text-xs font-black text-gray-400 uppercase tracking-widest">Keterangan</th>
                        <th class="p-4 text-xs font-black text-gray-400 uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($rows as $index => $row)
                    <tr x-data="{ saved: false }" @row-saved.window="if ($event.detail.index == {{ $index }}) { saved = true; setTimeout(() => saved = false, 2500) }" class="hover:bg-gray-50/50 transition group relative">
                        <td class="p-3">
                            <select wire:model.live="rows.{{ $index }}.jenis" class="w-full p-2 bg-transparent border-2 border-transparent focus:border-primary-500 rounded-lg outline-none font-bold {{ $row['jenis'] == 'Pemasukan' ? 'text-emerald-600' : 'text-rose-600' }}">
                                <option value="Pemasukan">Masuk</option>
                                <option value="Pengeluaran">Keluar</option>
                            </select>
                        </td>
                        <td class="p-3">
                            <input type="text" wire:model.live.debounce.500ms="rows.{{ $index }}.kategori" placeholder="Cth: Dana Masuk..." class="w-full p-2 bg-transparent border-2 border-transparent focus:border-primary-500 focus:bg-white rounded-lg outline-none font-medium">
                        </td>
                        <td class="p-3">
                            <input type="text" wire:model.live.debounce.500ms="rows.{{ $index }}.nama_barang" placeholder="Nama Barang..." class="w-full p-2 bg-transparent border-2 border-transparent focus:border-primary-500 focus:bg-white rounded-lg outline-none font-medium">
                        </td>
                        <td class="p-3">
                            <input type="number" wire:model.live.debounce.500ms="rows.{{ $index }}.jumlah" class="w-full p-2 bg-transparent border-2 border-transparent focus:border-primary-500 focus:bg-white rounded-lg outline-none font-bold text-center">
                        </td>
                        <td class="p-3">
                            <input type="number" wire:model.live.debounce.500ms="rows.{{ $index }}.harga_satuan" class="w-full p-2 bg-transparent border-2 border-transparent focus:border-primary-500 focus:bg-white rounded-lg outline-none font-bold text-right">
                        </td>
                        <td class="p-3">
                            <input type="text" value="{{ number_format($row['total'], 0, ',', '.') }}" disabled class="w-full p-2 bg-gray-50 border-2 border-transparent rounded-lg outline-none font-black text-right text-gray-500 cursor-not-allowed">
                        </td>
                        <td class="p-3">
                            <input type="text" wire:model.live.debounce.500ms="rows.{{ $index }}.keterangan" placeholder="..." class="w-full p-2 bg-transparent border-2 border-transparent focus:border-primary-500 focus:bg-white rounded-lg outline-none text-sm text-gray-500">
                        </td>
                        <td class="p-3 flex items-center justify-center gap-2 relative border-0">
                            <!-- Indikator Centang Auto-Save -->
                            <span x-show="saved" x-transition.opacity style="display: none;" class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-500 absolute -left-4" title="Otomatis Tersimpan!">
                                <svg class="w-5 h-5 drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </span>
                            
                            <button wire:click="removeRow({{ $index }})" class="p-2 mt-1 text-red-300 hover:text-red-600 hover:bg-red-50 rounded-lg transition opacity-0 group-hover:opacity-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if(empty($rows))
            <div class="p-10 text-center text-gray-400 font-bold">Data RAB masih kosong. Tambahkan baris baru.</div>
        @endif
    </div>
</div>
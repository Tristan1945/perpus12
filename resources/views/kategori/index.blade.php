@extends('layouts.app')

@section('title', 'Kategori - EduLib')

@section('content')

<x-badge />

<!-- Wrapper utama dengan state Alpine.js -->
<div class="p-6 lg:p-8 space-y-6" x-data="kategoriCrud()">
    
    <!-- Header & Action Button -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola Kategori Buku</h1>
            <p class="text-sm text-gray-600">Tambah, ubah, dan hapus kategori katalog perpustakaan.</p>
        </div>
        <button @click="openCreateModal()" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition shadow-sm">
            <span class="text-sm">+</span>
            <span>Tambah Kategori</span>
        </button>
    </div>

    <!-- Tabel Data Kategori -->
    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-50 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <th class="py-3.5 px-6">No</th>
                        <th class="py-3.5 px-6">Kategori</th>
                        <th class="py-3.5 px-6">Slug</th>
                        <th class="py-3.5 px-6">Deskripsi</th>
                        <th class="py-3.5 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-800">
                    @forelse($kategoris as $index => $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-4 px-6 font-medium">{{ $kategoris->firstItem() + $index }}</td>
                        <td class="py-4 px-6 font-semibold">{{ $item->kategori }}</td>
                        <td class="py-4 px-6 text-xs text-gray-500 font-mono">{{ $item->slug_Kategori }}</td>
                        <td class="py-4 px-6 text-gray-600">{{ $item->deskripsi ?? '-' }}</td>
                        <td class="py-4 px-6 text-center">
                            <div class="inline-flex items-center gap-2">
                                <!-- Edit Button -->
                                <button @click="openEditModal({{ json_encode($item) }})" class="p-1.5 rounded-lg text-blue-600 hover:bg-blue-50 transition" title="Edit">
                                    <span class="material-symbols-outlined text-base">edit</span>
                                </button>
                                <!-- Delete Button -->
                                <button @click="openDeleteModal({{ json_encode($item) }})" class="p-1.5 rounded-lg text-red-600 hover:bg-red-50 transition" title="Hapus">
                                    <span class="material-symbols-outlined text-base">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-gray-500">Belum ada data kategori.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($kategoris->hasPages())
        <div class="p-4 border-t border-gray-200">
            {{ $kategoris->links() }}
        </div>
        @endif
    </div>

    <!-- ==================== MODAL TAMBAH & EDIT (Reusable) ==================== -->
    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto bg-black/50 backdrop-blur-sm flex items-center justify-center p-4" x-cloak style="display: none;">
        <div @click.outside="closeModal()" class="bg-white w-full max-w-md rounded-2xl shadow-xl overflow-hidden border border-gray-200 p-6 space-y-6">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-900" x-text="isEditMode ? 'Edit Kategori' : 'Tambah Kategori Baru'"></h3>
                <button @click="closeModal()" class="text-gray-500 hover:text-gray-900">
                    ✖️
                </button>
            </div>
            
            <form :action="isEditMode ? '/kategori/' + form.id : '/kategori'" method="POST" class="space-y-4">
                @csrf
                <template x-if="isEditMode">
                    <input type="hidden" name="_method" value="PUT">
                </template>
                
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Nama Kategori</label>
                    <input type="text" name="kategori" x-model="form.kategori" required maxlength="50" class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm outline-none transition" placeholder="Contoh: Fiksi, Teknologi">
                </div>
                
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Deskripsi (Opsional)</label>
                    <textarea name="deskripsi" x-model="form.deskripsi" rows="3" maxlength="255" class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm outline-none transition" placeholder="Keterangan singkat kategori..."></textarea>
                </div>
                
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                    <button type="button" @click="closeModal()" class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition shadow-sm" x-text="isEditMode ? 'Perbarui' : 'Simpan'"></button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== MODAL KONFIRMASI HAPUS ==================== -->
    <div x-show="showDeleteModal" class="fixed inset-0 z-50 overflow-y-auto bg-black/50 backdrop-blur-sm flex items-center justify-center p-4" x-cloak style="display: none;">
        <div @click.outside="closeDeleteModal()" class="bg-white w-full max-w-sm rounded-2xl shadow-xl overflow-hidden border border-gray-200 p-6 space-y-6 text-center">
            <div class="w-12 h-12 rounded-full bg-red-100 text-red-600 flex items-center justify-center mx-auto">
                <span class="text-2xl">⚠️</span>
            </div>
            <div class="space-y-2">
                <h3 class="text-lg font-bold text-gray-900">Hapus Kategori?</h3>
                <p class="text-sm text-gray-600">Apakah Anda yakin ingin menghapus kategori <strong class="text-gray-900" x-text="deleteForm.kategori"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <form :action="'/kategori/' + deleteForm.id" method="POST" class="flex items-center justify-center gap-3">
                @csrf
                @method('DELETE')
                <button type="button" @click="closeDeleteModal()" class="w-full px-4 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition">Batal</button>
                <button type="submit" class="w-full px-4 py-2.5 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition shadow-sm">Ya, Hapus</button>
            </form>
        </div>
    </div>

</div>

<!-- Alpine Script Component State -->
<script>
    function kategoriCrud() {
        return {
            showModal: false,
            showDeleteModal: false,
            isEditMode: false,
            form: { id: null, kategori: '', deskripsi: '' },
            deleteForm: { id: null, kategori: '' },
            
            openCreateModal() {
                this.isEditMode = false;
                this.form = { id: null, kategori: '', deskripsi: '' };
                this.showModal = true;
            },
            
            openEditModal(item) {
                this.isEditMode = true;
                this.form = { id: item.id, kategori: item.kategori, deskripsi: item.deskripsi };
                this.showModal = true;
            },
            
            closeModal() {
                this.showModal = false;
            },
            
            openDeleteModal(item) {
                this.deleteForm = { id: item.id, kategori: item.kategori };
                this.showDeleteModal = true;
            },
            
            closeDeleteModal() {
                this.showDeleteModal = false;
            }
        }
    }
</script>
@endsection
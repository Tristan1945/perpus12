@extends('layouts.app')

@section('title', 'Katalog Pustaka & Reservasi Mandiri - EduLib')

@section('content')
<div class="flex flex-col w-full" x-data="{
    searchQuery: '',
    selectedCategory: 'all',
    selectedLocation: 'all',
    toastVisible: false,
    toastMessage: '',
    showToast(msg) {
        this.toastMessage = msg;
        this.toastVisible = true;
        setTimeout(() => { this.toastVisible = false }, 4000);
    }
}">

    <!-- Top Hero & Context Strip -->
    <div class="px-space-md lg:px-space-lg py-space-xl bg-surface-container-low">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row lg:items-end justify-between gap-space-lg">
            <div class="flex flex-col gap-space-xs max-w-2xl">
                <div
                    class="inline-flex items-center gap-space-xs px-space-sm py-0.5 rounded-full bg-surface-container-highest text-secondary w-fit font-label-md text-label-md">
                    <span class="material-symbols-outlined text-[16px]">menu_book</span>
                    <span>Sistem OPAC &amp; Sirkulasi Pintar</span>
                </div>
                <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight font-bold">Katalog
                    Pustaka &amp; Reservasi Mandiri</h1>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    Eksplorasi koleksi literatur kurikulum merdeka, modul olimpiade, hingga fiksi sastra.
                    Reservasi antrean instan terintegrasi data NISN.
                </p>
            </div>

            <!-- Quick Quota Card -->
            <div
                class="flex flex-col sm:flex-row items-stretch gap-space-md bg-surface-container-lowest p-space-md rounded-xl shadow-sm border border-outline-variant/20">
                <div
                    class="flex items-center gap-space-md pr-space-md border-b sm:border-b-0 sm:border-r border-outline-variant/20 pb-md sm:pb-0">
                    <div
                        class="w-12 h-12 rounded-xl bg-primary-container flex items-center justify-center text-on-primary shrink-0">
                        <span class="material-symbols-outlined text-[24px]">id_card</span>
                    </div>
                    <div class="flex flex-col">
                        <span
                            class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Kuota
                            Akun Siswa</span>
                        <span class="font-title-card text-title-card text-primary font-bold">1 / 3 Buku
                            Terpakai</span>
                        <span class="font-label-md text-label-md text-secondary">Ahmad Fauzi (XII IPA 1)</span>
                    </div>
                </div>
                <div class="flex flex-col justify-center bg-surface-container-low rounded-lg p-space-sm">
                    <span class="font-label-md text-label-md text-on-surface-variant">Sisa Kuota Pinjam</span>
                    <span class="font-headline-sm text-headline-sm text-secondary font-bold">2 Slot</span>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
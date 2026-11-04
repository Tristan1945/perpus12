@extends('layouts.app')

@section('title', 'Data Siswa - EduLib')

@section('content')
<div class="p-space-md lg:p-space-lg">
    <div class="mx-auto max-w-7xl">
        <div class="mb-space-lg">
            <h1 class="font-headline-lg text-headline-lg font-bold text-on-surface">Data Siswa</h1>
            <p class="mt-1 text-body-md text-on-surface-variant">
                Daftar siswa yang terdaftar di perpustakaan.
            </p>
        </div>

        <div class="overflow-hidden rounded-xl border border-outline-variant/30 bg-surface-container-lowest shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[640px] text-left">
                    <thead class="bg-surface-container-low">
                        <tr class="border-b border-outline-variant/30">
                            <th class="px-space-md py-space-sm font-label-md text-label-md text-on-surface-variant">Nama</th>
                            <th class="px-space-md py-space-sm font-label-md text-label-md text-on-surface-variant">NISN</th>
                            <th class="px-space-md py-space-sm font-label-md text-label-md text-on-surface-variant">Kelas</th>
                            <th class="px-space-md py-space-sm font-label-md text-label-md text-on-surface-variant">No. Telepon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswas as $siswa)
                            <tr class="border-b border-outline-variant/20 last:border-0">
                                <td class="px-space-md py-space-md font-label-md font-semibold text-on-surface">
                                    {{ $siswa->user?->name ?? '-' }}
                                </td>
                                <td class="px-space-md py-space-md text-body-sm text-on-surface-variant">
                                    {{ $siswa->nisn }}
                                </td>
                                <td class="px-space-md py-space-md text-body-sm text-on-surface-variant">
                                    {{ $siswa->kelas?->nama_kelas ?? '-' }}
                                </td>
                                <td class="px-space-md py-space-md text-body-sm text-on-surface-variant">
                                    {{ $siswa->phone_number ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-space-md py-space-xl text-center text-body-md text-on-surface-variant">
                                    Belum ada data siswa.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($siswas->hasPages())
                <div class="border-t border-outline-variant/20 p-space-md">
                    {{ $siswas->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

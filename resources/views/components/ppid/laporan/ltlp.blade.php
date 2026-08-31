<table class="table table-bordered">
    <thead class="bg-primary" style="color:white;">
        <tr>
            <th>Nama</th>
            <th>Tahun</th>
            <th>Semester</th>
            <th>Lihat</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $item)
            <tr>
                <td>
                    {{-- Bisa gabungkan nama + tahun --}}
                    {{ $item->nama }}
                </td>
                <td>
                    {{ $item->tahun }}
                </td>
                <td class="text-center">
                    {{-- Contoh tampilkan text semester --}}
                    {{ $item->semester == 1 ? 'SEMESTER I' : ($item->semester == 2 ? 'SEMESTER II' : $item->semester) }}
                </td>
                <td class="text-center">
                    @if ($item->file_pdf)
                        <a href="{{ asset('storage/' . $item->file_pdf) }}" target="_blank" class="btn btn-sm btn-primary">
                            Lihat
                        </a>
                    @else
                        -
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">
                    Data laporan belum tersedia
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

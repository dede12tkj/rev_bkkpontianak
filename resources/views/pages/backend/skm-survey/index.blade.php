@extends('layouts.back')

@section('title', 'Builder Survei IKM')

@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-3">Builder Survei Kepuasan Masyarakat (IKM)</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (!$survey)
        {{-- Belum ada survey sama sekali --}}
        <div class="card shadow">
            <div class="card-header"><h6>Buat Survei Pertama</h6></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin-skm-survey.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Judul Survei</label>
                        <input type="text" name="title" class="form-control" required
                            value="Survei Kepuasan Masyarakat (IKM) BKK Kelas I Pontianak">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <button class="btn btn-primary">Buat Survei</button>
                </form>
            </div>
        </div>
    @else

        {{-- Pengaturan Survei --}}
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Pengaturan Survei</h6>
                <div>
                    <a href="{{ route('skm-survey.show') }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                        Lihat Form Publik
                    </a>
                    <a href="{{ route('admin-skm-survey.responses') }}" class="btn btn-sm btn-outline-primary">
                        Lihat Rekap Hasil
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin-skm-survey.update', $survey->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Judul Survei</label>
                        <input type="text" name="title" class="form-control" required
                            value="{{ old('title', $survey->title) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi (ditampilkan di atas form publik)</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description', $survey->description) }}</textarea>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1"
                            id="isActive" {{ $survey->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="isActive">Aktifkan survei ini di halaman publik</label>
                    </div>
                    <button class="btn btn-primary btn-sm">Simpan Pengaturan</button>
                </form>
            </div>
        </div>

        {{-- Daftar Section --}}
        @foreach ($survey->sections as $section)
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">{{ $loop->iteration }}. {{ $section->title }}</h6>
                        @if ($section->description)
                            <small class="text-muted">{{ $section->description }}</small>
                        @endif
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <form method="POST" action="{{ route('admin-skm-section.move', $section->id) }}" class="d-inline">
                            @csrf
                            <input type="hidden" name="direction" value="up">
                            <button class="btn btn-sm btn-light" title="Naikkan" {{ $loop->first ? 'disabled' : '' }}>
                                <i class="bi bi-arrow-up"></i>
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin-skm-section.move', $section->id) }}" class="d-inline">
                            @csrf
                            <input type="hidden" name="direction" value="down">
                            <button class="btn btn-sm btn-light" title="Turunkan" {{ $loop->last ? 'disabled' : '' }}>
                                <i class="bi bi-arrow-down"></i>
                            </button>
                        </form>
                        <button type="button" class="btn btn-sm btn-outline-secondary btn-edit-section"
                            data-section='@json($section->only(['id', 'title', 'description']))'>
                            Edit
                        </button>
                        <button type="button" class="btn btn-sm btn-primary btn-add-question"
                            data-section-id="{{ $section->id }}">
                            + Pertanyaan
                        </button>
                        <form method="POST" action="{{ route('admin-skm-section.destroy', $section->id) }}" class="d-inline"
                            onsubmit="return confirm('Hapus section ini beserta seluruh pertanyaannya?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0">
                        <thead class="text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th>Pertanyaan</th>
                                <th width="15%">Tipe</th>
                                <th width="8%">Wajib</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($section->questions as $question)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $question->label }}
                                        @if ($question->help_text)
                                            <br><small class="text-muted">{{ Str::limit($question->help_text, 100) }}</small>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary">{{ \App\Models\SkmQuestion::TYPES[$question->type] ?? $question->type }}</span>
                                    </td>
                                    <td class="text-center">
                                        {!! $question->is_required ? '<i class="bi bi-check-circle-fill text-success"></i>' : '<i class="bi bi-dash-circle text-muted"></i>' !!}
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <form method="POST" action="{{ route('admin-skm-question.move', $question->id) }}">
                                                @csrf
                                                <input type="hidden" name="direction" value="up">
                                                <button class="btn btn-sm btn-light" {{ $loop->first ? 'disabled' : '' }}><i class="bi bi-arrow-up"></i></button>
                                            </form>
                                            <form method="POST" action="{{ route('admin-skm-question.move', $question->id) }}">
                                                @csrf
                                                <input type="hidden" name="direction" value="down">
                                                <button class="btn btn-sm btn-light" {{ $loop->last ? 'disabled' : '' }}><i class="bi bi-arrow-down"></i></button>
                                            </form>
                                            <button type="button" class="btn btn-sm btn-outline-secondary btn-edit-question"
                                                data-question='@json($question->load('options'))'
                                                data-section-id="{{ $section->id }}">
                                                Edit
                                            </button>
                                            <form method="POST" action="{{ route('admin-skm-question.destroy', $question->id) }}"
                                                onsubmit="return confirm('Hapus pertanyaan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">Belum ada pertanyaan di section ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach

        <button type="button" class="btn btn-outline-primary mb-5" data-bs-toggle="modal" data-bs-target="#sectionModal"
            onclick="resetSectionModal()">
            + Tambah Section Baru
        </button>

    @endif
</div>

{{-- ===================== MODAL: SECTION ===================== --}}
<div class="modal fade" id="sectionModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" id="sectionForm">
            @csrf
            <input type="hidden" name="_method" id="sectionMethod" value="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sectionModalTitle">Tambah Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul Section</label>
                        <input type="text" name="title" id="sectionTitle" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi / Petunjuk Pengisian (opsional)</label>
                        <textarea name="description" id="sectionDescription" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- ===================== MODAL: QUESTION ===================== --}}
<div class="modal fade" id="questionModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="questionForm">
            @csrf
            <input type="hidden" name="_method" id="questionMethod" value="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="questionModalTitle">Tambah Pertanyaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Label Pertanyaan</label>
                            <textarea name="label" id="questionLabel" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tipe Pertanyaan</label>
                            <select name="type" id="questionType" class="form-select" onchange="toggleTypePanels()" required>
                                @foreach (\App\Models\SkmQuestion::TYPES as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Teks Bantuan / Penjelasan (opsional, tampil di bawah label)</label>
                        <textarea name="help_text" id="questionHelpText" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_required" id="questionRequired" value="1" checked>
                        <label class="form-check-label" for="questionRequired">Wajib diisi</label>
                    </div>

                    {{-- Panel: Opsi (select/radio/checkbox) --}}
                    <div id="panel-options" class="type-panel border rounded p-3 mb-3">
                        <label class="form-label fw-semibold">Daftar Opsi Jawaban</label>
                        <div id="optionsContainer"></div>
                        <button type="button" class="btn btn-sm btn-outline-secondary mt-1" onclick="addOptionRow()">
                            + Tambah Opsi
                        </button>
                        <p class="text-muted small mt-2 mb-0">
                            Centang "Other" pada opsi yang perlu memunculkan kolom isian bebas (mis. "Other: ...").
                        </p>
                    </div>

                    {{-- Panel: Likert --}}
                    <div id="panel-likert" class="type-panel border rounded p-3 mb-3">
                        <label class="form-label fw-semibold">Pengaturan Skala Likert</label>
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <label class="form-label small">Nilai Minimum</label>
                                <input type="number" name="scale_min" id="scaleMin" class="form-control" value="1">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label small">Nilai Maksimum</label>
                                <input type="number" name="scale_max" id="scaleMax" class="form-control" value="4">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label small">Label Nilai Minimum</label>
                                <input type="text" name="min_label" id="minLabel" class="form-control" placeholder="Sangat Tidak Puas">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label small">Label Nilai Maksimum</label>
                                <input type="text" name="max_label" id="maxLabel" class="form-control" placeholder="Sangat Puas">
                            </div>
                        </div>
                    </div>

                    {{-- Panel: Text/Textarea --}}
                    <div id="panel-text" class="type-panel border rounded p-3 mb-3">
                        <label class="form-label small">Maksimal Karakter (opsional)</label>
                        <input type="number" name="max_length" id="maxLength" class="form-control" style="max-width: 200px;">
                    </div>

                    {{-- Panel: Number --}}
                    <div id="panel-number" class="type-panel border rounded p-3 mb-3">
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label class="form-label small">Nilai Minimum (opsional)</label>
                                <input type="number" name="min_value" id="minValue" class="form-control">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label small">Nilai Maksimum (opsional)</label>
                                <input type="number" name="max_value" id="maxValue" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Pertanyaan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    const CHOICE_TYPES = ['select', 'radio', 'checkbox'];
    let optionRowIndex = 0;

    function toggleTypePanels() {
        const type = document.getElementById('questionType').value;
        document.getElementById('panel-options').style.display = CHOICE_TYPES.includes(type) ? 'block' : 'none';
        document.getElementById('panel-likert').style.display = type === 'likert' ? 'block' : 'none';
        document.getElementById('panel-text').style.display = (type === 'text' || type === 'textarea') ? 'block' : 'none';
        document.getElementById('panel-number').style.display = type === 'number' ? 'block' : 'none';
    }

    function addOptionRow(label = '', allowOther = false) {
        const idx = optionRowIndex++;
        const wrapper = document.createElement('div');
        wrapper.className = 'input-group mb-2';
        wrapper.innerHTML = `
            <input type="text" name="option_label[${idx}]" class="form-control" placeholder="Teks opsi" value="${label.replace(/"/g, '&quot;')}">
            <span class="input-group-text">
                <input type="checkbox" name="option_allow_other[${idx}]" value="1" class="form-check-input mt-0" ${allowOther ? 'checked' : ''}>
                &nbsp;Other
            </span>
            <button type="button" class="btn btn-outline-danger" onclick="this.closest('.input-group').remove()">&times;</button>
        `;
        document.getElementById('optionsContainer').appendChild(wrapper);
    }

    function resetSectionModal() {
        document.getElementById('sectionModalTitle').innerText = 'Tambah Section';
        document.getElementById('sectionForm').action = '{{ $survey ? route('admin-skm-section.store', $survey->id) : '#' }}';
        document.getElementById('sectionMethod').value = 'POST';
        document.getElementById('sectionTitle').value = '';
        document.getElementById('sectionDescription').value = '';
    }

    function resetQuestionModal(sectionId) {
        document.getElementById('questionModalTitle').innerText = 'Tambah Pertanyaan';
        document.getElementById('questionForm').action = `/admin-skm-question/${sectionId}`;
        document.getElementById('questionMethod').value = 'POST';
        document.getElementById('questionLabel').value = '';
        document.getElementById('questionHelpText').value = '';
        document.getElementById('questionType').value = 'radio';
        document.getElementById('questionRequired').checked = true;
        document.getElementById('optionsContainer').innerHTML = '';
        document.getElementById('scaleMin').value = 1;
        document.getElementById('scaleMax').value = 4;
        document.getElementById('minLabel').value = '';
        document.getElementById('maxLabel').value = '';
        document.getElementById('maxLength').value = '';
        document.getElementById('minValue').value = '';
        document.getElementById('maxValue').value = '';
        addOptionRow();
        addOptionRow();
        toggleTypePanels();
    }

    document.querySelectorAll('.btn-add-question').forEach(btn => {
        btn.addEventListener('click', function () {
            resetQuestionModal(this.dataset.sectionId);
            new bootstrap.Modal(document.getElementById('questionModal')).show();
        });
    });

    document.querySelectorAll('.btn-edit-section').forEach(btn => {
        btn.addEventListener('click', function () {
            const section = JSON.parse(this.dataset.section);
            document.getElementById('sectionModalTitle').innerText = 'Edit Section';
            document.getElementById('sectionForm').action = `/admin-skm-section/${section.id}`;
            document.getElementById('sectionMethod').value = 'PUT';
            document.getElementById('sectionTitle').value = section.title;
            document.getElementById('sectionDescription').value = section.description ?? '';
            new bootstrap.Modal(document.getElementById('sectionModal')).show();
        });
    });

    document.querySelectorAll('.btn-edit-question').forEach(btn => {
        btn.addEventListener('click', function () {
            const q = JSON.parse(this.dataset.question);
            document.getElementById('questionModalTitle').innerText = 'Edit Pertanyaan';
            document.getElementById('questionForm').action = `/admin-skm-question/${q.id}`;
            document.getElementById('questionMethod').value = 'PUT';
            document.getElementById('questionLabel').value = q.label;
            document.getElementById('questionHelpText').value = q.help_text ?? '';
            document.getElementById('questionType').value = q.type;
            document.getElementById('questionRequired').checked = !!q.is_required;

            const cfg = q.config || {};
            document.getElementById('scaleMin').value = cfg.scale_min ?? 1;
            document.getElementById('scaleMax').value = cfg.scale_max ?? 4;
            document.getElementById('minLabel').value = cfg.min_label ?? '';
            document.getElementById('maxLabel').value = cfg.max_label ?? '';
            document.getElementById('maxLength').value = cfg.max_length ?? '';
            document.getElementById('minValue').value = cfg.min ?? '';
            document.getElementById('maxValue').value = cfg.max ?? '';

            document.getElementById('optionsContainer').innerHTML = '';
            (q.options || []).forEach(opt => addOptionRow(opt.label, opt.allow_other));
            if (!q.options || q.options.length === 0) {
                addOptionRow();
                addOptionRow();
            }

            toggleTypePanels();
            new bootstrap.Modal(document.getElementById('questionModal')).show();
        });
    });
</script>

@endsection

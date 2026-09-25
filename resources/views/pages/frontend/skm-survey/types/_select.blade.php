@php $old = old("answers.{$question->id}"); @endphp

<select class="form-select" style="max-width: 500px;" name="answers[{{ $question->id }}]"
    {{ $question->is_required ? 'required' : '' }}
    @if ($question->options->contains('allow_other', true))
        onchange="document.getElementById('other_{{ $question->id }}').classList.toggle('d-none', this.value !== '__other__')"
    @endif>
    <option value="" disabled {{ $old ? '' : 'selected' }}>-- Pilih salah satu --</option>
    @foreach ($question->options as $option)
        @php $value = $option->allow_other ? '__other__' : $option->value; @endphp
        <option value="{{ $value }}" {{ $old === $value ? 'selected' : '' }}>
            {{ $option->label }}
        </option>
    @endforeach
</select>

@if ($question->options->contains('allow_other', true))
    <input type="text" name="answers_other[{{ $question->id }}]"
        id="other_{{ $question->id }}"
        class="form-control mt-2 {{ $old === '__other__' ? '' : 'd-none' }}"
        style="max-width: 400px;"
        placeholder="Sebutkan lainnya..."
        value="{{ old("answers_other.{$question->id}") }}">
@endif

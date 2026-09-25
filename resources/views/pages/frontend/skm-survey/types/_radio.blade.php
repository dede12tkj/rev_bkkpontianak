@php
    $old = old("answers.{$question->id}");
    $hasOther = $question->options->contains('allow_other', true);
@endphp

<div>
    @foreach ($question->options as $option)
        @php $isOther = $option->allow_other; @endphp
        <div class="form-check mb-1">
            <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]"
                id="q{{ $question->id }}_opt{{ $option->id }}"
                value="{{ $isOther ? '__other__' : $option->value }}"
                {{ $old === ($isOther ? '__other__' : $option->value) ? 'checked' : '' }}
                @if ($hasOther) onchange="document.getElementById('other_{{ $question->id }}').classList.toggle('d-none', this.value !== '__other__')" @endif
                {{ $question->is_required ? 'required' : '' }}>
            <label class="form-check-label" for="q{{ $question->id }}_opt{{ $option->id }}">
                {{ $option->label }}
            </label>
        </div>
    @endforeach

    @if ($hasOther)
        <input type="text" name="answers_other[{{ $question->id }}]"
            id="other_{{ $question->id }}"
            class="form-control mt-2 {{ $old === '__other__' ? '' : 'd-none' }}"
            style="max-width: 400px;"
            placeholder="Sebutkan lainnya..."
            value="{{ old("answers_other.{$question->id}") }}">
    @endif
</div>

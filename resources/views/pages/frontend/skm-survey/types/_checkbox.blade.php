@php $old = (array) old("answers.{$question->id}", []); @endphp

<div>
    @foreach ($question->options as $option)
        <div class="form-check mb-1">
            <input class="form-check-input" type="checkbox" name="answers[{{ $question->id }}][]"
                id="q{{ $question->id }}_opt{{ $option->id }}"
                value="{{ $option->value }}"
                {{ in_array($option->value, $old) ? 'checked' : '' }}>
            <label class="form-check-label" for="q{{ $question->id }}_opt{{ $option->id }}">
                {{ $option->label }}
            </label>
        </div>
    @endforeach
</div>

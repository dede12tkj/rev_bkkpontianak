@php
    $old = old("answers.{$question->id}");
    $min = $question->scaleMin();
    $max = $question->scaleMax();
@endphp

<div class="skm-likert-scale">
    <span class="skm-likert-label">{{ $question->scaleMinLabel() }}</span>

    <div class="skm-likert-options">
        @for ($i = $min; $i <= $max; $i++)
            <label class="skm-likert-option">
                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $i }}"
                    {{ (string) $old === (string) $i ? 'checked' : '' }}
                    {{ $question->is_required ? 'required' : '' }}>
                <span>{{ $i }}</span>
            </label>
        @endfor
    </div>

    <span class="skm-likert-label">{{ $question->scaleMaxLabel() }}</span>
</div>

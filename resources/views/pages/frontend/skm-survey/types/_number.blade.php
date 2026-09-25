<input type="number" name="answers[{{ $question->id }}]" class="form-control" style="max-width: 220px;"
    @if (isset($question->config['min'])) min="{{ $question->config['min'] }}" @endif
    @if (isset($question->config['max'])) max="{{ $question->config['max'] }}" @endif
    value="{{ old("answers.{$question->id}") }}"
    {{ $question->is_required ? 'required' : '' }}>

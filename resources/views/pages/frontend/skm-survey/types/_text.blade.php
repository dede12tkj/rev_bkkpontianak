<input type="text" name="answers[{{ $question->id }}]" class="form-control" style="max-width: 500px;"
    maxlength="{{ $question->config['max_length'] ?? 255 }}"
    value="{{ old("answers.{$question->id}") }}"
    {{ $question->is_required ? 'required' : '' }}>

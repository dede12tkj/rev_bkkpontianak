<textarea name="answers[{{ $question->id }}]" class="form-control" rows="4"
    maxlength="{{ $question->config['max_length'] ?? 2000 }}"
    {{ $question->is_required ? 'required' : '' }}>{{ old("answers.{$question->id}") }}</textarea>

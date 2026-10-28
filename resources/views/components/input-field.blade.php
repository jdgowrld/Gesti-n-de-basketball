@props(['name', 'label', 'type' => 'text', 'placeholder' => '', 'value' => '', 'required' => true])

<div class="mb-3">
    <label class="form-label">{{ $label }}</label>
    
    <input type="{{ $type }}" 
           name="{{ $name }}" 
           class="form-control @error($name) is-invalid @enderror" 
           placeholder="{{ $placeholder }}" 
           value="{{ old($name, $value) }}" 
           {{ $required ? 'required' : '' }}>
    
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
@props([
      'name' , 'value' => '' , 'label' => false
])
@if($label)
<label>{{ $label }}</label>
@endif
<textarea
    name="description"
         {{ $attributes->class([
            'form-control',
            'is-invalid' => @$errors->has($name)
        ]) }}
>{{ old('description' , $value) }}</textarea>

@error($name)
    <div class="invalid-feedback">
    {{ $message }}
    </div>
@enderror

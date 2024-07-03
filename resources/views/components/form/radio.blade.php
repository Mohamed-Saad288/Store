
@props(['name','options','checked' => false])
@foreach($options as $value => $text)
    <div class="custom-control custom-radio">
        <input type="radio"
               id="customRadio2"
               name="{{ $name  }}"
               class="custom-control-input"
               value="{{ $value }}"
               @checked(old($name,$checked)== $value)
            {{ $attributes->class([
                'form-checked-input',
                'is-invalid' => @$errors->has($name)
            ]) }}
        >
        <label class="custom-control-label" for="customRadio2">{{ $text }}</label>
    </div>

@endforeach

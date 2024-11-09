<div>
    @props(['name' => null, 'label' => null, 'id' => null, 'multiple' => false]) 
    <pre>{{ var_dump($attributes ) }} </pre>
        <label for="{{ $id ?? 'image' }}">{{ $label ?? 'Image' }}</label>
        <input 
            type="file" 
            class="form-control dropify" 
            name="{{ $name ?? 'image' }}" 
            value="" 
          id="{{ $attributes->merge(['id' => $id ?? $name]) }}"
            accept="image/png, image/jpeg, image/jpg" {{ $attributes->merge(['multiple' => $multiple ?? false]) }} 
            required
        >
        
        @if ($errors->has($name ?? 'image'))
            <span class="text-danger">
                {{ $errors->first($name ?? 'image') }}
            </span>
        @endif
    
</div>
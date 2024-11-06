<select name="{{ $name }}" class="form-select {{ $class ?? '' }}">
    @foreach ($options as $key => $value)
        <option value="{{ $key }}" {{ old($name, $selected) == $key ? 'selected' : '' }}>
            {{ $value }}
        </option>
    @endforeach
</select>

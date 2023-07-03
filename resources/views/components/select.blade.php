@props(['options', 'value' => ''])

<select {{ $attributes->merge(['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) }} >
  <option value="choose" selected>Choose a Category</option>
  @foreach ($options as $option)
  @if (old('category_id', $value) == $option->id)
    <option value="{{ $option->id }}" selected>
      {{ $option->name }}
    </option>
  @else
    <option value="{{ $option->id }}">
      {{ $option->name }}
    </option>
  @endif
  @endforeach
</select>

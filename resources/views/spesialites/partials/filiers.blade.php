@foreach($filiers as $filier)
    <option value="{{ $filier->id }}">{{ $filier->name }}</option>
@endforeach
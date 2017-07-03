@foreach($spesialites as $spesialite)
    <option value="{{ $spesialite->id }}">{{ $spesialite->name }}</option>
@endforeach
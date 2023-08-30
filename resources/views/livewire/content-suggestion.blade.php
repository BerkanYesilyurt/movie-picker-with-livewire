<div>
    @if($errors->any())
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    @endif

    <form wire:submit.prevent="generateContent">
        <select wire:model="type" required>
            <option value="">Choose Content Type</option>
            <option value="movie">Movie</option>
            <option value="tv">TV Series</option>
        </select>
        <button type="submit">OK</button>
    </form>
</div>

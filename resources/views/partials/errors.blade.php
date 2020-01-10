@foreach ($errors->all() as $error)
<div class="relative px-3 py-3 mb-4 border rounded text-red-darker border-red-dark bg-red-lighter">
    <li>{{ $error }}</li>
</div>
@endforeach

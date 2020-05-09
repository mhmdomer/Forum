@foreach ($errors->all() as $error)
<div class="p-2 my-1 bg-red-200 text-red-500 rounded-lg">
    <li>{{ $error }}</li>
</div>
@endforeach

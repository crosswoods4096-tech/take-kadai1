@extends('layouts.app')

@section('content')
<h1 style="font-size: 32px; font-weight: bold; margin-bottom: 20px;">
    画像一覧
</h1>

<div style="
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    ">
    @foreach ($images as $image)
    <div>
        <img src="{{ asset('storage/' . $image->image) }}"
            alt="uploaded image"
            style="width: 300px; height: auto; border: 1px solid #ccc; padding: 5px;">
    </div>
    @endforeach
</div>
@endsection
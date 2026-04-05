<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Homepage Banners') }}
        </h2>
    </x-slot>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: #f5f5f5;
            }
            .container {
                width: 600px;
                margin: 50px auto;
                background: #fff;
                padding: 20px;
                border-radius: 8px;
            }
            h2 {
                text-align: center;
            }
            .form-group {
                margin-bottom: 15px;
            }
            label {
                font-weight: bold;
            }
            input[type="file"] {
                display: block;
                margin-top: 5px;
            }
            .error {
                color: red;
                font-size: 13px;
            }
            .success {
                color: green;
                text-align: center;
                margin-bottom: 10px;
            }
            button {
                width: 100%;
                padding: 10px;
                background: black;
                color: white;
                border: none;
                cursor: pointer;
                border-radius: 5px;
            }
        </style>
    <h2>Edit Banner</h2>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div>
            <label>Hero Tag</label>
            <input type="text" name="hero_tag" value="{{ $banner->hero_tag }}">
        </div>

        <div>
            <label>Hero Title 1</label>
            <input type="text" name="hero_title_1" value="{{ $banner->hero_title_1 }}">
        </div>

        <div>
            <label>Hero Title 2</label>
            <input type="text" name="hero_title_2" value="{{ $banner->hero_title_2 }}">
        </div>

        <div>
            <label>Hero Subtitle</label>
            <textarea name="hero_subtitle">{{ $banner->hero_subtitle }}</textarea>
        </div>

        @for ($i = 1; $i <= 5; $i++)
            <div>
                <label>Slide {{ $i }}</label>
                
                {{-- Show current image --}}
                <div class="preview">
                    @if($banner['slide_'.$i])
                        <img src="{{ asset('storage/' . $banner['slide_'.$i]) }}">
                    @endif
                </div>

                {{-- Upload new image --}}
                <input type="file" name="slide_{{ $i }}">

                @error('slide_'.$i)
                    <div style="color:red">{{ $message }}</div>
                @enderror
            </div>
            <br>
        @endfor

        <button type="submit">Update Banner</button>
    </form>
</x-app-layout>

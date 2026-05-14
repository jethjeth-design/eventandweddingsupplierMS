<x-client-layout>
<style>
.container{
    max-width:1100px;
    margin:auto;
    padding:30px;
}

.card-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(320px,1fr));
    gap:20px;
    margin-top:20px;
}

.pkg-card{
    background:#fff;
    border-radius:14px;
    padding:20px;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
}

.pkg-top{
    display:flex;
    justify-content:space-between;
    gap:15px;
    align-items:flex-start;
}

.price{
    font-weight:bold;
    color:#2563eb;
}

.pkg-inclusions{
    margin-top:15px;
    padding-left:18px;
}

.pkg-inclusions li{
    margin-bottom:6px;
}

.book-wrap{
    margin-top:30px;
    text-align:right;
}

.book-btn{
    background:#2563eb;
    color:white;
    border:none;
    padding:14px 22px;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
}

.book-btn:hover{
    background:#1d4ed8;
}
</style>
{{-- Alerts --}}
    @if(session('success'))
    <div class="ev-alert-success">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/></svg>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="ev-alert-error">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="10" cy="10" r="8"/><path d="M10 6v4M10 14v.5"/></svg>
        {{ session('error') }}
    </div>
    @endif
<div class="container">

    {{-- POPULAR PACKAGE --}}
    <div class="popular-header">

        <h2>
            {{ $popular->name }}
        </h2>

        <p>
            {{ $popular->event_type }}
        </p>

    </div>

    <hr>

<form action="{{ route('bookings.store') }}" method="POST">

    @csrf

    {{-- IMPORTANT --}}
    <input type="hidden"
           name="event_id"
           value="{{ request()->event_id }}">

    <div class="card-grid">

        @foreach($matchedPackages as $package)

            <div class="pkg-card">

                <label>

                    <input type="checkbox"
                           name="package_ids[]"
                           value="{{ $package->id }}">

                    {{ $package->name }}

                </label>

            </div>

        @endforeach

    </div>

    <button type="submit">
        Book Selected Suppliers
    </button>

</form>

</div>

</x-client-layout>
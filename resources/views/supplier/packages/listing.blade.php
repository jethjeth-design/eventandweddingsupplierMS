<x-supplier-layout>
<div style="max-width:1100px;margin:auto;padding:20px;">

    <h2 style="margin-bottom:20px;">📦 My Packages</h2>

    <!-- ADD PACKAGE -->
    <div style="text-align:right;margin-bottom:15px;">
        <a href="#"
           style="background:#28a745;color:#fff;padding:8px 12px;border-radius:5px;text-decoration:none;">
            + Add Package
        </a>
    </div>

    <!-- PACKAGE GRID -->
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:15px;">

        @forelse($packages as $package)

            <div style="
                background:#fff;
                border:1px solid #eee;
                border-radius:10px;
                padding:15px;
                box-shadow:0 5px 15px rgba(0,0,0,0.05);
            ">

                <h4>{{ $package->name }}</h4>

                <p style="color:gray;">
                    {{ Str::limit($package->description, 80) }}
                </p>

                <p>💰 ₱{{ number_format($package->price) }}</p>
                <p>👥 {{ $package->guest_capacity }} guests</p>
                <p>🎉 {{ ucfirst($package->event_type) }}</p>

                <!-- INCLUSIONS -->
                <ul style="margin-top:10px;padding-left:18px;">
                    @foreach($package->inclusions as $inc)
                        <li>{{ $inc->title }}</li>
                    @endforeach
                </ul>

                <!-- ACTIONS -->
                <div style="margin-top:10px;display:flex;gap:5px;flex-wrap:wrap;">

                    <a href="#"
                       style="background:#007bff;color:#fff;padding:5px 8px;border-radius:5px;text-decoration:none;font-size:12px;">
                        Edit
                    </a>

                    <form action="#"
                          method="POST"
                          onsubmit="return confirm('Delete this package?')">
                        @csrf
                        @method('DELETE')

                        <button style="background:#dc3545;color:#fff;padding:5px 8px;border:none;border-radius:5px;font-size:12px;">
                            Delete
                        </button>
                    </form>

                    <a href="{{ route('supplier.package.assignTeamsForm', $package->id) }}"
                       style="background:#ffc107;color:#000;padding:5px 8px;border-radius:5px;text-decoration:none;font-size:12px;">
                        Assign Team
                    </a>

                </div>

            </div>

        @empty

            <div style="text-align:center;color:gray;">
                No packages yet.
            </div>

        @endforelse

    </div>

</div>

</x-supplier-layout>
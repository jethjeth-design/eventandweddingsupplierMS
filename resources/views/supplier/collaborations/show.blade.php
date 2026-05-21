<x-supplier-layout>
<div class="container">

    <h2 class="mb-4">
        {{ $collaboration->title }}
    </h2>

    <div class="card mb-4">

        <div class="card-body">

            <p>
                <strong>Description:</strong><br>
                {{ $collaboration->description }}
            </p>

            <p>
                <strong>Event Date:</strong>
                {{ $collaboration->event_date }}
            </p>

            <p>
                <strong>Location:</strong>
                {{ $collaboration->location }}
            </p>

            <p>
                <strong>Budget:</strong>
                ₱{{ number_format($collaboration->budget, 2) }}
            </p>

            <p>
                <strong>Status:</strong>
                {{ ucfirst($collaboration->status) }}
            </p>

        </div>

    </div>

    {{-- Invite Supplier --}}
    {{-- Invite Supplier --}}
<div class="card mb-4">

    <div class="card-header bg-primary text-white">
        Invite Supplier
    </div>

    <div class="card-body">

        <form action="{{ route('collaboration.members.store') }}" method="POST">
            @csrf

            <input type="hidden"
                   name="collaboration_id"
                   value="{{ $collaboration->id }}">

            {{-- SUPPLIER DROPDOWN --}}
            <div class="mb-3">
                <label class="form-label">Select Supplier</label>

                @php
                    $ownerId = auth()->user()->supplier?->id;
                @endphp

                <select name="supplier_profile_id"
                        class="form-control"
                        required>

                    <option value="">
                        -- Choose Supplier --
                    </option>

                    @foreach($suppliers as $supplier)

                        @if($supplier->id != $ownerId)

                            <option value="{{ $supplier->id }}">

                                {{ $supplier->business_name }}

                                ({{ $supplier->first_name }}
                                {{ $supplier->last_name }})

                            </option>

                        @endif

                    @endforeach

                </select>
            </div>

            <div class="mb-3">
                <label>Role</label>
                <input type="text"
                       name="role"
                       class="form-control"
                       placeholder="Photographer"
                       required>
            </div>

            <div class="mb-3">
                <label>Responsibilities</label>
                <textarea name="responsibilities"
                          class="form-control"
                          placeholder="What will they do?"></textarea>
            </div>

            <div class="mb-3">
                <label>Agreed Price</label>
                <input type="number"
                       step="0.01"
                       name="agreed_price"
                       class="form-control"
                       placeholder="₱0.00">
            </div>

            <button class="btn btn-success w-100">
                + Invite Supplier
            </button>

        </form>

    </div>

</div>

    {{-- Members --}}
    <div class="card">

        <div class="card-header">
            Collaboration Members
        </div>

        <div class="card-body">

            @forelse($collaboration->members as $member)

                <div class="border rounded p-3 mb-3">

                    <h5>
                        Supplier Profile:
                        {{ $member->supplier_profile_id }}
                    </h5>

                    <p>
                        <strong>Role:</strong>
                        {{ $member->role }}
                    </p>

                    <p>
                        <strong>Responsibilities:</strong><br>
                        {{ $member->responsibilities }}
                    </p>

                    <p>
                        <strong>Price:</strong>
                        ₱{{ number_format($member->agreed_price, 2) }}
                    </p>

                    <p>
                        <strong>Status:</strong>
                        {{ ucfirst($member->status) }}
                    </p>

                </div>

            @empty

                <p>No members yet.</p>

            @endforelse

        </div>

    </div>

</div>
</x-supplier-layout>
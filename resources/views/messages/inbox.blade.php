@if(auth()->user()->isAdmin())
<x-app-layout>

<div class="container py-4">

    <div class="row">

        {{-- LEFT SIDEBAR --}}
        <div class="col-md-4 border-end">

            <h4 class="mb-3">Admin Inbox</h4>

            {{-- CONVERSATIONS --}}
            @forelse($conversations as $conversation)

                <a href="{{ route('messages.chat', $conversation->id) }}"
                   class="d-block p-3 border rounded mb-2 text-decoration-none">

                    <strong>
                        {{ $conversation->title ?? ucfirst($conversation->type) }}
                    </strong>

                    <br>

                    <small class="text-muted">
                        {{ optional($conversation->latestMessage)->message ?? 'No messages yet' }}
                    </small>

                </a>

            @empty
                <p class="text-muted">No conversations yet.</p>
            @endforelse

        </div>

        {{-- RIGHT PANEL --}}
        <div class="col-md-8 d-flex align-items-center justify-content-center">

            <h5 class="text-muted">
                Select a conversation
            </h5>

        </div>

    </div>

</div>

</x-app-layout>
@elseif(auth()->user()->isSupplier())
{{-- resources/views/messages/supplier-chatbox.blade.php --}}

<x-supplier-layout>

<div class="container py-4">

    <div class="row">

        {{-- LEFT: CONVERSATIONS --}}
        <div class="col-md-4 border-end">

            <h5 class="mb-3">Inbox</h5>
             
                {{-- START NEW CHAT (SUPPLIER VIEW) --}}
                <button class="btn btn-primary mb-3"
                        data-bs-toggle="modal"
                        data-bs-target="#groupChatModal">

                    Create Group Chat

                </button>
            <hr>

            {{-- ========================= --}}
                {{-- ADMIN CHAT --}}
                {{-- ========================= --}}

                <h6 class="text-muted mt-3">Admin Support</h6>

                @forelse($admins as $admin)

                    <a href="{{ route('messages.open', $admin->id) }}"
                    class="d-block p-2 border rounded mb-2 text-decoration-none">

                        <strong>
                            {{ $admin->name }} (Admin)
                        </strong>

                        <br>

                        <small class="text-muted">
                            Chat with support / admin
                        </small>

                    </a>

                @empty

                    <p class="text-muted">No admin available.</p>

                @endforelse

            {{-- ========================= --}}
            {{-- COLLABORATORS (NEW) --}}
            {{-- ========================= --}}
            @if(isset($collaborators) && $collaborators->count())

                <h6 class="text-muted">Project Collaborators</h6>

                @foreach($collaborators as $conversation)

                    @php
                        $otherUser = $conversation->participants
                            ->where('user_id', '!=', auth()->id())
                            ->first()?->user;
                    @endphp

                    <a href="{{ route('messages.chat', $conversation->id) }}"
                       class="d-block p-2 border rounded mb-2 text-decoration-none">

                        <strong>
                            {{ optional($otherUser->supplier)->business_name ?? 'Collaborator' }}
                        </strong>

                        <br>

                        <small class="text-muted">
                            {{ optional($conversation->messages->last())->message ?? 'No messages yet' }}
                        </small>

                    </a>

                @endforeach

            @endif

            <hr>

            {{-- ========================= --}}
            {{-- EXISTING CONVERSATIONS --}}
            {{-- ========================= --}}
            <h6 class="text-muted">Chats</h6>

            {{-- ALL CONVERSATIONS (INCLUDING GROUP) --}}
            @forelse($conversations as $conversation)

                @php

                    /*
                    |--------------------------------------------------------------------------
                    | OTHER USER
                    |--------------------------------------------------------------------------
                    */

                    $otherUser = $conversation->participants
                        ->where('user_id', '!=', auth()->id())
                        ->first()?->user;

                    /*
                    |--------------------------------------------------------------------------
                    | DISPLAY TITLE
                    |--------------------------------------------------------------------------
                    */

                    if ($conversation->type == 'group') {

                        $displayName = $conversation->title ?? 'Group Chat';

                    } else {

                        if ($otherUser?->supplierProfile) {

                            $displayName =
                                $otherUser->supplierProfile->business_name;

                        } else {

                            $displayName =
                                $otherUser->name ?? 'Client';
                        }
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | LAST MESSAGE
                    |--------------------------------------------------------------------------
                    */

                    $lastMessage =
                        optional($conversation->messages->last())->message
                        ?? 'No messages yet';

                @endphp

                <a href="{{ route('messages.chat', $conversation->id) }}"
                class="d-block p-3 border rounded mb-2 text-decoration-none">

                    <strong>

                        {{ $displayName }}

                    </strong>

                    <br>

                    <small class="text-muted">

                        {{ Str::limit($lastMessage, 40) }}

                    </small>

                </a>

            @empty

                <p class="text-muted">
                    No conversations yet.
                </p>

            @endforelse

        </div>

        {{-- RIGHT PANEL --}}
        <div class="col-md-8 d-flex align-items-center justify-content-center">

            <h5 class="text-muted">
                Select a conversation
            </h5>

        </div>

    </div>
    
</div>
{{-- GROUP CHAT MODAL --}}
<div class="modal fade" id="groupChatModal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="{{ route('group.chat.store') }}" method="POST">
                @csrf

                {{-- HEADER --}}
                <div class="modal-header">
                    <h5 class="modal-title">Create Group Chat</h5>
                </div>

                <div class="modal-body">

                    {{-- GROUP TITLE --}}
                    <div class="mb-3">

                        <label class="form-label">Group Name</label>

                        <input type="text"
                               name="title"
                               class="form-control"
                               placeholder="Wedding Team Chat"
                               required>

                    </div>

                    {{-- ========================= --}}
                    {{-- CLIENT (OPTIONAL) --}}
                    {{-- ========================= --}}
                    <div class="mb-3">

                        <label class="form-label fw-bold">
                            Add Client (Optional)
                        </label>

                        <select name="client_id" class="form-select">

                            <option value="">-- Select Client --</option>

                            @foreach($clients as $client)

                                <option value="{{ $client->id }}">
                                    {{ $client->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- ========================= --}}
                    {{-- ADMIN / EVENT PLANNER --}}
                    {{-- ========================= --}}
                    <div class="mb-3">

                        <label class="form-label fw-bold">
                            Add Admin / Event Planner
                        </label>

                        @foreach($admins as $admin)

                            @if($admin->id != auth()->id())

                                <div class="form-check">

                                    <input type="checkbox"
                                           name="participants[]"
                                           value="{{ $admin->id }}"
                                           class="form-check-input">

                                    <label class="form-check-label">
                                        {{ $admin->name }} (Admin)
                                    </label>

                                </div>

                            @endif

                        @endforeach

                    </div>

                    {{-- ========================= --}}
                    {{-- SUPPLIERS --}}
                    {{-- ========================= --}}
                    <div class="mb-3">

                        <label class="form-label fw-bold">
                            Add Suppliers
                        </label>

                        @foreach($suppliers as $supplier)

                            @if($supplier->id != auth()->id())

                                <div class="form-check">

                                    <input type="checkbox"
                                           name="participants[]"
                                           value="{{ $supplier->id }}"
                                           class="form-check-input">

                                    <label class="form-check-label">

                                        {{ optional($supplier->supplier)->business_name }}

                                    </label>

                                </div>

                            @endif

                        @endforeach

                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="modal-footer">

                    <button type="submit" class="btn btn-success">
                        Create Group
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<script>
    // Optional: Add JavaScript to handle modal behavior if needed
    document.addEventListener('DOMContentLoaded', function() {
        var groupChatModal = document.getElementById('groupChatModal');
        groupChatModal.addEventListener('show.bs.modal', function (event) {
            // You can add any dynamic behavior here if needed when the modal is shown
        });
    });
</script>

</x-supplier-layout>
@else
{{-- resources/views/messages/client-chatbox.blade.php --}}

<x-client-layout>

    <div class="container py-4">

        <div class="row">

            {{-- LEFT: CONVERSATIONS --}}
            <div class="col-md-4 border-end">

                <h5 class="mb-3">Inbox</h5>

                {{-- ========================= --}}
                {{-- ADMIN CHAT --}}
                {{-- ========================= --}}

                <h6 class="text-muted mt-3">Admin Support</h6>

                @forelse($admins as $admin)

                    <a href="{{ route('messages.open', $admin->id) }}"
                    class="d-block p-2 border rounded mb-2 text-decoration-none">

                        <strong>
                            {{ $admin->name }} (Admin)
                        </strong>

                        <br>

                        <small class="text-muted">
                            Chat with support / admin
                        </small>

                    </a>

                @empty

                    <p class="text-muted">No admin available.</p>

                @endforelse

                {{-- ========================= --}}
                {{-- ALL SUPPLIERS --}}
                {{-- ========================= --}}
                <h6 class="text-muted">All Suppliers</h6>

                @forelse($suppliers as $supplierUser)

                    @if($supplierUser && $supplierUser->supplier)

                        <a href="{{ route('messages.open', $supplierUser->id) }}"
                        class="d-block p-2 border rounded mb-2 text-decoration-none">

                            <strong>
                                {{ $supplierUser->supplier->business_name }}
                            </strong>

                            <br>

                            <small class="text-muted">
                                Start conversation
                            </small>

                        </a>

                    @endif

                @empty

                    <p class="text-muted">No suppliers found.</p>

                @endforelse

                <hr>

                {{-- ========================= --}}
                {{-- EXISTING CHATS --}}
                {{-- ========================= --}}
                <h6 class="text-muted">Chats</h6>

                @forelse($conversations as $conversation)

                    @php

                        /*
                        |--------------------------------------------------------------------------
                        | OTHER USER
                        |--------------------------------------------------------------------------
                        */

                        $otherUser = $conversation->participants
                            ->where('user_id', '!=', auth()->id())
                            ->first()?->user;

                        /*
                        |--------------------------------------------------------------------------
                        | DISPLAY TITLE
                        |--------------------------------------------------------------------------
                        */

                        if ($conversation->type == 'group') {

                            $displayName = $conversation->title ?? 'Group Chat';

                        } else {

                            if ($otherUser?->supplierProfile) {

                                $displayName =
                                    $otherUser->supplierProfile->business_name;

                            } else {

                                $displayName =
                                    $otherUser->name ?? 'Client';
                            }
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | LAST MESSAGE
                        |--------------------------------------------------------------------------
                        */

                        $lastMessage =
                            optional($conversation->messages->last())->message
                            ?? 'No messages yet';

                    @endphp

                    <a href="{{ route('messages.chat', $conversation->id) }}"
                    class="d-block p-3 border rounded mb-2 text-decoration-none">

                        <strong>

                            {{ $displayName }}

                        </strong>

                        <br>

                        <small class="text-muted">

                            {{ Str::limit($lastMessage, 40) }}

                        </small>

                    </a>

                    @empty

                    <p class="text-muted">
                        No conversations yet.
                    </p>

                @endforelse

            </div>

            {{-- RIGHT PANEL --}}
            <div class="col-md-8 d-flex align-items-center justify-content-center">

                <h5 class="text-muted">
                    Select a conversation
                </h5>

            </div>

        </div>

    </div>

</x-client-layout>
@endif


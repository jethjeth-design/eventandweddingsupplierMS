@if(auth()->user()->isAdmin())
<x-app-layout>

<div class="container py-4">

    <div class="card shadow border-0">

        {{-- ========================= --}}
        {{-- CHAT HEADER --}}
        {{-- ========================= --}}
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

            <div>

                <h5 class="mb-0">

                    {{ $conversation->title ?? 'Chat Room' }}

                </h5>

                <small>

                    {{ ucfirst($conversation->type) }}

                </small>

            </div>

            <a href="{{ route('messages.inbox') }}"
               class="btn btn-light btn-sm">

                Back

            </a>

        </div>

        {{-- ========================= --}}
        {{-- GROUP INFO --}}
        {{-- ========================= --}}
        @if($conversation->type == 'group')

            <div class="border-bottom p-3 bg-light">

                {{-- GROUP TITLE --}}
                <h5 class="fw-bold mb-3">

                    {{ $conversation->title ?? 'Group Chat' }}

                </h5>

                {{-- PARTICIPANTS --}}
                <h6 class="fw-semibold mb-2 text-muted">
                    Participants
                </h6>

                <div class="d-flex flex-wrap gap-2">

                    @foreach($conversation->participants as $participant)

                        <span class="badge bg-secondary p-2">

                            {{ $participant->user->name }}

                            @if($participant->user->supplier)

                                - {{ $participant->user->supplier->business_name }}

                            @endif

                        </span>

                    @endforeach

                </div>

            </div>

        @endif

        {{-- ========================= --}}
        {{-- CHAT BODY --}}
        {{-- ========================= --}}
        <div class="card-body"
             style="height: 500px; overflow-y: auto; background: #f8f9fa;">

            @forelse($conversation->messages as $message)

                @php
                    $isMe = $message->sender_id == auth()->id();
                @endphp

                <div class="d-flex mb-3 {{ $isMe ? 'justify-content-end' : 'justify-content-start' }}">

                    <div class="rounded shadow-sm p-3
                        {{ $isMe ? 'bg-primary text-white' : 'bg-white border' }}"
                        style="max-width: 70%; min-width: 150px;">

                        {{-- SENDER --}}
                        <div class="mb-1">

                            <strong>

                                {{ $message->sender->name }}

                            </strong>

                            @if($message->sender->supplier)

                                <small class="{{ $isMe ? 'text-light' : 'text-muted' }}">

                                    • {{ $message->sender->supplier->business_name }}

                                </small>

                            @endif

                        </div>

                        {{-- MESSAGE --}}
                        <div class="mb-1">

                            {{ $message->message }}

                        </div>

                        {{-- TIME --}}
                        <small class="{{ $isMe ? 'text-light' : 'text-muted' }}">

                            {{ $message->created_at->diffForHumans() }}

                        </small>

                    </div>

                </div>

            @empty

                <div class="text-center text-muted mt-5">

                    <h5>
                        No messages yet
                    </h5>

                    <p>
                        Start the conversation.
                    </p>

                </div>

            @endforelse

        </div>

        {{-- ========================= --}}
        {{-- MESSAGE INPUT --}}
        {{-- ========================= --}}
        <div class="card-footer bg-white">

            <form action="{{ route('messages.send') }}"
                  method="POST">

                @csrf

                <input type="hidden"
                       name="conversation_id"
                       value="{{ $conversation->id }}">

                <div class="input-group">

                    <input type="text"
                           name="message"
                           class="form-control"
                           placeholder="Type your message..."
                           required>

                    <button class="btn btn-primary">

                        Send

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</x-app-layout>
@elseif(auth()->user()->isSupplier())
{{-- resources/views/messages/supplier-chatbox.blade.php --}}

<x-supplier-layout>

<div class="container py-4">

    <div class="card shadow border-0">

        {{-- ========================= --}}
        {{-- CHAT HEADER --}}
        {{-- ========================= --}}
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

            <div>

                <h5 class="mb-0">

                    {{ $conversation->title ?? 'Chat Room' }}

                </h5>

                <small>

                    {{ ucfirst($conversation->type) }}

                </small>

            </div>

            <a href="{{ route('messages.inbox') }}"
               class="btn btn-light btn-sm">

                Back

            </a>

        </div>

        {{-- ========================= --}}
        {{-- GROUP INFO --}}
        {{-- ========================= --}}
        @if($conversation->type == 'group')

            <div class="border-bottom p-3 bg-light">

                {{-- GROUP TITLE --}}
                <h5 class="fw-bold mb-3">

                    {{ $conversation->title ?? 'Group Chat' }}

                </h5>

                {{-- PARTICIPANTS --}}
                <h6 class="fw-semibold mb-2 text-muted">
                    Participants
                </h6>

                <div class="d-flex flex-wrap gap-2">

                    @foreach($conversation->participants as $participant)

                        <span class="badge bg-secondary p-2">

                            {{ $participant->user->name }}

                            @if($participant->user->supplier)

                                - {{ $participant->user->supplier->business_name }}

                            @endif

                        </span>

                    @endforeach

                </div>

            </div>

        @endif

        {{-- ========================= --}}
        {{-- CHAT BODY --}}
        {{-- ========================= --}}
        <div class="card-body"
             style="height: 500px; overflow-y: auto; background: #f8f9fa;">

            @forelse($conversation->messages as $message)

                @php
                    $isMe = $message->sender_id == auth()->id();
                @endphp

                <div class="d-flex mb-3 {{ $isMe ? 'justify-content-end' : 'justify-content-start' }}">

                    <div class="rounded shadow-sm p-3
                        {{ $isMe ? 'bg-primary text-white' : 'bg-white border' }}"
                        style="max-width: 70%; min-width: 150px;">

                        {{-- SENDER --}}
                        <div class="mb-1">

                            <strong>

                                {{ $message->sender->name }}

                            </strong>

                            @if($message->sender->supplier)

                                <small class="{{ $isMe ? 'text-light' : 'text-muted' }}">

                                    • {{ $message->sender->supplier->business_name }}

                                </small>

                            @endif

                        </div>

                        {{-- MESSAGE --}}
                        <div class="mb-1">

                            {{ $message->message }}

                        </div>

                        {{-- TIME --}}
                        <small class="{{ $isMe ? 'text-light' : 'text-muted' }}">

                            {{ $message->created_at->diffForHumans() }}

                        </small>

                    </div>

                </div>

            @empty

                <div class="text-center text-muted mt-5">

                    <h5>
                        No messages yet
                    </h5>

                    <p>
                        Start the conversation.
                    </p>

                </div>

            @endforelse

        </div>

        {{-- ========================= --}}
        {{-- MESSAGE INPUT --}}
        {{-- ========================= --}}
        <div class="card-footer bg-white">

            <form action="{{ route('messages.send') }}"
                  method="POST">

                @csrf

                <input type="hidden"
                       name="conversation_id"
                       value="{{ $conversation->id }}">

                <div class="input-group">

                    <input type="text"
                           name="message"
                           class="form-control"
                           placeholder="Type your message..."
                           required>

                    <button class="btn btn-primary">

                        Send

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</x-supplier-layout>
@else
{{-- resources/views/messages/client-chatbox.blade.php --}}

<x-client-layout>

<div class="container py-4">

    <div class="card shadow border-0">

        {{-- ========================= --}}
        {{-- CHAT HEADER --}}
        {{-- ========================= --}}
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

            <div>

                <h5 class="mb-0">

                    {{ $conversation->title ?? 'Chat Room' }}

                </h5>

                <small>

                    {{ ucfirst($conversation->type) }}

                </small>

            </div>

            <a href="{{ route('messages.inbox') }}"
               class="btn btn-light btn-sm">

                Back

            </a>

        </div>

        {{-- ========================= --}}
        {{-- GROUP INFO --}}
        {{-- ========================= --}}
        @if($conversation->type == 'group')

            <div class="border-bottom p-3 bg-light">

                {{-- GROUP TITLE --}}
                <h5 class="fw-bold mb-3">

                    {{ $conversation->title ?? 'Group Chat' }}

                </h5>

                {{-- PARTICIPANTS --}}
                <h6 class="fw-semibold mb-2 text-muted">
                    Participants
                </h6>

                <div class="d-flex flex-wrap gap-2">

                    @foreach($conversation->participants as $participant)

                        <span class="badge bg-secondary p-2">

                            {{ $participant->user->name }}

                            @if($participant->user->supplier)

                                - {{ $participant->user->supplier->business_name }}

                            @endif

                        </span>

                    @endforeach

                </div>

            </div>

        @endif

        {{-- ========================= --}}
        {{-- CHAT BODY --}}
        {{-- ========================= --}}
        <div class="card-body"
             style="height: 500px; overflow-y: auto; background: #f8f9fa;">

            @forelse($conversation->messages as $message)

                @php
                    $isMe = $message->sender_id == auth()->id();
                @endphp

                <div class="d-flex mb-3 {{ $isMe ? 'justify-content-end' : 'justify-content-start' }}">

                    <div class="rounded shadow-sm p-3
                        {{ $isMe ? 'bg-primary text-white' : 'bg-white border' }}"
                        style="max-width: 70%; min-width: 150px;">

                        {{-- SENDER --}}
                        <div class="mb-1">

                            <strong>

                                {{ $message->sender->name }}

                            </strong>

                            @if($message->sender->supplier)

                                <small class="{{ $isMe ? 'text-light' : 'text-muted' }}">

                                    • {{ $message->sender->supplier->business_name }}

                                </small>

                            @endif

                        </div>

                        {{-- MESSAGE --}}
                        <div class="mb-1">

                            {{ $message->message }}

                        </div>

                        {{-- TIME --}}
                        <small class="{{ $isMe ? 'text-light' : 'text-muted' }}">

                            {{ $message->created_at->diffForHumans() }}

                        </small>

                    </div>

                </div>

            @empty

                <div class="text-center text-muted mt-5">

                    <h5>
                        No messages yet
                    </h5>

                    <p>
                        Start the conversation.
                    </p>

                </div>

            @endforelse

        </div>

        {{-- ========================= --}}
        {{-- MESSAGE INPUT --}}
        {{-- ========================= --}}
        <div class="card-footer bg-white">

            <form action="{{ route('messages.send') }}"
                  method="POST">

                @csrf

                <input type="hidden"
                       name="conversation_id"
                       value="{{ $conversation->id }}">

                <div class="input-group">

                    <input type="text"
                           name="message"
                           class="form-control"
                           placeholder="Type your message..."
                           required>

                    <button class="btn btn-primary">

                        Send

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</x-client-layout>
@endif


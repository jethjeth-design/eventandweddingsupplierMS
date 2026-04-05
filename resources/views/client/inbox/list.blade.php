<x-client-layout>
    <style>
        .chat-container {
            max-width: 800px;
            margin: auto;
            border: 1px solid #ddd;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            height: 80vh;
            background: #fff;
        }

        .chat-header {
            padding: 15px;
            border-bottom: 1px solid #eee;
            font-weight: bold;
        }

        .chat-box {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            background: #f5f7fb;
        }

        .chat-row {
            display: flex;
            margin-bottom: 10px;
        }

        .chat-left {
            justify-content: flex-start;
        }

        .chat-right {
            justify-content: flex-end;
        }

        .chat-bubble {
            padding: 10px 15px;
            border-radius: 20px;
            max-width: 60%;
            font-size: 14px;
        }

        .chat-me {
            background: #4CAF50;
            color: #fff;
        }

        .chat-them {
            background: #e4e6eb;
        }

    </style>

    <div class="container py-5">
        <h2 class="mb-4">Inbox</h2>
        <div class="list-group">
            @forelse($conversations as $msg)
                @php
                    $otherUser = $msg->sender_id == auth()->id()
                        ? $msg->receiver
                        : $msg->sender;
                @endphp

                <a href="{{ route('chat', [$otherUser->id, $msg->supplier_id]) }}"
                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    {{ $otherUser->name }}
                    @if($msg->unread_count > 0)
                        <span class="badge badge-primary badge-pill">{{ $msg->unread_count }}</span>
                    @endif
                </a>
            @empty
                <p>No conversations yet.</p>
            @endforelse
        </div>
        
    </div>
</x-client-layout>
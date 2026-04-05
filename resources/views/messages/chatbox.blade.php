@if(auth()->user()->isSupplier())
<x-supplier-layout>
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

        .chat-time {
            font-size: 10px;
            margin-top: 5px;
            opacity: 0.7;
        }

        .chat-form {
            border-top: 1px solid #eee;
            padding: 10px;
        }

        .chat-input-group {
            display: flex;
            gap: 10px;
        }

        .chat-input-group textarea {
            flex: 1;
            resize: none;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .chat-input-group button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>
    <div class="chat-container">

        {{-- HEADER --}}
        <div class="chat-header">
            <h3>Conversation</h3>
        </div>

        {{-- MESSAGES --}}
        <div class="chat-box">
            @foreach($messages as $msg)

                @if($msg->sender_id == auth()->id())
                    {{-- YOU --}}
                    <div class="chat-row chat-right">
                        <div class="chat-bubble chat-me">
                            {{ $msg->message }}
                            <div class="chat-time">
                                {{ $msg->created_at->format('h:i A') }}
                            </div>
                        </div>
                    </div>
                @else
                    {{-- OTHER USER --}}
                    <div class="chat-row chat-left">
                        <div class="chat-bubble chat-them">
                            {{ $msg->message }}
                            <div class="chat-time">
                                {{ $msg->created_at->format('h:i A') }}
                            </div>
                        </div>
                    </div>
                @endif

            @endforeach
        </div>

        {{-- MESSAGE FORM --}}
        <div class="chat-form">
            <form method="POST" action="{{ route('chat.send') }}">
                @csrf

                <input type="hidden" name="receiver_id" value="{{ $userId }}">
                <input type="hidden" name="supplier_id" value="{{ $supplierId }}">

                <div class="chat-input-group">
                    <textarea name="message" placeholder="Type a message..." required></textarea>
                    <button type="submit">Send</button>
                </div>
            </form>
        </div>

    </div>
</x-supplier-layout>
@elseif(auth()->user()->isClient())
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

        .chat-time {
            font-size: 10px;
            margin-top: 5px;
            opacity: 0.7;
        }

        .chat-form {
            border-top: 1px solid #eee;
            padding: 10px;
        }

        .chat-input-group {
            display: flex;
            gap: 10px;
        }

        .chat-input-group textarea {
            flex: 1;
            resize: none;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .chat-input-group button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>
    <div class="chat-container">

        {{-- HEADER --}}
        <div class="chat-header">
            <h3>Conversation</h3>
        </div>

        {{-- MESSAGES --}}
        <div class="chat-box">
            @foreach($messages as $msg)

                @if($msg->sender_id == auth()->id())
                    {{-- YOU --}}
                    <div class="chat-row chat-right">
                        <div class="chat-bubble chat-me">
                            {{ $msg->message }}
                            <div class="chat-time">
                                {{ $msg->created_at->format('h:i A') }}
                            </div>
                        </div>
                    </div>
                @else
                    {{-- OTHER USER --}}
                    <div class="chat-row chat-left">
                        <div class="chat-bubble chat-them">
                            {{ $msg->message }}
                            <div class="chat-time">
                                {{ $msg->created_at->format('h:i A') }}
                            </div>
                        </div>
                    </div>
                @endif

            @endforeach
        </div>

        {{-- MESSAGE FORM --}}
        <div class="chat-form">
            <form method="POST" action="{{ route('chat.send') }}">
                @csrf

                <input type="hidden" name="receiver_id" value="{{ $userId }}">
                <input type="hidden" name="supplier_id" value="{{ $supplierId }}">

                <div class="chat-input-group">
                    <textarea name="message" placeholder="Type a message..." required></textarea>
                    <button type="submit">Send</button>
                </div>
            </form>
        </div>

    </div>
</x-client-layout>
@endif
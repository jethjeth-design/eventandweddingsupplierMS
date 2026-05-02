<x-supplier-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success mb-4">
            ✅ Verification email has been sent again!
        </div>
    @endif
    
    @if(!auth()->user()->hasVerifiedEmail())
        <div class="alert alert-warning d-flex justify-content-between align-items-center mb-4">

            <div>
                <strong>⚠ Email not verified</strong><br>
                Please verify your email to unlock booking, messaging, and full access.
            </div>

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-dark">
                    Resend Email
                </button>
            </form>

        </div>
    @endif

    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged ") }} {{ Auth::user()->name }} {{ __("as a supplier!") }}
                </div>
            </div>
        </div>
    </div>
</x-supplier-layout>

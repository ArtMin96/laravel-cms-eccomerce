<div class="message-dialog g-card-wrap {{ $alertTypeClasses[$alertType] }}" style="display: @if($message) block @else none @endif">
    <span>{{ $message }}</span>
</div>

@push('script')
    <script>
        window.addEventListener('livewire:load', function () {
            setTimeout(function () {
                $('.message-dialog').fadeOut('slow', function(){ $(this).hide(); });
            }, 5000);
        });
    </script>
@endpush

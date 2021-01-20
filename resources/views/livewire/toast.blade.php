<div class="alert {{ $alertTypeClasses[$alertType] }} alert-dismissible fade show alert-solid position-fixed custom-toast"
     role="alert"
     style="z-index: 1050; width: fit-content; bottom: 1rem; right: 1rem; display: @if($message) block @else none @endif"
>
    {{ $message }}
    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>

@push('script')
    <script>
        window.addEventListener('livewire:load', function () {
            setTimeout(function () {
                document.getElementsByClassName('custom-toast')[0].style.display = 'none';
            }, 5000);
        });
    </script>
@endpush

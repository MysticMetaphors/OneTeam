<div class="modal-container">
    <div class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">{{ $title }}</h2>
                <button class="close-button">&times;</button>
            </div>
            <div class="modal-body">
                {{ $slot }}
                <button type="submit">Yes</button>
            </div>
        </div>
    </div>
</div>

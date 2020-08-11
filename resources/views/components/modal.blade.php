<div class="modal {{ $animation ?? 'fade' }} {{ $class ?? '' }}" id="{{ $id ?? 'modal' }}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            @isset($title)
                <div class="modal-header">
                    <h5 class="modal-title">{{ $title }}</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endisset

            <div class="modal-body">
                {{ $slot }}
            </div>

            @isset($footer)
                <div class="modal-footer">
                    {{ $footer }}
                </div>
            @endisset
        </div>
    </div>
</div>



<div class="modal" tabindex="-1" role="dialog" id="alertSave">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
                <p>Modal body text goes here.</p>
                <p>Modal body text goes here.</p>
                <p>Modal body text goes here.</p>
                <p>Modal body text goes here.</p>
                <p>Modal body text goes here.</p>
                <p>Modal body text goes here.</p>
                <p>Modal body text goes here.</p>
                <p>Modal body text goes here.</p>
                <p>Modal body text goes here.</p>
                <p>Modal body text goes here.</p>
                <p>Modal body text goes here.</p>
                <p>Modal body text goes here.</p>
                <p>Modal body text goes here.</p>
                <p>Modal body text goes here.</p>
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
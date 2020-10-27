<script>
    let onConfirmRoute = () => console.log("calling empty route")

    const confirmModalTitle = document.getElementById('confirm-modal-title')
    const confirmModalBody = document.getElementById('confirm-modal-body')

    function registerConfirmRoute(confirmRoute, onSuccessRoute, method) {
        onConfirmRoute = () => {
            let confirmButton = document.getElementById('confirm-btn')
            let cancelButton = document.getElementById('cancel-btn')

            confirmButton.disabled = true
            cancelButton.disabled = true
            fetch(confirmRoute, {
                headers: {'X-CSRF-TOKEN': '{!! csrf_token() !!}'},
                method
            }).finally(_ => window.location.href = onSuccessRoute)
        }
    }
</script>

<div class="modal" id="confirm-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm your action</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">Are you sure?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" id="cancel-btn" type="button">Cancel</button>
                <button class="btn btn-primary" id="confirm-btn" onclick="onConfirmRoute()" type="button">Confirm
                </button>
            </div>
        </div>
    </div>
</div>

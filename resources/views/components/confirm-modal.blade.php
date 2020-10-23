<script>
    let onConfirmRoute = () => console.log("calling empty route")

    const confirmModalTitle = document.getElementById('confirm-modal-title')
    const confirmModalBody = document.getElementById('confirm-modal-body')

    function registerConfirmRoute(confirmRoute) {
        onConfirmRoute = () => window.location.href = confirmRoute
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="onConfirmRoute()">Confirm</button>
            </div>
        </div>
    </div>
</div>
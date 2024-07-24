<!-- Modal Import JSON -->
<div class="modal fade" id="importJSONModal" tabindex="-1" aria-labelledby="importJSONModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="import/proses1_json.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="importJSONModalLabel">Import JSON</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="file" name="file" accept=".json" required class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="import" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

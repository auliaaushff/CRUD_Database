<!-- Modal Import XLSX -->
<div class="modal fade" id="importXLSXModal" tabindex="-1" aria-labelledby="importXLSXModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="import/proses1_xlsx.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="importXLSXModalLabel">Import XLSX</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="file" name="file" accept=".xlsx" required class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="import" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

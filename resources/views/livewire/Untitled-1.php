<main class="main-content">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Authors table</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="authors-table" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Author</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Function</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th>
                                        <th class="text-secondary opacity-7">Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
$(document).ready(function() {
    $('#authors-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'https://www.pasardana.id/api/StockNewSector/GetAll', // Your API endpoint
        columns: [
            { 
                data: null,
                render: function(data, type, row) {
                    return `
                        <div class="d-flex px-2 py-1">
                            <div>
                                <img src="${row.image}" class="avatar avatar-sm me-3">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">${row.name}</h6>
                                <p class="text-xs text-secondary mb-0">${row.email}</p>
                            </div>
                        </div>
                    `;
                }
            },
            { 
                data: null,
                render: function(data, type, row) {
                    return `
                        <p class="text-xs font-weight-bold mb-0">${row.function}</p>
                        <p class="text-xs text-secondary mb-0">${row.department}</p>
                    `;
                }
            },
            { 
                data: 'status',
                render: function(data, type, row) {
                    const statusClass = data === 'Online' ? 'success' : 'secondary';
                    return `<span class="badge badge-sm bg-gradient-${statusClass}">${data}</span>`;
                }
            },
            { data: 'employed_date' },
            { 
                data: null,
                render: function(data, type, row) {
                    return `
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                            Edit
                        </a>
                    `;
                }
            }
        ],
        language: {
            processing: "Loading...",
            search: "Search:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            infoEmpty: "Showing 0 to 0 of 0 entries",
            infoFiltered: "(filtered from _MAX_ total entries)",
            emptyTable: "No data available"
        }
    });
});
</script>

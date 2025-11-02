<main class="main-content">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Stock Sectors</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="sectors-table" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Loading...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Loading data...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Add these before your existing script -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"> -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    let table = null;

    $.ajax({
        url: '/api/stock-sectors',
        method: 'GET',
        success: function(response) {
            if (response && Array.isArray(response)) {
                if (table) {
                    table.destroy();
                }

                const columns = [];
                if (response.length > 0) {
                    const sampleRow = response[0];
                    Object.keys(sampleRow).forEach(function(key) {
                        columns.push({
                            data: key,
                            name: key,
                            title: key.charAt(0).toUpperCase() + key.slice(1).replace('_', ' ')
                        });
                    });
                }

                // Destroy existing table if any
                if ($.fn.DataTable.isDataTable('#sectors-table')) {
                    $('#sectors-table').DataTable().destroy();
                }
                
                // Clear existing content
                $('#sectors-table').empty();

                // Initialize new table
                table = $('#sectors-table').DataTable({
                    data: response,
                    columns: columns,
                    ordering: true,
                    searching: true,
                    pageLength: 10,
                    responsive: true,
                    dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ entri",
                        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                        infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
                        infoFiltered: "(difilter dari _MAX_ total entri)",
                        emptyTable: "Data tidak tersedia",
                        paginate: {
                            first: "Pertama",
                            last: "Terakhir",
                            next: "Selanjutnya",
                            previous: "Sebelumnya"
                        }
                    },
                    drawCallback: function(settings) {
                        // Reinitialize any Bootstrap tooltips/popovers if needed
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching data:', error);
            alert('Gagal mengambil data. Silakan coba lagi.');
        }
    });
});
</script>

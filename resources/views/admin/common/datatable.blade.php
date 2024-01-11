@once
    @push('styles')
        <link href="{{asset('assets/global/datatables/datatables.bundle.css')}}" rel="stylesheet"
              type="text/css"/>
    @endpush
@endonce
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable">
        <thead>
        <tr>
            @foreach ($tableHeads as $key => $title)
                <th>{{$title}}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

@once
@push('scripts')
    <script src="{{asset('assets/global/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
    <script>
        $(function() {

            var columns = eval('{!! json_encode($columns) !!}');

            var dataTable = $('#dataTable').DataTable({
                dom: 'rt<"row"<"col-md-2 col-sm-12"l><"col-md-5 col-sm-12 text-center"i><"col-md-5 col-sm-12"p>>',
                language: {
                    search: "",
                    searchPlaceholder: "Search",
                },
                lengthMenu: [
                    [10, 15, 20, 50, 100, 150, 200, -1],
                    [10, 15, 20, 50, 100, 150, 200, "All"]
                ],
                pageLength: 15,
                pagingType: "full_numbers",
                order: [
                    [0, "desc"]
                ],
                processing: true,
                serverSide: true,
                fnRowCallback : function(nRow, aData, iDisplayIndex){
                    $("td:first", nRow).html(iDisplayIndex +1);
                    return nRow;
                },
                ajax: {
                    url: '{{ url($dataUrl) }}',
                    data: function (e) {
                        var fields = $('#searchForm').serializeArray();
                        $.each( fields, function( i, field ) {
                            e[field.name] = field.value;
                        });
                    }
                },
                columns: columns
            });

            $('#searchForm').submit(function (e) {
                e.preventDefault();
                dataTable.draw();
            });

            $('.reset').click(function (e) {
                e.preventDefault();
                $('#searchForm').trigger("reset");
                dataTable.draw();
            });

        });
    </script>
@endpush
@endonce

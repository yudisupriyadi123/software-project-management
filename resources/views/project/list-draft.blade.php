@extends('template.master')
@section('title', 'Proyek Draft: Daftar')

@section('css')
<style>
/* TODO: ganti clearfix dengan ml-auto/mr-auto */
.clearfix .left, .clearfix .right {display: inline-block}
.clearfix .left {float: left}
.clearfix .right {float:right}

.icon-box {
    width: 2.5rem;
    height: 1.5rem;
    display: inline-block;
    background: no-repeat center/100% 100%;
    vertical-align: bottom;
    font-style: normal;
    box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.1);
    border-radius: 2px;
}
</style>
@endsection

@section('content')
    <div class="container">
        @component('pagetitle')
            Daftar Proyek Draft
        @endcomponent

        @component('cardtable', ['class' => 'datatable'])
            <thead>
            <tr>
                <th class="text-center w-1"></th>
                <th>Client</th>
                <th class="text-center w-1">Jenis</th>
                <th>Proyek</th>
                <th class="text-center"><i class="fe fe-settings"></i></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center" colspan="5">
                    <div class="loader mx-auto"></div>
                </td>
            </tr>
            </tbody>
        @endcomponent
    </div>

    <script>
    require(['datatables', 'jquery'], function(datatable, $) {
        $('.datatable').DataTable({
            serverSide: true,
            ajax: '{{ route('draft-project-list-ajax') }}',
            // why? It because I want to remove sort icon for col 0
            order: [],
            columnDefs: [
                {
                    render: function(data, type, row) {
                        if (data) {
                            return `
                                <div class="avatar d-block" style="background-image: url( ${ require.toUrl('storage/clientImage/' + data) } )"></div>
                            `;
                        }

                        return `
                            <div class="avatar avatar-placeholder d-block"></div>
                        `;
                    },
                    orderable: false,
                    targets: 0,
                },
                {
                    render: function(data, type, row) {
                        return `
                            <div>${data}</div>
                            <div class="small text-muted">
                            Bekerja sama sejak: ${row['created_at']}
                            </div>
                        `;
                    },
                    targets: 1,
                },
                {
                    render: function(data, type, row) {
                        return `
                            <i class="icon-box"><i class="${data}"></i></i>
                        `;
                    },
                    className: 'text-center',
                    targets: 2,
                },
                {
                    render: function(data, type, row) {
                        let html = `
                            <div class="item-action dropdown">
                            <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ url('/project/detail') }}/${row['id']}" target="_blank" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Detail </a>
                            </div>
                            </div>
                        `;

                        return html;
                    },
                    className: 'text-center',
                    orderable: false,
                    targets: 4,
                },
            ],
            columns: [
                { data: 'client.photo' },
                { data: 'client.name' },

                { data: 'project_type.icon' },

                { data: 'name' },

                { data: null },
            ]
        });
    });
    </script>
@endsection

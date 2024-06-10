@extends('shopify-app::layouts.default')
@section('content')
  @section('styles')
    @include('layout.header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css"/>
    <style type="text/css">
   .tooltip {
     position: relative;
     opacity: 1;
   }

   .tooltip .tooltiptext {
     visibility: hidden;
     width: 106px;
     background-color: black;
     color: #fff;
     text-align: center;
     border-radius: 6px;
     padding: 5px 0;
     position: absolute;
     z-index: 1;
     bottom: 155%;
     left: 50%;
     margin-left: -53px;
     font-size: 13px;
   }

   .tooltip .tooltiptext::after {
     content: "";
     position: absolute;
     top: 100%;
     left: 50%;
     margin-left: -5px;
     border-width: 5px;
     border-style: solid;
     border-color: black transparent transparent transparent;
   }

   .tooltip:hover .tooltiptext {
     visibility: visible;
   }

   input:focus-visible {
     outline: none;
   }
   table.dataTable{
    font-family: 'Poppins', sans-serif;
   }
   .customer_wrapper .card_shadow {
     box-shadow: 0px 7px 17px #e5e2ff80;
     border-radius: 5px;
   }

   .customer_wrapper .containers {
     width: 90%;
     margin: 0 auto;
   }

   .customer_wrapper thead tr {
     font-family: 'Inter', sans-serif;
     font-size: 14px;
     font-weight: 600;
   }

   .customer_wrapper thead th {
     border-bottom: 1px solid #efecec !important;
   }

   .customer_wrapper tbody th {
     font-family: 'Inter', sans-serif;
     font-size: 14px;
     font-weight: 500;
     color: black;
     text-align: center !important;
     border-bottom: 1px solid #efecec;
     border-top: none !important;
   }

   .customer_wrapper table.dataTable.no-footer {
     border-bottom: none;
   }

   .customer_wrapper .dataTables_filter {
      float: right;
      width: 50%;
      /* padding: 20px 10px; */
      margin-bottom: 15px;
      box-sizing: border-box;
      display: flex;
      justify-content: flex-end;
      align-items: center;
      height: 100%;
      padding-top: 15px;
   }
   .customer_wrapper div.dataTables_wrapper div.dataTables_filter label{
    font-size: 14px;
    font-family: 'Poppins', sans-serif;
   }

   .customer_wrapper .dt-buttons {
     float: left;
     width: 50%;
     display: flex;
     justify-content: start;
     padding: 5px 10px;
     box-sizing: border-box;
   }

   .customer_wrapper .dataTables_length {
     width: 50%;
     height: 40px;
     background-color: #F9F9F9;
   }

   .customer_wrapper .dataTables_length label {
     padding: 10px 10px;
     line-height: 38px;
   }

   .customer_wrapper .dataTables_filter input {
     border-radius: 20px;
     padding: 5px 15px;
     color: #8b7a7a;
     font-family: 'Inter', sans-serif;
     font-size: 12px;
     border: 1px solid #7a6363;
   }

   .customer_wrapper .dataTables_filter label {
     position: relative;
     left: 0;
     top: 0;
   }

   .customer_wrapper .dataTables_filter label span {
     position: absolute;
     left: 16px;
     top: 8%;
   }

   .customer_wrapper .paginate_button next:hover,
   .customer_wrapper .paginate_button previous:hover {
     background: none !important;
   }

   .customer_wrapper button.dt-button {
     font-family: 'Inter', sans-serif;
     color: #76777a;
     font-size: 14px;
     background: transparent;
     font-weight: medium;
     border: none;
     margin-bottom: 0;
     margin: 0;
     
     transition: all .3s ease;
   }

   .customer_wrapper button.dt-button:focus {
     background: none;
     border: none;
   }

   .customer_wrapper button.dt-button:hover {
     border: none;
     background: none;
   }

   .customer_wrapper .dataTables_info {
     font-family: 'Inter', sans-serif;
     font-size: 14px;
     font-weight: 400;
     color: #46474b;
     width: 50%;
     display: inline-block;
   }

   .customer_wrapper .dataTables_paginate {
     font-family: 'Inter', sans-serif;
     font-size: 14px;
     font-weight: 500;
     color: #8b7a7a;
     padding-top: 0;
     width: 50%;
     display: inline-block;
   }

   .customer_wrapper span a.paginate_button {
     min-width: 28px !important;
     padding: 5px 0px !important;
     background-color: white !important;
   }

   .customer_wrapper span a.paginate_button.current {
     color: white !important;
     opacity: 1;
     border: none !important;
     background: none !important;
     border-radius: 4px !important;
   }

   .customer_wrapper span a.paginate_button:hover {
     background: linear-gradient(to bottom, #fff 0%, #dcdcdc 100%) !important;
     border: none !important;
     color: black !important;
   }
   .fa-regular  {
    color:white !important;
   }
   .customer_wrapper .dataTables_paginate .paginate_button:hover a{
     background: transparent !important;
/*     background: linear-gradient(to bottom, #fff 0%, #dcdcdc 100%) !important;*/
     border: none !important;
     color: #EE2E64 !important;
   }

   /*responsive css start*/
   @media screen and (max-width: 768px) {
     .customer_wrapper .dataTables_wrapper {
       width: 100%;
       overflow: hidden;
       overflow-x: auto;
     }

     .customer_wrapper .dt-buttons {
       width: 100%;
     }

     .customer_wrapper .dataTables_filter {
       width: 100%;
     }
   }

   /*responsive css end*/
   table.dataTable thead .sorting_asc {
     background-image: none !important;
   }

   .customer_wrapper button.dt-button:after {
     content: "";
     display: block;
     height: 2px;
     position: absolute;
     width: 0;
     bottom: 0;
     left: 0;
     background-color: #EE2E64;
     transition: width 500ms ease-in-out;
   }

   .customer_wrapper button.dt-button:hover {
     color: #EE2E64;
     border: none;
    border-bottom: 1px solid #EE2E64;
   }

   .customer_wrapper button.dt-button:hover:after {
     width: 100%;
   }

   table.dataTable thead .sorting_desc {
     background-image: none !important;
   }

   table.dataTable thead .sorting {
     background-image: none !important;
   }

   thead {
     background-color: white;
     border-bottom: 1px solid #efecec;
   }

   table {
     margin-top: 20px;
     box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
     border-radius: 8px;
     overflow: hidden;
   }
   thead th input[type="checkbox"] {
     accent-color: #EE2E64 !important;
     cursor: pointer;
   }

   thead tr th:nth-child(1):after,
   thead tr th:nth-child(1):before {
     display: none;
   }

   .bodyContent .colomContent:nth-child(1) {
     padding-left: 0 !important;
   }

   .active_box {
     width: 30px;
     height: 30px;
     background-color: #EE2E64;
     display: flex;
     justify-content: center;
     align-items: center;
     color: white;
     font-size: 15px;
     margin: 0 auto;
     cursor: pointer;
   }

   .subscribed {
    background-color: #e9f9f4;
    padding: 8px 20px;
    border-radius: 4px;
    font-size: 12px;
    color: #448674;
   }

   .not_subscribed {
    background-color: #fdedeb;
    padding: 8px;
    border-radius: 4px;
    color: #a76666;
    font-size: 12px;
   }

   .colomContent a {
     color: #202127;
     text-decoration: none;
   }
   .search_bar .search_box {
     border-radius: 100px;
     padding: 5px;
     background-color: #f5f7fb;
     width: 300px;
     box-sizing: border-box;
     margin-left: auto;
   }

   .search_bar .search_box .search_feild {
     background-color: transparent;
     border: none;
     border-right: 1px solid #8080808c;
     width: 85%;
     font-size: 14px;
     border-radius: 0;
   }

   .search_bar .search_box .search_feild:focus-visible {
     outline: none;
   }

   .search_bar .search_box button {
     border: none;
     background-color: transparent;
     font-size: 16px;
     width: 10%;
     text-align: center;
     color: #8080808c;
   }
   .customer_email {
    text-decoration: none;
    color: black;
   }
   body {
    margin: 0px !important;
   }
 </style>
    <style>  
   body {
     background-color: #f0f2f9;
   }

   .paginate_button {
     border-radius: 0 !important;
   }

   .bodyContent .colomContent {
     padding-left: 18px;
     text-align: left;
   }

   .table.dataTable.stripe tbody tr.odd,
   table.dataTable.display tbody tr.odd {
     background-color: white;
   }

   .table.dataTable.order-column tbody tr>.sorting_1,
   table.dataTable.order-column tbody tr>.sorting_2,
   table.dataTable.order-column tbody tr>.sorting_3,
   table.dataTable.display tbody tr>.sorting_1,
   table.dataTable.display tbody tr>.sorting_2,
   table.dataTable.display tbody tr>.sorting_3 {
     background-color: white !important;
   }

   .table.dataTable.display tbody tr.even>.sorting_1,
   table.dataTable.order-column.stripe tbody tr.even>.sorting_1 {
     background-color: white !important;
   }

   .table.dataTable.row-border tbody th,
   table.dataTable.row-border tbody td,
   table.dataTable.display tbody th,
   table.dataTable.display tbody td {
     background-color: white;
   }

   .table.dataTable.display tbody tr.odd>.sorting_1,
   table.dataTable.order-column.stripe tbody tr.odd>.sorting_1 {
     background-color: white !important;
   }

   table.dataTable.display tbody tr:hover>.sorting_1,
   table.dataTable.order-column.hover tbody tr:hover>.sorting_1 {
     background-color: white !important;
   }

   table.dataTable.display tbody tr.odd>.sorting_1,
   table.dataTable.order-column.stripe tbody tr.odd>.sorting_1 {
     background-color: white !important;
   }

   .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
   .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
   .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
     color: #46474b !important;
     font-size: 14px;
   }

   .dataTables_wrapper .dataTables_paginate .paginate_button.current,
   .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
     color: #46474b;
     font-size: 14px;
   }
   #customerTables{
    width:100% !important;
   }
   #customerTables thead th{
    padding: 10px 5px;
    text-align: left;
    font-size: 14px !important;
    font-weight: 500;
   }
   #customerTables thead th:first-child{
      text-align: center;
   }
    #customerTables tbody td{
      padding: 5px 5px;
      font-size: 14px !important;
    }
    #customerTables tbody td.select-checkbox{
      text-align: center;
    }
    table.dataTable tbody td.select-checkbox:before{
      margin-top:2px;
    }
    
    .pagination{
       display: flex;
       padding: 0;
       list-style: none;
    }
    .pagination li{
      padding: 7px 15px;
      color: black;
    }
    .pagination li a{
      color: black;
    }
    .pagination li.active a{
      color: #EE2E64;
    }
    table.dataTable tr.selected td.select-checkbox::after, table.dataTable tr.selected th.select-checkbox::after{
      content: "✓";
      font-size: 12px;
      text-align: center;
      top: 55%;
      left: 52%;
      transform: translate(-50%, -50%);
      text-shadow: none;
      margin: 0;
      position: absolute;
    }
    table.dataTable tbody td.select-checkbox:before,table.dataTable tbody td.select-checkbox:after{
      display: none;
    }
    .provider_img{
      width: 20px;
      height:20px;
    }
    .fa-user{
      padding-right:10px
    }
@media screen and (min-width: 1440px) {
  #customerTables thead th{
    font-size: 18px !important;
  }
  #customerTables tbody td{
    font-size: 16px !important;
  }
  .customer_wrapper button.dt-button{
    font-size: 16px ;
  }
  .customer_wrapper div.dataTables_wrapper div.dataTables_filter label{
    font-size: 16px ;
  }
}
</style>
    @endsection
  @include('layout.topbar')
  <div class=" customer_wrapper p-0 m-0 container-fluid">
    <div class="containers">
      <div class="table-wrapper">
        <div class="Polaris-Page__Content">
          <div class="Polaris-Card ">
            <div class="Polaris-DataTable">
              <div class="Polaris-DataTable__ScrollContainer" style="padding: 12px;">
                <table id="customerTables" class="display dataTable no-footer" role="grid" aria-describedby="customerTables_info" style="width: 980px;">
                    <thead>
                      <tr role="row">
                        <th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header col1 select-checkbox sorting_disabled sorting_asc" rowspan="1" colspan="1" aria-label="" style="width: 25px;">
                          <button style="border: none; background: transparent; font-size: 14px;" id="selectAll"><i class="far fa-square"></i></button>
                        </th>
                        <th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header export sorting" tabindex="0" aria-controls="customerTables" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending" style="width: 201px;">First Name</th>
                        <th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header export sorting" tabindex="0" aria-controls="customerTables" rowspan="1" colspan="1" aria-label="Email Marketing: activate to sort column ascending" style="width: 103px;">Email Marketing</th>
                        <th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header export sorting" tabindex="0" aria-controls="customerTables" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 224px;">Email</th>
                        <th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header export sorting" tabindex="0" aria-controls="customerTables" rowspan="1" colspan="1" aria-label="Login Provider: activate to sort column ascending" style="width: 94px;">Login Provider</th>
                        <th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header export sorting" tabindex="0" aria-controls="customerTables" rowspan="1" colspan="1" aria-label="Created Date: activate to sort column ascending" style="width: 102px;">Created Date</th>
                        <th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header sorting" tabindex="0" aria-controls="customerTables" rowspan="1" colspan="1" aria-label="Active: activate to sort column ascending" style="width: 43px;">Active</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
  @section('scripts')
    @parent
    @include('layout.footer')
    <script>
      $("body").LoadingOverlay("show");
      $(document).ready(function(){
        setTimeout(function() {
          $("body").LoadingOverlay("hide");
        }, 3000);
        $("ul.nav-links li a").removeClass("active_nav");
        $(".customer_nav").addClass("active_nav"); 
        let myTable = $('#customerTables').DataTable({
          ajax: "customersAjax?action=fetchCustomers&shop={{ Auth::user()->name }}",
          dom: "Bfrtip",
          columnDefs: [{
              orderable: false,
              className: 'select-checkbox',
              targets: 0,
              render: function () {
                return '<i class="far fa-square"></i>';
              }
          }],
          select: {
              style: 'multi',
              selector: 'td:first-child',
          },
          order: [],
          buttons: [
            {
              extend: 'excelHtml5',
              exportOptions: {
                  columns: '.export',
              }
            },
            {
              extend: 'csvHtml5',
              exportOptions: {
                  columns: '.export'
              }
            },
            {
              extend: 'pdfHtml5',
              exportOptions: {
                  columns: '.export'
              }
            }
          
          ],
        });
        $('#selectAll').click(function() {
          if (myTable.rows({
            selected: true
          }).count() > 0) {
            myTable.rows().deselect();
            return;
          }
          myTable.rows().select();
        });
        myTable.on('select deselect', function(e, dt, type, indexes) {
          $('#customerTables tbody tr .select-checkbox i').attr('class', 'far fa-square');
          $('#customerTables tbody tr.selected .select-checkbox i').attr('class', 'far fa-check-square');
          if (type === 'row') {
            // We may use dt instead of myTable to have the freshest data.
            if (dt.rows().count() === dt.rows({
              selected: true
            }).count()) {
              // Deselect all items button.
              $('#selectAll i').attr('class', 'far fa-check-square');
              return;
            }
            if (dt.rows({
              selected: true
            }).count() === 0) {
              // Select all items button.
              $('#selectAll i').attr('class', 'far fa-square');
              return;
            }
            // Deselect some items button.
            $('#selectAll i').attr('class', 'far fa-minus-square');
          }
        });
      });
      function customer(p1, p2) {
        $confirmation_url = 'https://' + p2 + '/admin/customers/' + p1;
        window.open($confirmation_url, '_blank').focus();
      }
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js">
   
  @endsection
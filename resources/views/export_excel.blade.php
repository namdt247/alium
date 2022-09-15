<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export Supplier Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h3 align="center">Export Supplier Data to Excel</h3>
        <div align="center" class="mb-3">
            <a class="btn btn-success" href="{{route('export_excel.excel')}}">
                Export to Excel
            </a>
        </div>
        <div class="table-responsive">
            <table class="tabel table-striped table-bordered">
                <tr>
                    <td>Code</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Phone</td>
                    <td>Address</td>
                    <td>Min quality</td>
                    <td>Max quality</td>
                    <td>Num Employee</td>
                </tr>
                @foreach($supplier_data as $supplier)
                    <tr>
                        <td>{{$supplier->sp_code}}</td>
                        <td>{{$supplier->sp_name}}</td>
                        <td>{{$supplier->sp_email}}</td>
                        <td>{{$supplier->sp_phone}}</td>
                        <td>{{$supplier->sp_location}}</td>
                        <td>{{$supplier->sp_minQuantity}}</td>
                        <td>{{$supplier->sp_maxQuantity}}</td>
                        <td>{{$supplier->sp_numEmployee}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>
</html>
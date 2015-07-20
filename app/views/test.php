

<!doctype html>
<html ng-app="app" xmlns="http://www.w3.org/1999/html">
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular-touch.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular-animate.js"></script>
    <script src="http://ui-grid.info/docs/grunt-scripts/csv.js"></script>
    <script src="http://ui-grid.info/docs/grunt-scripts/pdfmake.js"></script>
    <script src="http://ui-grid.info/docs/grunt-scripts/vfs_fonts.js"></script>
    <script src="../js/angular/ui-grid-unstable.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../js/angular/ui-grid-unstable.min.css">
    <script src="../js/angular/a.js"></script>
    <style>

        .grid {
            width: 600px;
            height: 450px;
        }
    </style>
</head>
<body>
<div ng-controller="MainCtrl">
    <strong>Data Length:</strong> {{ gridOptions.data.length | number }}
    <br>
    <strong>Last Cell Edited:</strong> {{msg.lastCellEdited}}
    <br>
    <div ui-grid="gridOptions" ui-grid-edit class="grid"></div>
    <br>
    <div><strong>Last file uploaded:</strong></div>
    <div>{{lastFile}}</div>
</div>
</body>
</html>
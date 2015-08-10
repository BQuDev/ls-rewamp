var app = angular.module('app', ['ngTouch', 'ui.grid', 'ui.grid.edit', 'ui.grid.cellNav']);
var stack_bottomright = {"dir1": "down", "dir2": "left"};

angular.module('addressFormatter', []).filter('address', function () {
  return function (input) {
      return input.street + ', ' + input.city + ', ' + input.state + ', ' + input.zip;
  };
});
 
app.controller('MainCtrl', ['$scope', '$http', function ($scope, $http) {
  $scope.gridOptions = {
	enableFiltering: true
  };
    $scope.gridOptions.enableCellEditOnFocus = true;

 
  $scope.gridOptions.columnDefs = [
    { name: 'san', enableFiltering: false,enableCellEdit: false, displayName: 'SAN', width: '7%' },
    { name: 'ls_student_number', enableCellEdit: false, displayName: 'LSM Number', width: '10%' },
    { name: 'c1', enableFiltering: false,cellClass:'editable', displayName: 'Range and use of secondary sources', width: '10%' },
    { name: 'c2', enableFiltering: false,cellClass:'editable', displayName: 'Theoretical context' , width: '10%' },
    { name: 'c3', enableFiltering: false,cellClass:'editable', displayName: 'Brand context ', width: '10%'},
    { name: 'c4', enableFiltering: false,cellClass:'editable', displayName: 'Evaluation', width: '8%'},
    { name: 'c5', enableFiltering: false,cellClass:'editable', displayName: 'Quality of presentation', width: '10%'},
    { name: 'c6', enableFiltering: false,cellClass:'editable', displayName: 'Communication of ideas', width: '10%'},
    { name: 'm1', enableFiltering: false, displayName: 'First Marker\'s Mark',enableCellEdit: false, width: '7%'},
    { name: 'm2', enableFiltering: false,cellClass:'editable', displayName: 'Second Marker\'s Mark', width: '8%'},
    { name: 'ageed_mark', enableFiltering: false,cellClass:'editable', displayName: 'Agreed Mark', width: '5%'},
	{name: 'edit', enableFiltering: false, displayName: '', enableCellEdit: false,cellTemplate: '<button id="editBtn" type="button" class="btn btn-success no_padding_btn" ng-click="grid.appScope.edit(row.entity)" >Export</button> '}
	/*
	{ name: 'san', enableCellEdit: false, displayName: 'SAN' },
    { name: 'ls_student_number', enableCellEdit: false, displayName: 'LSM Number' },
    { name: 'c1', displayName: 'Range and use of secondary sources'},
    { name: 'c2', displayName: 'Theoretical context'  },
    { name: 'c3', displayName: 'Brand context '},
    { name: 'c4', displayName: 'Evaluation'},
    { name: 'c5', displayName: 'Quality of presentation'},
    { name: 'c6', displayName: 'Communication of ideas'},
    { name: 'm1', displayName: 'First Marker\'s Mark'},
    { name: 'm2', displayName: 'Second Marker\'s Mark'},
    { name: 'ageed_mark', displayName: 'Agreed Mark'}
	*/
  ];
 
 $scope.msg = {};
 
 $scope.gridOptions.onRegisterApi = function(gridApi){
          //set gridApi on scope
          $scope.gridApi = gridApi;
          gridApi.edit.on.afterCellEdit($scope,function(rowEntity, colDef, newValue, oldValue){
            $scope.msg.lastCellEdited = 'edited row id:' + rowEntity.id + ' Column:' + colDef.name + ' newValue:' + newValue + ' oldValue:' + oldValue ;

			if(!newValue.match(/[^0-9]/)) {
					if(newValue>100){
						
						new PNotify({
                        title: 'Please enter a value less than 100',
                        text: 'Marks cannot exceed 100.Please enter a value less than 100',
                        notice:'error',
                        type : 'error',
                        buttons: {
                            closer: true,
                            sticker: true
                        },
                        animate_speed: 100,
                        opacity: .9,
                        hide: true,
                        stack: stack_bottomright
                    });
					
						
						
						
					}else{

              $scope.$apply();
              // get the form data
              var formData = {
                  san: rowEntity.san,
                  ls_student_number: rowEntity.ls_student_number,
                  col: colDef.name,
                  val:newValue
              };

              // process the form
			  if((oldValue != newValue)/*&&(newValue>0)*/){
          $.ajax({
                  type        : 'POST',
                  url         : 'save_marks_for_IM_A_01_glanced',
                  data        : formData,
                  dataType    : 'json',
                  success     : function(data) {
					  if((data == 1)&&(document.getElementById('auto_refresh').checked)){
						  $http.get('students_for_marks_IM_A_01_glanced')
            .success(function(data) {
                $scope.gridOptions.data = data;
				
				new PNotify({
                        title: 'Marks for '+rowEntity.ls_student_number+' calculated',
                        text: 'Marks Saved to database successfully.',
                        notice:'success',
                        type : 'success',
                        buttons: {
                            closer: true,
                            sticker: true
                        },
                        animate_speed: 100,
                        opacity: .9,
                        hide: true,
                        stack: stack_bottomright
                    });
					
					
            });
					  }
                  }
              });
		  }
					}
					
					}else{
				new PNotify({
                                    title: 'Not a number',
                                    text: 'Please enter number for '+rowEntity.ls_student_number,
                                    notice:'error',
                                    type : 'error',
                                    buttons: {
                                        closer: true,
                                        sticker: true
                                    },
                                    animate_speed: 100,
                                    opacity: .9,
                                    hide: true,
                                    stack: stack_bottomright
                                });
				
			}


          });
        };

    $scope.refreshData = function(){

        $http.get('students_for_marks_IM_A_01_glanced')
            .success(function(data) {
                $scope.gridOptions.data = data;
                
                		new PNotify({
                        title: 'Marks calculated',
                        text: 'Marks successfully calculated with given data.',
                        notice:'success',
                        type : 'success',
                        buttons: {
                            closer: true,
                            sticker: true
                        },
                        animate_speed: 100,
                        opacity: .9,
                        hide: true,
                        stack: stack_bottomright
                    });
                    
            });
    }

    $scope.excel_export = function(){

      
                
                		new PNotify({
                        title: 'Exporting Excel File',
                        text: 'This process will take time, depending on student data',
                        notice:'success',
                        type : 'success',
                        buttons: {
                            closer: true,
                            sticker: true
                        },
                        animate_speed: 100,
                        opacity: .9,
                        hide: true,
                        stack: stack_bottomright
                    });
                    
					 window.open("save_marks_for_IM_A_01_glanced_excel_export", '_blank');
          
}
	
	
    $scope.edit = function(san){

     //  console.log(Object.keys(san).map(function(k) { return san[k] })[0]);
	 /*
	  var formData1 = {
                  san: Object.keys(san).map(function(k) { return san[k] })[0]
              };*/
			  /*
	        $.ajax({
                  type        : 'GET',
                  url         : 'save_marks_for_IM_A_01_glanced_word',
                  data        : formData1,
                  dataType    : 'json',
                  success     : function(data) {
                  }
              });*/
			  console.log("save_marks_for_IM_A_01_glanced_word?san="+Object.keys(san).map(function(k) { return san[k] })[0]+"&export_type="+document.querySelector('input[name="export_type"]:checked').value);
			  //window.location = "save_marks_for_IM_A_01_glanced_word?san="+Object.keys(san).map(function(k) { return san[k] })[0]+"&export_type="+document.querySelector('input[name="export_type"]:checked').value;

    window.open("save_marks_for_IM_A_01_glanced_word?san="+Object.keys(san).map(function(k) { return san[k] })[0]+"&export_type="+document.querySelector('input[name="export_type"]:checked').value, '_blank');
	}



  $http.get('students_for_marks_IM_A_01_glanced')
    .success(function(data) {
      $scope.gridOptions.data = data;
    });
}])











/*

var app = angular.module('app', ['ngTouch', 'ui.grid', 'ui.grid.edit', 'addressFormatter']);

angular.module('addressFormatter', []).filter('address', function () {
  return function (input) {
      return input.street + ', ' + input.city + ', ' + input.state + ', ' + input.zip;
  };
});

app.controller('MainCtrl', ['$scope', '$http', function ($scope, $http) {
  $scope.gridOptions = {  };

  $scope.storeFile = function( gridRow, gridCol, files ) {
    // ignore all but the first file, it can only select one anyway
    // set the filename into this column
    gridRow.entity.filename = files[0].name;

    // read the file and set it into a hidden column, which we may do stuff with later
    var setFile = function(fileContent){
      gridRow.entity.file = fileContent.currentTarget.result;
      // put it on scope so we can display it - you'd probably do something else with it
      $scope.lastFile = fileContent.currentTarget.result;
      $scope.$apply();
    };
    var reader = new FileReader();
    reader.onload = setFile;
    reader.readAsText( files[0] );
  };

  $scope.gridOptions.columnDefs = [
    { name: 'id', enableCellEdit: false, width: '10%' },
    { name: 'name', displayName: 'Name (editable)', width: '20%' },
    { name: 'age', displayName: 'Age' , type: 'number', width: '10%' },
    { name: 'gender', displayName: 'Gender', editableCellTemplate: 'ui-grid/dropdownEditor', width: '20%',
      cellFilter: 'mapGender', editDropdownValueLabel: 'gender', editDropdownOptionsArray: [
      { id: 1, gender: 'male' },
      { id: 2, gender: 'female' }
    ] },
    { name: 'registered', displayName: 'Registered' , type: 'date', cellFilter: 'date:"yyyy-MM-dd"', width: '20%' },
    { name: 'address', displayName: 'Address', type: 'object', cellFilter: 'address', width: '30%' },
    { name: 'address.city', displayName: 'Address (even rows editable)', width: '20%',
         cellEditableCondition: function($scope){
         return $scope.rowRenderIndex%2
         }
    },
    { name: 'isActive', displayName: 'Active', type: 'boolean', width: '10%' },
    { name: 'pet', displayName: 'Pet', width: '20%', editableCellTemplate: 'ui-grid/dropdownEditor',
      editDropdownRowEntityOptionsArrayPath: 'foo.bar[0].options', editDropdownIdLabel: 'value'
    },
    { name: 'filename', displayName: 'File', width: '20%', editableCellTemplate: 'ui-grid/fileChooserEditor',
      editFileChooserCallback: $scope.storeFile }
  ];

 $scope.msg = {};

 $scope.gridOptions.onRegisterApi = function(gridApi){
          //set gridApi on scope
          $scope.gridApi = gridApi;
          gridApi.edit.on.afterCellEdit($scope,function(rowEntity, colDef, newValue, oldValue){
            $scope.msg.lastCellEdited = 'edited row id:' + rowEntity.id + ' Column:' + colDef.name + ' newValue:' + newValue + ' oldValue:' + oldValue ;
            $scope.$apply();
          });
        };

  $http.get('../500_complex.json')
    .success(function(data) {
      for(i = 0; i < data.length; i++){
        data[i].registered = new Date(data[i].registered);
        data[i].gender = data[i].gender==='male' ? 1 : 2;
        if (i % 2) {
          data[i].pet = 'fish'
          data[i].foo = {bar: [{baz: 2, options: [{value: 'fish'}, {value: 'hamster'}]}]}
        }
        else {
          data[i].pet = 'dog'
          data[i].foo = {bar: [{baz: 2, options: [{value: 'dog'}, {value: 'cat'}]}]}
        }
      }
      $scope.gridOptions.data = data;
    });
}])

.filter('mapGender', function() {
  var genderHash = {
    1: 'male',
    2: 'female'
  };

  return function(input) {
    if (!input){
      return '';
    } else {
      return genderHash[input];
    }
  };
})
;*/

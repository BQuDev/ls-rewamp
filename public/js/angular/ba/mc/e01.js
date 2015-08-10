var app = angular.module('app', ['ngTouch', 'ui.grid', 'ui.grid.edit', 'ui.grid.cellNav']);
var stack_bottomright = {"dir1": "down", "dir2": "left"};

angular.module('addressFormatter', []).filter('address', function () {
  return function (input) {
      return input.street + ', ' + input.city + ', ' + input.state + ', ' + input.zip;
  };
});
 
app.controller('MainCtrl', ['$scope', '$http', function ($scope, $http) {
  $scope.gridOptions = {
	enableFiltering: true,
	fastWatch: true,
	flatEntityAccess: true,
	enableRowSelection: true,
	enableColumnResizing: true,
  };
    $scope.gridOptions.enableCellEditOnFocus = true;

 
  $scope.gridOptions.columnDefs = [
    { name: 'scj_number', enableCellEdit: false, displayName: 'ARU SID', width: '10%' },
    { name: 'ls_student_number', enableCellEdit: false, displayName: 'LSM', width: '10%' },
    { name: 'forename_1', enableCellEdit: false, displayName: 'Name', width: '10%' },
    { name: 'c1', type: 'number', enableFiltering: false,cellClass:'editable', displayName: 'Criteria 1', cellTooltip: 
        function( row, col ) {
          return 'Introduction include an outline of the company,Their current position in the market,Clearly identified client problem, Implications for the business if the problem is not addressed';
        }, headerTooltip: 
        function( col ) {
          return 'Introduction include an outline of the company,Their current position in the market,Clearly identified client problem, Implications for the business if the problem is not addressed';
        }
	},
    { name: 'c2', type: 'number', enableFiltering: false,cellClass:'editable', displayName: 'Criteria 2' , cellTooltip: 
        function( row, col ) {
          return 'Situation analysis of the market include a review of the market using suitable models (e.g. STEEPLE; SWOT McKinsey 7s, etc.)';
        }, headerTooltip: 
        function( col ) {
		  return 'Situation analysis of the market include a review of the market using suitable models (e.g. STEEPLE; SWOT McKinsey 7s, etc.)';
        }
	},
    { name: 'm1', type: 'number', enableFiltering: false, displayName: 'First Marker\'s Mark',enableCellEdit: false},
    { name: 'm2', type: 'number', enableFiltering: false,cellClass:'editable', displayName: 'Second Marker\'s Mark' },
    { name: 'ageed_mark', type: 'number', enableFiltering: false,cellClass:'editable', displayName: 'Agreed Mark' },
	/*{name: 'sele', enableFiltering: false, enableSorting: false, displayName: '', l: false,type: 'boolean',editableCellTemplate:'<div class="checkbox i-checks"><label><input type="checkbox" value="{{ row.entity.san }}" name="{{ row.entity.san }}" ng-click="grid.appScope.edit1(row.entity)" checked><i></i></label></div>',cellTemplate: '<div class="checkbox i-checks"><label><input type="checkbox" value="{{ row.entity.san }}" name="{{ row.entity.san }}" ng-click="grid.appScope.edit1(row.entity)" ><i></i></label></div>'},*/
	{name: 'sample',displayName: 'Sample', enableFiltering: false, cellFilter: 'mapGender', width: '5%', enableSorting: false, editDropdownValueLabel: 'gender', editableCellTemplate: 'ui-grid/dropdownEditor', editDropdownOptionsArray: [
      { id: 1, gender: 'Sample' }
    ]},
	{name: 'edit', enableFiltering: false, enableSorting: false, displayName: '',  enableCellEdit: false,cellTemplate: '<button id="editBtn" type="button" class="btn btn-success no_padding_btn" ng-click="grid.appScope.edit(row.entity)" >Export</button> '}
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

			//if(!newValue.match(/[^0-9]/)) { 

			
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
                  url         : 'save_marks_for_MC_A_01',
                  data        : formData,
                  dataType    : 'json',
                  success     : function(data) {
					  if((data == 1)&&(document.getElementById('auto_refresh').checked)){
						  $http.get('students_for_marks_MC_A_01')
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
					}}
			/*}else{
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
				
			}*/


          });
        };

    $scope.refreshData = function(){

        $http.get('students_for_marks_MC_A_01')
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
                    
					 window.open("save_marks_for_MC_A_01_excel_export", '_blank');
          
}
	
	$scope.edit1 = function(san){
		console.log(san);
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
                  url         : 'save_marks_for_MC_A_01_glanced_word',
                  data        : formData1,
                  dataType    : 'json',
                  success     : function(data) {
                  }
              });*/
			//  console.log("save_marks_for_IM_A_02_word?san="+Object.keys(san).map(function(k) { return san[k] })[0]+"&export_type="+document.querySelector('input[name="export_type"]:checked').value);
			  //console.log("save_marks_for_IM_A_02_word?san="+Object.keys(san).map(function(k) { return san[k] })[0]+"&export_type="+document.querySelector('input[name="export_type"]:checked').value);
			  //window.location = "save_marks_for_MC_A_01_glanced_word?san="+Object.keys(san).map(function(k) { return san[k] })[0]+"&export_type="+document.querySelector('input[name="export_type"]:checked').value;

    //window.open("save_marks_for_IM_A_02_word?san="+Object.keys(san).map(function(k) { return san[k] })[0]+"&export_type="+document.querySelector('input[name="export_type"]:checked').value, '_blank');
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();

if(dd<10) {
    dd='0'+dd
} 

if(mm<10) {
    mm='0'+mm
} 

today = dd+'-'+mm+'-'+yyyy;
	window.open("save_marks_for_MC_A_01_word?san="+Object.keys(san).map(function(k) { return san[k] })[0]+"&export_type=word&d="+today, '_blank');
	}



  $http.get('students_for_marks_MC_A_01')
    .success(function(data) {
      $scope.gridOptions.data = data;
	  
	 
    });
}]).filter('mapGender', function() {
  var genderHash = {
    1: 'Sample'
  };
 
  return function(input) {
    if (!input){
      return '';
    } else {
      return genderHash[input];
    }
  };
});


$(function() {
	$('.grid').css( "height" ,(($('#content').height()-100)+'px'));
});


function dummysave(){
	                		new PNotify({
                        title: 'Data Saved Sccessfully',
                        text: 'All the data saved successfully to the system',
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
}

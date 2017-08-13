<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>book of complaints</title>
	<link href="/template/css/style.css" rel="stylesheet">
	<script src="/template/js/jquery-3.2.1.min.js"></script>
	<script src="/template/js/react.min.js"></script>
    <script src="/template/js/react-dom.min.js"></script>
    <script src="/template/js/browser.min.js"></script>
</head>
<body>

	<script>

		// $(document).ready(function(){
		// 	$(".pagination li").click(function () {
		// 		var id = $(this).attr("data-id");

  //           //alert("data-id = " + id);
  //           $.post("/ajax/page-"+id, {}, function (data) {
  //           	if(data){
  //              	    //JSON.parse(data);
  //   					alert("Прибыли данные: " + data); //user['name']
  //   				}
  //   			});
  //           return false;
  //       });
		// });



		$(document).ready(function(){
			$(".pagination li").click(function () {
				var id = $(this).attr("data-id");
				//$(this).addClass('active');
				//alert("data-id = " + id);
				$.ajax({
					url:"/test/page-"+id,
					type: 'POST',
					//type:'GET',
					//dataType: 'json',
					//data:{},
					//data: json,
					contentType: 'application/json; charset=utf-8',
					success: function(data){
						var arr = JSON.parse(data);
						if(data){


							//-----------------
							// alert("Данные: " + data);
							//alert("Данные: " + arr.length);
							var len = arr.length;
							$('#hidden').val(len);
							for(let i=0; i<len; i++){

								$('#tr'+i+'>td:nth-child(1)').text(arr[i]['name']);
								$('#tr'+i+'>td:nth-child(2)').text(arr[i]['email']);
								$('#tr'+i+'>td:nth-child(3)').text(arr[i]['dateComment']);
								$('#tr'+i+'>td:nth-child(4)').text(arr[i]['ip']);
								$('#tr'+i+'>td:nth-child(5)').text(arr[i]['browser']);
								$('#tr'+i+'>td:nth-child(6)').text(arr[i]['textComment']);
								// //alert("Array: " + arr[i]);
								// for(var prop in arr[i]){    //arr[i]  is obj
								// 	//alert(arr[i][prop]);

								// }
							}

							// // arr.forEach(function(obj, i, arr) {
							// // 	for(var prop in obj[i]){
							// // 		alert(obj[i][prop]);
							// // 	}
							// // });
							//--------------------------

						}
					},
					// complete: function(len){
     //                    // alert("OOps");
     //                    // $.post('ajaxview.php', { hidd:len}, function (data) {

     //                    // });
                   // }
 });
				return false;
			});
		});



		// $(document).ready(function(){
		// 	$(".pagination li").click(function () {
		// 		var id = $(this).attr("data-id");

  //           //alert("data-id = " + id);
  //           $.getJSON("/ajax/page-"+id ,{}, function (data) {
  //           	if(data){
  //              	    //JSON.parse(data);
  //   					alert("Прибыли данные: " + data); //user['name']
  //   				}
  //   			});
  //           return false;
  //       });
		// });


		// $.getJSON( "ajax/test.json", function( data ) {
		// 	var items = [];
		// 	$.each( data, function( key, val ) {
		// 		items.push( "<li id='" + key + "'>" + val + "</li>" );
		// 	});

		// 	$( "<ul/>", {
		// 		"class": "my-new-list",
		// 		html: items.join( "" )
		// 	}).appendTo( "body" );
		// });


	</script>

<script type="text/babel">


</script>
 <!--   <input type="hidden" name = "hidd" id = "hidden"> -->

<div id = "forTable"></div>

	<table>

		<tr id = "tr">
			<th>
				<center> name </center>
			</th>
			<th>
				<center> email </center>
			</th>
			<th>
				<center> date </center>
			</th>
			<th>
				<center> ip </center>
			</th>
			<th>
				<center> browser </center>
			</th>
			<th>
				<center> text</center>
			</th>
		</tr>
    <?php for ($i = 0; $i < 5; $i++): ?>
			<tr id="tr<?php echo $i; ?>">
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
			</tr>
		<?php endfor;?>

	</table> <br>

	<?php echo '<br>' . $_POST['hidd'] ?>

	<?php //var_dump($users)?>

	<!-- Постраничная навигация -->
	<?php echo $pagination->get(); ?><br><br>


	<a href="/book">Book of complaints</a><br>



</body>

</html>
<!-- required -->

